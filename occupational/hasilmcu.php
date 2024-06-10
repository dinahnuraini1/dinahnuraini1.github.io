<?php
include '../koneksi.php';

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
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <!-- <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script> -->
    <style>
        .icon-white {
            filter: brightness(0) invert(1);
        }

        /* Mengatur gaya tombol toggle */
        .toggle-button {
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 0 10px;
            border: none;
            background: none;
        }

        /* Mengatur ikon dalam tombol toggle */
        .toggle-button i {
            font-size: 16px;
        }

        .toggle-button .fa-minus {
            margin-left: 5px;
            /* Memberikan sedikit jarak antara ikon plus dan minus */
        }

        /* Menyembunyikan ikon sesuai dengan status */
        .toggle-button .fa-minus.d-none {
            display: none;
        }

        .toggle-button .fa-plus.d-none {
            display: none;
        }

        /* Mengatur gaya header */
        .card-header .border-radius-lg {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            /* Memulai dari kiri */
        }

        /* Mengatur gaya teks header */
        .card-header h6 {
            margin: 0;
            margin-left: 10px;
            /* Jarak antara teks dan tombol toggle */
            text-align: left;
            flex-grow: 1;
            /* Membuat elemen teks mengisi ruang yang tersedia */
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        .table-responsive {
            overflow-x: auto;
        }

        /* #pieChartCanvas {
            width: 300px !important;
            height: 300px !important;
        }

        #pieChartCanvas2 {
            width: 200px !important;
            height: 200px !important;
        } */
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
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
                    <a class="nav-link text-white active" href="hasilmcu.php" style="background-color: #A3D8FF;">
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
                    <a class="nav-link text-white " href="rikes.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
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
                <a class="btn w-100" href="../index.php" type="button" style="background-color: #A3D8FF; color:black">Kembali</a>
            </div>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <!-- <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Occupational Health</li>
                    </ol> -->
                    <!-- <h6 class="font-weight-bolder mb-0">Occupational Health</h6> -->

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
            </div>
        </nav>

        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="border-radius-lg pt-4 pb-3" style="background-color: #A3D8FF;">
                                <h6 class="text-black text-capitalize ps-3">Hasil MCU (Medical Check Up)</h6>
                            </div>
                            <br>
                            <a href="tambah_mcu.php">
                                <i class="fa-solid"><img src="../assets/img/icon/plus.png" alt="" width="30" height="30"></i>
                            </a><br>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <?php
                            $query = "SELECT * FROM mcu";

                            $result = mysqli_query($conn, $query);

                            // Inisialisasi array untuk menyimpan opsi tahun
                            $tahunOptions = [];
                            $selectedTahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';

                            // Loop melalui hasil query dan tambahkan tahun ke dalam array
                            while ($row = mysqli_fetch_assoc($result)) {
                                $tahunOptions[] = $row['tanggal'];
                            }
                            ?>
                            <form action="hasilmcu.php" method="GET" style="margin-left: 20px;">
                                <div class="row justify-content-center">
                                    <div class="col-md-2">
                                        <select name="tahun" class="form-control" id="tahunSelect">
                                            <option value="" selected>Pilih Tahun</option>
                                            <?php
                                            // Remove duplicate years
                                            $tahunOptions = array_unique($tahunOptions);

                                            // Sort the years in ascending order
                                            sort($tahunOptions);

                                            foreach ($tahunOptions as $tahunOption) : ?>
                                                <option value="<?php echo $tahunOption; ?>" <?php echo $selectedTahun == $tahunOption ? 'selected' : ''; ?>>
                                                    <?php echo $tahunOption; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <?php if (!empty($selectedTahun)) : ?>
                                        <?php
                                        // Ambil kelas yang tersedia untuk tahun yang dipilih
                                        $kelasQuery = "SELECT DISTINCT kelas FROM mcu WHERE tanggal = '$selectedTahun'";
                                        $kelasResult = mysqli_query($conn, $kelasQuery);
                                        $kelasOptions = [];

                                        while ($kelasRow = mysqli_fetch_assoc($kelasResult)) {
                                            $kelasOptions[] = $kelasRow['kelas'];
                                        }
                                        ?>

                                        <div class="col-md-2">
                                            <select name="kelas" class="form-control" id="kelasSelect">
                                                <option value="" selected>Semua Kelas</option>
                                                <option value="Kelas Kesehatan I">Kelas Kesehatan I</option>
                                                <option value="Kelas Kesehatan II">Kelas Kesehatan II</option>
                                                <option value="Kelas Kesehatan III">Kelas Kesehatan III</option>
                                                <option value="Kelas Kesehatan IV">Kelas Kesehatan IV</option>
                                                <option value="Kelas Kesehatan V">Kelas Kesehatan V</option>
                                            </select>
                                        </div>

                                    <?php endif; ?>
                                    <div class="col-md-2">
                                        <button id="search-button" class="btn" type="submit" style="background-color: #A3D8FF;">Cari</button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive p-0">
                                <?php
                                // Ambil tahun dan kelas yang dipilih dari parameter GET
                                $selectedTahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';
                                $selectedKelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';

                                // Tabel muncul hanya jika 'tahun' sudah dipilih
                                $showTable = !empty($selectedTahun);

                                if ($showTable) {
                                    $query1 = "SELECT * FROM mcu WHERE tanggal = '$selectedTahun'";
                                    // Jika kelas dipilih, tambahkan kondisi ke query
                                    if (!empty($selectedKelas)) {
                                        $query1 .= " AND kelas = '$selectedKelas'";
                                    }
                                    // Urutkan berdasarkan kolom kelas secara khusus menggunakan CASE statement
                                    $query1 .= " ORDER BY CASE 
                        WHEN kelas = 'Kelas Kesehatan I' THEN 1
                        WHEN kelas = 'Kelas Kesehatan II' THEN 2
                        WHEN kelas = 'Kelas Kesehatan III' THEN 3
                        WHEN kelas = 'Kelas Kesehatan IV' THEN 4
                        WHEN kelas = 'Kelas Kesehatan V' THEN 5
                        ELSE 6
                    END";
                                    $result1 = mysqli_query($conn, $query1);

                                    // Inisialisasi variabel total
                                    $totalProgram = 0;
                                    $totalRealisasi = 0;
                                    $totalNilaiA = 0;
                                    $totalNilaiB = 0;
                                    $totalNilaiC = 0;
                                    $totalNilaiD = 0;
                                }
                                ?>
                                <div id="dataTable" style="display: <?php echo $showTable ? 'block' : 'none'; ?>;">
                                    <table id="profilTable" style="text-align: center; margin-left:10px;">
                                        <thead style="background-color:#A3D8FF;color:white">
                                            <tr>
                                                <th rowspan="2" class="centered-cell">No</th>
                                                <!-- <th rowspan="2" class="centered-cell">Tanggal</th> -->
                                                <th rowspan="2" class="centered-cell">Kelas</th>
                                                <th rowspan="2" class="centered-cell">Program</th>
                                                <th rowspan="2" class="centered-cell">Realisasi</th>
                                                <th rowspan="2" class="centered-cell">Percentage</th>
                                                <th colspan="4" class="centered-cell">Nilai</th>
                                                <th style="width: 100px;" rowspan="2" class="centered-cell">Action</th>
                                            </tr>
                                            <tr>
                                                <th>A</th>
                                                <th>B</th>
                                                <th>C</th>
                                                <th>D</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($showTable) {
                                                $i = 1;
                                                $totalProgram = 0;
                                                $totalRealisasi = 0;
                                                $totalNilaiA = 0;
                                                $totalNilaiB = 0;
                                                $totalNilaiC = 0;
                                                $totalNilaiD = 0;

                                                while ($row = mysqli_fetch_assoc($result1)) {
                                                    // Retrieve values from the row
                                                    // $tgl = isset($row['tanggal']) ? $row['tanggal'] : 0;
                                                    $program = isset($row['program']) ? $row['program'] : 0;
                                                    $realisasi = isset($row['realisasi']) ? $row['realisasi'] : 0;

                                                    // Add values to total variables
                                                    $totalProgram += $program;
                                                    $totalRealisasi += $realisasi;
                                                    $totalNilaiA += isset($row['nilai_a']) ? $row['nilai_a'] : 0;
                                                    $totalNilaiB += isset($row['nilai_b']) ? $row['nilai_b'] : 0;
                                                    $totalNilaiC += isset($row['nilai_c']) ? $row['nilai_c'] : 0;
                                                    $totalNilaiD += isset($row['nilai_d']) ? $row['nilai_d'] : 0;

                                                    // Calculate percentage
                                                    $percentage = $program != 0 ? ($realisasi / $program) * 100 : 0;
                                            ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <!-- <td><?php echo date('d-m-Y', strtotime($tgl)); ?></td> -->
                                                        <td><?php echo isset($row['kelas']) ? $row['kelas'] : ''; ?></td>

                                                        <td><?php echo $program; ?></td>
                                                        <td><?php echo $realisasi; ?></td>
                                                        <td><?php echo number_format($percentage, 2); ?>%</td>
                                                        <td><?php echo isset($row['nilai_a']) ? $row['nilai_a'] : 0; ?></td>
                                                        <td><?php echo isset($row['nilai_b']) ? $row['nilai_b'] : 0; ?></td>
                                                        <td><?php echo isset($row['nilai_c']) ? $row['nilai_c'] : 0; ?></td>
                                                          <td><?php echo isset($row['nilai_d']) ? $row['nilai_d'] : 0; ?></td>
                                                        <td>
                                                            <center>
                                                                <a href="edit_mcu.php?id=<?php echo isset($row['id']) ? $row['id'] : ''; ?>">
                                                                    <img src="../assets/img/icon/pen.png" alt="" width="30" height="30">
                                                                </a>
                                                                <a href="hapus_mcu.php?id=<?php echo isset($row['id']) ? $row['id'] : ''; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                                    <img src="../assets/img/icon/bin.png" alt="" width="30" height="30">
                                                                </a>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $i++;
                                                }
                                                // Calculate total percentage
                                                $totalPercentage = $totalProgram != 0 ? ($totalRealisasi / $totalProgram) * 100 : 0;
                                                ?>
                                                <tr>
                                                    <td colspan="2"><b>Total</b></td>
                                                    <td><b><?php echo $totalProgram; ?></b></td>
                                                    <td><b><?php echo $totalRealisasi; ?></b></td>
                                                    <td><b><?php echo number_format($totalPercentage, 2); ?>%</b></td>
                                                    <td><b><?php echo $totalNilaiA; ?></b></td>
                                                    <td><b><?php echo $totalNilaiB; ?></b></td>
                                                    <td><b><?php echo $totalNilaiC; ?></b></td>
                                                    <td><b><?php echo $totalNilaiD; ?></b></td>
                                                    <td></td>
                                                </tr>

                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table><br>
                                </div>
                                <?php if ($showTable && $totalRealisasi > 0) : ?>
                                    <div class="charts-container">
                                        <div class="col-md-9 mx-auto">
                                            <canvas id="barChart"></canvas>
                                            <!-- Ganti id dari pieChart menjadi barChart -->
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <br>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var barCtx = document.getElementById('barChart').getContext('2d');

                    var data = {
                        labels: ['A', 'B', 'C', 'D'],
                        datasets: [{
                            label: 'Persentase Nilai',
                            data: [<?php echo $totalNilaiA; ?>, <?php echo $totalNilaiB; ?>, <?php echo $totalNilaiC; ?>, <?php echo $totalNilaiD; ?>],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(75, 192, 192, 0.6)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)'
                            ],
                            borderWidth: 1
                        }]
                    };

                    var options = {
                        scales: {
                            y: {
                                min: 0, // Mulai dari 0
                                max: 300, // Maksimum adalah 30
                                stepSize: 10 // Langkah antara setiap nilai
                            }
                        }
                    };

                    var barChart = new Chart(barCtx, {
                        type: 'bar',
                        data: data,
                        options: options
                    });
                });
            </script>


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
        </div>
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
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>