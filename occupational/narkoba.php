<?php
include '../koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
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
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        #pieChartCanvas,
        #pieChartCanvas2 {
            width: 100px !important;
            height: 100px !important;
        }

        .charts-container {
            display: flex;
            justify-content: space-around;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
    <div class="container">
        <?php
        if (isset($_SESSION['success_message'])) {
            echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
            unset($_SESSION['success_message']);
        }
        if (isset($_SESSION['error_message'])) {
            echo "<script>alert('" . $_SESSION['error_message'] . "');</script>";
            unset($_SESSION['error_message']);
        }
        ?>

        <!-- Rest of your HTML content -->
    </div>

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
                    <a class="nav-link text-white " href="hasilmcu.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class=""><img src="gambar/doctor-consultation.png" alt="" width="20" height="20"></i>
                        </div>
                        <span class="nav-link-text ms-1">Hasil MCU</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white " href="kebugaran.php">
                        <div class=" text-white text-center me-2 d-flex align-items-center justify-content-center">
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
                    <a class="nav-link text-white active" href="narkoba.php" style="background-color: #A3D8FF;">
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

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="border-radius-lg pt-4 pb-3 d-flex align-items-center" style="background-color: #A3D8FF;">
                                <h6 class="text-black text-capitalize ml-2 mb-0">Hasil Tes Narkoba</h6>
                            </div>
                            <br>
                            <a href="tambah_narkoba.php">
                                <i class="fa-solid"><img src="../assets/img/icon/plus.png" alt="" width="30" height="30"></i>
                            </a><br>

                            <div class="card-body px-0 pb-2">
                                <?php
                                $query3 = "SELECT DISTINCT year(tanggal) AS tahun FROM narkoba";
                                $result3 = mysqli_query($conn, $query3);

                                $tahunOptions = [];
                                $selectedTahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';

                                while ($row2 = mysqli_fetch_assoc($result3)) {
                                    $tahunOptions[] = $row2['tahun'];
                                }
                                ?>
                                <form action="narkoba.php" method="GET">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2">
                                            <select name="tahun" class="form-control" id="tahunSelect">
                                                <option value="" selected>Pilih Tahun</option>
                                                <?php
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
                                        <div class="col-md-2">
                                            <button id="search-button" class="btn" type="submit" style="background-color: #A3D8FF;">Cari</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="table-responsive p-0">
                                    <?php
                                    // Ambil tahun yang dipilih dari parameter GET
                                    $selectedTahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';

                                    // Tabel muncul hanya jika 'tahun' sudah dipilih dan tombol 'Cari' diklik
                                    $showTable = !empty($selectedTahun);

                                    if ($showTable) {
                                        $query1 = "SELECT * FROM narkoba WHERE YEAR(tanggal) = '$selectedTahun' ORDER BY tanggal ASC";
                                        $result1 = mysqli_query($conn, $query1);

                                        // Inisialisasi variabel total
                                        $totalJumlah = 0;
                                        $totalPositif = 0;
                                        $totalNegatif = 0;
                                    }

                                    ?>
                                    <div id="dataTable" style="display: <?php echo $showTable ? 'block' : 'none'; ?>;">
                                        <table id="profilTable" style="text-align: center; margin-left:10px;">
                                            <thead style="background-color:#A3D8FF;color:white">
                                                <tr>
                                                    <th class="centered-cell">No</th>
                                                    <th class="centered-cell">Tanggal</th>
                                                    <th class="centered-cell">Lokasi</th>
                                                    <th class="centered-cell">Jumlah Peserta</th>
                                                    <th class="centered-cell">Positif</th>
                                                    <th class="centered-cell">Negatif</th>
                                                    <th class="centered-cell">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($showTable) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result1)) {
                                                        // Tambahkan nilai ke total variabel
                                                        $totalJumlah += $row['jumlah'];
                                                        $totalPositif += $row['positif'];
                                                        $totalNegatif += $row['negatif'];
                                                ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                                            <td><?php echo $row['lokasi']; ?></td>
                                                            <td><?php echo $row['jumlah']; ?></td>
                                                            <td><?php echo $row['positif']; ?></td>
                                                            <td><?php echo $row['negatif']; ?></td>
                                                            <td>
                                                                <center>
                                                                    <a href="edit_narkoba.php?id=<?php echo $row['id']; ?>">
                                                                        <img src="../assets/img/icon/pen.png" alt="" width="30" height="30">
                                                                    </a>
                                                                    <a href="hapus_narkoba.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                                        <img src="../assets/img/icon/bin.png" alt="" width="30" height="30">
                                                                    </a>
                                                                </center>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td colspan="3"><b>Total</b></td>
                                                        <td><b><?php echo $totalJumlah; ?></b></td>
                                                        <td><b><?php echo $totalPositif; ?></b></td>
                                                        <td><b><?php echo $totalNegatif; ?></b></td>
                                                        <td></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table><br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card" style="background-color: #A3D8FF;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Jumlah Peserta</h5>
                                                        <p class="card-text" style="font-weight:bold; color:black;"><?php echo $totalJumlah; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-body" style="background-color: rgba(255, 99, 132, 0.6); border-radius:10px;">
                                                        <h5 class="card-title">Total Positif</h5>
                                                        <p class="card-text" style="font-weight:bold; color:black;"><?php echo $totalPositif; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-body" style="background-color: rgba(255, 206, 86, 0.6); border-radius:10px;">
                                                        <h5 class="card-title">Total Negatif</h5>
                                                        <p class="card-text" style="font-weight:bold; color:black;"><?php echo $totalNegatif; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><br>
                                    </div>
                                </div>
                                <!-- <?php if ($showTable) { ?>
                                    <div class="card-body px-0 pb-2">
                                        <canvas id="pieChart" width="300" height="300"></canvas>
                                    </div>
                                <?php } ?> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 
            <?php if ($showTable) { ?>
                <script>
                    var ctx = document.getElementById('pieChart').getContext('2d');
                    var myPieChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Positif', 'Negatif'],
                            datasets: [{
                                label: 'Hasil Tes Narkoba',
                                data: [<?php echo $totalPositif; ?>, <?php echo $totalNegatif; ?>],
                                backgroundColor: ['#FF6384', '#36A2EB'],
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false, // Set to false to allow for custom aspect ratio
                            aspectRatio: 1, // Change the aspect ratio to fit your needs
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
                </script>
            <?php } ?> -->


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


    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <!-- <script src="path/to/chartjs/dist/chart.umd.js"></script> -->
    <script src="../assets/js/node_modules/chart.js/dist/chart.js"></script>
    <script src="../assets/js/chart.umd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js" integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script async defer src="https://buttons.github.io/buttons.js">
    </script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>

</body>

</html>