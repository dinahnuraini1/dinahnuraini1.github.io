<?php
session_start();
include '../koneksi.php';
$queryDiagnosa = "SELECT diagnosa, COUNT(*) as count FROM risiko GROUP BY diagnosa";
$resultDiagnosa = mysqli_query($conn, $queryDiagnosa);

$diagnosaData = [
    'Ringan' => 0,
    'Sedang' => 0,
    'Berat' => 0
];

// Simpan hasil query ke dalam array
while ($row6 = mysqli_fetch_assoc($resultDiagnosa)) {
    $diagnosaData[$row6['diagnosa']] = $row6['count'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/logo1.png">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

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
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
    <script>
        // Ambil semua elemen dengan kelas 'open-image-modal'
        const openImageModalButtons = document.querySelectorAll('.open-image-modal');

        // Tambahkan event listener untuk setiap tombol
        openImageModalButtons.forEach(button => {
            button.addEventListener('click', () => {
                const imageUrl = button.src; // Ambil URL gambar dari tombol yang diklik
                // Tampilkan gambar dalam modal atau lightbox
                // Anda dapat menggunakan library JavaScript seperti Bootstrap Modal atau Lightbox
                // atau Anda dapat menulis kode kustom untuk menampilkan gambar dalam tampilan modal
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
                    <a class="nav-link text-white" href="rikes.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class=""><img src="gambar/health-report.png" alt="" width="20" height="20"></i>
                        </div>
                        <span class="nav-link-text ms-1">Hasil Rikes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="narkoba.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class=""><img src="../assets/img/icon/cardiogram.png" alt="" width=" 20" height="20" class="icon-white"></i>
                        </div>
                        <span class="nav-link-text ms-1">Hasil Tes Narkoba</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white active" href="promo.php" style="background-color: #A3D8FF;">
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
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Occupational Health</h6> -->

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
            <div id="penyuluhanKesehatanContent">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="border-radius-lg pt-4 pb-3" style="background-color: #A3D8FF;">
                                    <h6 class="text-capitalize ps-3">Penyuluhan Kesehatan</h6>
                                </div><br>
                                <a href="tambah_penyuluhan.php">
                                    <i class="fa-solid"><img src="../assets/img/icon/plus.png" alt="" width="30" height="30"></i>
                                </a><br>

                            </div>
                            <div class="card-body px-0 pb-2">
                                <?php
                                $query = "SELECT DISTINCT year(tanggal) AS tahun FROM penyuluhan";
                                $result = mysqli_query($conn, $query);

                                // Inisialisasi array untuk menyimpan opsi tahun
                                $tahunOptions = [];
                                $selectedTahunPenyuluhan = isset($_GET['tahun']) ? $_GET['tahun'] : '';

                                // Loop melalui hasil query dan tambahkan tahun ke dalam array
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $tahunOptions[] = $row['tahun'];
                                }
                                ?>
                                <form action="promo.php" method="GET" style="margin-left: 20px;">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2">
                                            <select name="tahun_penyuluhan" class="form-control" id="tahunSelectPenyuluhan">
                                                <option value="" selected>Pilih Tahun</option>
                                                <?php
                                                // Sort the years in ascending order
                                                sort($tahunOptions);

                                                foreach ($tahunOptions as $tahunOption) : ?>
                                                    <option value="<?php echo $tahunOption; ?>" <?php echo $selectedTahunPenyuluhan == $tahunOption ? 'selected' : ''; ?>>
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
                                    $selectedTahunPenyuluhan = isset($_GET['tahun_penyuluhan']) ? $_GET['tahun_penyuluhan'] : '';
                                    if ($selectedTahunPenyuluhan) {
                                        $query1 = "SELECT * FROM penyuluhan WHERE year(tanggal) = '$selectedTahunPenyuluhan'";
                                        $result1 = mysqli_query($conn, $query1);
                                        $showTable = true;
                                    } else {
                                        $showTable = false;
                                    }
                                    $showTable = isset($_GET['tahun_penyuluhan']) && !empty($_GET['tahun_penyuluhan']);
                                    ?>
                                    <div id="dataTable" style="display: <?php echo $showTable ? 'block' : 'none'; ?>;">
                                        <table id="profilTable" style="text-align: center; margin-left:10px;"> <!-- Tambahkan kelas table-sm untuk merampingkan tabel -->
                                            <thead style="background-color:#A3D8FF;color:white">
                                                <tr>
                                                    <th class="centered-cell">No</th>
                                                    <th class="centered-cell">Tanggal</th>
                                                    <th class="centered-cell">Uraian</th>
                                                    <th class="centered-cell">Tema</th>
                                                    <th class="centered-cell">Jumlah Peserta</th>
                                                    <th class="centered-cell">Dokumentasi</th>
                                                    <th style="width: 100px;" class="centered-cell">Action</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($showTable) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result1)) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                                            <td><?php echo isset($row['uraian']) ? $row['uraian'] : ''; ?></td>
                                                            <td><?php echo isset($row['tema']) ? $row['tema'] : 0; ?></td>
                                                            <td><?php echo isset($row['jumlah']) ? $row['jumlah'] : 0; ?></td>
                                                            <td>
                                                                <center>
                                                                    <a href="data_gambar.php?id=<?php echo $row['id']; ?>">
                                                                        <img src="../assets/img/icon/zoom.png" alt="" width="30" height="30">
                                                                    </a>
                                                                </center>
                                                            </td>


                                                            <td>
                                                                <center>
                                                                    <a href="edit_penyuluhan.php?id=<?php echo isset($row['id']) ? $row['id'] : ''; ?>">
                                                                        <img src="../assets/img/icon/pen.png" alt="" width="30" height="30">
                                                                    </a>
                                                                    <a href="hapus_penyuluhan.php?id=<?php echo isset($row['id']) ? $row['id'] : ''; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="container-fluid py-4">
            <div id="homeHospitalContent">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="border-radius-lg pt-4 pb-3" style="background-color: #A3D8FF;">
                                    <h6 class="text-capitalize ps-3">Home and Hospital Visit</h6>
                                </div><br>
                                <a href="tambah_home.php">
                                    <i class="fa-solid"><img src="../assets/img/icon/plus.png" alt="" width="30" height="30"></i>
                                </a><br>

                            </div>
                            <div class="card-body px-0 pb-2">
                                <?php
                                $query2 = "SELECT DISTINCT year(tanggal) AS tahun FROM home";
                                $result2 = mysqli_query($conn, $query2);

                                // Inisialisasi array untuk menyimpan opsi tahun
                                $tahunOptions1 = [];
                                $selectedTahunHome = isset($_GET['tahun']) ? $_GET['tahun'] : '';

                                // Loop melalui hasil query dan tambahkan tahun ke dalam array
                                while ($row1 = mysqli_fetch_assoc($result2)) {
                                    $tahunOptions1[] = $row1['tahun'];
                                }
                                ?>
                                <form action="promo.php" method="GET" style="margin-left: 20px;">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2">
                                            <select name="tahun_home" class="form-control" id="tahunSelectHome">
                                                <option value="" selected>Pilih Tahun</option>
                                                <?php
                                                // Sort the years in ascending order
                                                sort($tahunOptions1);

                                                foreach ($tahunOptions1 as $tahunOption1) : ?>
                                                    <option value="<?php echo $tahunOption1; ?>" <?php echo $selectedTahunHome == $tahunOption1 ? 'selected' : ''; ?>>
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
                                <div class="table-responsive p-0">
                                    <?php
                                    $selectedTahunHome = isset($_GET['tahun_home']) ? $_GET['tahun_home'] : '';
                                    if ($selectedTahunHome) {
                                        $query3 = "SELECT * FROM home WHERE YEAR(tanggal) = '$selectedTahunHome'";
                                        $result3 = mysqli_query($conn, $query3);
                                        $showTable1 = true;
                                    } else {
                                        $showTable1 = false;
                                    }
                                    $showTable1 = isset($_GET['tahun_home']) && !empty($_GET['tahun_home']);
                                    ?>
                                    <div id="dataTable" style="display: <?php echo $showTable1 ? 'block' : 'none'; ?>;">
                                        <!-- <table id="profilTable" class="table-sm" style="text-align: center; margin-left:10px; width: 100%;"> -->
                                        <table id="profilTable" class="table-sm" style="text-align: center; width: 2000px; margin-left: 10px;"> <!-- Tambahkan kelas table-sm untuk merampingkan tabel dan set width: 100% -->
                                            <thead style="background-color:#A3D8FF;color:white">
                                                <tr>
                                                    <th class="centered-cell" style="width: 3%;">No</th> <!-- Ubah width menjadi 10% -->
                                                    <th class="centered-cell" style="width: 5%;">Tanggal</th> <!-- Ubah width menjadi 15% -->
                                                    <th class="centered-cell" style="width: 5%;">Nipp</th> <!-- Ubah width menjadi 10% -->
                                                    <th class="centered-cell" style="width: 10%;">Nama</th> <!-- Ubah width menjadi 15% -->
                                                    <th class="centered-cell" style="width: 15%;">Lokasi</th> <!-- Ubah width menjadi 15% -->
                                                    <th class="centered-cell" style="width: 20%;">Deskripsi</th> <!-- Ubah width menjadi 20% -->
                                                    <th class="centered-cell" style="width: 20%;">Rekomendasi</th> <!-- Ubah width menjadi 10% -->
                                                    <th class="centered-cell" style="width: 5%;">Dokumentasi</th> <!-- Ubah width menjadi 5% -->
                                                    <th class="centered-cell" style="width: 10%;">Action</th> <!-- Ubah width menjadi 10% -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($showTable1) {
                                                    $i = 1;
                                                    while ($row1 = mysqli_fetch_assoc($result3)) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo date('d-m-Y', strtotime($row1['tanggal'])); ?></td>
                                                            <td><?php echo isset($row1['nipp']) ? $row1['nipp'] : 0; ?></td>
                                                            <td><?php echo isset($row1['nama']) ? $row1['nama'] : ''; ?></td>
                                                            <td><?php echo isset($row1['lokasi']) ? $row1['lokasi'] : 0; ?></td>
                                                            <td><?php echo isset($row1['deskripsi']) ? $row1['deskripsi'] : 0; ?></td>
                                                            <td><?php echo isset($row1['rekomendasi']) ? $row1['rekomendasi'] : 0; ?></td>
                                                            <td>
                                                                <center>
                                                                    <a href="data_home.php?id=<?php echo $row1['id']; ?>">
                                                                        <img src="../assets/img/icon/zoom.png" alt="" width="30" height="30">
                                                                    </a>
                                                                </center>
                                                            </td>
                                                            <td>
                                                                <center>
                                                                    <a href="edit_home.php?id=<?php echo isset($row1['id']) ? $row1['id'] : ''; ?>">
                                                                        <img src="../assets/img/icon/pen.png" alt="" width="30" height="30">
                                                                    </a>
                                                                    <a href="hapus_home.php?id=<?php echo isset($row1['id']) ? $row1['id'] : ''; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- PEKERJA RISIKO TINGGI -->
        <div class="container-fluid py-4">
            <div id="RisikoContent">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="border-radius-lg pt-4 pb-3" style="background-color: #A3D8FF;">
                                    <h6 class="text-capitalize ps-3">Pekerja Risiko Tinggi</h6>
                                </div><br>
                                <a href="tambah_risiko.php">
                                    <i class="fa-solid"><img src="../assets/img/icon/plus.png" alt="" width="30" height="30"></i>
                                </a><br>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <?php
                                $query5 = "SELECT DISTINCT tanggal AS tahun FROM risiko";
                                $result5 = mysqli_query($conn, $query5);

                                // Inisialisasi array untuk menyimpan opsi tahun
                                $tahunOptions5 = [];
                                $selectedTahunRisiko = isset($_GET['tahun_risiko']) ? $_GET['tahun_risiko'] : '';

                                // Loop melalui hasil query dan tambahkan tahun ke dalam array
                                while ($row5 = mysqli_fetch_assoc($result5)) {
                                    $tahunOptions5[] = $row5['tahun'];
                                }
                                ?>
                                <form action="promo.php" method="GET" style="margin-left: 20px;">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2">
                                            <select name="tahun_risiko" class="form-control" id="tahunSelectRisiko">
                                                <option value="" selected>Pilih Tahun</option>
                                                <?php
                                                // Sort the years in ascending order
                                                sort($tahunOptions5);

                                                foreach ($tahunOptions5 as $tahunOption5) : ?>
                                                    <option value="<?php echo $tahunOption5; ?>" <?php echo $selectedTahunRisiko == $tahunOption5 ? 'selected' : ''; ?>>
                                                        <?php echo $tahunOption5; ?>
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
                                // Tampilkan tabel hanya jika 'tahun_risiko' sudah dipilih dan tombol 'Cari' diklik
                                if ($selectedTahunRisiko) {
                                    $query5 = "SELECT * FROM risiko WHERE tanggal = '$selectedTahunRisiko'";
                                    $result5 = mysqli_query($conn, $query5);
                                    $showTable5 = true;
                                } else {
                                    $showTable5 = false;
                                }
                                ?>
                                <div class="table-responsive p-0">
                                    <div id="dataTable" style="display: <?php echo $showTable5 ? 'block' : 'none'; ?>;">
                                        <table id="profilTable" style="text-align: center; margin-left:10px;">
                                            <thead style="background-color:#A3D8FF;color:white">
                                                <tr>
                                                    <th class="centered-cell">No</th>
                                                    <th class="centered-cell">Nipp</th>
                                                    <th class="centered-cell">Nama</th>
                                                    <th class="centered-cell">Unit kerja</th>
                                                    <th class="centered-cell">Diagnosa</th>
                                                    <th class="centered-cell">Level</th>
                                                    <th style="width: 100px;" class="centered-cell">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($showTable5) {
                                                    $i = 1;
                                                    while ($row5 = mysqli_fetch_assoc($result5)) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo isset($row5['nipp']) ? $row5['nipp'] : 0; ?></td>
                                                            <td><?php echo isset($row5['nama']) ? $row5['nama'] : ''; ?></td>
                                                            <td><?php echo isset($row5['unit']) ? $row5['unit'] : 0; ?></td>
                                                            <td><?php echo isset($row5['rekomendasi']) ? $row5['rekomendasi'] : 0; ?></td>
                                                            <td><?php echo isset($row5['diagnosa']) ? $row5['diagnosa'] : 0; ?></td>

                                                            <td>
                                                                <center>
                                                                    <a href="edit_risiko.php?id=<?php echo isset($row5['id']) ? $row5['id'] : ''; ?>">
                                                                        <img src="../assets/img/icon/pen.png" alt="" width="30" height="30">
                                                                    </a>
                                                                    <a href="hapus_risiko.php?id=<?php echo isset($row5['id']) ? $row5['id'] : ''; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                                    </div>
                                    <?php if ($showTable5) : ?>
                                        <div class="charts-container">
                                            <div class="col-md-9 mx-auto">
                                                <canvas id="barChart"></canvas>
                                                <!-- Ganti id dari pieChart menjadi barChart -->
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx = document.getElementById('barChart').getContext('2d');
            var diagnosaData = <?php echo json_encode($diagnosaData); ?>;
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Ringan', 'Sedang', 'Berat'],
                    datasets: [{
                        label: 'Jumlah Diagnosa',
                        data: [diagnosaData.Ringan, diagnosaData.Sedang, diagnosaData.Berat],
                        backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 206, 86, 0.6)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true, // Mulai dari 0
                            max: 100, // Maksimum adalah 300
                            ticks: {
                                stepSize: 20 // Langkah antara setiap nilai
                            }
                        }
                    }
                }
            });
        </script>



        <div class="container-fluid py-4">
            <div id="homeHospitalContent">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="border-radius-lg pt-4 pb-3" style="background-color: #A3D8FF;">
                                    <h6 class="text-capitalize ps-3">Pantauan Pekerja Sakit</h6>
                                </div><br>
                                <a href="tambah_pantauan.php">
                                    <i class="fa-solid"><img src="../assets/img/icon/plus.png" alt="" width="30" height="30"></i>
                                </a><br>

                            </div>
                            <div class="card-body px-0 pb-2">
                                <?php
                                // Query untuk mengambil tahun dari kolom tanggal
                                $query3 = "SELECT DISTINCT year(tanggal) as tahun FROM pantauan";
                                $result3 = mysqli_query($conn, $query3);

                                // Inisialisasi array untuk menyimpan opsi tahun
                                $tahunOptions2 = [];
                                $selectedTahunPantauan = isset($_GET['tahun']) ? $_GET['tahun'] : '';

                                // Loop melalui hasil query dan tambahkan tahun ke dalam array
                                while ($row2 = mysqli_fetch_assoc($result3)) {
                                    $tahunOptions2[] = $row2['tahun'];
                                }
                                ?>
                                <form action="promo.php" method="GET" style="margin-left: 20px;">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2">
                                            <select name="tahun_pantauan" class="form-control" id="tahunSelectPantauan">
                                                <option value="" selected>Pilih Tahun</option>
                                                <?php
                                                // Sort the years in ascending order
                                                sort($tahunOptions2);

                                                foreach ($tahunOptions2 as $tahunOption2) : ?>
                                                    <option value="<?php echo $tahunOption2; ?>" <?php echo $selectedTahunPantauan == $tahunOption2 ? 'selected' : ''; ?>>
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

                                <div class="table-responsive p-0">
                                    <?php
                                    $selectedTahunPantauan = isset($_GET['tahun_pantauan']) ? $_GET['tahun_pantauan'] : '';
                                    if ($selectedTahunPantauan) {
                                        $query5 = "SELECT * FROM pantauan WHERE YEAR(tanggal) = '$selectedTahunPantauan'";
                                        $result5 = mysqli_query($conn, $query5);
                                        $showTable3 = true;
                                    } else {
                                        $showTable3 = false;
                                    }
                                    $showTable3 = isset($_GET['tahun_pantauan']) && !empty($_GET['tahun_pantauan']);
                                    ?>
                                    <div id="dataTable" style="display: <?php echo $showTable3 ? 'block' : 'none'; ?>;">
                                        <table id="profilTable" style="text-align: center; margin-left:10px;"> <!-- Tambahkan kelas table-sm untuk merampingkan tabel -->
                                            <thead style="background-color:#A3D8FF;color:white">
                                                <tr>
                                                    <th class="centered-cell">No</th>
                                                    <th class="centered-cell">Tanggal</th>
                                                    <th class="centered-cell">Nipp</th>
                                                    <th class="centered-cell">Nama</th>


                                                    <th class="centered-cell">Deskripsi</th>
                                                    <th class="centered-cell">Dokumentasi</th>
                                                    <th style="width: 100px;" class="centered-cell">Action</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($showTable3) {
                                                    $i = 1;
                                                    while ($row3 = mysqli_fetch_assoc($result5)) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo date('d-m-Y', strtotime($row3['tanggal'])); ?></td>
                                                            <td><?php echo isset($row3['nipp']) ? $row3['nipp'] : 0; ?></td>
                                                            <td><?php echo isset($row3['nama']) ? $row3['nama'] : ''; ?></td>

                                                            <td><?php echo isset($row3['deskripsi']) ? $row3['deskripsi'] : 0; ?></td>
                                                            <td>
                                                                <center>
                                                                    <a href="data_pantauan.php?id=<?php echo $row3['id']; ?>">
                                                                        <img src="../assets/img/icon/zoom.png" alt="" width="30" height="30">
                                                                    </a>
                                                                </center>
                                                            </td>


                                                            <td>
                                                                <center>
                                                                    <a href="edit_pantauan.php?id=<?php echo isset($row3['id']) ? $row3['id'] : ''; ?>">
                                                                        <img src="../assets/img/icon/pen.png" alt="" width="30" height="30">
                                                                    </a>
                                                                    <a href="hapus_pantauan.php?id=<?php echo isset($row3['id']) ? $row3['id'] : ''; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                                    </div>
                                </div>
                            </div>
                        </div>
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