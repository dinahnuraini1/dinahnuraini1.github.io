<?php
include '../koneksi.php';
session_start();
// if (isset($_SESSION['error_message'])) {
//     // Menampilkan pesan kesalahan menggunakan alert JavaScript
//     echo "<script>alert('{$_SESSION['error_message']}');</script>";

//     // Hapus pesan kesalahan setelah ditampilkan
//     unset($_SESSION['error_message']);
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Occupational Health</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/logo1.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12 text-center" style="padding-top:20px;"><img style="width: 100px;" src="../assets/img/logo1.png"></div>
                            <div class="col-lg-12">
                                <div class="p-3 pb-4 pt-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Tambah Data Pekerja Risiko Tinggi</h1>
                                    </div>
                                    <form class="user" method="post" id="nilaiForm" enctype="multipart/form-data" action="proses_tambah_risiko.php">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control form-control-user" name="id" id="id" required>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="tanggal">Tahun:</label>
                                            <input type="number" class="form-control" id="tanggal" name="tanggal" min="0" required>
                                        </div><br>
                                        <!-- <div class="form-group">
                                            <label for="bulan">Bulan:</label>
                                            <select class="form-control" id="bulan" name="bulan" required>
                                                <option value="" selected>Pilih Bulan</option>
                                                <option value="Januari">Januari</option>
                                                <option value="Februari">Februari</option>
                                                <option value="Maret">Maret</option>
                                                <option value="April">April</option>
                                                <option value="Mei">Mei</option>
                                                <option value="Juni">Juni</option>
                                                <option value="Juli">Juli</option>
                                                <option value="Agustus">Agustus</option>
                                                <option value="September">September</option>
                                                <option value="Oktober">Oktober</option>
                                                <option value="November">November</option>
                                                <option value="Desember">Desember</option>
                                            </select>
                                        </div> -->
                                        <div class="form-group">
                                            <label for="nipp">nipp :</label>
                                            <input type="number" min="0" class="form-control" id="nipp" name="nipp" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="nama">Nama :</label>
                                            <input type="text" min="0" class="form-control" id="nama" name="nama" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="unit">Unit Kerja:</label>
                                            <input type="text" class="form-control" id="unit" name="unit" required>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="rekomendasi">Diagnosa:</label>
                                            <textarea class="form-control form-control-user" name="rekomendasi" id="rekomendasi" maxlength="200" rows="4"></textarea>
                                            <p style="color: red; font-style:italic;">*max 200 kata</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="diagnosa">Level:</label>
                                            <select class="form-control" id="diagnosa" name="diagnosa" required>
                                                <option value="" selected>Pilih Level</option>
                                                <option value="Ringan">Ringan</option>
                                                <option value="Sedang">Sedang</option>
                                                <option value="Berat">Berat</option>
                                            </select>
                                        </div>

                                        <br>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                        <a href="promo.php" class="btn btn-danger btn-user btn-block">Kembali</a>
                                    </form>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</body>

</html>