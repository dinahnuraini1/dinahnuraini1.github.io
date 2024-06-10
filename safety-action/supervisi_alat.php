<?php 
include "../koneksi.php";
// Ambil parameter tahun dari URL jika ada, default ke tahun saat ini
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
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

  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="safety_action.php" target="_blank">
        <span class="ms-1 font-weight-bold text-white">Dashboard Safety Action</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" href="safety_action.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i><img src="gambar/recovery.png" alt="" width="25" height="25"></i>
            </div>
            <span class="nav-link-text ms-1">IBPR</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="supervisi_alat.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i><img src="gambar/health.png" alt="" width="25" height="25"></i>
            </div>
            <span class="nav-link-text ms-1">Hasil supervisi alat kerja</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="supervisi_lingkungan.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i><img src="gambar/environmental.png" alt="" width="25" height="25"></i>
            </div>
            <span class="nav-link-text ms-1">Hasil Supervisi lingkungan</span>
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Safety Action</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Safety Action</h6>
        </nav>
        <ul class="navbar-nav justify-content-end">
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
            <a href="javascript:;" class="nav-link text-body p-0">=</a>
          </li>
          <li class="nav-item dropdown pe-2 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></a>
            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton"></ul>
          </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="d-flex justify-content-center align-items-center">
      <div class="card my-4" style="width: 300px;">
        <div class="card-body">
          <form action="supervisi_alat.php" method="GET"> <!-- Pastikan form action sesuai -->
            <div class="d-flex justify-content-between align-items-center">
              <div class="flex-grow-1 pr-1">
                <div class="form-group mb-0">
                  <select name="tahun" class="form-control" id="tahunSelect">
                    <option value="" selected>Pilih Tahun</option>
                    <?php
                    // Ambil tahun dari database
                    $sqlTahun = "SELECT DISTINCT YEAR(tanggal) AS tahun FROM supervisi_alat_kerja ORDER BY tahun ASC";
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

    <div class="container-fluid px-2 px-md-4">
      <div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                      <h6 class="text-white text-capitalize ps-3">Hasil Supervisi Alat Kerja</h6>
                      <div class="text-white text-capitalize ps-3"><a href="tambah_supervisi_alat.php" class="btn btn-primary"><i class="bi bi-plus-square"></i> Tambah Data</a></div>
                    </div>
                </div>
                <div class="card-body px-0 pb">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-sm">No</th>
                                    <th class="text-center text-sm">Tanggal</th>
                                    <th class="text-center text-sm">Unit Kerja</th>
                                    <th class="text-center text-sm">APD</th>
                                    <th class="text-center text-sm">APAR</th>
                                    <th class="text-center text-sm">P3K</th>
                                    <th class="text-center text-sm">Rekomendasi</th>
                                    <th class="text-center text-sm">Action</th>
                                    <th class="text-center text-smtext-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php 
                              $sql1 = "SELECT id, tanggal, unit_kerja, apd, apar, p3k, rekomendasi FROM supervisi_alat_kerja WHERE YEAR(tanggal) = '$tahun'";
                              $hasil = mysqli_query($conn, $sql1);
                              $nomor = 1; // Inisialisasi nomor urut
                              $total_apd = 0;
                              $total_apar = 0;
                              $total_p3k = 0;
                              
                              while($baris = mysqli_fetch_assoc($hasil)){ 
                                  $total_apd += $baris['apd'];
                                  $total_apar += $baris['apar'];
                                  $total_p3k += $baris['p3k'];
                              ?>
                              <tr>
                                <td class="text-center text-sm"><?= $nomor++; ?></td> <!-- Tampilkan dan tambahkan 1 ke nomor urut -->
                                <td class="text-center text-sm"><?= $baris['tanggal']; ?></td>
                                <td class="text-center text-sm"><?= $baris['unit_kerja']; ?></td>
                                <td class="text-center text-sm"><?= $baris['apd']; ?></td>
                                <td class="text-center text-sm"><?= $baris['apar']; ?></td>
                                <td class="text-center text-sm"><?= $baris['p3k']; ?></td>
                                <td class="text-center text-sm"><?= $baris['rekomendasi']; ?></td>
                                <td class="align-middle text-center text-sm">
                                    <a href="edit_supervisi_alat.php?id=<?= $baris['id']; ?>">
                                    <span class="badge badge-sm bg-gradient-success">Edit</span>
                                  </a>
                                    <a href="delete_supervisi_alat.php?id=<?= $baris['id']; ?>" onclick="return confirm('Anda yakin?')">
                                    <span class="badge badge-sm bg-gradient-danger">Delete</span>
                                  </a>
                                  </td>
                              </tr>
                              <?php } ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th colspan="3" class="text-center text-sm">Jumlah</th>
                                <th class="text-center text-sm"><?= $total_apd; ?></th>
                                <th class="text-center text-sm"><?= $total_apar; ?></th>
                                <th class="text-center text-sm"><?= $total_p3k; ?></th>
                                <th class="text-center text-sm text-secondary opacity-7"></th>
                              </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Kolom lainnya -->
      </div>
    </div>
  </main>

  <!-- Core JS Files -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!-- Control Center for Material Dashboard -->
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>
