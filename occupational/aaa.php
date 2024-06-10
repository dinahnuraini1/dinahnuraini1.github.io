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
    <script>
        $(document).ready(function() {
            $('#year').change(function() {
                const selectedYear = $(this).val();
                $('#month').empty().append('<option value="" selected>Pilih Bulan</option>');
                $('#day').empty().append('<option value="" selected>Pilih Tanggal</option>').prop('disabled', true);

                if (selectedYear) {
                    // Enable dropdown bulan
                    $('#month').prop('disabled', false);
                    // Lakukan AJAX request untuk mendapatkan bulan-bulan yang sesuai dengan tahun yang dipilih
                    $.ajax({
                        type: 'GET',
                        url: 'get_months.php', // Perbaiki URL ke file get_months.php
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
                $('#day').empty().append('<option value="" selected>Pilih Tanggal</option>');

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
    </script>

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
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class=""><img src="gambar/health-report.png" alt="" width="20" height="20"></i>
                        </div>
                        <span class="nav-link-text ms-1">Jumlah Rikes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="promo.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class=""><img src="gambar/marketing.png" alt="" width="20" height="20" class="icon-white"></i>
                        </div>

                        <span class="nav-link-text ms-1">Promotive and Preventive</span>
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
                                        <select name="month" id="month" class="form-control" required disabled>
                                            <option value="" selected>Pilih Bulan</option>
                                            <?php
                                            // Loop untuk menampilkan opsi bulan
                                            while ($rowMonth = $resultMonths->fetch_assoc()) {
                                                echo "<option value=\"" . $rowMonth['month'] . "\">" . date('F', mktime(0, 0, 0, $rowMonth['month'], 1)) . "</option>";
                                            }
                                            $resultMonths->data_seek(0);
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <select name="day" id="day" class="form-control" required disabled>
                                            <option value="" selected>Pilih Tanggal</option>
                                            <!-- Opsi tanggal akan diisi dengan AJAX -->
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button id="search-button" class="btn" type="submit" style="background-color: #A3D8FF;">Cari</button>
                                    </div>
                                </div>
                            </form>
                            <?php if (!empty($groupedRecords)) : ?>
                                <div class="table-responsive p-0">
                                    <table class="table">
                                        <thead style="background-color: #A3D8FF; color:black;">
                                            <tr>
                                                <th style="border-collapse:collapse; border: 1px solid black;">Awak Sarana</th>
                                                <?php foreach ($stationNames as $stationName) : ?>
                                                    <th colspan="2" style="border-collapse:collapse; border: 1px solid black;"><?php echo $stationName; ?></th>
                                                <?php endforeach; ?>
                                                <th colspan="2" style="border-collapse:collapse; border: 1px solid black;">Jumlah Hari Ini</th>
                                                <th colspan="2" style="border-collapse:collapse; border: 1px solid black;">Kumulatif</th>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cumulativeMsBefore = [];
                                            $cumulativeTmsBefore = [];

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


                                            // Inisialisasi total kumulatif
                                            $totalCumulativeMsBefore = 0;
                                            $totalCumulativeTmsBefore = 0;

                                            // Hitung total kumulatif
                                            foreach ($cumulativeMsBefore as $ms) {
                                                $totalCumulativeMsBefore += $ms;
                                            }
                                            foreach ($cumulativeTmsBefore as $tms) {
                                                $totalCumulativeTmsBefore += $tms;
                                            }

                                            // Tambahkan Kolom Kumulatif ke Tabel
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
                                            }
                                            $totalMs = 0;
                                            $totalTms = 0;
                                            // Tambahkan Kolom Kumulatif ke Tabel
                                            foreach ($groupedRecords as $crewName => $stations) {
                                                // Ambil total MS dan TMS hari ini
                                                $totalMsToday = array_sum(array_column($stations, 'ms'));
                                                $totalTmsToday = array_sum(array_column($stations, 'tms'));
                                                // Tambahkan ke total "Jumlah Hari Ini"
                                                $totalMs += $totalMsToday;
                                                $totalTms += $totalTmsToday;
                                            }
                                            foreach ($groupedRecords as $crewName => $stations) : ?>
                                                <tr style="border-collapse:collapse; border: 1px solid black;">
                                                    <td><?php echo htmlspecialchars($crewName); ?></td>
                                                    <?php foreach ($stationNames as $stationName) : ?>
                                                        <td style="border-collapse:collapse; border: 1px solid black;"><?php echo isset($stations[$stationName]) ? htmlspecialchars($stations[$stationName]['ms']) : '-'; ?></td>
                                                        <td style="border-collapse:collapse; border: 1px solid black;"><?php echo isset($stations[$stationName]) ? htmlspecialchars($stations[$stationName]['tms']) : '-'; ?></td>
                                                    <?php endforeach; ?>
                                                    <td style="border-collapse:collapse; border: 1px solid black;"><?php echo array_sum(array_column($stations, 'ms')); ?></td>
                                                    <td style="border-collapse:collapse; border: 1px solid black;"><?php echo array_sum(array_column($stations, 'tms')); ?></td>
                                                    <td style="border-collapse:collapse; border: 1px solid black;"><?php echo $totalCumulativeMsBefore; ?></td>
                                                    <td style="border-collapse:collapse; border: 1px solid black;"><?php echo $totalCumulativeTmsBefore; ?></td>
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
                                                <th><?php echo $totalMs; ?></th>
                                                <th><?php echo $totalTms; ?></th>
                                                <th><?php echo $totalCumulativeMsBefore; ?></th>
                                                <th><?php echo $totalCumulativeTmsBefore; ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
                            $query2 = "SELECT DISTINCT year(tanggal) AS tahun FROM sertifikasi";
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
                                $query3 = "SELECT * FROM sertifikasi WHERE YEAR(tanggal) = '$selectedTahun' ORDER BY tanggal ASC";

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
                                                <!-- <th class="centered-cell">Tanggal</th> -->
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
                                                        <!-- <td><?php echo date('d-m-Y', strtotime($row2['tanggal'])); ?></td> -->
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
                                                    max: 30, // Maksimum adalah 30
                                                    stepSize: 10 // Langkah antara setiap nilai
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

<?php if (!empty($groupedRecords)) : ?>
    <div class="table-responsive p-0">
        <table class="table">
            <thead style="background-color: #A3D8FF; color:black;">
                <tr>
                    <th style="border-collapse:collapse; border: 1px solid black;">Awak Sarana</th>
                    <?php foreach ($stationNames as $stationName) : ?>
                        <th colspan="2" style="border-collapse:collapse; border: 1px solid black;"><?php echo $stationName; ?></th>
                    <?php endforeach; ?>
                    <th colspan="2" style="border-collapse:collapse; border: 1px solid black;">Jumlah Hari Ini</th>
                    <th colspan="2" style="border-collapse:collapse; border: 1px solid black;">Kumulatif</th>
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
                while ($rowCumulativeBefore = $resultCumulativeBefore->fetch_assoc()) {
                    $cumulativeMsBefore[$rowCumulativeBefore['crew_name']] = $rowCumulativeBefore['cumulative_ms'] ?? 0;
                    $cumulativeTmsBefore[$rowCumulativeBefore['crew_name']] = $rowCumulativeBefore['cumulative_tms'] ?? 0;
                }
                $stmtCumulativeBefore->close();

                // Initialize totals for "Jumlah Hari Ini"
                $totalMs = 0;
                $totalTms = 0;

                // Initialize cumulative totals
                $totalCumulativeMsBefore = 0;
                $totalCumulativeTmsBefore = 0;

                // Calculate total cumulative before the selected date
                foreach ($cumulativeMsBefore as $ms) {
                    $totalCumulativeMsBefore += $ms;
                }
                foreach ($cumulativeTmsBefore as $tms) {
                    $totalCumulativeTmsBefore += $tms;
                }

                foreach ($groupedRecords as $crewName => $stations) : ?>
                    <tr style="border-collapse:collapse; border: 1px solid black;">
                        <td><?php echo htmlspecialchars($crewName); ?></td>
                        <?php foreach ($stationNames as $stationName) : ?>
                            <td style="border-collapse:collapse; border: 1px solid black;"><?php echo isset($stations[$stationName]) ? htmlspecialchars($stations[$stationName]['ms']) : '-'; ?></td>
                            <td style="border-collapse:collapse; border: 1px solid black;"><?php echo isset($stations[$stationName]) ? htmlspecialchars($stations[$stationName]['tms']) : '-'; ?></td>
                        <?php endforeach; ?>
                        <td style="border-collapse:collapse; border: 1px solid black;"><?php echo array_sum(array_column($stations, 'ms')); ?></td>
                        <td style="border-collapse:collapse; border: 1px solid black;"><?php echo array_sum(array_column($stations, 'tms')); ?></td>
                        <td style="border-collapse:collapse; border: 1px solid black;"><?php echo $cumulativeMsBefore[$crewName] ?? '-'; ?></td>
                        <td style="border-collapse:collapse; border: 1px solid black;"><?php echo $cumulativeTmsBefore[$crewName] ?? '-'; ?></td>
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
                    <th>
                        <?php
                        // Calculate the total MS for "Jumlah Hari Ini"
                        $totalMsHariIni = 0;
                        foreach ($groupedRecords as $stations) {
                            $totalMsHariIni += array_sum(array_column($stations, 'ms'));
                        }
                        echo $totalMsHariIni;
                        ?>
                    </th>
                    <th>
                        <?php
                        // Calculate the total TMS for "Jumlah Hari Ini"
                        $totalTmsHariIni = 0;
                        foreach ($groupedRecords as $stations) {
                            $totalTmsHariIni += array_sum(array_column($stations, 'tms'));
                        }
                        echo $totalTmsHariIni;
                        ?>
                    </th>
                    <th><?php echo $totalCumulativeMsBefore + $totalMsHariIni; ?></th>
                    <th><?php echo $totalCumulativeTmsBefore + $totalTmsHariIni; ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
<?php else : ?>
    <!-- <p>Tidak ada data untuk tanggal yang dipilih.</p> -->
<?php endif; ?>

<?php
// Include file koneksi ke database
include '../koneksi.php';

session_start();
if (isset($_SESSION['error_message'])) {
    // Menampilkan pesan kesalahan menggunakan alert JavaScript
    echo "<script>alert('{$_SESSION['error_message']}');</script>";

    // Hapus pesan kesalahan setelah ditampilkan
    unset($_SESSION['error_message']);
}
// Cek apakah parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    // Tangkap nilai id dari parameter URL
    $id = $_GET['id'];

    // Query untuk mendapatkan data pekerja berdasarkan id
    $query = "SELECT * FROM kebugaran WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    // Cek apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Ambil data pekerja dari hasil query
        $row = mysqli_fetch_assoc($result);
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1.0" name="viewport">

            <title>Edit Data Pekerja</title>
            <meta content="" name="description">
            <meta content="" name="keywords">

            <!-- Favicons -->
            <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
            <link rel="icon" type="image/png" href="../assets/img/logo1.png">


            <!-- Google Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

            <!-- Vendor CSS Files -->
            <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
            <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
            <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
            <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
            <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

            <!-- Template Main CSS File -->
            <link href="../assets/css/main2.css" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


            <!-- =======================================================
  * Template Name: UpConstruction - v1.2.1
  * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
        </head>

        <body class="bgimg">
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const realisasiInput = document.getElementById("realisasi");
                    const nilaiInputs = document.querySelectorAll(".nilai-input");
                    const totalWarning = document.getElementById("totalWarning");
                    const form = document.getElementById("nilaiForm");
                    const bulanInput = document.getElementById("bulan");
                    const tanggalInput = document.getElementById("tahun");
                    const bulanTahunWarning = document.getElementById("bulanTahunWarning");

                    // This should be populated from server-side to include all existing combinations
                    const existingEntries = [{
                            year: "2024",
                            month: "Januari"
                        },
                        // Add other existing entries here
                    ];

                    function checkTotal() {
                        let total = 0;
                        nilaiInputs.forEach(input => {
                            total += parseInt(input.value) || 0;
                        });
                        return total;
                    }

                    function checkDuplicate() {
                        // const selectedYear = tahunInput.value;
                        const selectedMonth = bulanInput.value;
                        return existingEntries.some(entry => entry.year === selectedYear && entry.month === selectedMonth);
                    }

                    form.addEventListener("submit", function(event) {
                        const realisasiValue = parseInt(realisasiInput.value) || 0;
                        const totalNilai = checkTotal();

                        if (totalNilai !== realisasiValue || checkDuplicate()) {
                            event.preventDefault();
                            if (totalNilai !== realisasiValue) {
                                totalWarning.style.display = "block";
                            } else {
                                totalWarning.style.display = "none";
                            }
                            if (checkDuplicate()) {
                                bulanTahunWarning.style.display = "block";
                            } else {
                                bulanTahunWarning.style.display = "none";
                            }
                        } else {
                            totalWarning.style.display = "none";
                            bulanTahunWarning.style.display = "none";
                        }
                    });

                    nilaiInputs.forEach(input => {
                        input.addEventListener("input", function() {
                            const realisasiValue = parseInt(realisasiInput.value) || 0;
                            const totalNilai = checkTotal();

                            if (totalNilai !== realisasiValue) {
                                totalWarning.style.display = "block";
                            } else {
                                totalWarning.style.display = "none";
                            }
                        });
                    });

                    realisasiInput.addEventListener("input", function() {
                        const realisasiValue = parseInt(realisasiInput.value) || 0;
                        const totalNilai = checkTotal();

                        if (totalNilai !== realisasiValue) {
                            totalWarning.style.display = "block";
                        } else {
                            totalWarning.style.display = "none";
                        }
                    });

                    bulanInput.addEventListener("input", function() {
                        if (checkDuplicate()) {
                            bulanTahunWarning.style.display = "block";
                        } else {
                            bulanTahunWarning.style.display = "none";
                        }
                    });

                    // tahunInput.addEventListener("input", function() {
                    //     if (checkDuplicate()) {
                    //         bulanTahunWarning.style.display = "block";
                    //     } else {
                    //         bulanTahunWarning.style.display = "none";
                    //     }
                    // });
                });
            </script>
            <div class="container">

                <!-- Outer Row -->
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12 col-md-9">
                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                    <div class="col-lg-12 text-center" style="padding-top:20px;"><img style="width: 100px;" src="../assets/img/logo1.png"></div>
                                    <div class="col-lg-12">
                                        <div class="p-3 pb-4 pt-4">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Edit Hasil Tes Kebugaran</h1>
                                            </div>

                                            <form class="user" method="post" action="proses_edit_kebugaran.php" onsubmit="return validateForm()" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control form-control-user" name=" id" value="<?php echo $row['id']; ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="tanggal">Tanggal:</label>
                                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo ($row['tanggal']); ?>">

                                                </div><br>
                                                <div class="form-group">
                                                    <label for="periode">Periode:</label>
                                                    <input type="text" class="form-control form-control-user" id="periode" name="periode" value="<?php echo ($row['periode']); ?>">

                                                </div><br>

                                                <div class="form-group">
                                                    <label for="program">Program:</label>
                                                    <input type="number" class="form-control" id="program" name="program" value="<?php echo $row['program']; ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="realisasi">Realisasi:</label>
                                                    <input type="number" class="form-control" id="realisasi" name="realisasi" value="<?php echo $row['realisasi']; ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="nilaiA">Nilai A:</label>
                                                    <input type="number" class="form-control" id="nilaiA" name="nilai_a" value="<?php echo $row['nilai_a']; ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="nilaiB">Nilai B:</label>
                                                    <input type="number" class="form-control" id="nilaiB" name="nilai_b" value="<?php echo $row['nilai_b']; ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="nilaiC">Nilai C:</label>
                                                    <input type="number" class="form-control" id="nilaiC" name="nilai_c" value="<?php echo $row['nilai_c']; ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="nilaiD">Nilai D:</label>
                                                    <input type="number" class="form-control" id="nilaiD" name="nilai_d" value="<?php echo $row['nilai_d']; ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <p id="totalWarning" style="color: red; display: none;">Total nilai harus berjumlah sama dengan nilai Realisasi!</p>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="pdfFile">File PDF:</label>
                                                    <?php if (!empty($row['pdf'])) : ?>
                                                        <p><a href="<?php echo $row['pdf']; ?>" target="_blank">Lihat PDF </a></p>
                                                    <?php endif; ?>
                                                    <input type="file" class="form-control-file" id="pdfFile" name="pdf_file" accept="application/pdf">
                                                    <p style="color: red; font-style:italic;">*max 5MB</p>
                                                </div><br>


                                                <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                                <a href="kebugaran.php" class="btn btn-danger btn-user btn-block">Kembali</a>
                                            </form>
        </body>

        </html>
<?php
    } else {
        // Jika data tidak ditemukan, tampilkan pesan error
        echo "Data tidak ditemukan.";
    }
} else {
    // Jika parameter id tidak diterima dari URL, tampilkan pesan error
    echo "ID tidak ditemukan.";
}

// Tutup koneksi ke database
mysqli_close($conn);
?>

<?php
// Lakukan koneksi ke database atau sertakan file konfigurasi koneksi
include '../koneksi.php';

// Jika form disubmit, proses data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    // Gunakan loop untuk mendapatkan nilai stasiun dan awak sarana
    $stations = array("UPT Crew Ka Madiun", "Stasiun Madiun", "Stasiun Kertosono", "Stasiun Blitar");
    $crews = array("Masinis", "Asmas", "Kondektur", "TKA", "Polsuska", "Serep, Lokrit, Langsir");
    foreach ($stations as $station) {
        foreach ($crews as $crew) {
            // Ambil nilai MS dan TMS
            $ms = $_POST[str_replace(' ', '', $station) . str_replace(' ', '', $crew) . '_ms'];
            $tms = $_POST[str_replace(' ', '', $station) . str_replace(' ', '', $crew) . '_tms'];
            // Lakukan pemrosesan data, misalnya simpan ke database
            // Contoh query untuk MySQL
            $query = "UPDATE records SET tanggal = '$tanggal', ms = '$ms', tms = '$tms' WHERE id = $id";
            mysqli_query($conn, $query);
        }
    }
    // Setelah selesai pemrosesan, redirect ke halaman rikes.php atau halaman lain yang sesuai
    header("Location: rikes.php");
    exit();
}

// Jika tidak ada data POST, ambil data dari database untuk ditampilkan di form
// Contoh query untuk MySQL

// $query = "SELECT * FROM records WHERE id = $id";
// $result = mysqli_query($conn, $query);
// $awak = mysqli_fetch_assoc($result);

// Misalnya $awak mengandung data yang ingin diedit

// Setiap input field harus diisi dengan data yang ada di database
$tanggal = isset($awak['tanggal']) ? $awak['tanggal'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Awak</title>
    <!-- Tambahkan link CSS atau Bootstrap jika diperlukan -->
</head>

<body>
    <h1>Edit Awak</h1>
    <form method="post" id="nilaiForm" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo isset($awak['id']) ? $awak['id'] : ''; ?>">
        <div class="form-group">
            <label for="tanggal">Tanggal:</label>
            <input type="tanggal" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" required>
        </div>
        <div class="form-group">
            <?php foreach ($stations as $station) : ?>
                <div class="station-block">
                    <h4><?php echo $station; ?></h4>
                    <?php foreach ($crews as $crew) : ?>
                        <h5><?php echo $crew; ?></h5>
                        <label for="<?php echo str_replace(' ', '', $station) . str_replace(' ', '', $crew) . '_ms'; ?>">MS:</label>
                        <input type="number" min="0" id="<?php echo str_replace(' ', '', $station) . str_replace(' ', '', $crew) . '_ms'; ?>" name="<?php echo str_replace(' ', '', $station) . str_replace(' ', '', $crew) . '_ms'; ?>" value="<?php echo isset($awak[str_replace(' ', '', $station) . str_replace(' ', '', $crew) . '_ms']) ? $awak[str_replace(' ', '', $station) . str_replace(' ', '', $crew) . '_ms'] : ''; ?>" required>
                        <label for="<?php echo str_replace(' ', '', $station) . str_replace(' ', '', $crew) . '_tms'; ?>">TMS:</label>
                        <input type="number" min="0" id="<?php echo str_replace(' ', '', $station) . str_replace(' ', '', $crew) . '_tms'; ?>" name="<?php echo str_replace(' ', '', $station) . str_replace(' ', '', $crew) . '_tms'; ?>" value="<?php echo isset($awak[str_replace(' ', '', $station) . str_replace(' ', '', $crew) . '_tms']) ? $awak[str_replace(' ', '', $station) . str_replace(' ', '', $crew) . '_tms'] : ''; ?>" required>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit">Simpan</button>
        <a href="rikes.php">Kembali</a>
    </form>
</body>

</html>