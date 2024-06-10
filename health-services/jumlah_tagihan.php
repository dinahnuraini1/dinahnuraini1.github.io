<?php 
include "../koneksi.php";
// Ambil parameter tahun dan bulan dari URL jika ada, default ke bulan dan tahun saat ini
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
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
<style>
        .rupiah-table {
            width: 100%;
            border-collapse: collapse;
        }
        .rupiah-table th, .rupiah-table td {
            padding: 8px;
        }
        .rupiah {
            text-align: right;
        }
    </style>
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
          <a class="nav-link text-white" href="jumlah_rujukan.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class=""><img src="gambar/hospital.png" alt="" width="20" height="20"></i>
            </div>
            <span class="nav-link-text ms-1">Rujukan Provider</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary " href="jumlah_tagihan.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class=""><img src="gambar/health-report.png" alt="" width="20" height="20"></i>
            </div>
            <span class="nav-link-text ms-1">Klaim Provider</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="klinik_mediska.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class=""><img src="gambar/clinic.png" alt="" width="20" height="20"></i>
            </div>
            <span class="nav-link-text ms-1">Klinik Mediska</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="faskes.php">
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
      <h6 class="font-weight-bolder mb-0">Klaim Provider</h6>
      
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
    <div class="d-flex justify-content-center align-items-center">
    <div class="card my-4" style="width: 300px;">
        <div class="card-body">
            <form action="jumlah_tagihan.php" method="GET">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="flex-grow-1 pr-1">
                        <div class="form-group mb-0">
                            <select name="tahun" class="form-control" id="tahunSelect">
                                <option value="" selected>Pilih Tahun</option>
                                <?php
                                // Ambil tahun dari database
                                $sqlTahun = "SELECT DISTINCT tahun FROM tagihan ORDER BY tahun ASC";
                                $resultTahun = mysqli_query($conn, $sqlTahun);

                                // Tampilkan opsi tahun dalam dropdown
                                while ($row = mysqli_fetch_assoc($resultTahun)) {
                                    $tahunOption = $row['tahun'];
                                    echo "<option value='$tahunOption'" . ($tahun == $tahunOption ? ' selected' : '') . ">$tahunOption</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="flex-grow-0 pl-1">
                        <button id="search-button" class="btn btn-primary w-100" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
        <div><a href="tambah_tagihan.php" class="btn btn-primary"><i class="bi bi-plus-square"></i> Tambah Data</a></div>
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Jumlah Tagihan Pasien Rawat Jalan Tingkat Lanjut (RJTL) Tahun <?= $tahun; ?></h6>
                <h7 class="text-white text-capitalize ps-3">*Dalam Ribuan</h7>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-sm">No</th>
                      <th class="text-center text-sm">Bulan</th>
                      <th class="text-center text-sm">Pasien</th>
                      <th class="text-center text-sm">Tagihan</th>
                      <th class="text-center text-sm">Action</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                       $sql1 = "SELECT id, bulan, jumlah_pasien, biaya FROM tagihan WHERE jenis_pasien= 'RJTL' AND tahun = '$tahun'";
                       $result = $conn->query($sql1);
                       $total = 0; // Inisialisasi total 
                       $total_pasien = 0;
                       $nomor = 1;
                       while ($baris = mysqli_fetch_assoc($result)) {
                           $total_tiap_bulan = (float)$baris['biaya'];
                           $total += $total_tiap_bulan;
                           $total_tiap_pasien = (float)$baris['jumlah_pasien'];
                           $total_pasien += $total_tiap_pasien;
                      ?>
                      <tr class="text-center">
                        <td class="text-center text-sm"><?= $nomor++; ?></td>
                        <td class="text-sm"><?= $baris['bulan']; ?></td>
                        <td class="text-sm"><?= $baris['jumlah_pasien']; ?></td>
                        <td class="text-sm rupiah"> <?= number_format($baris['biaya']); ?></td>
                        <td class="align-middle text-center text-sm">
                          <a href="../health-services/edit_tagihan.php?id=<?= $baris['id']; ?>">
                          <span class="badge badge-sm bg-gradient-success">Edit</span>
                        </a>
                          <a href="../health-services/delete_tagihan.php?id=<?= $baris['id']; ?>" onclick="return confirm('Anda yakin?')">
                          <span class="badge badge-sm bg-gradient-danger">Delete</span>
                        </a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                      <tr>
                          <th></th>
                          <th class="text-center text-sm">Jumlah</th>
                          <th class="text-center text-sm"><?= $total_pasien; ?></th> <!-- Menggunakan variabel $total_pasien yang merupakan total pasien dari seluruh data -->
                          <th class="text-sm rupiah"><?= number_format($total); ?></th>
                      </tr>
                  </tfoot>
                </table>
              </div>
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
                <h6 class="text-white text-capitalize ps-3">Jumlah Tagihan Pasien Rawat Inap (RI) Tahun <?= $tahun; ?></h6>
                <h7 class="text-white text-capitalize ps-3">*Dalam Ribuan</h7>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-sm">No</th>
                      <th class="text-center text-sm">Bulan</th>
                      <th class="text-center text-sm">Pasien</th>
                      <th class="text-center text-sm">Tagihan</th>
                      <th class="text-center text-sm">Action</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                       $sql1 = "SELECT id, bulan, jumlah_pasien, biaya FROM tagihan WHERE jenis_pasien= 'RI' AND tahun = '$tahun'";
                       $result = $conn->query($sql1);
                       $total = 0; // Inisialisasi total 
                       $total_pasien = 0;
                       $nomor = 1;
                       while ($baris = mysqli_fetch_assoc($result)) {
                           $total_tiap_bulan = (float)$baris['biaya'];
                           $total += $total_tiap_bulan;
                           $total_tiap_pasien = (float)$baris['jumlah_pasien'];
                           $total_pasien += $total_tiap_pasien;
                      ?>
                      <tr class="text-center">
                        <td class="text-center text-sm"><?= $nomor++; ?></td>
                        <td class="text-sm"><?= $baris['bulan']; ?></td>
                        <td class="text-sm"><?= $baris['jumlah_pasien']; ?></td>
                        <td class="text-sm rupiah"><?= number_format($baris['biaya']); ?></td>
                        <td class="align-middle text-center text-sm">
                          <a href="../health-services/edit_tagihan.php?id=<?= $baris['id']; ?>">
                          <span class="badge badge-sm bg-gradient-success">Edit</span>
                        </a>
                          <a href="../health-services/delete_tagihan.php?id=<?= $baris['id']; ?>" onclick="return confirm('Anda yakin?')">
                          <span class="badge badge-sm bg-gradient-danger">Delete</span>
                        </a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                      <tr>
                          <th></th>
                          <th class="text-center text-sm">Jumlah</th>
                          <th class="text-center text-sm"><?= $total_pasien; ?></th> <!-- Menggunakan variabel $total_pasien yang merupakan total pasien dari seluruh data -->
                          <th class="text-sm rupiah"><?= number_format($total); ?></th>
                      </tr>
                  </tfoot>
                </table>
              </div>
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