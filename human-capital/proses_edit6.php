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

        // Tentukan lokasi penyimpanan file yang diunggah
        $folder = '../daftar_gambar/';

        // Pindahkan file yang diunggah ke lokasi penyimpanan
        move_uploaded_file($tempname, $folder . $filename);

        // Query untuk mengupdate data pekerja dengan gambar baru
        $query =
            "UPDATE user_mediska_kertosono SET kedudukan='$kedudukan', jabatan='$jabatan', nama='$nama', nipp='$nipp', status='$status', tempat_lhr='$tempat_lhr', tgl='$tgl', pend='$pend', profesi='$profesi', gambar='$file_name' WHERE id='$id'";
    } else {
        // Query untuk mengupdate data pekerja tanpa mengubah gambar
        $query = "UPDATE user_mediska_kertosono SET kedudukan='$kedudukan', jabatan='$jabatan', nama='$nama',nipp='$nipp', status='$status', tempat_lhr='$tempat_lhr', tgl='$tgl', pend='$pend', profesi='$profesi' WHERE id='$id'";
    }

    // Eksekusi query untuk mengupdate data pekerja
    if (mysqli_query($conn, $query)) {
        // Jika pengeditan berhasil, redirect ke halaman coba.php
        echo "<script>alert('Data berhasil di perbarui!!'); window.location.href = 'coba.php';</script>";
        // header("Location: coba.php");
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
