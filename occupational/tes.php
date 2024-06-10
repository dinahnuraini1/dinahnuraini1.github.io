<?php
// Lakukan koneksi ke database di sini
include '../koneksi.php';

// Query untuk mendapatkan data dari tabel records dengan nama stasiun dan nama kru
$sql = "SELECT r.date, s.name AS station_name, c.name AS crew_name, r.ms, r.tms
        FROM records r
        INNER JOIN stations s ON r.station_id = s.id
        INNER JOIN crew c ON r.crew_id = c.id
        WHERE DATE(r.date) = '2024-05-25'";

$result = mysqli_query($conn, $sql);

// Buat array untuk menampung data pivot
$pivotData = array();

// Loop melalui hasil query untuk membangun data pivot
while ($row = mysqli_fetch_assoc($result)) {
    $pivotData[$row['crew_name']][$row['station_name']] = array('ms' => $row['ms'], 'tms' => $row['tms']);
}

// Tampilkan data dalam tabel HTML
echo "<table border='1'>";
echo "<tr><th></th>";

// Tampilkan nama stasiun sebagai judul kolom
foreach (array_keys(reset($pivotData)) as $station) {
    echo "<th colspan='2'>$station</th>";
}
echo "</tr>";

// Tampilkan nama crew di sepanjang samping kiri dan MS/TMS untuk setiap stasiun
foreach ($pivotData as $crew => $stationData) {
    echo "<tr><td>$crew</td>";
    foreach ($stationData as $data) {
        echo "<td>{$data['ms']}</td><td>{$data['tms']}</td>";
    }
    echo "</tr>";
}
echo "</table>";

// Tutup koneksi ke database di sini
