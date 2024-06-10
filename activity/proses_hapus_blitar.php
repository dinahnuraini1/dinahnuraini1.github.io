<?php
// Include file koneksi ke database
include '../koneksi.php';

// Cek apakah parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    // Tangkap nilai id dari parameter URL
    $id = $_GET['id'];

    // Query untuk menghapus data pekerja berdasarkan id
    $query = "DELETE FROM pic_blitar WHERE id = '$id'";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Redirect ke halaman human_capital.php setelah penghapusan berhasil
        header("Location: time.php");
    } else {
        // Jika gagal menghapus data, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    // Jika parameter id tidak diterima dari URL, tampilkan pesan error
    echo "ID tidak ditemukan.";
}

// Tutup koneksi ke database
mysqli_close($conn);
