<?php
// Mulai sesi
session_start();

// Koneksi ke database
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    // $tahun = mysqli_real_escape_string($conn, $_POST['tahun']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nipp = mysqli_real_escape_string($conn, $_POST['nipp']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $rekomendasi = mysqli_real_escape_string($conn, $_POST['rekomendasi']);

    $folder = "../dokumentasi_home/";
    $nama_p = $_FILES['gambar']['name'];
    $sumber_p = $_FILES['gambar']['tmp_name'];

    $deskripsi = ucwords(strtolower($deskripsi));
    $nama = ucwords(strtolower($nama));
    $lokasi = ucwords(strtolower($lokasi));
    $rekomendasi = ucwords(strtolower($rekomendasi));

    // Cek ukuran gambar
    if ($_FILES["gambar"]["size"] > 2000000) {
        echo "<script>alert('Maaf, ukuran gambar terlalu besar. Maksimum 2MB.'); window.location.href = 'tambah_home.php';</script>";
        exit;
    }

    // Cek tipe file gambar
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check !== false) {
        // Ambil tipe file gambar
        $imageFileType = strtolower(pathinfo($nama_p, PATHINFO_EXTENSION));

        // Izinkan hanya beberapa format gambar tertentu
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<script>alert('Maaf, hanya format JPG, JPEG, PNG, dan GIF yang diizinkan.'); window.location.href = 'tambah_home.php';</script>";
        }
    } else {
        echo "<script>alert('Maaf, file yang diunggah bukanlah gambar.'); window.location.href = 'tambah_home.php';</script>";
    }

    // Coba upload gambar
    $path_gambar = $folder . '/' . $nama_p;
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $path_gambar)) {
        // Query untuk mengecek apakah NIPP sudah ada dalam database
        $check_query = "SELECT COUNT(*) AS count FROM home WHERE id = '$id'";
        $check_result = mysqli_query($conn, $check_query);
        $check_data = mysqli_fetch_assoc($check_result);
        $nipp_count = $check_data['count'];


        // Query untuk menambahkan data ke database
        $sql = "INSERT INTO home ( tanggal, nama, nipp, lokasi, deskripsi, rekomendasi, gambar) VALUES ( '$tanggal',  '$nama', '$nipp', '$lokasi', '$deskripsi', '$rekomendasi', '$nama_p')";

        // Eksekusi query
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                alert('Data Home and Hospital Visit berhasil ditambahkan!');
                window.location.href = 'promo.php';
              </script>";
            exit();
        } else {
            // Tampilkan pesan error
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
} else {
    echo "<script>alert('Maaf, terjadi kesalahan saat mengupload gambar.'); window.location.href = 'tambah_home.php';</script>";
    exit;
}

// Tutup koneksi ke database
mysqli_close($conn);
