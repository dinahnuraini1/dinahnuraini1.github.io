<?php
// Include file koneksi ke database
include '../koneksi.php';

// Cek apakah metode POST telah digunakan untuk mengirim data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap nilai dari formulir
    $id = $_POST['id'];
    $kedudukan = $_POST['kedudukan'];
    $jabatan = $_POST['jabatan'];
    $nipp = $_POST['nipp'];
    $nama = $_POST['nama'];
    $status = $_POST['status'];
    $tempat_lhr = $_POST['tempat_lhr'];
    $tgl = $_POST['tgl'];
    $pend = $_POST['pend'];
    $profesi = $_POST['profesi'];

    $nama = ucwords(strtolower($nama)); // strtolower() digunakan untuk memastikan bahwa semua huruf kecil sebelumnya diubah menjadi huruf kecil terlebih dahulu
    $tempat_lhr = ucwords(strtolower($tempat_lhr));
    $profesi = ucwords(strtolower($profesi));
    $jabatan = ucwords(strtolower($jabatan));

    // Cek apakah file gambar telah diunggah
    if ($_FILES['gambar']['name']) {
        // Ambil nama file dan ekstensi file yang diunggah
        $filename = $_FILES['gambar']['name'];
        $tempname = $_FILES['gambar']['tmp_name'];
        $filesize = $_FILES['gambar']['size']; // ukuran file dalam byte

        // Cek ukuran gambar
        if ($filesize > 2000000) {
            echo "<script>alert('Maaf, ukuran gambar terlalu besar. Maksimum 2MB.'); window.location.href = 'edit2.php?id=$id';</script>";
            exit;
        }

        // Tentukan lokasi penyimpanan file yang diunggah
        $folder = '../daftar_gambar/';

        // Pindahkan file yang diunggah ke lokasi penyimpanan
        move_uploaded_file($tempname, $folder . $filename);

        // Query untuk mengecek apakah NIPP sudah ada dalam database selain data yang akan diedit
        $check_query = "SELECT COUNT(*) AS count FROM user_uk WHERE nipp = '$nipp' AND id != '$id'";
        $check_result = mysqli_query($conn, $check_query);
        $check_data = mysqli_fetch_assoc($check_result);
        $nipp_count = $check_data['count'];

        // Jika NIPP sudah ada dalam database, tampilkan pesan kesalahan
        if ($nipp_count > 0) {
            echo "<script>alert('NIPP sudah ada dalam database'); window.location.href = 'edit2.php?id=$id';</script>";
            exit;
        }

        // Query untuk mengupdate data pekerja dengan gambar baru
        $query =
            "UPDATE user_uk SET kedudukan='$kedudukan', jabatan='$jabatan', nama='$nama', nipp='$nipp', status='$status', tempat_lhr='$tempat_lhr', tgl='$tgl', pend='$pend', profesi='$profesi', gambar='$filename' WHERE id='$id'";
    } else {
        // Query untuk mengupdate data pekerja tanpa mengubah gambar
        $query = "UPDATE user_uk SET kedudukan='$kedudukan', jabatan='$jabatan', nama='$nama', nipp='$nipp', status='$status', tempat_lhr='$tempat_lhr', tgl='$tgl', pend='$pend', profesi='$profesi' WHERE id='$id'";
    }

    // Eksekusi query untuk mengupdate data pekerja
    if (mysqli_query($conn, $query)) {
        // Jika pengeditan berhasil, redirect ke halaman coba.php
        echo "<script>alert('Data berhasil di perbarui!!'); window.location.href = 'coba.php';</script>";
        exit();
    } else {
        // Jika pengeditan gagal, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    // Jika metode POST tidak digunakan, tampilkan pesan error
    echo "Metode tidak diizinkan.";
}

// Tutup koneksi ke database
mysqli_close($conn);
