<?php
// Include file koneksi ke database
include '../koneksi.php';

// Memeriksa apakah parameter id diterima dari URL
if (isset($_GET['id'])) {
    // Mengambil id dari URL dan membersihkannya untuk mencegah serangan SQL Injection
    $gambar_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Mengambil nama file gambar untuk dihapus dari database
    $sql_select = "SELECT gambar FROM flyer WHERE id = '$gambar_id'";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $gambar_file = $row['gambar'];

        // Menghapus gambar dari tabel tb_gambar berdasarkan id
        $sql_delete = "DELETE FROM flyer WHERE id = '$gambar_id'";

        if ($conn->query($sql_delete) === TRUE) {
            // Hapus file gambar dari penyimpanan (jika perlu)
            $file_path = "../gambar_flyer/" . $gambar_file;
            if (file_exists($file_path)) {
                unlink($file_path); // Hapus file dari direktori
            }
            // Alert ketika gambar berhasil dihapus
            echo "<script>alert('Gambar berhasil dihapus');</script>";

            // Redirect ke halaman utama (index.php) dengan menyoroti bagian galeri
            echo "<script>window.location.href = 'flyer.php';</script>";
            exit;
        } else {
            // Alert jika terjadi kesalahan saat menghapus gambar
            echo "<script>alert('Error: Gambar tidak dapat dihapus.');</script>";
            // Redirect ke halaman utama (index.php)
            echo "<script>window.location.href = 'flyer.php';</script>";
            exit;
        }
    } else {
        // Alert jika gambar tidak ditemukan
        echo "<script>alert('Gambar tidak ditemukan');</script>";
        // Redirect ke halaman utama (index.php)
        echo "<script>window.location.href = 'flyer.php';</script>";
        exit;
    }
} else {
    // Alert jika parameter id tidak diterima
    echo "<script>alert('Parameter id tidak diterima.');</script>";
    // Redirect ke halaman utama (index.php)
    echo "<script>window.location.href = 'flyer.php';</script>";
    exit;
}
