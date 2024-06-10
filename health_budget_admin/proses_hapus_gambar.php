<?php
include "../koneksi.php";

// Memeriksa apakah parameter gambar_id diterima dari URL
if (isset($_GET['gambar_id'])) {
    // Mengambil gambar_id dari URL dan membersihkannya untuk mencegah serangan SQL Injection
    $gambar_id = mysqli_real_escape_string($conn, $_GET['gambar_id']);

    // Menghapus gambar dari database berdasarkan gambar_id
    $sql = "DELETE FROM anggaran_perkegiatan WHERE id = '$gambar_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Gambar berhasil dihapus";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Parameter gambar_id tidak diterima.";
}

// Menutup koneksi
$conn->close();
