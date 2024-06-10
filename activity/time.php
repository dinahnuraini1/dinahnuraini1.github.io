<?php

include '../koneksi.php';
// Query untuk mengambil data dari database
$query = "SELECT * FROM pic_manager";
$result = mysqli_query($conn, $query);
$totalRows = mysqli_num_rows($result);

$query1 = "SELECT * FROM pic_madiun";
$result1 = mysqli_query($conn, $query1);
$totalRows1 = mysqli_num_rows($result1);

$query2 = "SELECT * FROM pic_blitar";
$result2 = mysqli_query($conn, $query2);
$totalRows2 = mysqli_num_rows($result2);

$query3 = "SELECT * FROM pic_kediri";
$result3 = mysqli_query($conn, $query3);
$totalRows3 = mysqli_num_rows($result3);

$query4 = "SELECT * FROM pic_kertosono";
$result4 = mysqli_query($conn, $query4);
$totalRows4 = mysqli_num_rows($result4);


$queryTotalProcess = "SELECT COUNT(*) as total FROM pic_manager WHERE status = 'Process'";
$resultTotalProcess = mysqli_query($conn, $queryTotalProcess);
$rowTotalProcess = mysqli_fetch_assoc($resultTotalProcess);
$totalRowsProcess = $rowTotalProcess['total'];

$queryTotalProcess1 = "SELECT COUNT(*) as total FROM pic_kertosono WHERE status = 'Process'";
$resultTotalProcess1 = mysqli_query($conn, $queryTotalProcess1);
$rowTotalProcess1 = mysqli_fetch_assoc($resultTotalProcess1);
$totalRowsProcess1 = $rowTotalProcess1['total'];

$queryTotalProcess2 = "SELECT COUNT(*) as total FROM pic_madiun WHERE status = 'Process'";
$resultTotalProcess2 = mysqli_query($conn, $queryTotalProcess2);
$rowTotalProcess2 = mysqli_fetch_assoc($resultTotalProcess2);
$totalRowsProcess2 = $rowTotalProcess2['total'];

$queryTotalProcess3 = "SELECT COUNT(*) as total FROM pic_blitar WHERE status = 'Process'";
$resultTotalProcess3 = mysqli_query($conn, $queryTotalProcess3);
$rowTotalProcess3 = mysqli_fetch_assoc($resultTotalProcess3);
$totalRowsProcess3 = $rowTotalProcess3['total'];

$queryTotalProcess4 = "SELECT COUNT(*) as total FROM pic_kediri WHERE status = 'Process'";
$resultTotalProcess4 = mysqli_query($conn, $queryTotalProcess4);
$rowTotalProcess4 = mysqli_fetch_assoc($resultTotalProcess4);
$totalRowsProcess4 = $rowTotalProcess4['total'];

// donee

$queryTotalDone = "SELECT COUNT(*) as total FROM pic_manager WHERE status = 'Done'";
$resultTotalDone = mysqli_query($conn, $queryTotalDone);
$rowTotalDone = mysqli_fetch_assoc($resultTotalDone);
$totalRowsDone = $rowTotalDone['total'];

$queryTotalDone1 = "SELECT COUNT(*) as total FROM pic_madiun WHERE status = 'Done'";
$resultTotalDone1 = mysqli_query($conn, $queryTotalDone1);
$rowTotalDone1 = mysqli_fetch_assoc($resultTotalDone1);
$totalRowsDone1 = $rowTotalDone1['total'];

$queryTotalDone2 = "SELECT COUNT(*) as total FROM pic_kertosono WHERE status = 'Done'";
$resultTotalDone2 = mysqli_query($conn, $queryTotalDone2);
$rowTotalDone2 = mysqli_fetch_assoc($resultTotalDone2);
$totalRowsDone2 = $rowTotalDone2['total'];

$queryTotalDone3 = "SELECT COUNT(*) as total FROM pic_kediri WHERE status = 'Done'";
$resultTotalDone3 = mysqli_query($conn, $queryTotalDone3);
$rowTotalDone3 = mysqli_fetch_assoc($resultTotalDone3);
$totalRowsDone3 = $rowTotalDone3['total'];

$queryTotalDone4 = "SELECT COUNT(*) as total FROM pic_blitar WHERE status = 'Done'";
$resultTotalDone4 = mysqli_query($conn, $queryTotalDone4);
$rowTotalDone4 = mysqli_fetch_assoc($resultTotalDone4);
$totalRowsDone4 = $rowTotalDone4['total'];

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

    <!-- =======================================================
  * Template Name: UpConstruction - v1.2.1
  * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        .hidden {
            display: none;
        }
    </style>

    <!-- =======================================================
  * Template Name: UpConstruction - v1.2.1
  * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
                        fetch('data_user_uk.php') // Ganti dengan URL yang sesuai untuk mengambil data dari tabel user_uk
                            .then(response => response.json())
                            .then(data => {
                                // Manipulasi DOM untuk menampilkan data dari tabel user_uk di sini
                            })
                            .catch(error => console.error('Error:', error));
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

        </div>
    </header><!-- End Header -->

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <div class="breadcrumbs d-flex align-items-center" style="background-image: url('../assets/img/depan/4.jpg');">
            <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

                <h2>Activity Plan</h2>
                <ol>
                    <li><a href="../index.php">Home</a></li>
                    <li>Activity Plan</li>
                </ol>

            </div>
        </div><!-- End Breadcrumbs -->

        <!-- ======= Service Details Section ======= -->
        <section id="service-details" class="service-details">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <a href="tambah_time.php">
                    <i class="fa-solid"><img src="../assets/img/icon/plus.png" alt="" width="30" height="30"></i>
                </a>
                <br>
                <!-- TABLE IP -->

                <div class="row">
                    <div class="col-12">
                        <!-- MANAGER KESEHATAN -->
                        <div class="card my-4">

                            <div class="card-header p-3 position-relative ">
                                <div class="border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center" style="background-color: #C6EBC5;">

                                    <button id="toggle-button1" class="toggle-button" data-target-id="table-body1" style="margin-left: 10px;">
                                        <i class="fas fa-plus"></i>
                                        <i class="fas fa-minus d-none"></i>
                                    </button>
                                    <h6 class="text-black text-capitalize"> PIC MANAGER UNIT KESEHATAN </h6>
                                    <h6> <img src="../assets/img/icon/yes.png" alt="" width="30" height="30"><?php echo $totalRowsDone; ?></h6>
                                    <h6> <img src="../assets/img/icon/no.png" alt="" width="30" height="30"><?php echo $totalRowsProcess; ?>
                                    </h6>

                                </div>
                            </div>

                            <div class="card-body px-0 pb-2 table-body1 hidden" id="table-body1">
                                <div class="table-responsive p-0">

                                    <table id="profilTable" class="table table-bordered table-sm" style="text-align: center;"> <!-- Tambahkan kelas table-sm untuk merampingkan tabel -->
                                        <thead>
                                            <tr>

                                                <!-- <th>No</th> -->
                                                <th>No</th>

                                                <th>Tanggal</th>
                                                <th>Uraian</th>
                                                <th>Status</th>
                                                <th style="width: 100px;">Action</th> <!-- Atur lebar kolom Action -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $icon = '';
                                                if ($row['status'] == 'Done') {
                                                    $bg_color = '#C6EBC5'; // warna hijau untuk status 'Done'
                                                } else if (
                                                    $row['status'] == 'Process'
                                                ) {
                                                    $bg_color = '#FF9B9B'; // warna merah untuk status 'Process'
                                                }

                                            ?>
                                                <tr>


                                                    <td><?php echo $i; ?></td>

                                                    <td><?php echo $row['tanggal']; ?></td>
                                                    <td><?php echo $row['uraian']; ?></td>
                                                    <td style="background-color: <?php echo $bg_color; ?>"><?php echo $row['status']; ?></td>
                                                    <td>
                                                        <center>
                                                            <!-- Tombol edit -->
                                                            <a href="edit_manager.php?id=<?php echo $row['id']; ?>">
                                                                <i class="fa-solid"><img src="../assets/img/icon/pen.png" alt="" width="30" height="30"></i>
                                                            </a>
                                                            <!-- Tombol hapus -->
                                                            <a href="hapus_manager.php?id=<?php echo $row['id']; ?>">
                                                                <i class="fa-solid"><img src="../assets/img/icon/bin.png" alt="" width="30" height="30"></i>
                                                            </a>
                                                            <!-- Menampilkan gambar ikon berdasarkan status -->

                                                        </center>
                                                    </td>

                                                </tr>
                                            <?php
                                                $i++;
                                            }
                                            // echo "<script>sortTableByJobPosition();</script>";
                                            ?>
                                        </tbody>

                                    </table><br>
                                </div>

                            </div>
                        </div>
                        <!-- KEPALA MADIUN -->
                        <div class="card my-4">

                            <div class="card-header p-3 position-relative ">
                                <div class="border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center" style="background-color: #C6EBC5;">

                                    <button id="toggle-button2" class="toggle-button" data-target-id="table-body2" style="margin-left: 10px;">
                                        <i class="fas fa-plus"></i>
                                        <i class="fas fa-minus d-none"></i>
                                    </button>
                                    <h6 class="text-black text-capitalize"> PIC KEPALA KLINIK MEDISKA MADIUN </h6>

                                    <h6> <img src="../assets/img/icon/yes.png" alt="" width="30" height="30"><?php echo $totalRowsDone1; ?></h6>
                                    <h6> <img src="../assets/img/icon/no.png" alt="" width="30" height="30"><?php echo $totalRowsProcess2; ?>
                                    </h6>
                                </div>
                            </div>

                            <div class="card-body px-0 pb-2 table-body2 hidden" id="table-body2">
                                <div class="table-responsive p-0">

                                    <table id="profilTable" class="table table-bordered table-sm" style="text-align: center;"> <!-- Tambahkan kelas table-sm untuk merampingkan tabel -->
                                        <thead>
                                            <tr>

                                                <!-- <th>No</th> -->
                                                <th>No</th>

                                                <th>Tanggal</th>
                                                <th>Uraian</th>
                                                <th>Status</th>
                                                <th style="width: 100px;">Action</th> <!-- Atur lebar kolom Action -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                                $icon = '';
                                                if ($row1['status'] == 'Done') {
                                                    $bg_color = '#C6EBC5'; // warna hijau untuk status 'Done'
                                                } else if (
                                                    $row1['status'] == 'Process'
                                                ) {
                                                    $bg_color = '#FF9B9B'; // warna merah untuk status 'Process'
                                                }
                                            ?>
                                                <tr>


                                                    <td><?php echo $i; ?></td>

                                                    <td><?php echo $row1['tanggal']; ?></td>
                                                    <td><?php echo $row1['uraian']; ?></td>
                                                    <td style="background-color: <?php echo $bg_color; ?>"><?php echo $row1['status']; ?></td>
                                                    <td>
                                                        <center>
                                                            <!-- Tombol edit -->
                                                            <a href="edit_madiun.php?id=<?php echo $row1['id']; ?>">
                                                                <i class="fa-solid"><img src="../assets/img/icon/pen.png" alt="" width="30" height="30"></i>
                                                            </a>
                                                            <!-- Tombol hapus -->
                                                            <a href="hapus_madiun.php?id=<?php echo $row1['id']; ?>">
                                                                <i class="fa-solid"><img src="../assets/img/icon/bin.png" alt="" width="30" height="30"></i>
                                                            </a>
                                                            <!-- Menampilkan gambar ikon berdasarkan status -->

                                                        </center>
                                                    </td>

                                                </tr>
                                            <?php $i++;
                                            }
                                            // echo "<script>sortTableByJobPosition();</script>";
                                            ?>
                                        </tbody>

                                    </table><br>
                                </div>

                            </div>
                        </div>

                        <!-- KEPALA KERTOSONO -->
                        <div class="card my-4">

                            <div class="card-header p-3 position-relative ">
                                <div class="border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center" style="background-color: #C6EBC5;">

                                    <button id="toggle-button3" class="toggle-button" data-target-id="table-body3" style="margin-left: 10px;">
                                        <i class="fas fa-plus"></i>
                                        <i class="fas fa-minus d-none"></i>
                                    </button>
                                    <h6 class="text-black text-capitalize"> PIC KEPALA KLINIK MEDISKA KERTOSONO </h6>

                                    <h6> <img src="../assets/img/icon/yes.png" alt="" width="30" height="30"><?php echo $totalRowsDone2; ?></h6>
                                    <h6> <img src="../assets/img/icon/no.png" alt="" width="30" height="30"><?php echo $totalRowsProcess1; ?>
                                    </h6>
                                </div>
                            </div>

                            <div class="card-body px-0 pb-2 table-body3 hidden" id="table-body3">
                                <div class="table-responsive p-0">

                                    <table id="profilTable" class="table table-bordered table-sm" style="text-align: center;"> <!-- Tambahkan kelas table-sm untuk merampingkan tabel -->
                                        <thead>
                                            <tr>

                                                <!-- <th>No</th> -->
                                                <th>No</th>

                                                <th>Tanggal</th>
                                                <th>Uraian</th>
                                                <th>Status</th>
                                                <th style="width: 100px;">Action</th> <!-- Atur lebar kolom Action -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row4 = mysqli_fetch_assoc($result4)) {
                                                $icon = '';
                                                if ($row4['status'] == 'Done') {
                                                    $bg_color = '#C6EBC5'; // warna hijau untuk status 'Done'
                                                } else if (
                                                    $row4['status'] == 'Process'
                                                ) {
                                                    $bg_color = '#FF9B9B'; // warna merah untuk status 'Process'
                                                }
                                            ?>
                                                <tr>


                                                    <td><?php echo $i; ?></td>

                                                    <td><?php echo $row4['tanggal']; ?></td>
                                                    <td><?php echo $row4['uraian']; ?></td>
                                                    <td style="background-color: <?php echo $bg_color; ?>"><?php echo $row4['status']; ?></td>
                                                    <td>
                                                        <center>
                                                            <!-- Tombol edit -->
                                                            <a href="edit_kertosono.php?id=<?php echo $row4['id']; ?>">
                                                                <i class="fa-solid"><img src="../assets/img/icon/pen.png" alt="" width="30" height="30"></i>
                                                            </a>
                                                            <!-- Tombol hapus -->
                                                            <a href="hapus_kertosono.php?id=<?php echo $row4['id']; ?>">
                                                                <i class="fa-solid"><img src="../assets/img/icon/bin.png" alt="" width="30" height="30"></i>
                                                            </a>
                                                            <!-- Menampilkan gambar ikon berdasarkan status -->

                                                        </center>
                                                    </td>

                                                </tr>
                                            <?php $i++;
                                            }
                                            // echo "<script>sortTableByJobPosition();</script>";
                                            ?>
                                        </tbody>

                                    </table><br>
                                </div>

                            </div>
                        </div>

                        <!-- KEPALA KEDIRI -->
                        <div class="card my-4">

                            <div class="card-header p-3 position-relative ">
                                <div class="border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center" style="background-color: #C6EBC5;">

                                    <button id="toggle-button4" class="toggle-button" data-target-id="table-body4" style="margin-left: 10px;">
                                        <i class="fas fa-plus"></i>
                                        <i class="fas fa-minus d-none"></i>
                                    </button>
                                    <h6 class="text-black text-capitalize"> PIC KEPALA KLINIK MEDISKA KEDIRI </h6>

                                    <h6> <img src="../assets/img/icon/yes.png" alt="" width="30" height="30"><?php echo $totalRowsDone3; ?></h6>
                                    <h6> <img src="../assets/img/icon/no.png" alt="" width="30" height="30"><?php echo $totalRowsProcess4; ?>
                                    </h6>
                                </div>
                            </div>

                            <div class="card-body px-0 pb-2 table-body4 hidden" id="table-body4">
                                <div class="table-responsive p-0">

                                    <table id="profilTable" class="table table-bordered table-sm" style="text-align: center;"> <!-- Tambahkan kelas table-sm untuk merampingkan tabel -->
                                        <thead>
                                            <tr>

                                                <!-- <th>No</th> -->
                                                <th>No</th>

                                                <th>Tanggal</th>
                                                <th>Uraian</th>
                                                <th>Status</th>
                                                <th style="width: 100px;">Action</th> <!-- Atur lebar kolom Action -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                                $icon = '';
                                                if ($row3['status'] == 'Done') {
                                                    $bg_color = '#C6EBC5'; // warna hijau untuk status 'Done'
                                                } else if (
                                                    $row3['status'] == 'Process'
                                                ) {
                                                    $bg_color = '#FF9B9B'; // warna merah untuk status 'Process'
                                                }
                                            ?>
                                                <tr>


                                                    <td><?php echo $i; ?></td>

                                                    <td><?php echo $row3['tanggal']; ?></td>
                                                    <td><?php echo $row3['uraian']; ?></td>
                                                    <td style="background-color: <?php echo $bg_color; ?>"><?php echo $row3['status']; ?></td>
                                                    <td>
                                                        <center>
                                                            <!-- Tombol edit -->
                                                            <a href="edit_kediri.php?id=<?php echo $row3['id']; ?>">
                                                                <i class="fa-solid"><img src="../assets/img/icon/pen.png" alt="" width="30" height="30"></i>
                                                            </a>
                                                            <!-- Tombol hapus -->
                                                            <a href="hapus_kediri.php?id=<?php echo $row3['id']; ?>">
                                                                <i class="fa-solid"><img src="../assets/img/icon/bin.png" alt="" width="30" height="30"></i>
                                                            </a>
                                                            <!-- Menampilkan gambar ikon berdasarkan status -->

                                                        </center>
                                                    </td>

                                                </tr>
                                            <?php $i++;
                                            }
                                            // echo "<script>sortTableByJobPosition();</script>";
                                            ?>
                                        </tbody>

                                    </table><br>
                                </div>

                            </div>
                        </div>

                        <!-- KEPALA BLITAR -->
                        <div class="card my-4">

                            <div class="card-header p-3 position-relative ">
                                <div class="border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center" style="background-color: #C6EBC5;">

                                    <button id="toggle-button5" class="toggle-button" data-target-id="table-body5" style="margin-left: 10px;">
                                        <i class="fas fa-plus"></i>
                                        <i class="fas fa-minus d-none"></i>
                                    </button>
                                    <h6 class="text-black text-capitalize"> PIC KEPALA KLINIK MEDISKA BLITAR </h6>

                                    <h6> <img src="../assets/img/icon/yes.png" alt="" width="30" height="30"><?php echo $totalRowsDone4; ?></h6>
                                    <h6> <img src="../assets/img/icon/no.png" alt="" width="30" height="30"><?php echo $totalRowsProcess3; ?>
                                    </h6>
                                </div>
                            </div>

                            <div class="card-body px-0 pb-2 table-body5 hidden" id="table-body5">
                                <div class="table-responsive p-0">

                                    <table id="profilTable" class="table table-bordered table-sm" style="text-align: center;"> <!-- Tambahkan kelas table-sm untuk merampingkan tabel -->
                                        <thead>
                                            <tr>

                                                <!-- <th>No</th> -->
                                                <th>No</th>

                                                <th>Tanggal</th>
                                                <th>Uraian</th>
                                                <th>Status</th>
                                                <th style="width: 100px;">Action</th> <!-- Atur lebar kolom Action -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                                $icon = '';
                                                if ($row2['status'] == 'Done') {
                                                    $bg_color = '#C6EBC5'; // warna hijau untuk status 'Done'
                                                } else if (
                                                    $row2['status'] == 'Process'
                                                ) {
                                                    $bg_color = '#FF9B9B'; // warna merah untuk status 'Process'
                                                }
                                            ?>
                                                <tr>


                                                    <td><?php echo $i; ?></td>

                                                    <td><?php echo $row2['tanggal']; ?></td>
                                                    <td><?php echo $row2['uraian']; ?></td>
                                                    <td style="background-color: <?php echo $bg_color; ?>"><?php echo $row2['status']; ?></td>
                                                    <td>
                                                        <center>
                                                            <!-- Tombol edit -->
                                                            <a href="edit_blitar.php?id=<?php echo $row2['id']; ?>">
                                                                <i class="fa-solid"><img src="../assets/img/icon/pen.png" alt="" width="30" height="30"></i>
                                                            </a>
                                                            <!-- Tombol hapus -->
                                                            <a href="hapus_blitar.php?id=<?php echo $row2['id']; ?>">
                                                                <i class="fa-solid"><img src="../assets/img/icon/bin.png" alt="" width="30" height="30"></i>
                                                            </a>
                                                            <!-- Menampilkan gambar ikon berdasarkan status -->

                                                        </center>
                                                    </td>

                                                </tr>
                                            <?php $i++;
                                            }
                                            // echo "<script>sortTableByJobPosition();</script>";
                                            ?>
                                        </tbody>

                                    </table><br>
                                </div>

                            </div>
                        </div>
                    </div>
                </div><a href="../index.php">
                    <i class="fa-solid"><img src="../assets/img/icon/undo.png" alt="" width="30" height="30"></i>
                </a>
            </div>
            </div>
            </div>
        </section>


        <!-- End Service Details Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="footer-content position-relative">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            <h3 style="color:white">Unit Kesehatan</h3>
                            <p>
                                Kompol Sunaryo, Madiun Lor, <br>
                                Kec. Manguharjo, Kota Madiun, <br>
                                Jawa Timur 63122 <br><br>
                            </p>
                            <div class="social-links d-flex mt-3">
                                <a href="https://twitter.com/keretaapikita" class="d-flex align-items-center justify-content-center"><i class="bi bi-twitter"></i></a>
                                <a href="https://www.facebook.com/keretaapikita" class="d-flex align-items-center justify-content-center"><i class="bi bi-facebook"></i></a>
                                <a href="https://www.instagram.com/keretaapikita" class="d-flex align-items-center justify-content-center"><i class="bi bi-instagram"></i></a>
                                <a href="https://www.youtube.com/keretaapikita" class="d-flex align-items-center justify-content-center"><i class="bi bi-youtube"></i></a>
                            </div>
                        </div>
                    </div><!-- End footer info column-->

                    <div class="col-lg-8 col-md-1" style="text-align: justify; margin-top:15px; line-height:30px;">
                        <p class="text-justify">Unit Kesehatan Daop VII Madiun merupakah sebuah organisasi di bawah daerah Operasi VII Madiun.
                            yang wilayah kerjanya meliputi seluruh wilayah kerja Daop VII Madiun. Unit Kesehatan Daop VII Madiun
                            memberikan pelayanan kesehatan primer bagi pekerja dan keluarga serta memantau kesehatan pekerja
                            di lingkungan daop VII Madiun. Unit Kesehatan Daop VII Madiun memiliki 4 klinik diantaranya mediska Madiun,
                            mediska Kertosono, mediska Kediri,dan mediska Blitar. Selain itu terdapat 4 pos kesehatan/pos pemeriksaan kesehatan (
                            antara lain pos kesehatan stasiun Madiun, Kertosono, Kediri dan Blitar.</p>
                    </div><!-- End footer links column-->


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

</body>

</html>