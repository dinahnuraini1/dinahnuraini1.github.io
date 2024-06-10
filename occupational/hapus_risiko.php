<?php
// Mulai sesi
session_start();

// Koneksi ke database
include '../koneksi.php';

// Periksa apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query untuk menghapus data berdasarkan id
    $query = "DELETE FROM risiko WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        // Jika berhasil, arahkan ke halaman lain atau tampilkan pesan sukses
        echo "<script>
            alert('Data berhasil dihapus!');
            window.location.href = 'promo.php';
          </script>";
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan
        $_SESSION['error_message'] = "Terjadi kesalahan: " . mysqli_error($conn);
        header("Location: promo.php"); // Sesuaikan dengan halaman tujuan Anda
        exit();
    }
} else {
    // Jika parameter 'id' tidak ada, kembalikan ke halaman lain dengan pesan kesalahan
    $_SESSION['error_message'] = "ID tidak ditemukan!";
    header("Location: promo.php"); // Sesuaikan dengan halaman tujuan Anda
    exit();
}

// Tutup koneksi
mysqli_close($conn);
