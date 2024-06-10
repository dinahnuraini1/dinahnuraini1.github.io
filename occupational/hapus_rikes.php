<?php
// Mulai sesi
session_start();

// Koneksi ke database
include '../koneksi.php';

// Periksa apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query untuk menghapus data berdasarkan id
    $query = "DELETE FROM rikes WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Data Rikes Khusus berhasil dihapus!');
            window.location.href = 'rikes.php';
          </script>";
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        $_SESSION['error_message'] = "Terjadi kesalahan: " . mysqli_error($conn);
        header("Location: rikes.php"); // Sesuaikan dengan halaman tujuan Anda
        exit();
    }
} else {
    // Jika parameter 'id' tidak ada, kembalikan ke halaman lain dengan pesan kesalahan
    $_SESSION['error_message'] = "ID tidak ditemukan!";
    header("Location: rikes.php"); // Sesuaikan dengan halaman tujuan Anda
    exit();
}

// Tutup koneksi
mysqli_close($conn);
