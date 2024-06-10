<?php
// Lakukan koneksi ke database atau sertakan file konfigurasi koneksi
include '../koneksi.php';

// Ambil tanggal dari parameter URL jika tersedia
$date = isset($_GET['date']) ? $_GET['date'] : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Awak</title>
    <!-- Tambahkan link CSS atau Bootstrap jika diperlukan -->
</head>

<body>
    <h1>Edit Awak</h1>
    <form method="post" id="nilaiForm" enctype="multipart/form-data" action="proses_edit_awak.php">

        <div class="form-group">
            <input type="hidden" name="date" value="<?php echo $date; ?>">

            <label for="date">Tanggal:</label>
            <input type="date" id="date" name="date" value="<?php echo $date; ?>" readonly>
            <input type="hidden" name="original_date" value="<?php echo $date; ?>">

        </div>
        <div class="form-group">

            <?php
            // Lakukan koneksi ke database di sini
            include '../koneksi.php';

            // Query untuk mendapatkan data dari tabel records dengan nama stasiun dan nama kru
            // Mengambil data berdasarkan tanggal yang dipilih dari parameter URL
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
                echo "<h3>$station</h3>";
                foreach ($crewData as $crew => $data) {
                    // Buat ID input yang unik dengan menggabungkan nama stasiun dan kru
                    $input_id_ms = "ms_" . str_replace(' ', '_', $station) . "_" . str_replace(' ', '_', $crew);
                    $input_id_tms = "tms_" . str_replace(' ', '_', $station) . "_" . str_replace(' ', '_', $crew);
                    echo "<div>";
                    echo "<h4>$crew</h4>";
                    echo "<label for='$input_id_ms'>MS:</label>";
                    echo "<input type='number' class='form-control' id='$input_id_ms' name='$input_id_ms' value='{$data['ms']}' required>";
                    echo "<label for='$input_id_tms'>TMS:</label>";
                    echo "<input type='number' class='form-control' id='$input_id_tms' name='$input_id_tms' value='{$data['tms']}' required>";

                    // Input tersembunyi untuk data stasiun dan awak
                    echo "<input type='hidden' name='station_crew_data[$station][$crew][ms]' value='{$data['ms']}'>";
                    echo "<input type='hidden' name='station_crew_data[$station][$crew][tms]' value='{$data['tms']}'>";

                    echo "</div>";
                }
            }

            mysqli_close($conn);

            ?>
            <br>
            <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
            <a href="rikes.php" class="btn btn-danger btn-user btn-block">Kembali</a>
        </div>
    </form>
    
</body>

</html>