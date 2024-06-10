<?php 
include "../koneksi.php";
// Ambil parameter tahun dan bulan dari URL jika ada, default ke bulan dan tahun saat ini
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$sql3 = "SELECT id, jenis_kepesertaan, januari, februari, maret, april, mei, juni, juli, agustus, september, oktober, november, desember FROM kunjungan WHERE tahun = '$tahun'";
$result = $conn->query($sql3);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        'jenis_kepesertaan' => $row['jenis_kepesertaan'],
        'januari' => $row['januari'],
        'februari' => $row['februari'],
        'maret' => $row['maret'],
        'april' => $row['april'],
        'mei' => $row['mei'],
        'juni' => $row['juni'],
        'juli' => $row['juli'],
        'agustus' => $row['agustus'],
        'september' => $row['september'],
        'oktober' => $row['oktober'],
        'november' => $row['november'],
        'desember' => $row['desember'],
    ];
}

$chartData = json_encode($data);
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
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
      <a class="navbar-brand m-0" href="services.php" target="_blank">
      <span class="ms-1 font-weight-bold text-white">Dashboard Health Services</span>
    </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="kunjungan_klinik.php">
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
      <h6 class="font-weight-bolder mb-0">Kunjungan Klinik</h6>
      
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
<div class="d-flex justify-content-center align-items-center">
    <div class="card my-4" style="width: 300px;">
        <div class="card-body">
            <form action="kunjungan_klinik.php" method="GET">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="flex-grow-1 pr-1">
                        <div class="form-group mb-0">
                            <select name="tahun" class="form-control" id="tahunSelect">
                                <option value="" selected>Pilih Tahun</option>
                                <?php
                                // Ambil tahun dari database
                                $sqlTahun = "SELECT DISTINCT tahun FROM kunjungan ORDER BY tahun ASC";
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

<div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Grafik Kunjungan Klinik Tahun <?= $tahun; ?></h6>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="kunjunganChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

  <div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
        <div class="col-12">
          <div>
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div><a href="tambah_kunjungan.php" class="btn btn-primary"><i class="bi bi-plus-square"></i> Tambah Data</a>
            </div>
          </div>
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">REKAPITULASI KUNJUNGAN KLINIK MEDISKA DAOP 7 MADIUN TAHUN <?= $tahun; ?></h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                      <thead>
                          <tr>
                              <th class="text-center text-sm">NO</th>
                              <th class="text-center text-sm">JENIS KEPESERTAAN</th>
                              <th class="text-center text-sm">JAN</th>
                              <th class="text-center text-sm">FEB</th>
                              <th class="text-center text-sm">MAR</th>
                              <th class="text-center text-sm">APR</th>
                              <th class="text-center text-sm">MEI</th>
                              <th class="text-center text-sm">JUN</th>
                              <th class="text-center text-sm">JUL</th>
                              <th class="text-center text-sm">AGU</th>
                              <th class="text-center text-sm">SEP</th>
                              <th class="text-center text-sm">OKT</th>
                              <th class="text-center text-sm">NOV</th>
                              <th class="text-center text-sm">DES</th>
                              <th class="text-center text-sm">JUMLAH</th>
                              <th class="text-center text-sm">ACTION</th>
                              <th class="text-secondary opacity-7"></th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          $sql3 = "SELECT id,jenis_kepesertaan, januari, februari, maret, april, mei, juni, juli, agustus, september, oktober, november, desember FROM kunjungan WHERE tahun = '$tahun'";
                          $result = $conn->query($sql3);
                          $total_kunjungan_per_bulan = [
                              'januari' => 0, 'februari' => 0, 'maret' => 0, 'april' => 0, 'mei' => 0,
                              'juni' => 0, 'juli' => 0, 'agustus' => 0, 'september' => 0, 'oktober' => 0,
                              'november' => 0, 'desember' => 0
                          ];
                          $total_semua_kunjungan = 0;
                          $nomor = 1;
                          while ($baris = mysqli_fetch_assoc($result)) {
                              $total_per_kepesertaan = $baris['januari'] + $baris['februari'] + $baris['maret'] + $baris['april'] + $baris['mei'] + $baris['juni'] + $baris['juli'] + $baris['agustus'] + $baris['september'] + $baris['oktober'] + $baris['november'] + $baris['desember'];
                              $total_semua_kunjungan += $total_per_kepesertaan;

                              foreach ($total_kunjungan_per_bulan as $bulan => $total) {
                                  $total_kunjungan_per_bulan[$bulan] += $baris[$bulan];
                              }
                          ?>
                              <tr class="text-center">
                                  <td class="text-center text-sm"><?= $nomor++; ?></td>
                                  <td class="text-center text-sm"><?= $baris['jenis_kepesertaan']; ?></td>
                                  <td class="text-center text-sm"><?= $baris['januari']; ?></td>
                                  <td class="text-center text-sm"><?= $baris['februari']; ?></td>
                                  <td class="text-center text-sm"><?= $baris['maret']; ?></td>
                                  <td class="text-center text-sm"><?= $baris['april']; ?></td>
                                  <td class="text-center text-sm"><?= $baris['mei']; ?></td>
                                  <td class="text-center text-sm"><?= $baris['juni']; ?></td>
                                  <td class="text-center text-sm"><?= $baris['juli']; ?></td>
                                  <td class="text-center text-sm"><?= $baris['agustus']; ?></td>
                                  <td class="text-center text-sm"><?= $baris['september']; ?></td>
                                  <td class="text-center text-sm"><?= $baris['oktober']; ?></td>
                                  <td class="text-center text-sm"><?= $baris['november']; ?></td>
                                  <td class="text-center text-sm"><?= $baris['desember']; ?></td>
                                  <td class="text-center text-sm"><?= $total_per_kepesertaan; ?></td>
                                  <td class="align-middle text-center text-sm">
                                    <a href="../health-services/edit_kunjungan.php?id=<?= $baris['id']; ?>">
                                    <span class="badge badge-sm bg-gradient-success">Edit</span>
                                   </a>
                                   <a href="../health-services/delete_kunjungan.php?id=<?= $baris['id']; ?>" onclick="return confirm('Anda yakin?')">
                                    <span class="badge badge-sm bg-gradient-danger">Delete</span>
                                  </a>
                                  </td>

                              </tr>
                          <?php } ?>
                      </tbody>
                      <tfoot>
                          <tr>
                              <th colspan="2" class="text-center text-sm">Jumlah</th>
                              <th class="text-center text-sm"><?= $total_kunjungan_per_bulan['januari']; ?></th>
                              <th class="text-center text-sm"><?= $total_kunjungan_per_bulan['februari']; ?></th>
                              <th class="text-center text-sm"><?= $total_kunjungan_per_bulan['maret']; ?></th>
                              <th class="text-center text-sm"><?= $total_kunjungan_per_bulan['april']; ?></th>
                              <th class="text-center text-sm"><?= $total_kunjungan_per_bulan['mei']; ?></th>
                              <th class="text-center text-sm"><?= $total_kunjungan_per_bulan['juni']; ?></th>
                              <th class="text-center text-sm"><?= $total_kunjungan_per_bulan['juli']; ?></th>
                              <th class="text-center text-sm"><?= $total_kunjungan_per_bulan['agustus']; ?></th>
                              <th class="text-center text-sm"><?= $total_kunjungan_per_bulan['september']; ?></th>
                              <th class="text-center text-sm"><?= $total_kunjungan_per_bulan['oktober']; ?></th>
                              <th class="text-center text-sm"><?= $total_kunjungan_per_bulan['november']; ?></th>
                              <th class="text-center text-sm"><?= $total_kunjungan_per_bulan['desember']; ?></th>
                              <th class="text-center text-sm"><?= $total_semua_kunjungan; ?></th>
                          </tr>
                      </tfoot>
                    </table>
                    </div>
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
  <script>
    const chartData = <?= $chartData; ?>;
  </script>
  <!-- Tambahkan setelah elemen canvas -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('kunjunganChart').getContext('2d');
    const data = chartData;
    const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    const colors = [
        'rgba(0, 123, 255, 1)', // biru
        'rgba(40, 167, 69, 1)', // hijau
        'rgba(255, 7, 58, 1)',  // merah
        'rgba(255, 193, 7, 1)'  // kuning
    ];

    const datasets = data.map((item, index) => ({
        label: item.jenis_kepesertaan,
        data: [
            item.januari, item.februari, item.maret, item.april, item.mei, 
            item.juni, item.juli, item.agustus, item.september, 
            item.oktober, item.november, item.desember
        ],
        borderColor: colors[index % colors.length],
        backgroundColor: colors[index % colors.length],
        borderWidth: 2,
        fill: false
    }));

    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Grafik Kunjungan Klinik per Bulan'
                }
            }
        }
    });
});
</script>

<!--   Core JS Files   -->
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="../assets/js/plugins/chartjs.min.js"></script>
<script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
<!-- Tempatkan di antara tag <script> </script> Anda -->
</body>

</html>