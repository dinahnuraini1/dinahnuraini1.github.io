<?php 
include "../koneksi.php";
$sql1 = "SELECT id_faskes, jenis_provider, nama_provider, lokasi, masa_berlaku, no_kontrak, status_faskes, keterangan FROM faskes WHERE jenis_provider='Rumah Sakit'";
$hasil1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT id_faskes, jenis_provider, nama_provider, lokasi, masa_berlaku, no_kontrak, status_faskes, keterangan FROM faskes WHERE jenis_provider='Laboratorium'";
$hasil2 = mysqli_query($conn, $sql2);
$sql3 = "SELECT id_faskes, jenis_provider, nama_provider, lokasi, masa_berlaku, no_kontrak, status_faskes, keterangan FROM faskes WHERE jenis_provider='Optik'";
$hasil3 = mysqli_query($conn, $sql3); 
$sql4 = "SELECT id_faskes, jenis_provider, nama_provider, lokasi, masa_berlaku, no_kontrak, status_faskes, keterangan FROM faskes WHERE jenis_provider='Kontrak Profesi Dokter Praktik'";
$hasil4 = mysqli_query($conn, $sql4); 
$sql5 = "SELECT id_faskes, jenis_provider, nama_provider, lokasi, masa_berlaku, no_kontrak, status_faskes, keterangan FROM faskes WHERE jenis_provider='Kontrak Profesi Dokter Penganggung Jawab'";
$hasil5 = mysqli_query($conn, $sql5); 
$sql6 = "SELECT id_faskes, jenis_provider, nama_provider, lokasi, masa_berlaku, no_kontrak, status_faskes, keterangan FROM faskes WHERE jenis_provider='Kontrak Profesi Apoteker'";
$hasil6 = mysqli_query($conn, $sql6);
$totalRows1 = mysqli_num_rows($hasil1); 
$totalRows2 = mysqli_num_rows($hasil2);    
$totalRows3 = mysqli_num_rows($hasil3);  
$totalRows4 = mysqli_num_rows($hasil4);    
$totalRows5 = mysqli_num_rows($hasil5);    
$totalRows6 = mysqli_num_rows($hasil6);                      
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>Unit Kesehatan | Daop 7 Madiun
  </title>
  <!--     Fonts and icons     -->
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
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="services.php" target="_blank">
      <span class="ms-1 font-weight-bold text-white">Dashboard Health Services</span>
    </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
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
          <a class="nav-link text-white " href="jumlah_rujukan.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class=""><img src="gambar/hospital.png" alt="" width="20" height="20"></i>
            </div>
            <span class="nav-link-text ms-1">Rujukan Provider</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="jumlah_tagihan.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class=""><img src="gambar/health-report.png" alt="" width="20" height="20"></i>
            </div>
            <span class="nav-link-text ms-1">Klaim Provider</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="klinik_mediska.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class=""><img src="gambar/clinic.png" alt="" width="20" height="20"></i>
            </div>
            <span class="nav-link-text ms-1">Klinik Mediska</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="faskes.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class=""><img src="gambar/collaborative.png" alt="" width="20" height="20"></i>
            </div>
            <span class="nav-link-text ms-1">Faskes Kerja Sama</span>
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
    <nav aria-label="breadcrumb">
      
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Health Services</li>
      </ol>
      <h6 class="font-weight-bolder mb-0">Faskes Kerja Sama</h6>
      
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

    <!-- End Navbar -->
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('gambar/6.jpeg');">
      </div>
      <div class="col-12">
          

      <div class="container-fluid py-4">
      <div><a href="tambah_faskes.php" class="btn btn-primary"><i class="bi bi-plus-square"></i> Tambah Data</a></div>
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Rumah Sakit (<?php echo $totalRows1;?>)</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-sm">No</th>
                                            <th class="text-center text-sm">Nama Provider</th>
                                            <th class="text-center text-sm">Lokasi</th>
                                            <th class="text-center text-sm">Masa Berlaku</th>
                                            <th class="text-center text-sm">Nomor Kontrak</th>
                                            <th class="text-center text-sm">Status</th>
                                            <th class="text-center text-sm">Keterangan</th>
                                            <th class="text-center text-sm">Action</th>
                                            <th class="text-center text-smtext-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sql2 = "SELECT id_faskes, jenis_provider, nama_provider, lokasi, masa_berlaku, no_kontrak, status_faskes, keterangan FROM faskes WHERE jenis_provider='Rumah Sakit'";
                                        $hasil = mysqli_query($conn, $sql2);
                                        $totalRows1 = mysqli_num_rows($hasil);   
                                        $nomor = 1; // Inisialisasi nomor urut
                                        $tambahkapitasinon = 0;
                                        while($baris = mysqli_fetch_assoc($hasil)){ 
                                        ?>
                                            <tr>
                                                <td class="text-center text-sm"><?= $nomor++; ?></td> <!-- Tampilkan dan tambahkan 1 ke nomor urut -->
                                                <td class="text-center text-sm"><?= $baris['nama_provider']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['lokasi']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['masa_berlaku']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['no_kontrak']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['status_faskes']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['keterangan']; ?></td>
                                                <td class="text-center text-sm">
                                                  <a href="../health-services/edit_faskes.php?id_faskes=<?= $baris['id_faskes']; ?>" class="badge badge-sm bg-gradient-success">Edit</a>
                                                  <a href="../health-services/delete_faskes.php?id_faskes=<?= $baris['id_faskes']; ?>" onclick="return confirm('Anda yakin?')"><span class="badge badge-sm bg-gradient-danger">Delete</span>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Laboratorium (<?php echo $totalRows2;?>)</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-sm">No</th>
                                            <th class="text-center text-sm">Nama Provider</th>
                                            <th class="text-center text-sm">Lokasi</th>
                                            <th class="text-center text-sm">Masa Berlaku</th>
                                            <th class="text-center text-sm">Nomor Kontrak</th>
                                            <th class="text-center text-sm">Status</th>
                                            <th class="text-center text-sm">Keterangan</th>
                                            <th class="text-center text-sm">Action</th>
                                            <th class="text-center text-smtext-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sql2 = "SELECT id_faskes, jenis_provider, nama_provider, lokasi, masa_berlaku, no_kontrak, status_faskes, keterangan FROM faskes WHERE jenis_provider='Laboratorium'";
                                        $hasil = mysqli_query($conn, $sql2);
                                        $nomor = 1; // Inisialisasi nomor urut
                                        $tambahkapitasinon = 0;
                                        while($baris = mysqli_fetch_assoc($hasil)){ 
                                        ?>
                                            <tr>
                                                <td class="text-center text-sm"><?= $nomor++; ?></td> <!-- Tampilkan dan tambahkan 1 ke nomor urut -->
                                                <td class="text-center text-sm"><?= $baris['nama_provider']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['lokasi']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['masa_berlaku']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['no_kontrak']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['status_faskes']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['keterangan']; ?></td>
                                                <td class="text-center text-sm">
                                                  <a href="../health-services/edit_faskes.php?id_faskes=<?= $baris['id_faskes']; ?>" class="badge badge-sm bg-gradient-success">Edit</a>
                                                  <a href="../health-services/delete_faskes.php?id_faskes=<?= $baris['id_faskes']; ?>" onclick="return confirm('Anda yakin?')"><span class="badge badge-sm bg-gradient-danger">Delete</span>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Optik (<?php echo $totalRows3;?>)</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-sm">No</th>
                                            <th class="text-center text-sm">Nama Provider</th>
                                            <th class="text-center text-sm">Lokasi</th>
                                            <th class="text-center text-sm">Masa Berlaku</th>
                                            <th class="text-center text-sm">Nomor Kontrak</th>
                                            <th class="text-center text-sm">Status</th>
                                            <th class="text-center text-sm">Keterangan</th>
                                            <th class="text-center text-sm">Action</th>
                                            <th class="text-center text-smtext-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sql2 = "SELECT id_faskes, jenis_provider, nama_provider, lokasi, masa_berlaku, no_kontrak, status_faskes, keterangan FROM faskes WHERE jenis_provider='Optik'";
                                        $hasil = mysqli_query($conn, $sql2);
                                        $nomor = 1; // Inisialisasi nomor urut
                                        $tambahkapitasinon = 0;
                                        while($baris = mysqli_fetch_assoc($hasil)){ 
                                        ?>
                                            <tr>
                                                <td class="text-center text-sm"><?= $nomor++; ?></td> <!-- Tampilkan dan tambahkan 1 ke nomor urut -->
                                                <td class="text-center text-sm"><?= $baris['nama_provider']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['lokasi']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['masa_berlaku']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['no_kontrak']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['status_faskes']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['keterangan']; ?></td>
                                                <td class="text-center text-sm">
                                                  <a href="../health-services/edit_faskes.php?id_faskes=<?= $baris['id_faskes']; ?>" class="badge badge-sm bg-gradient-success">Edit</a>
                                                  <a href="../health-services/delete_faskes.php?id_faskes=<?= $baris['id_faskes']; ?>" onclick="return confirm('Anda yakin?')"><span class="badge badge-sm bg-gradient-danger">Delete</span>
                                                
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
          

            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Kontrak Profesi Dokter Praktik (<?php echo $totalRows4;?>)</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-sm">No</th>
                                            <th class="text-center text-sm">Nama Provider</th>
                                            <th class="text-center text-sm">Lokasi</th>
                                            <th class="text-center text-sm">Masa Berlaku</th>
                                            <th class="text-center text-sm">Nomor Kontrak</th>
                                            <th class="text-center text-sm">Status</th>
                                            <th class="text-center text-sm">Keterangan</th>
                                            <th class="text-center text-sm">Action</th>
                                            <th class="text-center text-smtext-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql2 = "SELECT id_faskes, jenis_provider, nama_provider, lokasi, masa_berlaku, no_kontrak, status_faskes, keterangan FROM faskes WHERE jenis_provider='Kontrak Profesi Dokter Praktik'";
                                        $hasil = mysqli_query($conn, $sql2);
                                        $nomor = 1; // Inisialisasi nomor urut
                                        $tambahkapitasinon = 0;
                                        while($baris = mysqli_fetch_assoc($hasil)){ 
                                        ?>
                                            <tr>
                                                <td class="text-center text-sm"><?= $nomor++; ?></td> <!-- Tampilkan dan tambahkan 1 ke nomor urut -->
                                                <td class="text-center text-sm"><?= $baris['nama_provider']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['lokasi']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['masa_berlaku']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['no_kontrak']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['status_faskes']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['keterangan']; ?></td>
                                                <td class="text-center text-sm">
                                                <a href="../health-services/edit_faskes.php?id_faskes=<?= $baris['id_faskes']; ?>" class="badge badge-sm bg-gradient-success">Edit</a>
                                                <a href="../health-services/delete_faskes.php?id_faskes=<?= $baris['id_faskes']; ?>" onclick="return confirm('Anda yakin?')"><span class="badge badge-sm bg-gradient-danger">Delete</span>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

          <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Kontrak Profesi Dokter Penganggung Jawab (<?php echo $totalRows5;?>)</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-sm">No</th>
                                            <th class="text-center text-sm">Nama Provider</th>
                                            <th class="text-center text-sm">Lokasi</th>
                                            <th class="text-center text-sm">Masa Berlaku</th>
                                            <th class="text-center text-sm">Nomor Kontrak</th>
                                            <th class="text-center text-sm">Status</th>
                                            <th class="text-center text-sm">Keterangan</th>
                                            <th class="text-center text-sm">Action</th>
                                            <th class="text-center text-smtext-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sql2 = "SELECT id_faskes, jenis_provider, nama_provider, lokasi, masa_berlaku, no_kontrak, status_faskes, keterangan FROM faskes WHERE jenis_provider='Kontrak Profesi Dokter Penganggung Jawab'";
                                        $hasil = mysqli_query($conn, $sql2);
                                        $nomor = 1; // Inisialisasi nomor urut
                                        $tambahkapitasinon = 0;
                                        while($baris = mysqli_fetch_assoc($hasil)){ 
                                        ?>
                                            <tr>
                                                <td class="text-center text-sm"><?= $nomor++; ?></td> <!-- Tampilkan dan tambahkan 1 ke nomor urut -->
                                                <td class="text-center text-sm"><?= $baris['nama_provider']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['lokasi']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['masa_berlaku']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['no_kontrak']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['status_faskes']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['keterangan']; ?></td>
                                                <td class="text-center text-sm">
                                                   <a href="../health-services/edit_faskes.php?id_faskes=<?= $baris['id_faskes']; ?>" class="badge badge-sm bg-gradient-success">Edit</a>
                                                   <a href="../health-services/delete_faskes.php?id_faskes=<?= $baris['id_faskes']; ?>" onclick="return confirm('Anda yakin?')"><span class="badge badge-sm bg-gradient-danger">Delete</span>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Kontrak Profesi Apoteker (<?php echo $totalRows6;?>)</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-sm">No</th>
                                            <th class="text-center text-sm">Nama Provider</th>
                                            <th class="text-center text-sm">Lokasi</th>
                                            <th class="text-center text-sm">Masa Berlaku</th>
                                            <th class="text-center text-sm">Nomor Kontrak</th>
                                            <th class="text-center text-sm">Status</th>
                                            <th class="text-center text-sm">Keterangan</th>
                                            <th class="text-center text-sm">Action</th>
                                            <th class="text-center text-smtext-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $sql2 = "SELECT id_faskes, jenis_provider, nama_provider, lokasi, masa_berlaku, no_kontrak, status_faskes, keterangan FROM faskes WHERE jenis_provider='Kontrak Profesi Apoteker'";
                                        $hasil = mysqli_query($conn, $sql2);
                                        $nomor = 1; // Inisialisasi nomor urut
                                        $tambahkapitasinon = 0;
                                        while($baris = mysqli_fetch_assoc($hasil)){ 
                                        ?>
                                            <tr>
                                                <td class="text-center text-sm"><?= $nomor++; ?></td> <!-- Tampilkan dan tambahkan 1 ke nomor urut -->
                                                <td class="text-center text-sm"><?= $baris['nama_provider']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['lokasi']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['masa_berlaku']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['no_kontrak']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['status_faskes']; ?></td>
                                                <td class="text-center text-sm"><?= $baris['keterangan']; ?></td>
                                                <td class="text-center text-sm">
                                                  <a href="../health-services/edit_faskes.php?id_faskes=<?= $baris['id_faskes']; ?>" class="badge badge-sm bg-gradient-success">Edit</a>
                                                  <a href="../health-services/delete_faskes.php?id_faskes=<?= $baris['id_faskes']; ?>" onclick="return confirm('Anda yakin?')"><span class="badge badge-sm bg-gradient-danger">Delete</span>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>