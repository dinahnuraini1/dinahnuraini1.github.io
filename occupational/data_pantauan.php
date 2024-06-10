<?php
include '../koneksi.php';

// Pastikan parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    // Tangkap nilai id dari parameter URL
    $id = $_GET['id'];

    // Query untuk mengambil data pekerja berdasarkan id
    $query = "SELECT * FROM pantauan WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    // Pastikan data pekerja ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Ambil data pekerja dari hasil query
        $row = mysqli_fetch_assoc($result);

        // Tampilkan profil pekerja
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

            <!-- =======================================================
  * Template Name: UpConstruction - v1.2.1
  * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
        </head>

        <body>


            <!-- ======= Header ======= -->
            <header id="header" class="header d-flex align-items-center">
                <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

                    <a href="index.php" class="logo d-flex align-items-center">
                        <!-- Uncomment the line below if you also wish to use an image logo -->
                        <!-- <img src="assets/img/logo.png" alt=""> -->
                        <h1>Unit Kesehatan | Daop 7 Madiun </h1>
                    </a>

                    <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
                    <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>


                </div>
            </header><!-- End Header -->

            <main id="main">

                <!-- ======= Breadcrumbs ======= -->
                <div class="breadcrumbs d-flex align-items-center" style="background-image: url('../assets/img/depan/4.jpg');">
                    <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

                        <h2>Occupational Health</h2>
                    </div>
                </div><!-- End Breadcrumbs -->

                <!-- ======= Service Details Section ======= -->
                <section id="service-details" class="service-details">

                    <div class="container" data-aos="fade-up" data-aos-delay="100">
                        <div>
                            <center>
                                <div data-aos="fade-up" data-aos-delay="200">
                                    <img style="width:50%; height: 50%;" src="../dokumentasi_pantauan/<?php echo $row['gambar']; ?>" />
                                    <!-- <img style="width:30%; height: 30%;" src="../dokumentasi_penyuluhan/<?php echo $row['gambar']; ?>" /> -->
                                </div><!-- End Icon Box -->
                            </center>
                            <br><br>
                            <br>
                            <a href="javascript:history.back()" class="btn btn-user btn-block" style="background-color: #A3D8FF;">Kembali</a>

                        </div>
                    </div>
                    </div>
                </section><!-- End Service Details Section -->
            </main><!-- End #main -->
            <!-- ======= Footer ======= -->
            <footer id="footer" class="footer">

                <div class="footer-content position-relative">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-4 col-md-6">
                                <div class="footer-info">
                                    <h3>Unit Kesehatan</h3>
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
<?php
    } else {
        // Jika data tidak ditemukan, tampilkan pesan error atau tindakan lainnya
        echo "Data pekerja tidak ditemukan.";
    }
} else {
    // Jika parameter id tidak diterima dari URL, tampilkan pesan error atau tindakan lainnya
    echo "ID pekerja tidak ditemukan.";
}
