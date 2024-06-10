<?php
// Lakukan koneksi ke database atau sertakan file konfigurasi koneksi
include '../koneksi.php';

// Ambil tanggal dari parameter URL jika tersedia
$date = isset($_GET['date']) ? $_GET['date'] : '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Edit Data Awak KA</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/logo1.png">


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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- =======================================================
  * Template Name: UpConstruction - v1.2.1
  * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <style>
        body {
            color: black;
            /* Mengatur warna teks menjadi hitam */
        }

        .station-box {
            border: 1px solid black;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12 text-center" style="padding-top:20px;"><img style="width: 100px;" src="../assets/img/logo1.png"></div>
                            <div class="col-lg-12">
                                <div class="p-3 pb-4 pt-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Edit Data Awak KA</h1>
                                    </div>

                                    <form method="post" id="nilaiForm" enctype="multipart/form-data" action="proses_edit_awak.php">

                                        <div class="form-group">
                                            <input type="hidden" name="date" value="<?php echo $date; ?>">

                                            <label for="date">Tanggal:</label><br>
                                            <input type="date" id="date" name="date" class='form-control' value="<?php echo $date; ?>" readonly>
                                            <input type="hidden" name="original_date" value="<?php echo $date; ?>">
                                        </div><br>
                                        <div class="form-group">

                                            <?php
                                            // Lakukan koneksi ke database di sini
                                            include '../koneksi.php';
                                            $sql = "SELECT r.date, s.name AS station_name, c.name AS crew_name, r.ms, r.tms
                FROM records r
                INNER JOIN stations s ON r.station_id = s.id
                INNER JOIN crew c ON r.crew_id = c.id
                WHERE DATE(r.date) = ?";

                                            $stmt = $conn->prepare($sql);
                                            $stmt->bind_param("s", $date);
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            // Buat array untuk menampung data pivot
                                            $pivotData = array();

                                            // Loop melalui hasil query untuk membangun data pivot
                                            while ($row = $result->fetch_assoc()) {
                                                $pivotData[$row['station_name']][$row['crew_name']] = array('ms' => $row['ms'], 'tms' => $row['tms']);
                                            }

                                            // Tampilkan form untuk setiap stasiun dan awak
                                            foreach ($pivotData as $station => $crewData) {
                                                echo "<div class='station-box'>";
                                                echo "<h5 style='color: black;'>$station</h5>";
                                                foreach ($crewData as $crew => $data) {
                                                    // Buat ID input yang unik dengan menggabungkan nama stasiun dan kru
                                                    $input_id_ms = "ms_" . str_replace(' ', '_', $station) . "_" . str_replace(' ', '_', $crew);
                                                    $input_id_tms = "tms_" . str_replace(' ', '_', $station) . "_" . str_replace(' ', '_', $crew);
                                                    echo "<div>";

                                                    echo "<h6>$crew</h6>";
                                                    echo "<label for='$input_id_ms'>MS:</label>";
                                                    echo "<input type='number' class='form-control' id='$input_id_ms' name='$input_id_ms' value='{$data['ms']}' required>";
                                                    echo "<label for='$input_id_tms'>TMS:</label>";
                                                    echo "<input type='number' class='form-control' id='$input_id_tms' name='$input_id_tms' value='{$data['tms']}' required>";
                                                    echo "<br>";
                                                    // Input tersembunyi untuk data stasiun dan awak
                                                    echo "<input type='hidden' name='station_crew_data[$station][$crew][ms]' value='{$data['ms']}'>";
                                                    echo "<input type='hidden' name='station_crew_data[$station][$crew][tms]' value='{$data['tms']}'>";

                                                    echo "</div>";
                                                }
                                                echo "</div>"; 
                                            }

                                            // mysqli_close($conn);

                                            ?>
                                            <br>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                        <a href="rikes.php" class="btn btn-danger btn-user btn-block">Kembali</a>
                                    </form>

</body>

</html>