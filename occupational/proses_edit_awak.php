<?php
// Lakukan koneksi ke database atau sertakan file konfigurasi koneksi
include '../koneksi.php';

// Periksa apakah data telah dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil tanggal dari input tersembunyi
    $date = $_POST['date'];

    // Ambil data stasiun dan awak dari input form
    $station_crew_data = $_POST['station_crew_data'];

    // Lakukan loop untuk mengambil data setiap stasiun dan awak
    foreach ($station_crew_data as $station => $crewData) {
        foreach ($crewData as $crew => $data) {
            // Buat ID input yang unik dengan menggabungkan nama stasiun dan kru
            $input_id_ms = "ms_" . str_replace(' ', '_', $station) . "_" . str_replace(' ', '_', $crew);
            $input_id_tms = "tms_" . str_replace(' ', '_', $station) . "_" . str_replace(' ', '_', $crew);

            // Ambil nilai MS dan TMS dari input form
            $ms = $_POST[$input_id_ms];
            $tms = $_POST[$input_id_tms];

            // Update data ke dalam database
            $sql = "UPDATE records SET ms = ?, tms = ? WHERE DATE(date) = ? AND station_id = (SELECT id FROM stations WHERE name = ?) AND crew_id = (SELECT id FROM crew WHERE name = ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iisss", $ms, $tms, $date, $station, $crew);
            $stmt->execute();
        }
    }

    echo "<script>
                alert('Data Awak KA berhasil diperbarui!');
                window.location.href = 'rikes.php';
              </script>";
    exit();
}

// Tutup koneksi database
mysqli_close($conn);
