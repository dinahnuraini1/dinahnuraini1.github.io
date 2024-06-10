<?php
// proses_edit_risiko.php

include '../koneksi.php'; // File koneksi ke database

// Periksa apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    $nipp = $_POST['nipp'];
    $nama = $_POST['nama'];
    $unit = $_POST['unit'];
    $diagnosa = $_POST['diagnosa'];
    $rekomendasi = $_POST['rekomendasi'];
    $nama = ucwords(strtolower($nama));
    $diagnosa = ucwords(strtolower($diagnosa));
    $unit = ucwords(strtolower($unit));
    $rekomendasi = ucwords(strtolower($rekomendasi));
    // Pastikan semua data yang diperlukan telah diisi
    if (!empty($id) && !empty($tanggal) && !empty($nipp) && !empty($nama) && !empty($unit) && !empty($diagnosa)) {
        // Perbarui data dalam database
        $query = "UPDATE risiko SET tanggal='$tanggal', nipp='$nipp', nama='$nama', unit='$unit', diagnosa='$diagnosa', rekomendasi='$rekomendasi'  WHERE id='$id'";

        if (mysqli_query($conn, $query)) {
            echo "<script>
            alert('Data berhasil diperbarui!');
            window.location.href = 'promo.php';
          </script>";
            exit();
        } else {
            // Jika terjadi kesalahan, tampilkan pesan kesalahan dan kembali ke halaman edit
            $_SESSION['error_message'] = "Terjadi kesalahan: " . mysqli_error($conn);
            header("Location: edit_risiko.php?id=$id");
            exit();
        }
    } else {
        echo "Semua data harus diisi.";
    }
} else {
    echo "Metode request tidak valid.";
}

// Tutup koneksi ke database
mysqli_close($conn);
