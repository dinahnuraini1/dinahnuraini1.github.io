<?php
// Include file koneksi ke database
include '../koneksi.php';

// Cek apakah parameter id_faskes telah diterima dari URL
if(isset($_GET['id_faskes'])) {
    // Tangkap nilai id_faskes dari parameter URL
    $id_faskes = $_GET['id_faskes'];

    // Query untuk menghapus data berdasarkan id_faskes
    $query = "DELETE FROM faskes WHERE id_faskes = '$id_faskes'";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {  
        // Redirect ke halaman health_budget.php setelah penghapusan berhasil
        header("Location: ../health-services/faskes.php");
        exit; // Hentikan proses eksekusi skrip
    } else {
        // Jika gagal menghapus data, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    // Jika parameter id_faskes tidak diterima dari URL, tampilkan pesan error
    echo "ID tidak ditemukan.";
}

// Tutup koneksi ke database
mysqli_close($conn);
?>
