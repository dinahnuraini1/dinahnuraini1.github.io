<?php
include "../koneksi.php";

// Periksa apakah 'id_pendapatan' telah diatur dalam URL
if(isset($_GET['id_pendapatan'])) {
    $id_pendapatan = $_GET['id_pendapatan'];

    // Query untuk mendapatkan data pendapatan berdasarkan 'id_pendapatan'
    $sql = "SELECT id_pendapatan, kapitasi, non_kapitasi FROM pendapatan WHERE id_pendapatan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_pendapatan);
    $stmt->execute();
    $hasil = $stmt->get_result();

    // Periksa apakah data ditemukan
    if($hasil->num_rows > 0) {
        $data = $hasil->fetch_assoc();
    } else {
        echo "Data tidak ditemukan";
        exit();
    }
    $stmt->close();
} else {
    echo "ID tidak disediakan";
    exit();
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
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is an easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA, and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
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
                                    <form class="user" method="post" action="pengeditan_pendapatan.php">
                                        <input type="hidden" name="id_pendapatan" value="<?php echo isset($data['id_pendapatan']) ? $data['id_pendapatan'] : ''; ?>">
                                        <div class="form-group">
                                            <label for="kapitasi">Kapitasi</label>
                                            <input style="border: 1px solid #ced4da;" class="form-control" type="text"  name="kapitasi" value="<?php echo isset($data['kapitasi']) ? $data['kapitasi'] : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="non_kapitasi">Non Kapitasi</label>
                                            <input style="border: 1px solid #ced4da;" class="form-control" type="text"  name="non_kapitasi" value="<?php echo isset($data['non_kapitasi']) ? $data['non_kapitasi'] : ''; ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                        <a href="pendapatan.php" class="btn btn-danger btn-user btn-block">Kembali</a>
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
