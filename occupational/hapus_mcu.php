<?php
// Mulai sesi
session_start();

// Koneksi ke database
include '../koneksi.php';

// Periksa apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query untuk menghapus data berdasarkan id
    $query = "DELETE FROM mcu WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Data MCU berhasil dihapus!');
            window.location.href = 'hasilmcu.php';
          </script>";
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        echo "<script>
            alert('Terjadi kesalahan!');
            window.location.href = 'hasilmcu.php';
          </script>";
        exit();
    }
} else {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href = 'hasilmcu.php';
          </script>";
    exit();
}

// Tutup koneksi
mysqli_close($conn);
