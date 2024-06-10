<?php
include '../koneksi.php';

// Pastikan parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    // Tangkap nilai id dari parameter URL
    $id = $_GET['id'];

    // Query untuk mengambil data pekerja berdasarkan id
    $query = "SELECT * FROM user_mediska_kertosono WHERE nipp = '$id'";
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

            <title>Human Capital</title>
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

            <style>
                .container {
                    width: 100%;
                    padding: 15px;
                }

                .icon-box {
                    flex: 0 0 33.33%;
                    padding: 15px;
                    box-sizing: border-box;
                }

                .icon-box img {
                    margin-right: 15px;
                }

                .stretched-link {
                    margin-left: 15px;
                    color: #A1C398;
                }

                @media (max-width: 768px) {
                    .icon-box {
                        flex: 0 0 50%;
                    }
                }

                @media (max-width: 480px) {
                    .icon-box {
                        flex: 0 0 100%;
                    }
                }
            </style>
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

                    <!-- <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
                    <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i> -->


                </div>
            </header><!-- End Header -->

            <main id="main">

                <!-- ======= Breadcrumbs ======= -->
                <div class="breadcrumbs d-flex align-items-center" style="background-image: url('../assets/img/depan/4.jpg');">
                    <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

                        <h2>Human Capital</h2>
                        <!-- <ol>
                            <li><a href="../index.php">Home</a></li>
                            <li><a href="../human-capital/human_capital.php">Human Capital</a></li>
                            <li>Data Pekerja</li>
                        </ol> -->

                    </div>
                </div><!-- End Breadcrumbs -->

                <!-- ======= Service Details Section ======= -->
                <section id="service-details" class="service-details">

                    <div class="container" data-aos="fade-up" data-aos-delay="100">
                        <!-- <div class="row gy-4"> -->
                        <!-- DESKRIPSI -->
                        <div>
                            <!-- <center> <img src="../assets/img/depan/3.jpg" alt="" class="img-fluid services-img" style="width: 50%;">
                            </center><br><br> -->
                            <center>
                                <div data-aos="fade-up" data-aos-delay="200">
                                    <img style="width:30%; height: 30%;" src="../daftar_gambar/<?php echo $row['gambar']; ?>" />
                                    <!-- <?php
                                            // Check if the 'gambar' column in your database contains the URL of the image
                                            // Replace 'gambar' with the actual column name that stores the image URL
                                            if (!empty($row['gambar'])) {
                                                echo '<img src="' . $row['gambar'] . '" alt="Gambar" width="30%" height="30%">';
                                            } else {
                                                // If no image URL is found in the database, you can display a placeholder image or a message
                                                echo '<img src="../daftar_gambar/" alt="Placeholder Image" width="60" height="60">';
                                            }
                                            ?> -->
                                </div><!-- End Icon Box -->
                            </center>
                            <br><br>


                            <div class="container">
                                <!-- Baris Pertama -->
                                <div class="row d-flex flex-wrap">
                                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                                        <i class="fa-solid"><img src="../assets/img/icon/id.png" alt="" width="50" height="50"></i>
                                        <div>
                                            <h4>
                                                <p class="stretched-link">NIPP</p>
                                            </h4>
                                            <p><?php echo $row['nipp']; ?></p>
                                        </div>
                                    </div>
                                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                                        <i class="fa-solid"><img src="../assets/img/icon/user.png" alt="" width="50" height="50"></i>
                                        <div>
                                            <h4>
                                                <p class="stretched-link">Nama</p>
                                            </h4>
                                            <p><?php echo $row['nama']; ?></p>
                                        </div>
                                    </div>
                                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                                        <i class="fa-solid"><img src="../assets/img/icon/jobs.png" alt="" width="50" height="50"></i>
                                        <div>
                                            <h4>
                                                <p class="stretched-link">Jabatan</p>
                                            </h4>
                                            <p><?php echo $row['jabatan']; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris Kedua -->
                                <div class="row d-flex flex-wrap">
                                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                                        <i class="fa-solid"><img src="../assets/img/icon/team.png" alt="" width="50" height="50"></i>
                                        <div>
                                            <h4>
                                                <p class="stretched-link">Kedudukan</p>
                                            </h4>
                                            <p><?php echo $row['kedudukan']; ?></p>
                                        </div>
                                    </div>
                                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                                        <i class="fa-solid"><img src="../assets/img/icon/lct.png" alt="" width="50" height="50"></i>
                                        <div>
                                            <h4>
                                                <p class="stretched-link">Tempat Lahir</p>
                                            </h4>
                                            <p><?php echo $row['tempat_lhr']; ?></p>
                                        </div>
                                    </div>
                                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                                        <i class="fa-solid"><img src="../assets/img/icon/schedule.png" alt="" width="50" height="50"></i>
                                        <div>
                                            <h4>
                                                <p class="stretched-link">Tanggal Lahir</p>
                                            </h4>
                                            <p><?php echo $row['tgl']; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris Ketiga -->
                                <div class="row d-flex flex-wrap">
                                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                                        <i class="fa-solid"><img src="../assets/img/icon/congratulation.png" alt="" width="50" height="50"></i>
                                        <div>
                                            <h4>
                                                <p class="stretched-link">Pendidikan</p>
                                            </h4>
                                            <p><?php echo $row['pend']; ?></p>
                                        </div>
                                    </div>
                                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                                        <i class="fa-solid"><img src="../assets/img/icon/academic.png" alt="" width="50" height="50"></i>
                                        <div>
                                            <h4>
                                                <p class="stretched-link">Profesi</p>
                                            </h4>
                                            <p><?php echo $row['profesi']; ?></p>
                                        </div>
                                    </div>
                                    <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="200">
                                        <i class="fa-solid"><img src="../assets/img/icon/status.png" alt="" width="50" height="50"></i>
                                        <div>
                                            <h4>
                                                <p class="stretched-link">Status</p>
                                            </h4>
                                            <p><?php echo $row['status']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>

                            <a href="coba.php" class="btn btn-user btn-block" style="background-color: #F27BBD;">Kembali</a>


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
