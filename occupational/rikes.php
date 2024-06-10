<?php
include '../koneksi.php';
session_start();

$dateFilter = isset($_GET['date']) ? $_GET['date'] : null;

$records = [];
$totalMs = 0;
$totalTms = 0;
$cumulativeMsBefore = []; // Total kumulatif MS sebelumnya per awak sarana
$cumulativeTmsBefore = []; // Total kumulatif TMS sebelumnya per awak sarana

// Query untuk mendapatkan nilai unik tahun, bulan, dan tanggal dari kolom date di tabel records
$sql = "SELECT DISTINCT YEAR(date) AS year, MONTH(date) AS month, DAY(date) AS day FROM records";
$result = $conn->query($sql);

if ($dateFilter) {
    // Menguraikan tanggal untuk digunakan dalam binding parameter
    $explodedDate = explode('-', $dateFilter);
    $year = $explodedDate[0];
    $month = $explodedDate[1];
    $day = $explodedDate[2];

    // Query untuk mendapatkan data pada tanggal yang difilter
    $sqlFiltered = "SELECT s.name AS station_name, c.name AS crew_name, r.ms, r.tms
                    FROM records r
                    JOIN stations s ON r.station_id = s.id
                    JOIN crew c ON r.crew_id = c.id
                    WHERE DAY(r.date) = ? AND MONTH(r.date) = ? AND YEAR(r.date) = ?";
    $stmt = $conn->prepare($sqlFiltered);
    $stmt->bind_param("iii", $day, $month, $year);
    $stmt->execute();
    $resultFiltered = $stmt->get_result();

    // Memasukkan hasil query ke dalam array records dan menghitung total MS dan TMS
    while ($row = $resultFiltered->fetch_assoc()) {
        $records[] = $row;
        $totalMs += $row['ms'];
        $totalTms += $row['tms'];
    }
    $stmt->close();

    // Query untuk mendapatkan jumlah kumulatif sebelumnya per awak sarana
    $sqlCumulativeBefore = "SELECT c.name AS crew_name, SUM(r.ms) AS cumulative_ms, SUM(r.tms) AS cumulative_tms
                            FROM records r
                            JOIN crew c ON r.crew_id = c.id
                            WHERE DATE(r.date) < ?
                            GROUP BY c.name";
    $stmtCumulativeBefore = $conn->prepare($sqlCumulativeBefore);
    $stmtCumulativeBefore->bind_param("s", $dateFilter);
    $stmtCumulativeBefore->execute();
    $resultCumulativeBefore = $stmtCumulativeBefore->get_result();
    while ($rowCumulativeBefore = $resultCumulativeBefore->fetch_assoc()) {
        $cumulativeMsBefore[$rowCumulativeBefore['crew_name']] = $rowCumulativeBefore['cumulative_ms'] ?? 0;
        $cumulativeTmsBefore[$rowCumulativeBefore['crew_name']] = $rowCumulativeBefore['cumulative_tms'] ?? 0;
    }
    $stmtCumulativeBefore->close();
}

// Query untuk mendapatkan tahun unik dari kolom date
$sqlYears = "SELECT DISTINCT YEAR(date) AS year FROM records ORDER BY year";
$resultYears = $conn->query($sqlYears);

// Query untuk mendapatkan bulan unik dari kolom date
$sqlMonths = "SELECT DISTINCT MONTH(date) AS month, YEAR(date) AS year FROM records ORDER BY year, month";
$resultMonths = $conn->query($sqlMonths);

// Query untuk mendapatkan tanggal unik dari kolom date
$sqlDates = "SELECT DISTINCT DAY(date) AS day, MONTH(date) AS month, YEAR(date) AS year FROM records ORDER BY year, month, day";
$resultDates = $conn->query($sqlDates);
$year = isset($_GET['year']) ? intval($_GET['year']) : null;
$month = isset($_GET['month']) ? intval($_GET['month']) : null;
$day = isset($_GET['day']) ? intval($_GET['day']) : null;

$records = [];
$totalMs = 0;
$totalTms = 0;

if ($year && $month && $day) {
    $dateFilter = sprintf('%04d-%02d-%02d', $year, $month, $day);

    $sqlFiltered = "SELECT s.name AS station_name, c.name AS crew_name, r.ms, r.tms
                    FROM records r
                    JOIN stations s ON r.station_id = s.id
                    JOIN crew c ON r.crew_id = c.id
                    WHERE DATE(r.date) = ?";
    $stmt = $conn->prepare($sqlFiltered);
    $stmt->bind_param("s", $dateFilter);
    $stmt->execute();
    $resultFiltered = $stmt->get_result();

    while ($row = $resultFiltered->fetch_assoc()) {
        $records[] = $row;
        $totalMs += $row['ms'];
        $totalTms += $row['tms'];
    }
    $stmt->close();
}
$stationNames = [];
$groupedRecords = [];

if (!empty($records)) {
    $stationNames = array_unique(array_column($records, 'station_name'));

    // Mengelompokkan data berdasarkan awak sarana
    foreach ($records as $record) {
        $groupedRecords[$record['crew_name']][$record['station_name']] = $record;
    }
}


// Menghitung total per stasiun untuk header
$totalsPerStation = [];
foreach ($stationNames as $stationName) {
    $totalsPerStation[$stationName]['ms'] = array_sum(array_column(array_filter($records, function ($record) use ($stationName) {
        return $record['station_name'] == $stationName;
    }), 'ms'));
    $totalsPerStation[$stationName]['tms'] = array_sum(array_column(array_filter($records, function ($record) use ($stationName) {
        return $record['station_name'] == $stationName;
    }), 'tms'));
}

// Mendapatkan tanggal yang tersedia jika tahun dan bulan dipilih
$days = [];
if (isset($_GET['year']) && isset($_GET['month'])) {
    $month = $_GET['month'];
    $sqlDates = "SELECT DISTINCT DAY(date) AS day FROM records WHERE YEAR(date) = ? AND MONTH(date) = ? ORDER BY day";
    $stmtDates = $conn->prepare($sqlDates);
    $stmtDates->bind_param("ii", $year, $month);
    $stmtDates->execute();
    $resultDates = $stmtDates->get_result();

    while ($rowDate = $resultDates->fetch_assoc()) {
        $days[] = $rowDate;
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/logo1.png">
    <title>Unit Kesehatan | Daop 7 Madiun
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />

    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <!-- <style>
        .icon-white {
            filter: brightness(0) invert(1);
        }

        /* CSS */
        .toggle-button {
            margin-left: 10px;
            /* atur jarak antara tombol dan teks */
        }

        .text-capitalize {
            margin-right: 10px;
            /* atur jarak antara teks dan tombol */
        }

        .centered-cell {
            text-align: center;
            vertical-align: middle;
        }

        .shortened-form .input-group {
            max-width: 300px;
        }

        .shortened-form .form-control {
            max-width: 500px;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #A3D8FF;
            color: black;
        }

        .jumlah-row td {
            font-weight: bold;
        }


        /* tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #ddd;
        }

        .table-responsive {
            overflow-x: auto;
        } */

        /* .jumlah-row td {
            font-weight: bold;
            border: 1px solid #ddd;
        } */

        #nilaiPieChart {
            width: 300px !important;
            height: 300px !important;
        }

        #pieChartCanvas2 {
            width: 300px !important;
            height: 300px !important;
        }

        /* #nilaiPieChart ,
        #pieChartCanvas2 {
            width: 300px !important;
            height: 300px !important;
        } */
        .centered-cell {
            text-align: center;
        }

        #chartContainer,
        #dataTable {
            display: none;
        }

        textarea {
            white-space: pre-wrap;
        }
    </style> -->
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #A3D8FF;
            color: black;
        }

        .centered-cell {
            text-align: center;
        }

        #profilTable td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
            /* Sesuaikan nilai ini sesuai kebutuhan */
        }

        .table-responsive {
            max-width: 100%;
            overflow-x: auto;
        }

        .icon-white {
            filter: brightness(0) invert(1);
        }
    </style>


</head>

<body class="g-sidenav-show  bg-gray-200">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script>
        $(document).ready(function() {
            $('#year').change(function() {
                const selectedYear = $(this).val();
                $('#month').empty().append('<option value="" selected>Pilih Bulan</option>');
                $('#day').empty().append('<option value="" selected>Pilih Tanggal</option>').prop('disabled', true);
                $('#day').empty().append('<option value="" selected>Pilih Tanggal</option>').prop('disabled', true);
                if (selectedYear) {
                    // Enable dropdown bulan
                    $('#month').prop('disabled', false);
                    // Lakukan AJAX request untuk mendapatkan bulan-bulan yang sesuai dengan tahun yang dipilih
                    $.ajax({
                        type: 'GET',
                        url: 'get_months.php',
                        data: {
                            year: selectedYear
                        },
                        success: function(response) {
                            $('#month').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", status, error);
                        }
                    });
                } else {
                    $('#month').prop('disabled', true);
                    $('#day').prop('disabled', true);
                }
            });

            $('#month').change(function() {
                const selectedMonth = $(this).val();
                const selectedYear = $('#year').val();


                if (selectedMonth && selectedYear) {
                    // Enable dropdown tanggal
                    $('#day').prop('disabled', false);
                    // Lakukan AJAX request untuk mendapatkan tanggal-tanggal yang sesuai dengan tahun dan bulan yang dipilih
                    $.ajax({
                        type: 'GET',
                        url: 'get_dates.php',
                        data: {
                            year: selectedYear,
                            month: selectedMonth
                        },
                        success: function(response) {
                            $('#day').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error:", status, error);
                        }
                    });
                } else {
                    $('#day').prop('disabled', true);
                }
            });
        });
    </script> -->
    <!-- <script>
        // Tambahkan event listener untuk pemilihan tahun dan bulan
        document.getElementById('year').addEventListener('change', updateDaysDropdown);
        document.getElementById('month').addEventListener('change', updateDaysDropdown);

        // Fungsi untuk memperbarui dropdown tanggal
        function updateDaysDropdown() {
            var year = document.getElementById('year').value;
            var month = document.getElementById('month').value;

            // Kirim permintaan AJAX ke server untuk mendapatkan tanggal yang sesuai
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_days.php?year=' + year + '&month=' + month, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Isi elemen dropdown tanggal dengan data yang diterima dari server
                    document.getElementById('day').innerHTML = xhr.responseText;
                    // Aktifkan dropdown tanggal setelah diisi
                    document.getElementById('day').removeAttribute('disabled');
                }
            };
            xhr.send();
        }
    </script> -->
    <!-- <script>
        document.getElementById('month').addEventListener('change', function() {
            if (this.value) {
                document.getElementById('day').disabled = false;
            } else {
                document.getElementById('day').disabled = true;
            }
        });
    </script> -->

    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="services.php" target="_blank">
                <span class="ms-1 font-weight-bold text-white">Occupational Health</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <!-- <li class="nav-item">
                    <a class="nav-link text-white  " href="occupational.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link text-white " href="flyer.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white  " href="hasilmcu.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class=""><img src="gambar/doctor-consultation.png" alt="" width="20" height="20"></i>
                        </div>
                        <span class="nav-link-text ms-1">Hasil MCU</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="kebugaran.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class=""><img src="gambar/hospital.png" alt="" width="20" height="20"></i>
                        </div>
                        <span class="nav-link-text ms-1">Hasil Tes Kebugaran</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white active" href="rikes.php" style="background-color: #A3D8FF;">
                        <div class=" text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class=""><img src="gambar/health-report.png" alt="" width="20" height="20"></i>
        </div>
        <span class="nav-link-text ms-1">Hasil Rikes</span>
        </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white " href="narkoba.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class=""><img src="../assets/img/icon/cardiogram.png" alt="" width="20" height="20" class="icon-white"></i>
                </div>

                <span class="nav-link-text ms-1">Hasil Tes Narkoba</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white " href="promo.php">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class=""><img src="gambar/marketing.png" alt="" width="20" height="20" class="icon-white"></i>
                </div>

                <span class="nav-link-text ms-1">Kesehatan Kerja</span>
            </a>
        </li>
        </ul>
        </div>
        <div class="sidenav-footer position-absolute w-100 bottom-0 ">
            <div class="mx-3">
                <a class="btn w-100" href="../index.php" type="button" style="background-color: #A3D8FF; color:black;"> Kembali</a>
            </div>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                </nav>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>

        </nav>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">

                            <div class="border-radius-lg pt-4 pb-3" style="background-color: #A3D8FF;">
                                <h6 class="text-capitalize ps-3">Awak KA</h6>
                            </div>
                            <br><br>
                            <a href="tambah_awak.php">
                                <i class="fa-solid"><img src="../assets/img/icon/plus.png" alt="" width="30" height="30"></i>
                            </a>
                            <br>
                            <form method="GET" action="rikes.php">
                                <div class="row justify-content-center">
                                    <div class="col-md-2">
                                        <select name="year" id="year" class="form-control" required>
                                            <option value="" selected>Pilih Tahun</option>
                                            <?php
                                            // Loop untuk menampilkan opsi tahun
                                            while ($rowYear = $resultYears->fetch_assoc()) {
                                                echo "<option value=\"" . $rowYear['year'] . "\">" . $rowYear['year'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="month" id="month" class="form-control" required>
                                            <option value="" selected>Pilih Bulan</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <select name="day" id="day" class="form-control" required>
                                            <option value="" selected>Pilih Tanggal</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button id="search-button" class="btn" type="submit" style="background-color: #A3D8FF;">Cari</button>
                                    </div>
                                </div>
                            </form>

                            <script>
                                // Fungsi untuk mengambil bulan-bulan yang sesuai dengan tahun yang dipilih
                                function getMonths() {
                                    var year = document.getElementById('year').value;
                                    var xhttp;
                                    if (year == "") {
                                        document.getElementById("month").innerHTML = "<option value=''>Pilih Bulan</option>";
                                        return;
                                    }
                                    xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function() {
                                        if (this.readyState == 4 && this.status == 200) {
                                            document.getElementById("month").innerHTML = this.responseText;
                                            // Panggil fungsi getDays() setelah bulan diambil
                                            getDays();
                                        }
                                    };
                                    xhttp.open("GET", "get_months.php?year=" + year, true);
                                    xhttp.send();
                                }

                                // Fungsi untuk mengambil tanggal-tanggal yang sesuai dengan tahun dan bulan yang dipilih
                                function getDays() {
                                    var year = document.getElementById('year').value;
                                    var month = document.getElementById('month').value;
                                    var xhttp;
                                    if (year == "" || month == "") {
                                        document.getElementById("day").innerHTML = "<option value=''>Pilih Tanggal</option>";
                                        return;
                                    }
                                    xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function() {
                                        if (this.readyState == 4 && this.status == 200) {
                                            document.getElementById("day").innerHTML = this.responseText;
                                        }
                                    };
                                    xhttp.open("GET", "get_dates.php?year=" + year + "&month=" + month, true);
                                    xhttp.send();
                                }

                                // Panggil fungsi getMonths() saat pemilihan tahun berubah
                                document.getElementById('year').addEventListener('change', getMonths);

                                // Panggil fungsi getDays() saat pemilihan bulan berubah
                                document.getElementById('month').addEventListener('change', getDays);
                            </script>


                            <?php if (!empty($groupedRecords)) : ?>
                                <div class="table-responsive p-0">
                                    <table class="table">
                                        <?php if ($dateFilter) : ?>
                                            <div class="mb-3"> Data Tanggal: <?php echo date('d F Y', strtotime($dateFilter)); ?></div>
                                        <?php endif; ?>
                                        <thead style="background-color: #A3D8FF; color:black;">
                                            <tr>
                                                <th style="border-collapse:collapse; border: 1px solid black;">Awak Sarana</th>
                                                <?php foreach ($stationNames as $stationName) : ?>
                                                    <th colspan="2" style="border-collapse:collapse; border: 1px solid black;"><?php echo $stationName; ?></th>
                                                <?php endforeach; ?>
                                                <th colspan="2" style="border-collapse:collapse; border: 1px solid black;">Jumlah Hari Ini</th>
                                                <th colspan="2" style="border-collapse:collapse; border: 1px solid black;">Kumulatif</th>
                                                <th colspan="2" style="border-collapse:collapse; border: 1px solid black;">Action</th>
                                            </tr>
                                            <tr>
                                                <th style="border-collapse:collapse; border: 1px solid black;"></th>
                                                <?php foreach ($stationNames as $stationName) : ?>
                                                    <th style="border-collapse:collapse; border: 1px solid black;">MS</th>
                                                    <th style="border-collapse:collapse; border: 1px solid black;">TMS</th>
                                                <?php endforeach; ?>
                                                <th style="border-collapse:collapse; border: 1px solid black;">MS</th>
                                                <th style="border-collapse:collapse; border: 1px solid black;">TMS</th>
                                                <th style="border-collapse:collapse; border: 1px solid black;">MS</th>
                                                <th style="border-collapse:collapse; border: 1px solid black;">TMS</th>
                                                <th colspan="2" style="border-collapse:collapse; border: 1px solid black;">
                                                    <!-- Tambahkan ikon untuk edit -->

                                                    <a href="edit.php?date=<?php echo urlencode($dateFilter); ?>">
                                                        <img src="../assets/img/icon/pen.png" alt="Edit" width="30" height="30">
                                                    </a>

                                                    <!-- Tambahkan ikon untuk hapus -->
                                                    <script>
                                                        function confirmDelete() {
                                                            return confirm("Apakah Anda yakin ingin menghapus semua data pada tanggal ini?");
                                                        }
                                                    </script>

                                                    <a href="hapus_awak.php?date=<?php echo urlencode($dateFilter); ?>" onclick="return confirmDelete()">
                                                        <img src="../assets/img/icon/bin.png" alt="Delete" width="30" height="30">
                                                    </a>

                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            // Query untuk mendapatkan jumlah kumulatif sebelumnya per awak sarana
                                            $sqlCumulativeBefore = "SELECT c.name AS crew_name, SUM(r.ms) AS cumulative_ms, SUM(r.tms) AS cumulative_tms
                            FROM records r
                            JOIN crew c ON r.crew_id = c.id
                            WHERE DATE(r.date) < ?
                            GROUP BY c.name";
                                            $stmtCumulativeBefore = $conn->prepare($sqlCumulativeBefore);
                                            $stmtCumulativeBefore->bind_param("s", $dateFilter);
                                            $stmtCumulativeBefore->execute();
                                            $resultCumulativeBefore = $stmtCumulativeBefore->get_result();
                                            $cumulativeMsBefore = [];
                                            $cumulativeTmsBefore = [];
                                            while ($rowCumulativeBefore = $resultCumulativeBefore->fetch_assoc()) {
                                                $cumulativeMsBefore[$rowCumulativeBefore['crew_name']] = $rowCumulativeBefore['cumulative_ms'] ?? 0;
                                                $cumulativeTmsBefore[$rowCumulativeBefore['crew_name']] = $rowCumulativeBefore['cumulative_tms'] ?? 0;
                                            }
                                            $stmtCumulativeBefore->close();

                                            // Inisialisasi total untuk "Jumlah Hari Ini"
                                            $totalMsHariIni = 0;
                                            $totalTmsHariIni = 0;

                                            // Inisialisasi total kumulatif
                                            $totalCumulativeMsBefore = array_sum($cumulativeMsBefore);
                                            $totalCumulativeTmsBefore = array_sum($cumulativeTmsBefore);

                                            // Inisialisasi total per stasiun
                                            $totalsPerStation = [];
                                            foreach ($stationNames as $stationName) {
                                                $totalsPerStation[$stationName]['ms'] = 0;
                                                $totalsPerStation[$stationName]['tms'] = 0;
                                            }

                                            // Proses data per awak sarana
                                            foreach ($groupedRecords as $crewName => $stations) {
                                                // Ambil total MS dan TMS hari ini
                                                $totalMsToday = array_sum(array_column($stations, 'ms'));
                                                $totalTmsToday = array_sum(array_column($stations, 'tms'));

                                                // Tambahkan total kumulatif sebelumnya
                                                $totalMsBefore = $cumulativeMsBefore[$crewName] ?? 0;
                                                $totalTmsBefore = $cumulativeTmsBefore[$crewName] ?? 0;

                                                $totalMsKumulatif = $totalMsToday + $totalMsBefore;
                                                $totalTmsKumulatif = $totalTmsToday + $totalTmsBefore;

                                                // Tambahkan kolom kumulatif ke dalam array $stations
                                                $groupedRecords[$crewName]['kumulatif'] = [
                                                    'ms' => $totalMsKumulatif,
                                                    'tms' => $totalTmsKumulatif
                                                ];

                                                // Tambahkan ke total "Jumlah Hari Ini"
                                                $totalMsHariIni += $totalMsToday;
                                                $totalTmsHariIni += $totalTmsToday;

                                                // Tambahkan ke total per stasiun
                                                foreach ($stationNames as $stationName) {
                                                    if (isset($stations[$stationName])) {
                                                        $totalsPerStation[$stationName]['ms'] += $stations[$stationName]['ms'];
                                                        $totalsPerStation[$stationName]['tms'] += $stations[$stationName]['tms'];
                                                    }
                                                }

                                                $groupedRecords[$crewName]['hariini'] = [
                                                    'ms' => $totalMsToday,
                                                    'tms' => $totalTmsToday
                                                ];
                                            }
                                            ?>

                                            <?php foreach ($groupedRecords as $crewName => $stations) : ?>
                                                <tr style="border-collapse:collapse; border: 1px solid black;">
                                                    <td><?php echo htmlspecialchars($crewName); ?></td>
                                                    <?php foreach ($stationNames as $stationName) : ?>
                                                        <td style="border-collapse:collapse; border: 1px solid black;"><?php echo isset($stations[$stationName]) ? htmlspecialchars($stations[$stationName]['ms']) : '-'; ?></td>
                                                        <td style="border-collapse:collapse; border: 1px solid black;"><?php echo isset($stations[$stationName]) ? htmlspecialchars($stations[$stationName]['tms']) : '-'; ?></td>
                                                    <?php endforeach; ?>
                                                    <td style="border-collapse:collapse; border: 1px solid black;"><?php echo $stations['hariini']['ms'] ?? '-'; ?></td>
                                                    <td style="border-collapse:collapse; border: 1px solid black;"><?php echo $stations['hariini']['tms'] ?? '-'; ?></td>
                                                    <td style="border-collapse:collapse; border: 1px solid black;"><?php echo $stations['kumulatif']['ms'] ?? '-'; ?></td>
                                                    <td style="border-collapse:collapse; border: 1px solid black;"><?php echo $stations['kumulatif']['tms'] ?? '-'; ?></td>
                                                    <td style="border-collapse:collapse; border: 1px solid black;"></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                        <tfoot>
                                            <tr class="jumlah-row">
                                                <th>Total</th>
                                                <?php foreach ($stationNames as $stationName) : ?>
                                                    <th><?php echo $totalsPerStation[$stationName]['ms']; ?></th>
                                                    <th><?php echo $totalsPerStation[$stationName]['tms']; ?></th>
                                                <?php endforeach; ?>
                                                <th><?php echo $totalMsHariIni; ?></th>
                                                <th><?php echo $totalTmsHariIni; ?></th>
                                                <th><?php echo $totalCumulativeMsBefore + $totalMsHariIni; ?></th>
                                                <th><?php echo $totalCumulativeTmsBefore + $totalTmsHariIni; ?></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>

                                        <!-- <tfoot>
                                            <tr class="jumlah-row">
                                                <th>Total</th>
                                                <?php foreach ($stationNames as $stationName) : ?>
                                                    <th><?php echo $totalsPerStation[$stationName]['ms']; ?></th>
                                                    <th><?php echo $totalsPerStation[$stationName]['tms']; ?></th>
                                                <?php endforeach; ?>
                                                <th><?php echo $totalMsHariIni; ?></th>
                                                <th><?php echo $totalTmsHariIni; ?></th>
                                                <th><?php echo $totalCumulativeMsBefore + $totalMsHariIni; ?></th>
                                                <th><?php echo $totalCumulativeTmsBefore + $totalTmsHariIni; ?></th>
                                                <th></th>
                                            </tr>
                                        </tfoot> -->
                                    </table>
                                    <?php 
                                    // Ambil tahun dan bulan yang dipilih dari parameter GET
                                    $selectedYear = $_GET['year']; // Contoh: 2024
                                    $selectedMonth = $_GET['month']; // Contoh: 05 (untuk Mei)

                                    // Inisialisasi total kumulatif MS dan TMS untuk bulan yang dipilih
                                    $totalKumulatifMs = 0;
                                    $totalKumulatifTms = 0;

                                    // Query untuk mengambil tanggal-tanggal unik dari data yang tersedia dalam bulan yang dipilih
                                    $sqlDates = "SELECT DISTINCT DATE(date) AS tanggal FROM records WHERE YEAR(date) = ? AND MONTH(date) = ?";
                                    $stmtDates = $conn->prepare($sqlDates);
                                    $stmtDates->bind_param("ss", $selectedYear, $selectedMonth);
                                    $stmtDates->execute();
                                    $resultDates = $stmtDates->get_result();

                                    // Loop melalui setiap tanggal unik dalam bulan yang dipilih
                                    while ($rowDate = $resultDates->fetch_assoc()) {
                                        // Ambil tanggal dalam format YYYY-MM-DD
                                        $date = $rowDate['tanggal'];

                                        // Query untuk mengambil data MS dan TMS untuk tanggal tersebut
                                        $sql = "SELECT SUM(ms) AS total_ms, SUM(tms) AS total_tms FROM records WHERE DATE(date) = ?";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("s", $date);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $row = $result->fetch_assoc();

                                        // Tambahkan total MS dan TMS ke dalam total kumulatif
                                        $totalKumulatifMs += $row['total_ms'];
                                        $totalKumulatifTms += $row['total_tms'];
                                    }



                                    ?>

                                    
                                       <h5 class="card-title">Jumlah Kumulatif MS dan TMS untuk Bulan <?php echo date("F Y", mktime(0, 0, 0, $selectedMonth, 1, $selectedYear)); ?></h5>
                                       <div class="row">
                                        <div class="col-md-4">
                                                <div class="card" style="background-color: #A3D8FF;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">MS</h5>
                                                        <p class="card-text" style="font-weight:bold; color:black;"><?php echo $totalKumulatifMs; ?></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-body" style="background-color: rgba(255, 99, 132, 0.6); border-radius:10px;">
                                                        <h5 class="card-title">TMS</h5>
                                                        <p class="card-text" style="font-weight:bold; color:black;"><?php echo $totalKumulatifTms; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <br>
                                </div>
                            <?php else : ?>
                                <p>Tidak ada data untuk tanggal yang dipilih.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>


        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="border-radius-lg pt-4 pb-3" style="background-color: #A3D8FF;">
                                <h6 class="text-capitalize ps-3">Sertifikasi</h6>
                            </div>
                            <br>
                            <a href="tambah_sertif.php">
                                <i class="fa-solid"><img src="../assets/img/icon/plus.png" alt="" width="30" height="30"></i>
                            </a>
                            <br>
                            <?php
                            $query2 = "SELECT DISTINCT tanggal AS tahun FROM sertifikasi";
                            $result2 = mysqli_query($conn, $query2);

                            $tahunOptions1 = [];
                            $selectedTahun = isset($_GET['tahun_sertifikasi']) && isset($_GET['action_sertifikasi']) && $_GET['action_sertifikasi'] == 'sertifikasi' ? $_GET['tahun_sertifikasi'] : '';

                            while ($row1 = mysqli_fetch_assoc($result2)) {
                                $tahunOptions1[] = $row1['tahun'];
                            }
                            ?>

                            <form action="rikes.php" method="GET">
                                <input type="hidden" name="action_sertifikasi" value="sertifikasi">
                                <div class="row justify-content-center">
                                    <div class="col-md-2">
                                        <select name="tahun_sertifikasi" class="form-control" id="tahunSelectSertifikasi">
                                            <option value="" selected>Pilih Tahun</option>
                                            <?php
                                            sort($tahunOptions1);

                                            foreach ($tahunOptions1 as $tahunOption1) : ?>
                                                <option value="<?php echo $tahunOption1; ?>" <?php echo $selectedTahun == $tahunOption1 ? 'selected' : ''; ?>>
                                                    <?php echo $tahunOption1; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button id="search-button" class="btn" type="submit" style="background-color: #A3D8FF;">Cari</button>
                                    </div>
                                </div>
                            </form>

                            <?php
                            $showTable = false;
                            if ($selectedTahun && $_GET['action_sertifikasi'] == 'sertifikasi') {
                                $query3 = "SELECT * FROM sertifikasi WHERE tanggal = '$selectedTahun'";
                                $query3 .= " ORDER BY CASE 
                        WHEN periode LIKE '%jan%' THEN 1
                        WHEN periode LIKE '%feb%' THEN 2
                        WHEN periode LIKE '%mar%' THEN 3
                        WHEN periode LIKE '%apr%' THEN 4
                        WHEN periode LIKE '%mei%' THEN 5
                        WHEN periode LIKE '%jun%' THEN 6
                        WHEN periode LIKE '%jul%' THEN 7
                        WHEN periode LIKE '%aug%' OR periode LIKE '%agus%' THEN 8
                        WHEN periode LIKE '%sep%' THEN 9
                        WHEN periode LIKE '%okt%' OR periode LIKE '%oct%' THEN 10
                        WHEN periode LIKE '%nov%' THEN 11
                        WHEN periode LIKE '%des%' OR periode LIKE '%dec%' THEN 12
                        ELSE 13
                    END";
                                $result3 = mysqli_query($conn, $query3);
                                $showTable = true;

                                $totalNilaiA = 0;
                                $totalNilaiB = 0;
                                $totalNilaiC = 0;
                                $totalNilaiD = 0;
                            }
                            ?>

                            <?php if ($showTable) : ?>
                                <div class="table-responsive p-0" style="overflow-x: auto;">
                                    <div id="dataTable" style="display: block;">
                                        <table id="profilTable" class="table">
                                            <thead>
                                                <tr style="background-color: #A3D8FF;">
                                                    <th rowspan="2" class="centered-cell" style="text-align: center; border:1px solid black;">No</th>
                                                    <!-- <th rowspan="2" class="centered-cell" style="text-align: center; border:1px solid black;">Tanggal</th> -->
                                                    <th rowspan="2" class="centered-cell" style="text-align: center; border:1px solid black;">Periode</th>
                                                    <th rowspan="2" class="centered-cell" style="text-align: center; border:1px solid black;">Uraian</th>
                                                    <th rowspan="2" class="centered-cell" style="text-align: center; border:1px solid black;">Unit Kerja</th>
                                                    <th colspan="4" class="centered-cell" style="text-align: center; border:1px solid black;">Nilai</th>
                                                    <th style="width: 100px;text-align: center; border:1px solid black;" rowspan="2" class="centered-cell">Action</th>
                                                </tr>
                                                <tr style="background-color: #A3D8FF;">
                                                    <th style="border:1px solid black;">A</th>
                                                    <th style="border:1px solid black;">B</th>
                                                    <th style="border:1px solid black;">C</th>
                                                    <th style="border:1px solid black;">D</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($showTable) {
                                                    $i = 1;
                                                    while ($row1 = mysqli_fetch_assoc($result3)) {
                                                        $totalNilaiA += isset($row1['nilai_a']) ? $row1['nilai_a'] : 0;
                                                        $totalNilaiB += isset($row1['nilai_b']) ? $row1['nilai_b'] : 0;
                                                        $totalNilaiC += isset($row1['nilai_c']) ? $row1['nilai_c'] : 0;
                                                        $totalNilaiD += isset($row1['nilai_d']) ? $row1['nilai_d'] : 0;
                                                ?>
                                                        <tr>
                                                            <td style="border:1px solid black;"><?php echo $i; ?></td>
                                                            <!-- <td style="border:1px solid black;"><?php echo isset($row1['tanggal']) ? date('d-m-Y', strtotime($row1['tanggal'])) : ''; ?></td> -->
                                                            <td style="border:1px solid black;"><?php echo isset($row1['periode']) ? $row1['periode'] : ''; ?></td>
                                                            <td style="white-space: pre-wrap;border:1px solid black;"><?php echo isset($row1['uraian']) ? $row1['uraian'] : ''; ?></td>
                                                            <td style="white-space: pre-wrap;border:1px solid black;"><?php echo isset($row1['unit']) ? $row1['unit'] : ''; ?></td>
                                                            <td style="border:1px solid black;"><?php echo isset($row1['nilai_a']) ? $row1['nilai_a'] : 0; ?></td>
                                                            <td style="border:1px solid black;"><?php echo isset($row1['nilai_b']) ? $row1['nilai_b'] : 0; ?></td>
                                                            <td style="border:1px solid black;"><?php echo isset($row1['nilai_c']) ? $row1['nilai_c'] : 0; ?></td>
                                                            <td style="border:1px solid black;"><?php echo isset($row1['nilai_d']) ? $row1['nilai_d'] : 0; ?></td>
                                                            <td style="border:1px solid black;">
                                                                <center>
                                                                    <a href="edit_sertif.php?id=<?php echo isset($row1['id']) ? $row1['id'] : ''; ?>">
                                                                        <img src="../assets/img/icon/pen.png" alt="" width="30" height="30">
                                                                    </a>
                                                                    <a href="hapus_sertif.php?id=<?php echo isset($row1['id']) ? $row1['id'] : ''; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                                        <img src="../assets/img/icon/bin.png" alt="" width="30" height="30">
                                                                    </a>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                <?php
                                                        $i++;
                                                    }
                                                }
                                                ?>
                                            </tbody>

                                            <tfoot>
                                                <tr>
                                                    <th colspan="4" style="text-align:left; background-color:white;">Total :</th>
                                                    <th style="background-color:white;"><?php echo $totalNilaiA; ?></th>
                                                    <th style="background-color:white;"><?php echo $totalNilaiB; ?></th>
                                                    <th style="background-color:white;"><?php echo $totalNilaiC; ?></th>
                                                    <th style="background-color:white;"><?php echo $totalNilaiD; ?></th>
                                                    <th style="background-color:white;"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <!-- Chart Containers -->
                                <div class="row">
                                    <!-- Chart -->
                                    <div class="col-md-4 mx-auto">
                                        <canvas id="pieChart"></canvas>
                                    </div>

                                    <!-- Tabel Total Nilai -->
                                    <div class="col-md-4 mx-auto">
                                        <table id="totalTable" class="table" style="margin-top: 20px; color:black;">
                                            <thead>
                                                <tr style="background-color: #CFE8A9;">
                                                    <th class="centered-cell" style="text-align: center; border:1px solid black;">Nilai</th>
                                                    <th class="centered-cell" style="text-align: center; border:1px solid black;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr style="background-color: rgba(255, 99, 132, 0.6);">
                                                    <td style="border:1px solid black;">A</td>
                                                    <td style="border:1px solid black;"><?php echo $totalNilaiA; ?></td>
                                                </tr>
                                                <tr style="background-color:rgba(54, 162, 235, 0.6);">
                                                    <td style="border:1px solid black;">B</td>
                                                    <td style="border:1px solid black;"><?php echo $totalNilaiB; ?></td>
                                                </tr>
                                                <tr style="background-color:rgba(255, 206, 86, 0.6);">
                                                    <td style="border:1px solid black;">C</td>
                                                    <td style="border:1px solid black;"><?php echo $totalNilaiC; ?></td>
                                                </tr>
                                                <tr style="background-color: rgba(75, 192, 192, 0.6);">
                                                    <td style="border:1px solid black;">D</td>
                                                    <td style="border:1px solid black;"><?php echo $totalNilaiD; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <br>

                            <?php else : ?>
                                <!-- <p>Tidak ada data untuk tahun yang dipilih.</p> -->
                            <?php endif; ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // var barCtx = document.getElementById('barChart').getContext('2d');
                var pieCtx = document.getElementById('pieChart').getContext('2d');

                var data = {
                    labels: ['A', 'B', 'C', 'D'],
                    datasets: [{
                        label: 'Total Nilai',
                        data: [<?php echo $totalNilaiA; ?>, <?php echo $totalNilaiB; ?>, <?php echo $totalNilaiC; ?>, <?php echo $totalNilaiD; ?>],
                        backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)', 'rgba(75, 192, 192, 0.6)'],
                        borderColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)', 'rgba(75, 192, 192, 0.6)'],
                        borderWidth: 1
                    }]
                };

                var pieChart = new Chart(pieCtx, {
                    type: 'pie',
                    data: data
                });
            });
        </script>



        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="border-radius-lg pt-4 pb-3" style="background-color: #A3D8FF;">
                                <h6 class="text-capitalize ps-3">Rikes Khusus</h6>
                            </div>
                            <br>
                            <a href="tambah_rikes.php">
                                <i class="fa-solid"><img src="../assets/img/icon/plus.png" alt="" width="30" height="30"></i>
                            </a>
                            <br>
                            <?php
                            $query3 = "SELECT DISTINCT year(tanggal) AS tahun FROM rikes";
                            $result3 = mysqli_query($conn, $query3);

                            $tahunOptions2 = [];
                            $selectedTahun1 = isset($_GET['tahun_rikes']) ? $_GET['tahun_rikes'] : '';

                            while ($row2 = mysqli_fetch_assoc($result3)) {
                                $tahunOptions2[] = $row2['tahun'];
                            }
                            ?>

                            <form action="rikes.php" method="GET">
                                <input type="hidden" name="action_rikes" value="rikes"> <!-- Tambahkan input tersembunyi untuk parameter 'action' -->
                                <div class="row justify-content-center">
                                    <div class="col-md-2">
                                        <select name="tahun_rikes" class="form-control" id="tahunSelectRikes">
                                            <option value="" selected>Pilih Tahun</option>
                                            <?php
                                            sort($tahunOptions2);

                                            foreach ($tahunOptions2 as $tahunOption2) : ?>
                                                <option value="<?php echo $tahunOption2; ?>" <?php echo $selectedTahun1 == $tahunOption2 ? 'selected' : ''; ?>>
                                                    <?php echo $tahunOption2; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button id="search-button" class="btn" type="submit" style="background-color: #A3D8FF;">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <?php
                                $showTable2 = isset($_GET['action_rikes']) && $_GET['action_rikes'] == 'rikes' && !empty($selectedTahun1);

                                if ($showTable2) {
                                    // Add ORDER BY clause to sort by 'tanggal' in ascending order
                                    $query4 = "SELECT * FROM rikes WHERE year(tanggal) = '$selectedTahun1' ORDER BY tanggal ASC";
                                    $result4 = mysqli_query($conn, $query4);
                                }
                                ?>
                                <?php if ($showTable2) : ?>
                                    <table id="profilTable" style="text-align: center; margin-left:10px; margin-right:10px;">
                                        <thead style="background-color:#A3D8FF;color:white">
                                            <tr>
                                                <th class="centered-cell">No</th>
                                                <th class="centered-cell">Tanggal</th>
                                                <th class="centered-cell">Nipp</th>
                                                <th class="centered-cell">Nama</th>
                                                <th class="centered-cell">Unit</th>
                                                <th class="centered-cell">Jabatan</th>
                                                <th class="centered-cell">Kedudukan</th>
                                                <th class="centered-cell">Kelas</th>
                                                <th class="centered-cell">Nilai</th>
                                                <th style="width: 100px;" class="centered-cell">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($showTable2) {
                                                $i = 1;
                                                while ($row2 = mysqli_fetch_assoc($result4)) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($row2['tanggal'])); ?></td>
                                                        <td><?php echo $row2['nipp']; ?></td>
                                                        <td style="white-space: normal;"><?php echo $row2['nama']; ?></td>
                                                        <td style="white-space: normal;"><?php echo $row2['unit']; ?></td>
                                                        <td style="white-space: normal;"><?php echo $row2['jabatan']; ?></td>
                                                        <td style="white-space: normal;"><?php echo $row2['kedudukan']; ?></td>
                                                        <td><?php echo $row2['kelas']; ?></td>
                                                        <td><?php echo $row2['nilai']; ?></td>
                                                        <td>
                                                            <center>
                                                                <a href="edit_rikes.php?id=<?php echo isset($row2['id']) ? $row2['id'] : ''; ?>">
                                                                    <img src="../assets/img/icon/pen.png" alt="" width="30" height="30">
                                                                </a>
                                                                <a href="hapus_rikes.php?id=<?php echo isset($row2['id']) ? $row2['id'] : ''; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                                    <img src="../assets/img/icon/bin.png" alt="" width="30" height="30">
                                                                </a>
                                                            </center>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $i++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table><br>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if ($showTable2) : ?>
                            <canvas style="margin-left:10px; margin-right:10px;" id="gradeChart" width="800" height="400"></canvas>
                            <?php
                            if ($showTable2) {
                                $query4 = "SELECT nilai, COUNT(*) as count FROM rikes WHERE year(tanggal) = '$selectedTahun1' GROUP BY nilai";
                                $result4 = mysqli_query($conn, $query4);

                                // Initialize counts
                                $gradeCounts = ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0];

                                // Fetch results and calculate total counts for each grade
                                while ($row = mysqli_fetch_assoc($result4)) {
                                    $gradeCounts[$row['nilai']] = $row['count'];
                                }
                            }
                            ?>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var ctx = document.getElementById('gradeChart').getContext('2d');
                                    var gradeChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: ['A', 'B', 'C', 'D'],
                                            datasets: [{
                                                label: 'Nilai',
                                                data: [
                                                    <?php echo $gradeCounts['A']; ?>,
                                                    <?php echo $gradeCounts['B']; ?>,
                                                    <?php echo $gradeCounts['C']; ?>,
                                                    <?php echo $gradeCounts['D']; ?>
                                                ],
                                                backgroundColor: [
                                                    'rgba(75, 192, 192, 0.2)',
                                                    'rgba(54, 162, 235, 0.2)',
                                                    'rgba(255, 206, 86, 0.2)',
                                                    'rgba(255, 99, 132, 0.2)'
                                                ],
                                                borderColor: [
                                                    'rgba(75, 192, 192, 1)',
                                                    'rgba(54, 162, 235, 1)',
                                                    'rgba(255, 206, 86, 1)',
                                                    'rgba(255, 99, 132, 1)'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    min: 0, // Mulai dari 0
                                                    max: 300, // Maksimum adalah 30
                                                    stepSize: 50 // Langkah antara setiap nilai
                                                }
                                            }
                                        }
                                    });
                                });
                            </script>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>





        <footer class="footer py-4  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            by
                            <a href="#" class="font-weight-bold" target="_blank">PT Kereta Api Indonesia.</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="material-icons py-2">settings</i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Material UI Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3 d-flex">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-3">
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
                <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard-pro">Free Download</a>
                <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View documentation</a>
                <div class="w-100 text-center">
                    <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
                    <h6 class="mt-3">Thank you for sharing!</h6>
                    <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fetch the total values from PHP
            var totalNilaiA = <?php echo $totalNilaiA; ?>;
            var totalNilaiB = <?php echo $totalNilaiB; ?>;
            var totalNilaiC = <?php echo $totalNilaiC; ?>;
            var totalNilaiD = <?php echo $totalNilaiD; ?>;

            // Get the context of the canvas element we want to select
            var ctx = document.getElementById('nilaiPieChart').getContext('2d');

            // Create the pie chart
            var nilaiPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Nilai A', 'Nilai B', 'Nilai C', 'Nilai D'],
                    datasets: [{
                        label: 'Total Nilai',
                        data: [totalNilaiA, totalNilaiB, totalNilaiC, totalNilaiD],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)'
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    // maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script> -->
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>