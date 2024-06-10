<?php 
include "../koneksi.php";
session_start();

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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      <a class="navbar-brand m-0" href="#" target="_blank">
      <span class="ms-1 font-weight-bold text-white">Dashboard Health Budget</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        
        <li class="nav-item">
          <a class="nav-link text-white" href="anggaran_percommitmenitem.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Anggaran Per CI</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="program_realisasi.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Anggaran PerKegiatan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="pendapatan.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Pendapatan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="anggaran_perkegiatan.php">
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
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Anggaran PerCommitment</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Anggaran PerCI</h6>
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
            <a href="../logout.php" class="nav-link font-weight-bold text-body p-0" id="logoutLink">
              <i class="fa-solid fa-lg "><img src=" ../assets/img/icon/logout.png" alt="" width="15" height="15" ></i>
              Logout
            </a>
          </li>

          <li class="nav-item dropdown pe-2 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            </a>
            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
            </ul>
          </li>
          <li class="nav-item d-flex align-items-center">
            <span class="nav-link text-body font-weight-bold px-0">
              <i class="fa fa-user me-sm-1"></i>

              <?php echo isset($_SESSION['nm_user']) ? $_SESSION['nm_user'] : "Guest"; ?>
            </span>

          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

    <!-- End Navbar -->
    <div class="container">
        <div class="row">
            <?php 
            // Query untuk mengambil data dari tabel anggaran_perci dan menghitung total nominal untuk setiap rincian
            $sql1 = "SELECT uraian_kegiatan, SUM(program) AS total_program, SUM(penyerapan) AS total_penyerapan FROM program_dan_realisasi WHERE uraian_kegiatan='Biaya Kesehatan Pegawai'";
            $result1 = $conn->query($sql1);

            // Inisialisasi array untuk menyimpan data
            $data1 = array();

            // Memasukkan data dari hasil query ke dalam array
            if ($result1->num_rows > 0) {
                while($row1 = $result1->fetch_assoc()) {
                    $total_sisa1 = $row1["total_program"] - $row1["total_penyerapan"];
                    $data1[] = array(
                        "uraian_kegiatan" => $row1["uraian_kegiatan"], 
                        "total_program" => $row1["total_program"], 
                        "total_penyerapan" => $row1["total_penyerapan"],
                        "total_sisa" => $total_sisa1
                    );
                }
            } else {
                echo "0 hasil";
            }
            
            // Query untuk mengambil data dari tabel anggaran_perci dan menghitung total nominal untuk setiap rincian
            $sql2 = "SELECT uraian_kegiatan, SUM(program) AS total_program, SUM(penyerapan) AS total_penyerapan FROM program_dan_realisasi WHERE uraian_kegiatan='Biaya Umum'";
            $result2 = $conn->query($sql2);

            // Inisialisasi array untuk menyimpan data
            $data2 = array();

            // Memasukkan data dari hasil query ke dalam array
            if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                    $total_sisa2 = $row2["total_program"] - $row2["total_penyerapan"];
                    $data2[] = array(
                        "uraian_kegiatan" => $row2["uraian_kegiatan"], 
                        "total_program" => $row2["total_program"], 
                        "total_penyerapan" => $row2["total_penyerapan"],
                        "total_sisa" => $total_sisa2
                    );
                }
            } else {
                echo "0 hasil";
            }
            ?>
            
            <div class="col-lg-6 col-md-12 mt-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Biaya Kesehatan Pegawai</h5>
                    </div>
                    <div class="card-body">
                        <div style="width: 100%; max-width: 600px; margin: auto;">
                            <canvas id="comparisonChartKesehatan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-12 mt-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Biaya Umum</h5>
                    </div>
                    <div class="card-body">
                        <div style="width: 100%; max-width: 600px; margin: auto;">
                            <canvas id="comparisonChartUmum"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Data untuk chart kesehatan pegawai
                var data1 = <?php echo json_encode($data1); ?>;
                var labels1 = [];
                var dataProgram1 = [];
                var dataPenyerapan1 = [];
                var dataSisa1 = [];

                data1.forEach(function(item){
                    labels1.push(item.uraian_kegiatan);
                    dataProgram1.push(item.total_program);
                    dataPenyerapan1.push(item.total_penyerapan);
                    dataSisa1.push(item.total_sisa);
                });

                // Membuat diagram batang untuk kesehatan pegawai
                var ctxComparisonKesehatan = document.getElementById('comparisonChartKesehatan').getContext('2d');
                var comparisonChartKesehatan = new Chart(ctxComparisonKesehatan, {
                    type: 'bar',
                    data: {
                        labels: labels1,
                        datasets: [
                            {
                                label: 'Total Program',
                                data: dataProgram1,
                                backgroundColor: 'rgba(255, 99, 132, 0.5)', // Merah
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Total Penyerapan',
                                data: dataPenyerapan1,
                                backgroundColor: 'rgba(255, 206, 86, 0.5)', // Kuning
                                borderColor: 'rgba(255, 206, 86, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Total Sisa',
                                data: dataSisa1,
                                backgroundColor: 'rgba(75, 192, 192, 0.5)', // Hijau
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Data untuk chart umum
                var data2 = <?php echo json_encode($data2); ?>;
                var labels2 = [];
                var dataProgram2 = [];
                var dataPenyerapan2 = [];
                var dataSisa2 = [];

                data2.forEach(function(item){
                    labels2.push(item.uraian_kegiatan);
                    dataProgram2.push(item.total_program);
                    dataPenyerapan2.push(item.total_penyerapan);
                    dataSisa2.push(item.total_sisa);
                });

                // Membuat diagram batang untuk umum
                var ctxComparisonUmum = document.getElementById('comparisonChartUmum').getContext('2d');
                var comparisonChartUmum = new Chart(ctxComparisonUmum, {
                    type: 'bar',
                    data: {
                        labels: labels2,
                        datasets: [
                            {
                                label: 'Total Program',
                                data: dataProgram2,
                                backgroundColor: 'rgba(255, 99, 132, 0.5)', // Merah
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Total Penyerapan',
                                data: dataPenyerapan2,
                                backgroundColor: 'rgba(255, 206, 86, 0.5)', // Kuning
                                borderColor: 'rgba(255, 206, 86, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Total Sisa',
                                data: dataSisa2,
                                backgroundColor: 'rgba(75, 192, 192, 0.5)', // Hijau
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }
                        ]
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
        </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-inde">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Biaya Kesehatan Pegawai</h6>
                <h7 class="text-white text-capitalize ps-3">*Dalam Ribuan</h7>
              </div>
            </div>
            <div class="card-body px-0 p">
              <div class="table-responsive p-0">
              <table class="table align-items-center mb-0 rupiah-table">
                <thead>
                  <tr>
                    <th class="text-center text-sm">No</th>
                    <th class="text-center text-sm">Uraian Kegiatan</th>
                    <th class="text-center text-sm">Program</th>
                    <th class="text-center text-sm">Penyerapan</th>
                    <th class="text-center text-sm">Sisa</th>
                    <th class="text-center text-sm">Presentase</th>
                    <th class="text-center text-sm">Action</th>
                    <th class="text-center text-sm text-secondary opacity-6"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sql = "SELECT id_program, uraian_kegiatan, rincian, program, penyerapan FROM program_dan_realisasi WHERE uraian_kegiatan = 'Biaya Kesehatan Pegawai'";
                  $hasil = mysqli_query($conn, $sql);
                  $nomor = 1; // Inisialisasi nomor urut
                  $total_program1 = 0; // Inisialisasi total program
                  $total_penyerapan1 = 0; // Inisialisasi total penyerapan
                  while($baris = mysqli_fetch_assoc($hasil)){ 
                      $program = (float)$baris['program']; // Cast program to float
                      $penyerapan = (float)$baris['penyerapan']; // Cast penyerapan to float
                      $sisa = $program - $penyerapan; // Hitung sisa
                      $total_program1 += $program; // Tambahkan program ke total program
                      $total_penyerapan1 += $penyerapan; // Tambahkan penyerapan ke total penyerapan
                      $presentase = ($sisa / $program) * 100; // Hitung presentase
                  ?>
                  <tr>
                    <td class="text-center text-sm"><?= $nomor++; ?></td> <!-- Tampilkan dan tambahkan 1 ke nomor urut -->
                    <td class="text-sm"><?= $baris['rincian']; ?></td>
                    <td class="text-sm rupiah"> <?= number_format($program); ?></td> <!-- Tampilkan program dengan format Rupiah dan dua angka desimal -->
                    <td class="text-sm rupiah"> <?= number_format($penyerapan); ?></td> <!-- Tampilkan penyerapan dengan format Rupiah dan dua angka desimal -->
                    <td class="text-sm rupiah"> <?= number_format($sisa); ?></td> <!-- Tampilkan sisa dengan format Rupiah dan dua angka desimal -->
                    <td class="text-sm text-center"><?= number_format($presentase); ?>%</td> <!-- Tampilkan presentase dengan dua angka desimal -->
                    <td class="align-middle text-center text-sm">
                          <a href="../health_budget_admin/program_realisasi/edit_program.php?id_program=<?= $baris['id_program']; ?>"><span class="badge badge-sm bg-gradient-success">Edit </span></a>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th>Jumlah</th>
                    <th class="text-sm rupiah"> <?= number_format($total_program1); ?></th> <!-- Tampilkan total program dengan format Rupiah dan dua angka desimal -->
                    <th class="text-sm rupiah"> <?= number_format($total_penyerapan1); ?></th> <!-- Tampilkan total penyerapan dengan format Rupiah dan dua angka desimal -->
                    <th class="text-sm rupiah"> <?= number_format($total_program1 - $total_penyerapan1); ?></th> <!-- Tampilkan total sisa dengan format Rupiah dan dua angka desimal -->
                    <th></th> <!-- Kolom kosong untuk presentase di bagian footer -->
                    <th></th> <!-- Kolom kosong untuk kolom terakhir -->
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
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-inde">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Biaya Umum</h6>
                <h7 class="text-white text-capitalize ps-3">*Dalam Ribuan</h7>
              </div>
            </div>
            <div class="card-body px-0 p">
              <div class="table-responsive p-0">
              <table class="table align-items-center mb-0 rupiah-table">
                  <thead>
                    <tr>
                      <th class="text-center text-sm">No</th>
                      <th class="text-center text-sm">Uraian Kegiatan</th>
                      <th class="text-center text-sm">Program</th>
                      <th class="text-center text-sm">Penyerapan</th>
                      <th class="text-center text-sm">Sisa</th>
                      <th class="text-center text-sm">Presentase</th>
                      <th class="text-center text-sm">Action</th>
                      <th class="text-center text-smtext-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $sql = "SELECT id_program, uraian_kegiatan, rincian, program, penyerapan FROM program_dan_realisasi WHERE uraian_kegiatan = 'Biaya Umum'";
                      $hasil = mysqli_query($conn, $sql);
                      $nomor = 1; // Inisialisasi nomor urut
                      $total_program2 = 0; // Inisialisasi total program
                      $total_penyerapan2 = 0; // Inisialisasi total penyerapan
                      while($baris = mysqli_fetch_assoc($hasil)){ 
                          $program2 = (float)$baris['program']; // Cast program to float
                          $penyerapan2 = (float)$baris['penyerapan']; // Cast penyerapan to float
                          $sisa2 = $program2 - $penyerapan2; // Hitung sisa
                          $total_program2 += $program2; // Tambahkan program ke total program
                          $total_penyerapan2 += $penyerapan2; // Tambahkan penyerapan ke total penyerapan
                          $presentase2 = ($sisa2 / $program2) * 100; // Hitung presentase
                      ?>
                    <tr>
                      <td class="text-center text-sm"><?= $nomor++; ?></td> <!-- Tampilkan dan tambahkan 1 ke nomor urut -->
                      <td class="text-sm"><?= $baris['rincian']; ?></td>
                      <td class="text-sm rupiah"> <?= number_format($program2); ?></td> <!-- Tampilkan program dengan format Rupiah dan dua angka desimal -->
                      <td class="text-sm rupiah"> <?= number_format($penyerapan2); ?></td> <!-- Tampilkan penyerapan dengan format Rupiah dan dua angka desimal -->
                      <td class="text-sm rupiah"> <?= number_format($sisa2); ?></td> <!-- Tampilkan sisa dengan format Rupiah dan dua angka desimal -->
                      <td class="text-sm  text-center"><?= number_format($presentase2); ?>%</td>
                      <td class="align-middle text-center text-sm">
                          <a href="../health_budget_admin/program_realisasi/edit_program.php?id_program=<?= $baris['id_program']; ?>"><span class="badge badge-sm bg-gradient-success">Edit </span></a>
                     </td>

                    </tr>
                  <?php } ?>
                </tbody>
                  <tfoot>
                      <tr>
                          <th></th>
                          <th>Jumlah</th>
                          <th class="rupiah"> <?= number_format($total_program2); ?></th> <!-- Tampilkan total program dengan format Rupiah dan dua angka desimal -->
                          <th class="rupiah"> <?= number_format($total_penyerapan2); ?></th> <!-- Tampilkan total penyerapan dengan format Rupiah dan dua angka desimal -->
                          <th class="rupiah"><?= number_format($total_program2 - $total_penyerapan2); ?></th> <!-- Tampilkan total sisa dengan format Rupiah dan dua angka desimal -->
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
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-inde">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Biaya Kesehatan Pegawai Dan Biaya Umum </h6>
                <h7 class="text-white text-capitalize ps-3">Total Keseluruhan *Dalam Ribuan</h7>
              </div>
            </div>
            <div class="card-body px-0 p">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  </tbody>
                <tfoot>
                    <tr>
                      <th></th>
                      <th></th>
                      <th>Total</th>
                      <th class="text-sm"> <?= number_format(($total_program1 - $total_penyerapan1)+($total_program2 - $total_penyerapan2)); ?></th>
                    </tr>
                  </tfoot>
                </table>
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

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>