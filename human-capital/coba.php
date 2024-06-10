<?php

include '../koneksi.php';
// Query untuk mengambil data dari database

$query = "SELECT * FROM user_uk ORDER BY 
 CASE 
                                                    WHEN Jabatan LIKE '%Manager%' THEN 1
                                                    WHEN Jabatan LIKE '%Assistant Manager%' THEN 2
                                                    WHEN Jabatan LIKE '%Kepala%' THEN 3
                                                    WHEN Jabatan LIKE '%Pelaksana' THEN 4
                                                    ELSE 5
                                                END";
$result = mysqli_query($conn, $query);
$totalRows = mysqli_num_rows($result);

// mediska madiun

$query1 = "SELECT * FROM user_mediska_madiun ORDER BY 
                                                CASE 
                                                    WHEN Jabatan LIKE '%Kepala%' THEN 1
                                                    WHEN Jabatan LIKE '%Dokter%' THEN 2
                                                    WHEN Jabatan LIKE '%Apoteker%' THEN 3
                                                    WHEN Jabatan LIKE '%Paramedis' THEN 4
                                                  
                                                    ELSE 5
                                                END";
$result1 = mysqli_query($conn, $query1);
$totalRows1 = mysqli_num_rows($result1);

// mediska blitar
$query2 = "SELECT * FROM user_mediska_blitar ORDER BY 
                                                CASE 
                                                    WHEN Jabatan LIKE '%Kepala%' THEN 1
                                                    WHEN Jabatan LIKE '%Paramedis%' THEN 2
                                                    ELSE 3
                                                END";
$result2 = mysqli_query($conn, $query2);
$totalRows2 = mysqli_num_rows($result2);

// mediska kediri
$query3 = "SELECT * FROM user_mediska_kediri ORDER BY 
                                                CASE 
                                                    WHEN Jabatan LIKE '%Kepala%' THEN 1
                                                    WHEN Jabatan LIKE '%Paramedis%' THEN 2
                                                    ELSE 3
                                                END";
$result3 = mysqli_query($conn, $query3);
$totalRows3 = mysqli_num_rows($result3);

// mediska kertosono
$query4 = "SELECT * FROM user_mediska_kertosono ORDER BY 
                                                CASE 
                                                    WHEN Jabatan LIKE '%Kepala%' THEN 1
                                                    WHEN Jabatan LIKE '%Pelaksana%' THEN 2
                                                    WHEN Jabatan LIKE '%Paramedis%' THEN 3
                                                    ELSE 4
                                                END";
$result4 = mysqli_query($conn, $query4);
$totalRows4 = mysqli_num_rows($result4);
//                                             // Mengirimkan header JSON
//                                             header('Content-Type: application/json');

//                                             // Debugging: Cetak output untuk verifikasi
//                                             echo json_encode($data);

// Tutup koneksi
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Human Capital</title>
    <meta content="" name="description">
    <meta content="" name="keywords">


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
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />

    <style>
        .hidden {
            display: none;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            color: black;

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

        .table-sm {
            font-size: 0.875rem;
            /* Adjust the font size to make the table more compact */
        }

        .input-group {
            margin: 10px 0;
            /* Adding margin to space out form elements */
        }
    </style>
</head>

<body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toggleButtons = document.querySelectorAll(".toggle-button");

            toggleButtons.forEach(function(toggleButton) {
                toggleButton.addEventListener("click", function() {
                    var targetId = toggleButton.getAttribute("data-target-id");
                    var tableBody = document.getElementById(targetId);
                    var icon = toggleButton.querySelector("i");

                    tableBody.classList.toggle("hidden");

                    if (tableBody.classList.contains("hidden")) {
                        icon.classList.remove("fa-minus");
                        icon.classList.add("fa-plus");
                    } else {
                        icon.classList.remove("fa-plus");
                        icon.classList.add("fa-minus");
                    }

                    // Mengambil data dari tabel user_uk saat tombol "+" pada kantor unit kesehatan diklik
                    if (!tableBody.classList.contains("hidden") && targetId === "table-body1") {
                        // Lakukan pengambilan data dari tabel user_uk di sini, contoh:
                        fetch('coba.php') // Ganti dengan URL yang sesuai untuk mengambil data dari tabel user_uk
                            .then(response => response.json())
                        // .then(data => {
                        //     // Manipulasi DOM untuk menampilkan data dari tabel user_uk di sini
                        // })
                        // .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
    </script>


    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1>Unit Kesehatan | Daop 7 Madiun </h1>
            </a>
            <!-- 
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i> -->

        </div>
    </header><!-- End Header -->

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs d-flex align-items-center" style="background-image: url('../assets/img/depan/4.jpg');">
            <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

                <h2>Human Capital</h2>
                <ol>
                    <li><a href="../index.php">Home</a></li>
                    <li>Human Capital</li>
                </ol>

            </div>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Service Details Section ======= -->
        <section id="service-details" class="service-details">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <a href="tambah2.php">
                    <i class="fa-solid"><img src="../assets/img/icon/plus.png" alt="" width="30" height="30"></i>
                </a>
                <br>
                <div class="row">
                    <!-- KANTOR UNIT KESEHATAN -->
                    <div class="col-12">
                        <div class="card my-4">

                            <div class="card-header p-3 position-relative ">
                                <div class="border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center" style="background-color: #F27BBD;">

                                    <button id="toggle-button1" class="toggle-button" data-target-id="table-body1" style="margin-left: 10px;">
                                        <i class="fas fa-plus"></i>
                                        <i class="fas fa-minus d-none"></i>
                                    </button>
                                    <h6 class="text-black text-capitalize"> Kantor Unit Kesehatan </h6>
                                    <h5> <span class="ml-auto" style="color:black;">(<?php echo $totalRows; ?>)</span></h5>
                                </div>
                            </div>
                            <div class="container">
                                <div class="card-body px-0 pb-2 table-body1 hidden" id="table-body1">
                                    <div class="table-responsive p-0" style="overflow-x: auto;">
                                        <table id="profilTable" style="text-align: center; width: 1060px; margin-left: 10px;"> <!-- Atur lebar tabel lebih besar dari container -->
                                            <thead>
                                                <tr style="background-color: #F27BBD; color: black;">
                                                    <th style="width: 100px;">NIPP</th>
                                                    <th style="width: 200px;">Nama</th>
                                                    <th style="width: 200px;">Jabatan</th>
                                                    <th style="width: 200px;">Kedudukan</th>
                                                    <!-- <th style="width: 100px;">Status</th>
                                                    <th style="width: 150px;">Tempat Lahir</th>
                                                    <th style="width: 150px;">Tanggal Lahir</th>
                                                    <th style="width: 150px;">Pendidikan</th>
                                                    <th style="width: 200px;">Profesi</th> -->
                                                    <th style="width: 100px;">Detail</th>
                                                    <th style="width: 150px;">Action</th> <!-- Atur lebar kolom Action -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><?php echo $row['nipp']; ?></td>
                                                        <td><?php echo $row['nama']; ?></td>
                                                        <td><?php echo $row['jabatan']; ?></td>
                                                        <td><?php echo $row['kedudukan']; ?></td>
                                                        <!-- <td><?php echo $row['status']; ?></td>
                                                        <td><?php echo $row['tempat_lhr']; ?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($row['tgl'])); ?></td>
                                                        <td><?php echo $row['pend']; ?></td>
                                                        <td><?php echo $row['profesi']; ?></td> -->
                                                        <td>
                                                            <center>
                                                                <a href="data_pekerja.php?id=<?php echo $row['nipp']; ?>">
                                                                    <img src="../assets/img/icon/det.png" alt="" width="20" height="20">
                                                                </a>
                                                            </center>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <a href="edit2.php?id=<?php echo $row['nipp']; ?>">
                                                                    <img src="../assets/img/icon/pen.png" alt="" width="30" height="30">
                                                                </a>
                                                                <a href="hapus2.php?id=<?php echo $row['nipp']; ?>">
                                                                    <img src="../assets/img/icon/bin.png" alt="" width="30" height="30">
                                                                </a>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <br>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- //KLINIK MEDISKA MADIUN -->

                        <div class="card my-4">
                            <div class="card-header p-3 position-relative ">
                                <div class="border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center" style="background-color: #F27BBD;">

                                    <button id="toggle-button2" class="toggle-button" data-target-id="table-body2" style="margin-left: 10px;">
                                        <i class="fas fa-plus"></i>
                                        <i class="fas fa-minus d-none"></i>
                                    </button>
                                    <h6 class="text-black text-capitalize"> Klinik Mediska Madiun </h6>
                                    <h5> <span class="ml-auto" style="color:black;">(<?php echo $totalRows1; ?>)</span></h5>
                                </div>
                            </div>

                            <div class="container">
                                <div class="card-body px-0 pb-2 table-body2 hidden" id="table-body2">
                                    <div class="table-responsive p-0" style="overflow-x: auto;">
                                        <table id="profilTable" style="text-align: center; width: 1060px; margin-left: 10px;"> <!-- Atur lebar tabel lebih besar dari container -->
                                            <thead>
                                                <thead style="background-color: #F27BBD; color: black;">
                                                    <tr>

                                                        <!-- <th>No</th> -->
                                                        <th style="width: 100px;">NIPP</th>
                                                        <th style="width: 200px;">Nama</th>
                                                        <th style="width: 200px;">Jabatan</th>
                                                        <th style="width: 200px;">Kedudukan</th>
                                                        <!-- <th style="width: 100px;">Status</th>
                                                        <th style="width: 150px;">Tempat Lahir</th>
                                                        <th style="width: 150px;">Tanggal Lahir</th>
                                                        <th style="width: 150px;">Pendidikan</th>
                                                        <th style="width: 200px;">Profesi</th> -->
                                                        <th style="width: 100px;">Detail</th>
                                                        <th style="width: 150px;">Action</th> <!-- Atur lebar kolom Action -->
                                                    </tr>
                                                </thead>
                                            <tbody>
                                                <?php

                                                while ($row1 = mysqli_fetch_assoc($result1)) {



                                                ?>
                                                    <tr>


                                                        <td><?php echo $row1['nipp']; ?></td>
                                                        <td><?php echo $row1['nama']; ?></td>
                                                        <td><?php echo $row1['jabatan']; ?></td>
                                                        <td><?php echo $row1['kedudukan']; ?></td>
                                                        <!-- <td><?php echo $row1['status']; ?></td>
                                                        <td><?php echo $row1['tempat_lhr']; ?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($row1['tgl'])); ?></td>
                                                        <td><?php echo $row1['pend']; ?></td>
                                                        <td><?php echo $row1['profesi']; ?></td> -->

                                                        <td>
                                                            <center>
                                                                <a href="pekerja_mediska_madiun.php?id=<?php echo $row1['nipp']; ?>">
                                                                    <img src="../assets/img/icon/det.png" alt="" width="20" height="20">
                                                                </a>
                                                            </center>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <!-- Tombol edit -->
                                                                <a href="edit3.php?id=<?php echo $row1['nipp']; ?>">
                                                                    <i class="fa-solid"><img src="../assets/img/icon/pen.png" alt="" width="30" height="30"></i>
                                                                </a>
                                                                <!-- Tombol hapus -->
                                                                <a href="hapus3.php?id=<?php echo $row1['nipp']; ?>">
                                                                    <i class="fa-solid"><img src="../assets/img/icon/bin.png" alt="" width="30" height="30"></i>
                                                                </a>
                                                            </center>
                                                        </td>

                                                    </tr>
                                                <?php
                                                }
                                                // echo "<script>sortTableByJobPosition();</script>";
                                                ?>
                                            </tbody>

                                        </table><br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- KLINIK MEDISKA BLITAR -->
                        <div class="card my-4">

                            <div class="card-header p-3 position-relative ">
                                <div class="border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center" style="background-color: #F27BBD;">

                                    <button id="toggle-button3" class="toggle-button" data-target-id="table-body3" style="margin-left: 10px;">
                                        <i class="fas fa-plus"></i>
                                        <i class="fas fa-minus d-none"></i>
                                    </button>
                                    <h6 class="text-black text-capitalize"> Klinik Mediska Blitar </h6>
                                    <h5> <span class="ml-auto" style="color:black;">(<?php echo $totalRows2; ?>)</span></h5>
                                </div>
                            </div>

                            <div class="container">
                                <div class="card-body px-0 pb-2 table-body3 hidden" id="table-body3">
                                    <div class="table-responsive p-0" style="overflow-x: auto;">
                                        <table id="profilTable" style="text-align: center; width: 1060px; margin-left: 10px;"> <!-- Atur lebar tabel lebih besar dari container -->
                                            <thead>
                                                <thead style="background-color: #F27BBD; color: black;">
                                                    <tr>

                                                        <th style="width: 100px;">NIPP</th>
                                                        <th style="width: 200px;">Nama</th>
                                                        <th style="width: 200px;">Jabatan</th>
                                                        <th style="width: 200px;">Kedudukan</th>
                                                        <!-- <th style="width: 100px;">Status</th>
                                                        <th style="width: 150px;">Tempat Lahir</th>
                                                        <th style="width: 150px;">Tanggal Lahir</th>
                                                        <th style="width: 150px;">Pendidikan</th>
                                                        <th style="width: 200px;">Profesi</th> -->
                                                        <th style="width: 100px;">Detail</th>
                                                        <th style="width: 150px;">Action</th> <!-- Atur lebar kolom Action -->
                                                    </tr>
                                                </thead>
                                            <tbody>
                                                <?php

                                                while ($row2 = mysqli_fetch_assoc($result2)) {



                                                ?>
                                                    <tr>


                                                        <td><?php echo $row2['nipp']; ?></td>
                                                        <td><?php echo $row2['nama']; ?></td>
                                                        <td><?php echo $row2['jabatan']; ?></td>
                                                        <td><?php echo $row2['kedudukan']; ?></td>
                                                        <!-- <td><?php echo $row2['status']; ?></td>
                                                        <td><?php echo $row2['tempat_lhr']; ?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($row2['tgl'])); ?></td>
                                                        <td><?php echo $row2['pend']; ?></td>
                                                        <td><?php echo $row2['profesi']; ?></td> -->

                                                        <td>
                                                            <center>
                                                                <a href="pekerja_mediska_blitar.php?id=<?php echo $row2['nipp']; ?>">
                                                                    <img src="../assets/img/icon/det.png" alt="" width="20" height="20">
                                                                </a>
                                                            </center>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <!-- Tombol edit -->
                                                                <a href="edit4.php?id=<?php echo $row2['nipp']; ?>">
                                                                    <i class="fa-solid"><img src="../assets/img/icon/pen.png" alt="" width="30" height="30"></i>
                                                                </a>
                                                                <!-- Tombol hapus -->
                                                                <a href="hapus4.php?id=<?php echo $row2['nipp']; ?>">
                                                                    <i class="fa-solid"><img src="../assets/img/icon/bin.png" alt="" width="30" height="30"></i>
                                                                </a>
                                                            </center>
                                                        </td>

                                                    </tr>
                                                <?php
                                                }
                                                // echo "<script>sortTableByJobPosition();</script>";
                                                ?>
                                            </tbody>

                                        </table><br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- KLINIK MEDISKA KEDIRI -->
                        <div class="card my-4">

                            <div class="card-header p-3 position-relative ">
                                <div class="border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center" style="background-color: #F27BBD;">

                                    <button id="toggle-button4" class="toggle-button" data-target-id="table-body4" style="margin-left: 10px;">
                                        <i class="fas fa-plus"></i>
                                        <i class="fas fa-minus d-none"></i>
                                    </button>
                                    <h6 class="text-black text-capitalize"> Klinik Mediska Kediri </h6>
                                    <h5> <span class="ml-auto" style="color:black;">(<?php echo $totalRows3; ?>)</span></h5>
                                </div>
                            </div>

                            <div class="container">
                                <div class="card-body px-0 pb-2 table-body4 hidden" id="table-body4">
                                    <div class="table-responsive p-0" style="overflow-x: auto;">
                                        <table id="profilTable" style="text-align: center; width: 1060px; margin-left: 10px;"> <!-- Atur lebar tabel lebih besar dari container -->
                                            <thead>
                                                <thead style="background-color: #F27BBD; color: black;">
                                                    <tr>
                                                        <th style="width: 100px;">NIPP</th>
                                                        <th style="width: 200px;">Nama</th>
                                                        <th style="width: 200px;">Jabatan</th>
                                                        <th style="width: 200px;">Kedudukan</th>
                                                        <!-- <th style="width: 100px;">Status</th>
                                                        <th style="width: 150px;">Tempat Lahir</th>
                                                        <th style="width: 150px;">Tanggal Lahir</th>
                                                        <th style="width: 150px;">Pendidikan</th>
                                                        <th style="width: 200px;">Profesi</th> -->
                                                        <th style="width: 100px;">Detail</th>
                                                        <th style="width: 150px;">Action</th> <!-- Atur lebar kolom Action -->
                                                    </tr>
                                                </thead>
                                            <tbody>
                                                <?php

                                                while ($row3 = mysqli_fetch_assoc($result3)) {



                                                ?>
                                                    <tr>


                                                        <td><?php echo $row3['nipp']; ?></td>
                                                        <td><?php echo $row3['nama']; ?></td>
                                                        <td><?php echo $row3['jabatan']; ?></td>
                                                        <td><?php echo $row3['kedudukan']; ?></td>
                                                        <!-- <td><?php echo $row3['status']; ?></td>
                                                        <td><?php echo $row3['tempat_lhr']; ?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($row3['tgl'])); ?></td>
                                                        <td><?php echo $row3['pend']; ?></td>
                                                        <td><?php echo $row3['profesi']; ?></td> -->

                                                        <td>
                                                            <center>
                                                                <a href="pekerja_mediska_kediri.php?id=<?php echo $row3['nipp']; ?>">
                                                                    <img src="../assets/img/icon/det.png" alt="" width="20" height="20">
                                                                </a>
                                                            </center>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <!-- Tombol edit -->
                                                                <a href="edit5.php?id=<?php echo $row3['nipp']; ?>">
                                                                    <i class="fa-solid"><img src="../assets/img/icon/pen.png" alt="" width="30" height="30"></i>
                                                                </a>
                                                                <!-- Tombol hapus -->
                                                                <a href="hapus5.php?id=<?php echo $row3['nipp']; ?>">
                                                                    <i class="fa-solid"><img src="../assets/img/icon/bin.png" alt="" width="30" height="30"></i>
                                                                </a>
                                                            </center>
                                                        </td>

                                                    </tr>
                                                <?php
                                                }
                                                // echo "<script>sortTableByJobPosition();</script>";
                                                ?>
                                            </tbody>

                                        </table><br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- KLINIK MEDISKA KERTOSONO -->
                        <div class="card my-4">

                            <div class="card-header p-3 position-relative ">
                                <div class="border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center" style="background-color: #F27BBD;">

                                    <button id="toggle-button5" class="toggle-button" data-target-id="table-body5" style="margin-left: 10px;">
                                        <i class="fas fa-plus"></i>
                                        <i class="fas fa-minus d-none"></i>
                                    </button>
                                    <h6 class="text-black text-capitalize"> Klinik Mediska Kertosono </h6>
                                    <h5> <span class="ml-auto" style="color:black;">(<?php echo $totalRows4; ?>)</span></h5>
                                </div>
                            </div>

                            <div class="container">
                                <div class="card-body px-0 pb-2 table-body5 hidden" id="table-body5">
                                    <div class="table-responsive p-0" style="overflow-x: auto;">
                                        <table id="profilTable" style="text-align: center; width: 1060px; margin-left: 10px;"> <!-- Atur lebar tabel lebih besar dari container -->
                                            <thead>
                                                <thead style="background-color: #F27BBD; color: black;">
                                                    <tr>

                                                        <!-- <th>No</th> -->
                                                        <th style="width: 100px;">NIPP</th>
                                                        <th style="width: 200px;">Nama</th>
                                                        <th style="width: 200px;">Jabatan</th>
                                                        <th style="width: 200px;">Kedudukan</th>
                                                        <!-- <th style="width: 100px;">Status</th>
                                                        <th style="width: 150px;">Tempat Lahir</th>
                                                        <th style="width: 150px;">Tanggal Lahir</th>
                                                        <th style="width: 150px;">Pendidikan</th>
                                                        <th style="width: 200px;">Profesi</th> -->
                                                        <th style="width: 100px;">Detail</th>
                                                        <th style="width: 150px;">Action</th> <!-- Atur lebar kolom Action -->
                                                    </tr>
                                                </thead>
                                            <tbody>
                                                <?php

                                                while ($row4 = mysqli_fetch_assoc($result4)) {



                                                ?>
                                                    <tr>


                                                        <td><?php echo $row4['nipp']; ?></td>
                                                        <td><?php echo $row4['nama']; ?></td>
                                                        <td><?php echo $row4['jabatan']; ?></td>
                                                        <td><?php echo $row4['kedudukan']; ?></td>
                                                        <!-- <td><?php echo $row4['status']; ?></td>
                                                        <td><?php echo $row4['tempat_lhr']; ?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($row4['tgl'])); ?></td>
                                                        <td><?php echo $row4['pend']; ?></td>
                                                        <td><?php echo $row4['profesi']; ?></td> -->

                                                        <td>
                                                            <center>
                                                                <a href="pekerja_mediska_kertosono.php?id=<?php echo $row4['nipp']; ?>">
                                                                    <img src="../assets/img/icon/det.png" alt="" width="20" height="20">
                                                                </a>
                                                            </center>
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <!-- Tombol edit -->
                                                                <a href="edit6.php?id=<?php echo $row4['nipp']; ?>">
                                                                    <i class="fa-solid"><img src="../assets/img/icon/pen.png" alt="" width="30" height="30"></i>
                                                                </a>
                                                                <!-- Tombol hapus -->
                                                                <a href="hapus6.php?id=<?php echo $row4['nipp']; ?>">
                                                                    <i class="fa-solid"><img src="../assets/img/icon/bin.png" alt="" width="30" height="30"></i>
                                                                </a>
                                                            </center>
                                                        </td>

                                                    </tr>
                                                <?php
                                                }
                                                // echo "<script>sortTableByJobPosition();</script>";
                                                ?>
                                            </tbody>

                                        </table><br>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <a href="../index.php">
                    <i class="fa-solid"><img src="../assets/img/icon/undo.png" alt="" width="30" height="30"></i>
                </a>
            </div>
        </section>
    </main><!-- End #main -->


    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="footer-content position-relative">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            <h3 style="color: white;">Unit Kesehatan</h3>
                            <p>
                                Kompol Sunaryo, Madiun Lor, <br>
                                Kec. Manguharjo, Kota Madiun, <br>
                                Jawa Timur 63122 <br><br>
                            </p>
                            <!-- <div class="social-links d-flex mt-3">
                                <a href="https://twitter.com/keretaapikita" class="d-flex align-items-center justify-content-center"><i class="bi bi-twitter"></i></a>
                                <a href="https://www.facebook.com/keretaapikita" class="d-flex align-items-center justify-content-center"><i class="bi bi-facebook"></i></a>
                                <a href="https://www.instagram.com/keretaapikita" class="d-flex align-items-center justify-content-center"><i class="bi bi-instagram"></i></a>
                                <a href="https://www.youtube.com/keretaapikita" class="d-flex align-items-center justify-content-center"><i class="bi bi-youtube"></i></a>
                            </div> -->
                        </div>
                    </div><!-- End footer info column-->

                    <div class="col-lg-8 col-md-1" style="text-align: justify; margin-top:15px; line-height:30px;">
                        <p class="text-justify">Unit Kesehatan Daop VII Madiun merupakah sebuah organisasi di bawah daerah Operasi VII Madiun.
                            yang wilayah kerjanya meliputi seluruh wilayah kerja Daop VII Madiun. Unit Kesehatan Daop VII Madiun
                            memberikan pelayanan kesehatan primer bagi pekerja dan keluarga serta memantau kesehatan pekerja
                            di lingkungan daop VII Madiun.</p>
                    </div>


                </div>
            </div>
        </div>

        <div class="footer-legal text-center position-relative">
            <div class="container">
                <div class="copyright">
                    PT Kereta Api Indonesia (Persero) <strong><span>&copy;2024</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <!-- <script>
        // Panggil fungsi sortir setelah data ditampilkan
        sortTableByJobPosition();
    </script> -->


</body>

</html>