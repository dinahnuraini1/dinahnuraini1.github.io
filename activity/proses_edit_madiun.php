<?php
// Include file koneksi ke database
include '../koneksi.php';

// Cek apakah parameter id telah diterima dari form
if (isset($_POST['id'])) {
    // Tangkap nilai id dari form
    $id = $_POST['id'];

    // Tangkap nilai-nlai lain dari form
    // $pic = $_POST['pic'];
    $tempat_lhr = $_POST['tempat_lhr'];
    $uraian = $_POST['uraian'];
    $status = $_POST['status'];
    $ket = $_POST['ket'];

    $uraian = ucwords(strtolower($uraian));
    // Query untuk update data pekerja berdasarkan id
    $query = "UPDATE pic_madiun SET tanggal = '$tempat_lhr', uraian = '$uraian', status = '$status', ket= '$ket' WHERE id = '$id'";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Jika query berhasil dieksekusi, redirect ke halaman timeline.php
        echo '<script>alert("Data berhasil di Edit!"); window.location.href = "time.php";</script>';
        exit();
    } else {
        // Jika query gagal dieksekusi, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    // Jika parameter id tidak diterima dari form, tampilkan pesan error
    echo "ID tidak diterima.";
}

// Tutup koneksi ke database
mysqli_close($conn);
