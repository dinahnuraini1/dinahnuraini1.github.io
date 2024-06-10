<?php
// Lakukan koneksi ke database atau sertakan file konfigurasi koneksi
include '../koneksi.php';

// Ambil tanggal dari parameter URL jika tersedia
$date = isset($_GET['date']) ? $_GET['date'] : '';

// Lakukan filter untuk mencegah injeksi SQL
$date = mysqli_real_escape_string($conn, $date);

// Query untuk menghapus semua data dengan tanggal yang sesuai
$sql = "DELETE FROM records WHERE DATE(date) = '$date'";

// Eksekusi query
if (mysqli_query($conn, $sql)) {
    echo "<script>
            alert('Data Berhasil di Hapus !');
            window.location.href = 'rikes.php';
          </script>";
    exit();
} else {
    echo "Terjadi kesalahan: " . mysqli_error($conn);
}

// Tutup koneksi ke database
mysqli_close($conn);
