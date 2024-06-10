<?php
include "../koneksi.php";

if (isset($_GET['id_klinik'])) {
    $id_klinik = $_GET['id_klinik'];
    $sql_detail = "SELECT * FROM klinik_mediska WHERE id_klinik = ?";
    $stmt = $conn->prepare($sql_detail);
    $stmt->bind_param("i", $id_klinik);
    $stmt->execute();
    $result = $stmt->get_result();
    $klinik = $result->fetch_assoc();
} else {
    echo "ID Klinik tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="./assets/img/favicon.png">
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
<link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="g-sidenav-show bg-gray-200">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="services.php" target="_blank">
      <span class="ms-1 font-weight-bold text-white">Dashboard Health Services</span>
    </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white" href="kunjungan_klinik.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class=""><img src="gambar/doctor-consultation.png" alt="" width="20" height="20"></i>
          </div>
          <span class="nav-link-text ms-1">Kunjungan Klinik</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="jumlah_rujukan.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class=""><img src="gambar/hospital.png" alt="" width="20" height="20"></i>
          </div>
          <span class="nav-link-text ms-1">Jumlah Rujukan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="jumlah_tagihan.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class=""><img src="gambar/health-report.png" alt="" width="20" height="20"></i>
          </div>
          <span class="nav-link-text ms-1">Jumlah Tagihan</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white active bg-gradient-primary" href="klinik_mediska.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class=""><img src="gambar/clinic.png" alt="" width="20" height="20"></i>
          </div>
          <span class="nav-link-text ms-1">Klinik Mediska</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="faskes.php">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class=""><img src="gambar/collaborative.png" alt="" width="20" height="20"></i>
          </div>
          <span class="nav-link-text ms-1">Faskes Kerja Sama</span>
        </a>
      </li>
    </ul>
  </div>
  <div class="sidenav-footer position-absolute w-100 bottom-0">
    <div class="mx-3">
      <a class="btn bg-gradient-primary w-100" href="../index.php" type="button">Back To Home</a>
    </div>
  </div>
</aside>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
  <!-- Navbar -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Health Services</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Klinik Mediska</h6>
      </nav>
      <ul class="navbar-nav  justify-content-end">
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>
        <li class="nav-item px-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0">
          </a>
        </li>
        <li class="nav-item dropdown pe-2 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">          
          </a>
          <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-5">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <h5>Detail Klinik</h5>
            <h6>Nama Klinik:</h6>
            <p><?= $klinik['nama_klinik']; ?></p>
            <h6>Alamat Klinik:</h6>
            <p><?= $klinik['alamat_klinik']; ?></p>
            <h6>Nomor Izin:</h6>
            <p><?= $klinik['nomor_izin']; ?></p>
            <h6>Dokter Umum:</h6>
            <p><?= $klinik['dokter_umum']; ?></p>
            <h6>Dokter Spesialis:</h6>
            <p><?= $klinik['dokter_spesialis']; ?></p>
            <h6>Link Peta:</h6>
            <a href="<?= $klinik['link']; ?>" class="btn btn-primary" target="_blank">Lihat di Google Maps</a>
          </div>
          <div class="col-md-6">
            <h6>Foto Klinik:</h6>
            <?php if (!empty($klinik['foto'])): ?>
              <img src="<?= $klinik['foto']; ?>" alt="Foto Klinik" class="img-fluid">
            <?php else: ?>
              <p>Belum ada foto yang diunggah.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>
      </div>
    </div>
</body>
 <!--   Core JS Files   -->
 <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</html>
