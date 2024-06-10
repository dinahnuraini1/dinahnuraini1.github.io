<?php
include '../koneksi.php';

// Menangkap data dari form
$tahun = $_POST['tahun'];
$bulan = $_POST['bulan'];
$tanggal = $_POST['tanggal'];

// Membuat tanggal dalam format yang sesuai untuk MySQL
$tanggal_mysql = $tahun . '-' . $bulan . '-' . $tanggal;

// Query untuk mengambil data dari database berdasarkan filter
$sql_filter = "SELECT * FROM awak_sarana WHERE tanggal = '$tanggal_mysql'";

// Eksekusi query
$result = $conn->query($sql_filter);

// Memeriksa apakah query berhasil dieksekusi
if ($result->num_rows > 0) {
    // Output data dari setiap baris hasil query
    while ($row = $result->fetch_assoc()) {
        echo "Data: " . $row["tanggal"] . "<br>";
        echo "Data: " . $row["ms"] . "<br>";
        echo "Data: " . $row["tms"] . "<br>";
        // echo "Data: " . $row["tanggal"] . "<br>";
    }
} else {
    echo "Tidak ada data yang ditemukan.";
}

// Tutup koneksi database
$conn->close();
