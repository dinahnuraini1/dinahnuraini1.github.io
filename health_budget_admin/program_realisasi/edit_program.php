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

$id_program = isset($_GET['id_program']) ? $_GET['id_program'] : '';

if (!empty($id_program)) {
    // Jalankan query untuk mendapatkan data yang ingin ditampilkan
    $sql = "SELECT * FROM program_dan_realisasi WHERE id_program=$id_program";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "ID tidak ditemukan.";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>Unit Kesehatan | Daop 7 Madiun</title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Edit Data</h4>
                  <div class="row mt-3">
                    <div class="col-2 text-center ms-auto">
                        <a href="#" class="btn"><i class="bi bi-arrow-left"></i></a>
                    </div>
                    <div class="col-2 text-center px-1">
                      </a>
                    </div>
                    <div class="col-2 text-center me-auto">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
              <form action="pengeditan.php" method="post" class="login-email">
              <div class="input-group input-group-outline my-3">
                    <input class="form-control" type="hidden"  name="id_program" value="<?php echo $data['id_program']?>">
        
                </div>
                <div class="input-group input-group-outline my-3">
                    <input class="form-control" type="hidden"  name="uraian_kegiatan" value="<?php echo $data['uraian_kegiatan']?>">
        
                </div>
                <div class="input-group input-group-outline my-3">
                    <input class="form-control" type="text"  name="rincian" value="<?php echo $data['rincian']?>">
        
                </div>
                <div class="input-group input-group-outline my-3">
                    <input class="form-control" type="number"  name="program" value="<?php echo $data['program']?>">
        
                </div>
                <div class="input-group input-group-outline my-3">
                    <input class="form-control" type="number"  name="penyerapan" value="<?php echo $data['penyerapan']?>">
                
                </div>
    
                <div class="input-group text-center">
                    <button name="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">submit</button>
                </div>
                </form>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>