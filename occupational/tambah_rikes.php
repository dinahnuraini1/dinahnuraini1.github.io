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
                                        <h1 class="h4 text-gray-900 mb-4">Tambah Data Rikes Khusus</h1>
                                    </div>
                                    <form class="user" method="post" action="proses_tambah_rikes.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal:</label>
                                            <input type="date" min="0" class="form-control" id="tanggal" name="tanggal" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="nama">Nama:</label>
                                            <input type="text" class="form-control form-control-user" name="nama" id="nama" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="nipp">Nipp:</label>
                                            <input type="number" class="form-control form-control-user" name="nipp" id="nipp" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="unit">Unit Kerja:</label>
                                            <input type="text" class="form-control form-control-user" name="unit" id="unit" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="jabatan">Jabatan:</label>
                                            <input type="text" class="form-control form-control-user" name="jabatan" id="jabatan" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="kedudukan">Kedudukan:</label>
                                            <input type="text" class="form-control form-control-user" name="kedudukan" id="kedudukan" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="kelas">Kelas Kesehatan:</label>
                                            <select class="form-control" name="kelas" id="kelas" required>
                                                <option value="">Pilih Kelas</option>
                                                <option value="Kelas Kesehatan I">Kelas Kesehatan I</option>
                                                <option value="Kelas Kesehatan II">Kelas Kesehatan II</option>
                                                <option value="Kelas Kesehatan III">Kelas Kesehatan III</option>
                                                <option value="Kelas Kesehatan IV">Kelas Kesehatan IV</option>
                                                <option value="Kelas Kesehatan V">Kelas Kesehatan V</option>
                                            </select>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="nilai">Nilai:</label>
                                            <select class="form-control" name="nilai" id="nilai" required>
                                                <option value="">Pilih Nilai</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option value="D">D</option>

                                            </select>
                                        </div><br>
                                        <div class="form-group">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="5242880"> <!-- 5MB dalam byte -->
                                            <label for="pdfFile">Upload PDF:</label>
                                            <input type="file" class="form-control-file" id="pdfFile" name="pdf_file" accept="application/pdf">
                                            <p style="color: red; font-style:italic;">*max 5MB</p>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" onclick=" submitForm()">Simpan</button>
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>