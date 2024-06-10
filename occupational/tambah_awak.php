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
    <style>
        .station-block {
            border: 1px solid #000;
            margin-bottom: 20px;
            padding: 10px;
        }
    </style>
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
                                        <h1 class="h4 text-gray-900 mb-4">Tambah Data Pemeriksaan Kesehatan Awak KA</h1>
                                    </div>
                                    <form class="user" method="post" id="nilaiForm" enctype="multipart/form-data" action="proses_tambah_awak.php">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control form-control-user" name="id" id="id" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="date">Tanggal:</label>
                                            <input type="date" class="form-control" id="date" name="date" required>
                                        </div><br>
                                        <div class="form-group">
                                            <?php
                                            // Daftar stasiun dan awak sarana yang telah ditetapkan
                                            $stations = array("UPT Crew Ka Madiun", "Stasiun Madiun", "Stasiun Kertosono", "Stasiun Blitar");
                                            $crews = array("Masinis", "Asmas", "Kondektur", "TKA", "Polsuska", "Serep, Lokrit, Langsir");

                                            // Perulangan untuk setiap stasiun
                                            for ($station = 0; $station < count($stations); $station++) :
                                            ?>
                                                <div class="station-block">
                                                    <h4><?php echo $stations[$station]; ?></h4>
                                                    <?php
                                                    // Perulangan untuk setiap awak sarana
                                                    for ($crew = 0; $crew < count($crews); $crew++) :
                                                    ?>
                                                        <h5><?php echo $crews[$crew]; ?></h5>
                                                        <label for="ms<?php echo $station + 1; ?>_<?php echo $crew + 1; ?>">MS:</label>
                                                        <input type="number" class="form-control" min=0 id="ms<?php echo $station + 1; ?>_<?php echo $crew + 1; ?>" name="ms<?php echo $station + 1; ?>_<?php echo $crew + 1; ?>" required>
                                                        <label for="tms<?php echo $station + 1; ?>_<?php echo $crew + 1; ?>">TMS:</label>
                                                        <input type="number" class="form-control" min=0 id="tms<?php echo $station + 1; ?>_<?php echo $crew + 1; ?>" name="tms<?php echo $station + 1; ?>_<?php echo $crew + 1; ?>" required>
                                                    <?php endfor; ?>
                                                </div>
                                            <?php endfor; ?>
                                        </div>
                                        <br>


                                        <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                        <a href="rikes.php" class="btn btn-danger btn-user btn-block">Kembali</a>
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