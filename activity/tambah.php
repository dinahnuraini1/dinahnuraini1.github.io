<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Activity Plan</title>
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
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12 text-center" style="padding-top:20px;"><img style="width: 100px;" src="../assets/img/logo1.png"></div>
                            <div class="col-lg-12">
                                <div class="p-3 pb-4 pt-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Tambah Timeline</h1>
                                    </div>

                                    <form class="user" method="post" action="proses_tambahtime.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control form-control-user" name="id" id="id" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="Pilih PIC">PIC:</label>
                                            <select class="form-control" name="pic" id="pic" onchange="showHideJobOptions()" required>
                                                <option value="">Pilih PIC</option>
                                                <option value="Supervisor">Supervisor</option>
                                                <option value="Assistant Manager Pelayanan & Kepesertaan">Assistant Manager Pelayanan & Kepesertaan</option>
                                                <option value="Assistant Manager Kesehatan Kerja">Assistant Manager Kesehatan Kerja</option>
                                            </select>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="tanggal">Dateline:</label>
                                            <input type="date" class="form-control form-control-user" name="tanggal" id="tanggal" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="uraian">Uraian:</label>
                                            <textarea class="form-control form-control-user" name="uraian" id="uraian" maxlength="100" rows="4" required></textarea>
                                            <p style="color: red; font-style:italic;">*max 100 kata</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan:</label>
                                            <textarea class="form-control form-control-user" id="ket" name="ket" maxlength="1000" rows="4" required></textarea>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="status">Status:</label>
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="">Pilih Status</option>
                                                <option value="Done">Done</option>
                                                <option value="Process">Process</option>
                                            </select>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="pdf">Upload PDF:</label>
                                            <input type="file" class="form-control" name="pdf" id="pdf" accept="application/pdf">
                                        </div><br><br>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                        <a href="timeline2.php" class="btn btn-danger btn-user btn-block">Kembali</a>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>