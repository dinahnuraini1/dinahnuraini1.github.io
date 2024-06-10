<?php 
include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Unit Kesehatan | Daop 7 Madiun</title>
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="health_budget.php" target="_blank">
        <span class="ms-1 font-weight-bold text-white">Dashboard Health Budget</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white " href="anggaran_percommitmenitem.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Anggaran Per CI</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="program_realisasi.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Anggaran PerKegiatan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="pendapatan.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Pendapatan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="anggaran_perkegiatan.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">SAP</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-gradient-primary w-100" href="../index.php" type="button">Back To Home</a>
      </div>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
   <!-- Navbar -->
   <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm">
            <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
          </li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">SAP</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">SAP</h6>
    </nav>
    <!-- Navbar Collapse -->
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <!-- Dropdown Menu -->
        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
          <li class="mb-2">
            <a class="dropdown-item border-radius-md" href="javascript:;">
              <div class="d-flex py-1">
                <div class="my-auto">
                  <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                </div>
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="text-sm font-weight-normal mb-1">
                    <span class="font-weight-bold">New message</span> from Laur
                  </h6>
                  <p class="text-xs text-secondary mb-0">
                    <i class="fa fa-clock me-1"></i>
                    13 minutes ago
                  </p>
                </div>
              </div>
            </a>
          </li>
        </ul>
        <!-- Navbar Items -->
        <ul class="navbar-nav align-items-center">
          <!-- Sidenav Toggler -->
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </a>
          </li>
          <!-- Additional Nav Item -->
          <li class="nav-item px-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0">
              <!-- Content here if needed -->
            </a>
          </li>
          <!-- User Dropdown -->
          <li class="nav-item dropdown p d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <!-- Dropdown icon or text here if needed -->
            </a>
            <ul class="dropdown-menu dropdown-menu-end p py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
              <!-- Dropdown items here if needed -->
            </ul>
          </li>
          <!-- Log In Button -->
          <!-- <li class="nav-item d-flex align-items-center">
            <a href="../login.php" class="nav-link text-body font-weight-bold px-0">
              <i class="fa fa-user me-sm-1"></i>            
              <span class="d-sm-inline d-none">Log In</span>            
            </a>
          </li> -->
        </ul>
      </div>
    </div>
  </div>
</nav>
    <!-- End Navbar -->
    <?php
// Include file koneksi ke database
include '../koneksi.php';

// Query untuk mengambil data gambar dari database
$query = "SELECT * FROM anggaran_perkegiatan";
$result = mysqli_query($conn, $query);
?>

<section id="projects" class="projects">
  <div class="container" data-aos="fade-up">
    <div class="section-header" id="gallery">
      <h3>SAP</h3>
    </div>
    <a href="tambah_gambar.php">
      <i class="fa-solid"><img src="assets/img/plus.png" alt="" width="30" height="30"></i>
    </a><br><br>
    <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order">
      <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
        <?php
        // Loop untuk menampilkan gambar-gambar dalam galeri
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <div class="col-lg-4 col-md-6 portfolio-item filter-remodeling">
            <div class="portfolio-content h-100 position-relative">
              <img style="width:100%; height:100%;" src="gambar_perkegiatan/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_kegiatan']; ?>" />
              <div class="portfolio-info position-absolute top-0 end-0 p-2">
                <a href="gambar_perkegiatan/<?php echo $row['gambar']; ?>" title="Download Gambar" download class="me-2"><i class="bi bi-download text-white"></i></a>
                <a href="gambar_perkegiatan/<?php echo $row['gambar']; ?>" title="Kegiatan: <?php echo $row['nama_kegiatan']; ?><br> Tanggal: <?php echo $row['tanggal']; ?>" data-gallery="portfolio-gallery-remodeling" class="glightbox preview-link"><i class="bi bi-zoom-in text-white"></i></a>
                <a href="#" onclick="confirmDelete(<?php echo $row['id']; ?>)" title="Hapus Gambar" class="me-2 delete-link"><i class="bi bi-trash text-white"></i></a>
              </div>
            </div>
          </div><!-- End Projects Item -->
        <?php
        }
        ?>
      </div><!-- End Projects Container -->
    </div>
  </div>
</section>

<script>
  function confirmDelete(id) {
    var confirmDelete = confirm("Apakah Anda yakin ingin menghapus gambar?");
    if (confirmDelete) {
      window.location.href = "hapus_gambar.php?id=" + id;
    }
  }
</script>

<!-- Include the glightbox library -->
<link href="path/to/glightbox.min.css" rel="stylesheet">
<script src="path/to/glightbox.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const lightbox = GLightbox({
      selector: '.glightbox'
    });
  });
</script>


<style>
.portfolio-content {
    position: relative;
}
.portfolio-info {
    position: absolute;
    top: 10px;
    right: 10px;
    display: flex;
    gap: 10px;
    background: rgba(0, 0, 0, 0.5);
    padding: 5px;
    border-radius: 5px;
}
.portfolio-info a {
    color: white;
}
</style>

<!-- Include Glightbox JavaScript and CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>



      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                PT Kereta Api Indonesia
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>