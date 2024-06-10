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
    $sql = "SELECT * FROM kunjungan WHERE id = ?";
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
            window.location.href = 'kunjungan_klinik.php';
            </script>
        ";
        exit;
    }

    mysqli_stmt_close($stmt);
} else {
    echo "
        <script>
        alert('ID tidak diberikan');
        window.location.href = 'kunjungan_klinik.php';
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
                                        <h1 class="h4 text-gray-900 mb-4">Edit Data</h1>
                                    </div>
                                    <form class="user" method="post" action="pengeditan_kunjungan.php">
                                        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Jenis Kepesertaan</label>
                                                <select class="form-select" name="jenis_kepesertaan" required>
                                                    <option value="">Pilih Jenis Kepesertaan</option>
                                                    <option value="PEGAWAI" <?php echo $data['jenis_kepesertaan'] == 'PEGAWAI' ? 'selected' : ''; ?>>PEGAWAI</option>
                                                    <option value="KEL. PEGAWAI" <?php echo $data['jenis_kepesertaan'] == 'KEL. PEGAWAI' ? 'selected' : ''; ?>>KEL. PEGAWAI</option>
                                                    <option value="PASIEN UMUM" <?php echo $data['jenis_kepesertaan'] == 'PASIEN UMUM' ? 'selected' : ''; ?>>PASIEN UMUM</option>
                                                    <option value="BPJS KESEHATAN" <?php echo $data['jenis_kepesertaan'] == 'BPJS KESEHATAN' ? 'selected' : ''; ?>>BPJS KESEHATAN</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Januari</label>
                                                <input class="form-control" type="number" name="januari" value="<?php echo $data['januari']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Februari</label>
                                                <input class="form-control" type="number" name="februari" value="<?php echo $data['februari']; ?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Maret</label>
                                                <input class="form-control" type="number" name="maret" value="<?php echo $data['maret']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">April</label>
                                                <input class="form-control" type="number" name="april" value="<?php echo $data['april']; ?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Mei</label>
                                                <input class="form-control" type="number" name="mei" value="<?php echo $data['mei']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Juni</label>
                                                <input class="form-control" type="number" name="juni" value="<?php echo $data['juni']; ?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Juli</label>
                                                <input class="form-control" type="number" name="juli" value="<?php echo $data['juli']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Agustus</label>
                                                <input class="form-control" type="number" name="agustus" value="<?php echo $data['agustus']; ?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">September</label>
                                                <input class="form-control" type="number" name="september" value="<?php echo $data['september']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">Oktober</label>
                                                <input class="form-control" type="number" name="oktober" value="<?php echo $data['oktober']; ?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">November</label>
                                                <input class="form-control" type="number" name="november" value="<?php echo $data['november']; ?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Desember</label>
                                                <input class="form-control" type="number" name="desember" value="<?php echo $data['desember']; ?>" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">Tahun</label>
                                                <input class="form-control" type="number" name="tahun" value="<?php echo $data['tahun']; ?>" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                        <a href="kunjungan_klinik.php" class="btn btn-danger btn-user btn-block">Kembali</a>
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
