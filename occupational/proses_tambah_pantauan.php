<?php
// Mulai sesi
session_start();

// Koneksi ke database
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nipp = mysqli_real_escape_string($conn, $_POST['nipp']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

    $folder = "../dokumentasi_pantauan/";
    $nama_p = $_FILES['gambar']['name'];
    $sumber_p = $_FILES['gambar']['tmp_name'];

    $nama = ucwords(strtolower($nama));
    $deskripsi = ucwords(strtolower($deskripsi));

    // Cek ukuran gambar
    if ($_FILES["gambar"]["size"] > 2000000) {
        echo "<script>alert('Maaf, ukuran gambar terlalu besar. Maksimum 2MB.'); window.location.href = 'tambah_pantauan.php';</script>";
        exit;
    }

    // Cek tipe file gambar
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check !== false) {
        // Ambil tipe file gambar
        $imageFileType = strtolower(pathinfo($nama_p, PATHINFO_EXTENSION));

        // Izinkan hanya beberapa format gambar tertentu
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<script>alert('Maaf, hanya format JPG, JPEG, PNG, dan GIF yang diizinkan.'); window.location.href = 'tambah_pantauan.php';</script>";
        }
    } else {
        echo "<script>alert('Maaf, file yang diunggah bukanlah gambar.'); window.location.href = 'tambah_pantauan.php';</script>";
    }

    // Coba upload gambar
    $path_gambar = $folder . '/' . $nama_p;
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $path_gambar)) {
        // Query untuk mengecek apakah NIPP sudah ada dalam database
        $check_query = "SELECT COUNT(*) AS count FROM pantauan WHERE id = '$id'";
        $check_result = mysqli_query($conn, $check_query);
        $check_data = mysqli_fetch_assoc($check_result);
        $nipp_count = $check_data['count'];


        // Query untuk menambahkan data ke database
        $sql = "INSERT INTO pantauan ( tanggal, nama, nipp, deskripsi, gambar) VALUES ('$tanggal', '$nama', '$nipp', '$deskripsi','$nama_p')";

        // Eksekusi query
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                alert('Data Pantauan Pekerja Sakit berhasil ditambahkan!');
                window.location.href = 'promo.php';
              </script>";
            exit();
        } else {
            // Tampilkan pesan error
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
} else {
    echo "<script>alert('Maaf, terjadi kesalahan saat mengupload gambar.'); window.location.href = 'tambah_pantauan.php';</script>";
    exit;
}

// Tutup koneksi ke database
mysqli_close($conn);
