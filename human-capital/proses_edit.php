<?php
// Include file koneksi ke database
include '../koneksi.php';

// Cek apakah data telah dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap nilai input dari formulir
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $kedudukan = $_POST['kedudukan'];
    $tempat_lhr = $_POST['tempat_lhr'];
    $pend = $_POST['pend'];
    $profesi = $_POST['profesi'];

    $nama = ucwords(strtolower($nama)); // strtolower() digunakan untuk memastikan bahwa semua huruf kecil sebelumnya diubah menjadi huruf kecil terlebih dahulu
    $tempat_lhr = ucwords(strtolower($tempat_lhr));
    $profesi = ucwords(strtolower($profesi));
    $jabatan = ucwords(strtolower($jabatan));

    // Proses upload gambar baru jika ada yang diunggah
    if ($_FILES['gambar']['name'] != "") {
        $folder = "../tambah_gambar/";
        $nama_p = $_FILES['gambar']['name'];
        $sumber_p = $_FILES['gambar']['tmp_name'];

        // Cek ukuran gambar
        if ($_FILES["gambar"]["size"] > 2000000) {
            echo "<script>alert('Maaf, ukuran gambar terlalu besar. Maksimum 2MB.'); window.location.href = 'edit.php?id=$id';</script>";
            exit;
        }

        // Cek tipe file gambar
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check !== false) {
            $imageFileType = strtolower(pathinfo($nama_p, PATHINFO_EXTENSION));

            // Izinkan hanya beberapa format gambar tertentu
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "<script>alert('Maaf, hanya format JPG, JPEG, PNG, dan GIF yang diizinkan.'); window.location.href = 'edit.php?id=$id';</script>";
                exit;
            }
        } else {
            echo "<script>alert('Maaf, file yang diunggah bukanlah gambar.'); window.location.href = 'edit.php?id=$id';</script>";
            exit;
        }

        // Upload gambar baru
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $nama_p))  {
            // Update data pekerja termasuk gambar
            $sql = "UPDATE user_uk SET nama='$nama', jabatan='$jabatan', kedudukan='$kedudukan', tempat_lhr='$tempat_lhr', pend='$pend', profesi='$profesi', gambar='$nama_p' WHERE nipp='$id'";
        } else {
            echo "<script>alert('Maaf, terjadi kesalahan saat mengupload gambar.'); window.location.href = 'edit.php?id=$id';</script>";
            exit;
        }
    } else {
        // Update data pekerja tanpa mengubah gambar
        $sql = "UPDATE user_uk SET nama='$nama', jabatan='$jabatan', kedudukan='$kedudukan', tempat_lhr='$tempat_lhr', pend='$pend', profesi='$profesi' WHERE nipp='$id'";
    }

    // Eksekusi query
    if (mysqli_query($conn, $sql)) {
        // Jika berhasil mengupdate data, redirect ke halaman human_capital.php
        header("Location: coba.php");
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Tutup koneksi ke database
    mysqli_close($conn);
} else {
    // Jika tidak, tampilkan pesan bahwa data tidak ditemukan
    echo "Data tidak ditemukan.";
}
