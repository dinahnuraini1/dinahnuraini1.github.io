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

// Periksa apakah id telah diberikan melalui query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data dari database berdasarkan id
    $sql = "SELECT * FROM supervisi_alat_kerja WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Periksa apakah data ditemukan
    if ($data = mysqli_fetch_assoc($result)) {
        // Data ditemukan, lanjutkan untuk menampilkan form
    } else {
        echo "
            <script>
            alert('Data tidak ditemukan');
            window.location.href = 'supervisi_alat.php';
            </script>
        ";
        exit;
    }

    mysqli_stmt_close($stmt);
} else {
    echo "
        <script>
        alert('ID tidak diberikan');
        window.location.href = 'supervisi_alat.php';
        </script>
    ";
    exit;
}

// Tutup koneksi
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>Unit Kesehatan | Daop 7 Madiun</title>
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    .card {
      max-width: 600px;
      margin: auto;
    }
    .form-select, .form-control {
      border: 1px solid #ced4da !important;
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
                                    <form class="user" method="post" action="pengeditan_supervisi_alat.php">
                                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                        <div class="form-group">
                                            <label for="">Tanggal</label>
                                            <input type="date" class="form-control form-control-user" name="tanggal" placeholder="Tanggal" value="<?php echo $data['tanggal']; ?>">
                                        </div>
                                        <div class="form-group">
                                        <label for="">Unit Kerja</label>
                                            <input type="text" class="form-control form-control-user" name="unit_kerja"  value="<?php echo $data['unit_kerja']; ?>">
                                        </div>
                                        <div class="form-group">
                                        <label for="">APD</label>
                                            <input type="number" class="form-control form-control-user" name="apd" placeholder="APD" value="<?php echo $data['apd']; ?>">
                                        </div>
                                        <div class="form-group">
                                        <label for="">APAR</label>
                                            <input type="number" class="form-control form-control-user" name="apar" placeholder="APAR" value="<?php echo $data['apar']; ?>">
                                        </div>
                                        <div class="form-group">
                                        <label for="">P3K</label>
                                            <input type="number" class="form-control form-control-user" name="p3k" placeholder="P3K" value="<?php echo $data['p3k']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Rekomendasi</label>
                                            <textarea class="form-control form-control-user" name="rekomendasi"><?php echo $data['rekomendasi']; ?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                        <a href="supervisi_alat.php" type="submit" class="btn btn-danger btn-user btn-block">Kembali</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
