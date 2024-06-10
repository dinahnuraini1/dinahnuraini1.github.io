<?php
if (isset($_POST['filename'])) {
    $filename = $_POST['filename'];
    $filepath = 'uploads/' . $filename;

    if (file_exists($filepath)) {
        if (unlink($filepath)) {
            echo 'File berhasil dihapus.';
        } else {
            echo 'Gagal menghapus file.';
        }
    } else {
        echo 'File tidak ditemukan.';
    }
}
?>
