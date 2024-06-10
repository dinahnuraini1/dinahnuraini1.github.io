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
                                        <h1 class="h4 text-gray-900 mb-4">Tambah Hasil Tes Narkoba</h1>
                                    </div>
                                    <form class="user" method="post" id="nilaiForm" enctype="multipart/form-data" action="proses_tambah_narkoba.php">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control form-control-user" name="id" id="id" required>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="tanggal">Tanggal:</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" min="0" required>
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
                                            <label for="lokasi">Lokasi :</label>
                                            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah Peserta:</label>
                                            <input type="number" class="form-control" id="jumlah" name="jumlah" min="0" required>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="positif">Positif:</label>
                                            <input type="number" class="form-control nilai-input" id="positif" name="positif" min="0" required>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="negatif">Negatif:</label>
                                            <input type="number" class="form-control nilai-input" id="negatif" name="negatif" min="0" required>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="5242880"> <!-- 5MB dalam byte -->
                                            <label for="pdfFile">Upload PDF:</label>
                                            <input type="file" class="form-control-file" id="pdfFile" name="pdf_file" accept="application/pdf">
                                            <p style="color: red; font-style:italic;">*max 5MB</p>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                        <a href="narkoba.php" class="btn btn-danger btn-user btn-block">Kembali</a>
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