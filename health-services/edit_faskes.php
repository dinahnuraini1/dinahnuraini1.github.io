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

// Periksa apakah id_faskes telah diberikan melalui query string
if (isset($_GET['id_faskes'])) {
    $id_faskes = $_GET['id_faskes'];

    // Ambil data dari database berdasarkan id_faskes
    $sql = "SELECT * FROM faskes WHERE id_faskes = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_faskes);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Periksa apakah data ditemukan
    if ($data = mysqli_fetch_assoc($result)) {
        // Data ditemukan, lanjutkan untuk menampilkan form
    } else {
        echo "
            <script>
            alert('Data tidak ditemukan');
            window.location.href = 'faskes.php';
            </script>
        ";
        exit;
    }

    mysqli_stmt_close($stmt);
} else {
    echo "
        <script>
        alert('ID tidak diberikan');
        window.location.href = 'faskes.php';
        </script>
    ";
    exit;
}


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
                                    <form class="user" method="post" action="pengeditan_faskes.php">
                                      <input type="hidden" name="id_faskes" value="<?php echo $data['id_faskes']; ?>">
                                      <input type="hidden" name="jenis_provider" value="<?php echo $data['jenis_provider']; ?>">
                                      <div class="form-row">
                                          <div class="form-group col-md-6">
                                              <label for="">Nama Provider</label>
                                              <input class="form-control" type="text" name="nama_provider" value="<?php echo $data['nama_provider']; ?>" required>
                                          </div>
                                          <div class="form-group col-md-6">
                                              <label for="">Lokasi</label>
                                              <input class="form-control" type="text" name="lokasi" value="<?php echo $data['lokasi']; ?>" required>
                                          </div>
                                      </div>
                                      <div class="form-row">
                                          <div class="form-group col-md-6">
                                              <label for="">Masa Berlaku</label>
                                              <input class="form-control" type="text" name="masa_berlaku" value="<?php echo $data['masa_berlaku']; ?>" required>
                                          </div>
                                          <div class="form-group col-md-6">
                                              <label for="">No Kontrak</label>
                                              <input class="form-control" type="text" name="no_kontrak" value="<?php echo $data['no_kontrak']; ?>" required>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="">Status Faskes</label>
                                          <select class="form-select" name="status_faskes" required>
                                              <option value="">Pilih Status Faskes</option>
                                              <option value="Aktif" <?php echo $data['status_faskes'] == 'Aktif' ? 'selected' : ''; ?>>Aktif</option>
                                              <option value="Non Aktif" <?php echo $data['status_faskes'] == 'Non Aktif' ? 'selected' : ''; ?>>Non Aktif</option>
                                          </select>
                                      </div>
                                      <div class="form-row">
                                          <div class="form-group col-md-12">
                                              <label for="">Keterangan</label>
                                              <input class="form-control" type="text" name="keterangan" value="<?php echo $data['keterangan']; ?>" required>
                                          </div>
                                      </div>

                                      <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                      <a href="faskes.php" class="btn btn-danger btn-user btn-block">Kembali</a>
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
