<?php
// Include file koneksi.php untuk menghubungkan ke database
include '../koneksi.php';

// Mendapatkan id event dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus event berdasarkan id
    $delete_sql = "DELETE FROM events WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $id);

    // Eksekusi query
    if ($delete_stmt->execute()) {
        // Jika berhasil dihapus, redirect ke halaman lain atau tampilkan pesan sukses
         echo '<script>alert("Data berhasil di Hapus!"); window.location.href = "timeline1.php";</script>';
        exit();
    } else {
        // Jika gagal dihapus, tampilkan pesan kesalahan
        echo "Gagal menghapus event.";
    }
} else {
    // Jika tidak ada id yang diberikan, redirect ke halaman lain atau tampilkan pesan kesalahan
    echo "ID event tidak diberikan.";
    exit();
}
