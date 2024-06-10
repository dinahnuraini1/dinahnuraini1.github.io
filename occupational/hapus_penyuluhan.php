<?php
include '../koneksi.php';

// Pastikan parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    // Tangkap nilai id dari parameter URL
    $id = $_GET['id'];

    // Query untuk mengambil nama file gambar yang akan dihapus
    $query_select = "SELECT gambar FROM penyuluhan WHERE id = '$id'";
    $result_select = mysqli_query($conn, $query_select);

    // Periksa apakah query mengembalikan baris
    if (mysqli_num_rows($result_select) > 0) {
        $row_select = mysqli_fetch_assoc($result_select);
        $gambar = $row_select['gambar'];

        // Query untuk menghapus data penyuluhan dari database
        $query_delete = "DELETE FROM penyuluhan WHERE id = '$id'";
        $result_delete = mysqli_query($conn, $query_delete);

        if ($result_delete) {
            // Hapus gambar dari server jika data berhasil dihapus dari database
            if ($gambar) {
                $file_path = '../dokumentasi_penyuluhan/' . $gambar;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
                // Alert ketika gambar berhasil dihapus
                echo "<script>alert('Data berhasil dihapus');</script>";
            }
            // Redirect ke halaman utama (promo.php) dengan menyoroti bagian galeri
            echo "<script>window.location.href = 'promo.php';</script>";
            exit;
        } else {
            // Alert jika terjadi kesalahan saat menghapus data dari database
            echo "<script>alert('Error: Data tidak dapat dihapus.');</script>";
            // Redirect ke halaman utama (promo.php)
            echo "<script>window.location.href = 'promo.php';</script>";
            exit;
        }
    } else {
        // Alert jika tidak ada data dengan id yang diberikan
        echo "<script>alert('Data tidak ditemukan');</script>";
        // Redirect ke halaman utama (promo.php)
        echo "<script>window.location.href = 'promo.php';</script>";
        exit;
    }
} else {
    // Alert jika parameter id tidak diterima
    echo "<script>alert('Parameter id tidak diterima.');</script>";
    // Redirect ke halaman utama (promo.php)
    echo "<script>window.location.href = 'promo.php';</script>";
    exit;
}
