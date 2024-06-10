<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Health Budget</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="gambar/logo1.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        input::placeholder {
            color: #999; /* Ganti warna sesuai keinginan Anda */
            opacity: 1; /* Untuk memastikan placeholder terlihat dengan jelas */
        }
        .form-label {
            position: absolute;
            top: -10px;
            left: 15px;
            background: #fff;
            padding: 0 5px;
            font-size: 12px;
            color: #666;
        }
        .form-control {
            padding-top: 25px; /* Agar teks input tidak tertutup oleh placeholder */
        }
    </style>
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
                            <div class="col-lg-12 text-center" style="padding-top:20px;">
                                <img style="width: 100px;" src="gambar/logo1.png">
                            </div>
                            <div class="col-lg-12">
                                <div class="p-3 pb-4 pt-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Tambah Data</h1>
                                    </div>
                                    <form action="action_tambah_tagihan.php" method="POST" class="login-email">
                                        <div class="input-group input-group-outline my-3 position-relative">
                              
                                            <input class="form-control" type="text" name="tahun" placeholder="Masukkan tahun" required>
                                        </div>
                                        <div class="input-group input-group-outline my-3 position-relative">
                                            <select class="form-select" name="jenis_pasien" required>
                                                <option value="">Pilih Jenis Pasien</option>
                                                <option value="RJTL">RJTL</option>
                                                <option value="RI">RI</option>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-outline my-3 position-relative">
                                            <select class="form-select" name="bulan" required>
                                                <option value="">Pilih Bulan</option>
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
                                        </div>
                                        <div class="input-group input-group-outline my-3 position-relative">
                                         
                                            <input class="form-control" type="number" name="jumlah_pasien" placeholder="Masukkan jumlah pasien" required>
                                        </div>
                                        <div class="input-group input-group-outline my-3 position-relative">
                                            
                                            <input class="form-control" type="number" name="biaya" placeholder="Masukkan jumlah tagihan" required>
                                        </div>
                                        <div class="input-group text-center">
                                            <button name="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Submit</button>
                                            <a href="jumlah_tagihan.php" class="btn btn-danger btn-block w-100 my-4 mb-2">Kembali</a>
                                        </div>
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
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
</body>

</html>
