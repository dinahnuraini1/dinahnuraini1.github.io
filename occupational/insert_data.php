<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];

    // Memulai transaksi
    $conn->begin_transaction();

    try {
        $stations = [
            1 => 'Stasiun A',
            2 => 'Stasiun B',
            3 => 'Stasiun C',
            4 => 'Stasiun D'
        ];

        foreach ($stations as $station_id => $station_name) {
            for ($i = 1; $i <= 6; $i++) {
                $ms = $_POST["ms{$station_id}_{$i}"];
                $tms = $_POST["tms{$station_id}_{$i}"];
                $crew_id = $i; // Asumsi crew_id sama dengan nomor awak

                // Insert data ke tabel records
                $stmt = $conn->prepare("INSERT INTO records (station_id, crew_id, date, ms, tms) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("iisii", $station_id, $crew_id, $date, $ms, $tms);
                $stmt->execute();
                $stmt->close();
            }
        }

        // Commit transaksi jika tidak ada error
        $conn->commit();
        echo "Data berhasil dimasukkan.";
    } catch (Exception $e) {
        // Rollback transaksi jika ada error
        $conn->rollback();
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}

$conn->close();
