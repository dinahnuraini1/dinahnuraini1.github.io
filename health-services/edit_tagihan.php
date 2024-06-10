<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'kesehatan';

$conn = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil data berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tagihan WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "
            <script>
            alert('Data tidak ditemukan');
            window.location.href = 'jumlah_tagihan.php';
            </script>
        ";
        exit();
    }

    mysqli_stmt_close($stmt);
} else {
    echo "
        <script>
        alert('ID tidak ditemukan');
        window.location.href = 'jumlah_tagihan.php';
        </script>
    ";
    exit();
}
?>
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
            <div class="col-lg-6 col-md-8">
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
                                        <h1 class="h4 text-gray-900 mb-4">Edit Data</h1>
                                    </div>
                                    <form action="pengeditan_tagihan.php" method="POST" class="login-email">
                                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                        <div class="input-group input-group-outline my-3 position-relative">
                                            <input class="form-control" type="text" name="tahun" placeholder="Masukkan tahun" value="<?php echo $data['tahun']; ?>" required>
                                        </div>
                                        <div class="input-group input-group-outline my-3 position-relative">
                                            <select class="form-select" name="jenis_pasien" required>
                                                <option value="">Pilih Jenis Pasien</option>
                                                <option value="RJTL"<?php echo $data['jenis_pasien'] == 'RJTL' ? 'selected' : ''; ?>>RJTL</option>
                                                <option value="RI"<?php echo $data['jenis_pasien'] == 'RI' ? 'selected' : ''; ?>>RI</option>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-outline my-3 position-relative">
                                            <select class="form-select" name="bulan" required>
                                                <option value="">Pilih Bulan</option>
                                                <option value="Januari" <?php echo $data['bulan'] == 'Januari' ? 'selected' : ''; ?>>Januari</option>
                                                <option value="Februari" <?php echo $data['bulan'] == 'Februari' ? 'selected' : ''; ?>>Februari</option>
                                                <option value="Maret" <?php echo $data['bulan'] == 'Maret' ? 'selected' : ''; ?>>Maret</option>
                                                <option value="April" <?php echo $data['bulan'] == 'April' ? 'selected' : ''; ?>>April</option>
                                                <option value="Mei" <?php echo $data['bulan'] == 'Mei' ? 'selected' : ''; ?>>Mei</option>
                                                <option value="Juni" <?php echo $data['bulan'] == 'Juni' ? 'selected' : ''; ?>>Juni</option>
                                                <option value="Juli" <?php echo $data['bulan'] == 'Juli' ? 'selected' : ''; ?>>Juli</option>
                                                <option value="Agustus" <?php echo $data['bulan'] == 'Agustus' ? 'selected' : ''; ?>>Agustus</option>
                                                <option value="September" <?php echo $data['bulan'] == 'September' ? 'selected' : ''; ?>>September</option>
                                                <option value="Oktober" <?php echo $data['bulan'] == 'Oktober' ? 'selected' : ''; ?>>Oktober</option>
                                                <option value="November" <?php echo $data['bulan'] == 'November' ? 'selected' : ''; ?>>November</option>
                                                <option value="Desember" <?php echo $data['bulan'] == 'Desember' ? 'selected' : ''; ?>>Desember</option>
                                            </select>
                                        </div>
                                        <div class="input-group input-group-outline my-3 position-relative">
                                            <input class="form-control" type="number" name="jumlah_pasien" placeholder="Masukkan jumlah pasien" value="<?php echo $data['jumlah_pasien']; ?>" required>
                                        </div>
                                        <div class="input-group input-group-outline my-3 position-relative">
                                            <input class="form-control" type="number" name="biaya" placeholder="Masukkan jumlah tagihan" value="<?php echo $data['biaya']; ?>" required>
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
