<?php

include '../koneksi.php';
// Query untuk mengambil data dari database
$query = "SELECT * FROM tb_timeline";
$result = mysqli_query($conn, $query);

$sql_tahun = 'SELECT DISTINCT pic FROM tb_timeline';
$result_tahun = mysqli_query($conn, $sql_tahun);
$pic = [];
while ($row_tahun = mysqli_fetch_assoc($result_tahun)) {
  $pic[] = $row_tahun['pic'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Activity Plan</title>
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/logo1.png">

  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/main2.css" rel="stylesheet">
  <style>
    .shortened-form .input-group {
      max-width: 300px;
    }

    .shortened-form .form-control {
      max-width: 500px;
    }

    .form-container {
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>

  <!-- =======================================================
  * Template Name: UpConstruction - v1.2.1
  * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>


  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>Unit Kesehatan | Daop 7 Madiun </h1>
      </a>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs d-flex align-items-center" style="background-image: url('../assets/img/depan/4.jpg');">
      <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

        <h2>Activity Plan</h2>
        <ol>
          <li><a href="../index.php">Home</a></li>
          <li>Activity Plan</li>
        </ol>

      </div>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Service Details Section ======= -->
    <section id="service-details" class="service-details">

      <?php
      // Database connection
      // $conn = new mysqli('host', 'username', 'password', 'database');

      // Check if PIC is selected
      $selectedPic = isset($_GET['pic']) ? $_GET['pic'] : '';

      // Modify query to filter by PIC if selected
      if (!empty($selectedPic)) {
        $query = "SELECT * FROM tb_timeline WHERE pic = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $selectedPic);
        $stmt->execute();
        $result = $stmt->get_result();
      } else {
        $query = "SELECT * FROM tb_timeline";
        $result = mysqli_query($conn, $query);
      }

      $picOptions = ['Superviser', 'Assistant Manager Pelayanan & Kepesertaan', 'Assistant Manager Kesehatan Kerja']; // Example PIC options
      ?>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="form-container">
          <form action="timeline.php" method="GET" class="form-inline">
            <div class="input-group">
              <select name="pic" class="form-control">
                <option value="" selected>Semua PIC</option>
                <?php foreach ($picOptions as $picOption) : ?>
                  <option value="<?php echo $picOption; ?>" <?php echo $selectedPic == $picOption ? 'selected' : ''; ?>>
                    <?php echo $picOption; ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <div class="input-group-append">
                <button id="search-button" class="btn btn-success" type="submit" style="background-color: #C6EBC5;color:black">Cari</button>
              </div>

            </div>
          </form>
        </div>
        <br>
        <a href="tambah.php">
          <i class="fa-solid"><img src="../assets/img/icon/plus.png" alt="" width="30" height="30"></i>
        </a>
        <br><br>
        <!-- TABLE IP -->
        <div class="row">
          <div class="col-md-15">
            <div class="table-responsive"> <!-- Tambahkan kelas table-responsive untuk mendukung tampilan responsif -->
              <table class="table table-bordered table-sm" style="text-align: center;border:1px;"> <!-- Tambahkan kelas table-sm untuk merampingkan tabel -->
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Uraian</th>
                    <th>Dateline</th>
                    <th>PIC</th>
                    <th>Status</th>
                    <th style="width: 100px;">Action</th> <!-- Atur lebar kolom Action -->
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  $processRows = [];
                  $otherRows = [];

                  // Separate rows into 'Process' and others
                  while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['status'] == 'Process') {
                      $processRows[] = $row;
                    } else {
                      $otherRows[] = $row;
                    }
                  }

                  // Function to sort rows by date
                  function sortByDate($a, $b)
                  {
                    $dateA = strtotime($a['tanggal']);
                    $dateB = strtotime($b['tanggal']);
                    return $dateA - $dateB;
                  }

                  // Sort rows by date
                  usort($processRows, 'sortByDate');
                  usort($otherRows, 'sortByDate');

                  // Merge 'Process' rows at the top followed by other rows
                  $allRows = array_merge($processRows, $otherRows);

                  foreach ($allRows as $row) {
                    $icon = '';
                    if ($row['status'] == 'Done') {
                      $bg_color = '#C6EBC5'; // green color for 'Done' status
                    } else if ($row['status'] == 'Process') {
                      $bg_color = '#FF9B9B'; // red color for 'Process' status
                    }
                  ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $row['uraian']; ?></td>
                      <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                      <td><?php echo $row['pic']; ?></td>


                      <td style="background-color: <?php echo $bg_color; ?>"><?php echo $row['status']; ?></td>
                      <td>
                        <center>
                          <!-- Edit button -->
                          <a href="edit.php?id=<?php echo $row['id']; ?>">
                            <i class="fa-solid"><img src="../assets/img/icon/pen.png" alt="" width="30" height="30"></i>
                          </a>
                          <!-- Delete button -->
                          <a href="hapus.php?id=<?php echo $row['id']; ?>">
                            <i class="fa-solid"><img src="../assets/img/icon/bin.png" alt="" width="30" height="30"></i>
                          </a>
                          <!-- Display icon image based on status -->
                        </center>
                      </td>
                    </tr>
                  <?php $i++;
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <a href="../index.php">
          <i class="fa-solid"><img src="../assets/img/icon/undo.png" alt="" width="30" height="30"></i>
        </a>
      </div>
    </section>


    <!-- End Service Details Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-content position-relative">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="footer-info">
              <h3>Unit Kesehatan</h3>
              <p>
                Kompol Sunaryo, Madiun Lor, <br>
                Kec. Manguharjo, Kota Madiun, <br>
                Jawa Timur 63122 <br><br>
              </p>
              <div class="social-links d-flex mt-3">
                <a href="https://twitter.com/keretaapikita" class="d-flex align-items-center justify-content-center"><i class="bi bi-twitter"></i></a>
                <a href="https://www.facebook.com/keretaapikita" class="d-flex align-items-center justify-content-center"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/keretaapikita" class="d-flex align-items-center justify-content-center"><i class="bi bi-instagram"></i></a>
                <a href="https://www.youtube.com/keretaapikita" class="d-flex align-items-center justify-content-center"><i class="bi bi-youtube"></i></a>
              </div>
            </div>
          </div><!-- End footer info column-->

          <div class="col-lg-8 col-md-1" style="text-align: justify; margin-top:15px; line-height:30px;">
            <p class="text-justify">Unit Kesehatan Daop VII Madiun merupakah sebuah organisasi di bawah daerah Operasi VII Madiun.
              yang wilayah kerjanya meliputi seluruh wilayah kerja Daop VII Madiun. Unit Kesehatan Daop VII Madiun
              memberikan pelayanan kesehatan primer bagi pekerja dan keluarga serta memantau kesehatan pekerja
              di lingkungan daop VII Madiun. Unit Kesehatan Daop VII Madiun memiliki 4 klinik diantaranya mediska Madiun,
              mediska Kertosono, mediska Kediri,dan mediska Blitar. Selain itu terdapat 4 pos kesehatan/pos pemeriksaan kesehatan (
              antara lain pos kesehatan stasiun Madiun, Kertosono, Kediri dan Blitar.</p>
          </div><!-- End footer links column-->


        </div>
      </div>
    </div>

    <div class="footer-legal text-center position-relative">
      <div class="container">
        <div class="copyright">
          PT Kereta Api Indonesia (Persero) <strong><span>&copy;2024</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
        </div>
      </div>
    </div>

  </footer>
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>