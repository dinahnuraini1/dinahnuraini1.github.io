<?php 
include "../koneksi.php";
session_start();

// Ambil parameter tahun dari URL jika ada
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

$sql1 = "SELECT klinik, bulan, kapitasi, non_kapitasi FROM pendapatan WHERE tahun = '$tahun'";
$result = $conn->query($sql1);

// Inisialisasi array untuk menyimpan data berdasarkan klinik
$data_per_klinik = array();

// Periksa apakah query berhasil dieksekusi
if ($result->num_rows > 0) {
    // Ambil setiap baris hasil query
    while($row = $result->fetch_assoc()) {
        // Tambahkan data ke array berdasarkan klinik
        $klinik = $row["klinik"];
        $bulan = $row["bulan"];
        $kapitasi = $row["kapitasi"];
        $non_kapitasi = $row["non_kapitasi"];
        
        // Jika klinik belum ada dalam array, inisialisasi array untuk klinik tersebut
        if (!isset($data_per_klinik[$klinik])) {
            $data_per_klinik[$klinik] = array();
        }

        // Tambahkan data bulan, kapitasi, dan non-kapitasi ke array klinik
        $data_per_klinik[$klinik][] = array(
            "bulan" => $bulan,
            "kapitasi" => $kapitasi,
            "non_kapitasi" => $non_kapitasi
        );
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="./assets/img/favicon.png">

<title>  
Unit Kesehatan | Daop 7 Madiun
</title>
<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

<!-- Nucleo Icons -->
<link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
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
  </head>

<body class="g-sidenav-show  bg-gray-200">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="health_budget.php" target="_blank">
        <span class="ms-1 font-weight-bold text-white">Dashboard Health Budget</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white " href="anggaran_percommitmenitem.php">
            <div class="text-white text-center me d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Anggaran Per CI</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="program_realisasi.php">
            <div class="text-white text-center me d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Anggaran PerKegiatan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="pendapatan.php">
            <div class="text-white text-center me d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Pendapatan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="anggaran_perkegiatan.php">
            <div class="text-white text-center me d-flex align-items-center justify-content-center">
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
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Pendapatan</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Pendapatan</h6>
    </nav>
  
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
          <li class="nav-item d-flex align-items-center">
            <a href="../login.php" class="nav-link text-body font-weight-bold px-0">
              <i class="fa fa-user me-sm-1"></i>            
              <span class="d-sm-inline d-none">Log In</span>            
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

    <!-- End Navbar -->
    <div class="d-flex justify-content-center align-items-center">
    <div class="card my-4" style="width: 300px;">
        <div class="card-body">
            <form action="pendapatan.php" method="GET">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="flex-grow-1 pr-1">
                        <div class="form-group mb-0">
                            <select name="tahun" class="form-control" id="tahunSelect">
                                <option value="" selected>Pilih Tahun</option>
                                <?php
                                // Ambil tahun dari database
                                $sqlTahun = "SELECT DISTINCT tahun FROM pendapatan ORDER BY tahun ASC";
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



        <div class="container">
            <div class="row">
                <?php foreach ($data_per_klinik as $klinik => $data) { ?>
                    <div class="col-lg-6 col-md-8 mt-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Pendapatan <?php echo $klinik; ?> <?php echo $tahun; ?></h5>
                            </div>
                            <div class="card-body">
                                <canvas id="<?php echo str_replace(' ', '_', $klinik); ?>_Chart"></canvas>
                            </div>
                        </div>
                    </div>

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-MVniiUInL1VV+zLfv5tSYfEZv96Mw9NMBRvQxTcq2ptpGj2n1NglWh/Di21WV4lPO4JQ2+Xjg2SxgytQDylYOg==" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-MVniiUInL1VV+zLfv5tSYfEZv96Mw9NMBRvQxTcq2ptpGj2n1NglWh/Di21WV4lPO4JQ2+Xjg2SxgytQDylYOg==" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                    var data_<?php echo str_replace(' ', '_', $klinik); ?> = <?php echo json_encode($data); ?>;
                    var labels_<?php echo str_replace(' ', '_', $klinik); ?> = [];
                    var kapitasi_<?php echo str_replace(' ', '_', $klinik); ?> = [];
                    var non_kapitasi_<?php echo str_replace(' ', '_', $klinik); ?> = [];

                    data_<?php echo str_replace(' ', '_', $klinik); ?>.forEach(function(row) {
                        labels_<?php echo str_replace(' ', '_', $klinik); ?>.push(row.bulan);
                        kapitasi_<?php echo str_replace(' ', '_', $klinik); ?>.push(row.kapitasi);
                        non_kapitasi_<?php echo str_replace(' ', '_', $klinik); ?>.push(row.non_kapitasi);
                    });

                    var ctx_<?php echo str_replace(' ', '_', $klinik); ?> = document.getElementById('<?php echo str_replace(' ', '_', $klinik); ?>_Chart').getContext('2d');

                    var myChart_<?php echo str_replace(' ', '_', $klinik); ?> = new Chart(ctx_<?php echo str_replace(' ', '_', $klinik); ?>, {
                        type: 'bar',
                        data: {
                            labels: labels_<?php echo str_replace(' ', '_', $klinik); ?>,
                            datasets: [{
                                label: 'Kapitasi',
                                data: kapitasi_<?php echo str_replace(' ', '_', $klinik); ?>,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)', // Ubah borderColor sesuai dengan backgroundColor
                                borderWidth: 1
                            }, {
                                label: 'Non-Kapitasi',
                                data: non_kapitasi_<?php echo str_replace(' ', '_', $klinik); ?>,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)', // Ubah borderColor sesuai dengan backgroundColor
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>

                <?php } ?>
            </div>
        </div>
<?php 

// Ambil parameter tahun dari URL jika ada
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

// Fungsi untuk menghitung total per klinik
function getTotalPerKlinik($conn, $klinik, $tahun) {
    $sql = "SELECT kapitasi, non_kapitasi FROM pendapatan WHERE klinik='$klinik' AND tahun='$tahun'";
    $result = $conn->query($sql);
    $totalKapitasi = 0;
    $totalNonKapitasi = 0;
    while($row = $result->fetch_assoc()) {
        $totalKapitasi += $row['kapitasi'];
        $totalNonKapitasi += $row['non_kapitasi'];
    }
    return array($totalKapitasi, $totalNonKapitasi);
}

?>

<!-- Klinik Mediska Madiun -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Klinik Mediska Madiun</h6>
                        <h7 class="text-white text-capitalize ps-3">*Dalam Ribuan</h7>
                    </div>
                </div>
                <div class="card-body px-0 pb">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-sm">No</th>
                                    <th class="text-center text-sm">Bulan</th>
                                    <th class="text-center text-sm">Kapitasi</th>
                                    <th class="text-center text-sm">Non Kapitasi</th>
                                    <th class="text-center text-sm">Jumlah</th>
                                    <th class="text-center text-smtext-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                list($totalKapitasiMadiun, $totalNonKapitasiMadiun) = getTotalPerKlinik($conn, 'Mediska Madiun', $tahun);
                                $sql_madiun = "SELECT id_pendapatan, bulan, kapitasi, non_kapitasi FROM pendapatan WHERE klinik='Mediska Madiun' AND tahun='$tahun'";
                                $hasil = mysqli_query($conn, $sql_madiun);
                                $nomor = 1; // Inisialisasi nomor urut
                                $tambah_madiun = 0;
                                while($baris = mysqli_fetch_assoc($hasil)){ 
                                    $kapitasi_madiun = (float)$baris['kapitasi']; 
                                    $non_kapitasi_madiun = (float)$baris['non_kapitasi'];
                                    $tambah_madiun += $kapitasi_madiun + $non_kapitasi_madiun;
                                ?>
                                    <tr>
                                        <td class="text-center text-sm"><?= $nomor++; ?></td> <!-- Tampilkan dan tambahkan 1 ke nomor urut -->
                                        <td class="text-center text-sm"><?= $baris['bulan']; ?></td>
                                        <td class="text-sm rupiah"> <?= number_format($baris['kapitasi']); ?></td>
                                        <td class="text-sm rupiah"> <?= number_format($baris['non_kapitasi']); ?></td>
                                        <td class="text-sm rupiah"> <?= number_format($kapitasi_madiun + $non_kapitasi_madiun); ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="2" class="text-center"><strong>Total</strong></td>
                                    <td class="text-sm rupiah"><strong> <?= number_format($totalKapitasiMadiun); ?></strong></td>
                                    <td class="text-sm rupiah"><strong> <?= number_format($totalNonKapitasiMadiun); ?></strong></td>
                                    <td class="text-sm rupiah"><strong> <?= number_format($totalKapitasiMadiun + $totalNonKapitasiMadiun); ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Mediska Kertosono -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Klinik Mediska Kertosono</h6>
                        <h7 class="text-white text-capitalize ps-3">*Dalam Ribuan</h7>
                    </div>
                </div>
                <div class="card-body px-0 pb">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-sm">No</th>
                                    <th class="text-center text-sm">Bulan</th>
                                    <th class="text-center text-sm">Kapitasi</th>
                                    <th class="text-center text-sm">Non Kapitasi</th>
                                    <th class="text-center text-sm">Jumlah</th>
                                    <th class="text-center text-smtext-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                list($totalKapitasiKertosono, $totalNonKapitasiKertosono) = getTotalPerKlinik($conn, 'Mediska Kertosono', $tahun);
                                $sql2 = "SELECT id_pendapatan, bulan, kapitasi, non_kapitasi FROM pendapatan WHERE klinik='Mediska Kertosono' AND tahun='$tahun'";
                                $hasil = mysqli_query($conn, $sql2);
                                $nomor = 1; // Inisialisasi nomor urut
                                $tambahkapitasinon = 0;
                                while($baris = mysqli_fetch_assoc($hasil)){ 
                                    $kapitasi = (float)$baris['kapitasi']; 
                                    $non_kapitasi = (float)$baris['non_kapitasi'];
                                    $tambahkapitasinon += $kapitasi + $non_kapitasi;
                                ?>
                                    <tr>
                                        <td class="text-center text-sm"><?= $nomor++; ?></td> <!-- Tampilkan dan tambahkan 1 ke nomor urut -->
                                        <td class="text-center text-sm"><?= $baris['bulan']; ?></td>
                                        <td class="text-sm rupiah"> <?= number_format($baris['kapitasi']); ?></td>
                                        <td class="text-sm rupiah"> <?= number_format($baris['non_kapitasi']); ?></td>
                                        <td class="text-sm rupiah"> <?= number_format($kapitasi + $non_kapitasi); ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="2" class="text-center"><strong>Total</strong></td>
                                    <td class="text-sm rupiah"><strong> <?= number_format($totalKapitasiKertosono); ?></strong></td>
                                    <td class="text-sm rupiah"><strong> <?= number_format($totalNonKapitasiKertosono); ?></strong></td>
                                    <td class="text-sm rupiah"><strong> <?= number_format($totalKapitasiKertosono + $totalNonKapitasiKertosono); ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Mediska Kediri -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Klinik Mediska Kediri</h6>
                        <h7 class="text-white text-capitalize ps-3">*Dalam Ribuan</h7>
                    </div>
                </div>
                <div class="card-body px-0 pb">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-sm">No</th>
                                    <th class="text-center text-sm">Bulan</th>
                                    <th class="text-center text-sm">Kapitasi</th>
                                    <th class="text-center text-sm">Non Kapitasi</th>
                                    <th class="text-center text-sm">Jumlah</th>
                                    <th class="text-center text-smtext-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                list($totalKapitasiKediri, $totalNonKapitasiKediri) = getTotalPerKlinik($conn, 'Mediska Kediri', $tahun);
                                $sql_kediri = "SELECT id_pendapatan, bulan, kapitasi, non_kapitasi FROM pendapatan WHERE klinik='Mediska Kediri' AND tahun='$tahun'";
                                $hasil = mysqli_query($conn, $sql_kediri);
                                $nomor = 1; // Inisialisasi nomor urut
                                $tambah_kediri = 0;
                                while($baris = mysqli_fetch_assoc($hasil)){ 
                                    $kapitasi_kediri = (float)$baris['kapitasi']; 
                                    $non_kapitasi_kediri = (float)$baris['non_kapitasi'];
                                    $tambah_kediri += $kapitasi_kediri + $non_kapitasi_kediri;
                                ?>
                                    <tr>
                                        <td class="text-center text-sm"><?= $nomor++; ?></td> <!-- Tampilkan dan tambahkan 1 ke nomor urut -->
                                        <td class="text-center text-sm"><?= $baris['bulan']; ?></td>
                                        <td class="text-sm rupiah"> <?= number_format($baris['kapitasi']); ?></td>
                                        <td class="text-sm rupiah"> <?= number_format($baris['non_kapitasi']); ?></td>
                                        <td class="text-sm rupiah"> <?= number_format($kapitasi_kediri + $non_kapitasi_kediri); ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="2" class="text-center"><strong>Total</strong></td>
                                    <td class="text-sm rupiah"><strong> <?= number_format($totalKapitasiKediri); ?></strong></td>
                                    <td class="text-sm rupiah"><strong> <?= number_format($totalNonKapitasiKediri); ?></strong></td>
                                    <td class="text-sm rupiah"><strong> <?= number_format($totalKapitasiKediri + $totalNonKapitasiKediri); ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Mediska Blitar -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Klinik Mediska Blitar</h6>
                        <h7 class="text-white text-capitalize ps-3">*Dalam Ribuan</h7>
                    </div>
                </div>
                <div class="card-body px-0 pb">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-sm">No</th>
                                    <th class="text-center text-sm">Bulan</th>
                                    <th class="text-center text-sm">Kapitasi</th>
                                    <th class="text-center text-sm">Non Kapitasi</th>
                                    <th class="text-center text-sm">Jumlah</th>
                                    <th class="text-center text-smtext-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                list($totalKapitasiBlitar, $totalNonKapitasiBlitar) = getTotalPerKlinik($conn, 'Mediska Blitar', $tahun);
                                $sql_blitar = "SELECT id_pendapatan, bulan, kapitasi, non_kapitasi FROM pendapatan WHERE klinik='Mediska Blitar' AND tahun='$tahun'";
                                $hasil = mysqli_query($conn, $sql_blitar);
                                $nomor = 1; // Inisialisasi nomor urut
                                $tambah_blitar = 0;
                                while($baris = mysqli_fetch_assoc($hasil)){ 
                                    $kapitasi_blitar = (float)$baris['kapitasi']; 
                                    $non_kapitasi_blitar = (float)$baris['non_kapitasi'];
                                    $tambah_blitar += $kapitasi_blitar + $non_kapitasi_blitar;
                                ?>
                                    <tr>
                                        <td class="text-center text-sm"><?= $nomor++; ?></td> <!-- Tampilkan dan tambahkan 1 ke nomor urut -->
                                        <td class="text-center text-sm"><?= $baris['bulan']; ?></td>
                                        <td class="text-sm rupiah"> <?= number_format($baris['kapitasi']); ?></td>
                                        <td class="text-sm rupiah"> <?= number_format($baris['non_kapitasi']); ?></td>
                                        <td class="text-sm rupiah"> <?= number_format($kapitasi_blitar + $non_kapitasi_blitar); ?></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="2" class="text-center"><strong>Total</strong></td>
                                    <td class="text-sm rupiah"><strong> <?= number_format($totalKapitasiBlitar); ?></strong></td>
                                    <td class="text-sm rupiah"><strong> <?= number_format($totalNonKapitasiBlitar); ?></strong></td>
                                    <td class="text-sm rupiah"><strong> <?= number_format($totalKapitasiBlitar + $totalNonKapitasiBlitar); ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Semua Mediska -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Total Semua Mediska</h6>
                        <h7 class="text-white text-capitalize ps-3">*Dalam Ribuan</h7>
                    </div>
                </div>
                <div class="card-body px-0 pb">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-sm">No</th>
                                    <th class="text-center text-sm">Klinik</th>
                                    <th class="text-center text-sm">Kapitasi</th>
                                    <th class="text-center text-sm">Non Kapitasi</th>
                                    <th class="text-center text-sm">Jumlah</th>
                                    <th class="text-center text-smtext-secondary opacity-7"></th>
                                </tr>
                            </thead>                     
                            <tfoot>
                              <tr>
                                <td class="text-center text-sm">1</td>
                                <td class="text-sm">Klinik Mediska Madiun</th>
                                <td class="text-sm rupiah"><?= number_format($totalKapitasiMadiun); ?></td>
                                <td class="text-sm rupiah"><?= number_format($totalNonKapitasiMadiun); ?></td>
                                <td class="text-sm rupiah"><?= number_format($totalKapitasiMadiun + $totalNonKapitasiMadiun); ?></td>
                              </tr>
                              <tr>
                                <td class="text-center text-sm">2</td>
                                <td class="text-sm">Klinik Mediska Kertosono</td>
                                <td class="text-sm rupiah"><?= number_format($totalKapitasiKertosono); ?></td>
                                <td class="text-sm rupiah"><?= number_format($totalNonKapitasiKertosono); ?></td>
                                <td class="text-sm rupiah"><?= number_format($totalKapitasiKertosono + $totalNonKapitasiKertosono); ?></td>
                              </tr>
                              <tr>
                                <td class="text-center text-sm">3</td>
                                <td class="text-sm">Klinik Mediska Kediri</td>
                                <td class="text-sm rupiah"><?= number_format($totalKapitasiKediri); ?></td>
                                <td class="text-sm rupiah"><?= number_format($totalNonKapitasiKediri); ?></td>
                                <td class="text-sm rupiah"><?= number_format($totalKapitasiKediri + $totalNonKapitasiKediri); ?></td>
                            </tr>
                            <tr>
                                <td class="text-center text-sm">4</td>
                                <td class="text-sm">Klinik Mediska Blitar</td>
                                <td class="text-sm rupiah"><?= number_format($totalKapitasiBlitar); ?></td>
                                <td class="text-sm rupiah"><?= number_format($totalNonKapitasiBlitar); ?></td>
                                <td class="text-sm rupiah"><?= number_format($totalKapitasiBlitar + $totalNonKapitasiBlitar); ?></td>
                            </tr>
                              <tr>
                              <td colspan="2" class="text-center"><strong>Total</strong></td>
                                <td class="text-sm rupiah"><strong> <?= number_format($totalKapitasiMadiun + $totalKapitasiKertosono + $totalKapitasiKediri + $totalKapitasiBlitar); ?></strong></td>
                                <td class="text-sm rupiah"><strong> <?= number_format($totalNonKapitasiMadiun + $totalNonKapitasiKertosono + $totalNonKapitasiKediri + $totalNonKapitasiBlitar); ?></strong></td>
                                <td class="text-sm rupiah"><strong> <?= number_format($totalKapitasiMadiun + $totalKapitasiKertosono + $totalKapitasiKediri + $totalKapitasiBlitar + $totalNonKapitasiMadiun + $totalNonKapitasiKertosono + $totalNonKapitasiKediri + $totalNonKapitasiBlitar ); ?></strong></td>
                              </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


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
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>