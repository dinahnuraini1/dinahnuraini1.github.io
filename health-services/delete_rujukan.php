<?php
// Include file koneksi ke database
include '../koneksi.php';

// Cek apakah parameter id telah diterima dari URL
if(isset($_GET['id'])) {
    // Tangkap nilai id dari parameter URL
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan id
    $query = "DELETE FROM rujukan WHERE id = '$id'";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {  
        // Redirect ke halaman health_budget.php setelah penghapusan berhasil
        header("Location: ../health-services/jumlah_rujukan.php");
        exit; // Hentikan proses eksekusi skrip
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
?>
