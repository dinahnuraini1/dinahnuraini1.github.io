<?php
// Mulai sesi
session_start();

// Koneksi ke database
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $uraian = mysqli_real_escape_string($conn, $_POST['uraian']);
    $tema = mysqli_real_escape_string($conn, $_POST['tema']);
    $jumlah = mysqli_real_escape_string($conn, $_POST['jumlah']);

    $folder = "../dokumentasi_penyuluhan/";
    $nama_p = $_FILES['gambar']['name'];
    $sumber_p = $_FILES['gambar']['tmp_name'];

    $uraian = ucwords(strtolower($uraian));
    $tema = ucwords(strtolower($tema));

    // Cek ukuran gambar
    if ($_FILES["gambar"]["size"] > 2000000) {
        echo "<script>alert('Maaf, ukuran gambar terlalu besar. Maksimum 2MB.'); window.location.href = 'tambah_penyuluhan.php';</script>";
        exit;
    }

    // Cek tipe file gambar
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check !== false) {
        // Ambil tipe file gambar
        $imageFileType = strtolower(pathinfo($nama_p, PATHINFO_EXTENSION));

        // Izinkan hanya beberapa format gambar tertentu
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<script>alert('Maaf, hanya format JPG, JPEG, PNG, dan GIF yang diizinkan.'); window.location.href = 'tambah_penyuluhan.php';</script>";
        }
    } else {
        echo "<script>alert('Maaf, file yang diunggah bukanlah gambar.'); window.location.href = 'tambah_penyuluhan.php';</script>";
    }

    // Coba upload gambar
    $path_gambar = $folder . '/' . $nama_p;
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $path_gambar)) {
        // Query untuk mengecek apakah NIPP sudah ada dalam database
        $check_query = "SELECT COUNT(*) AS count FROM penyuluhan WHERE id = '$id'";
        $check_result = mysqli_query($conn, $check_query);
        $check_data = mysqli_fetch_assoc($check_result);
        $nipp_count = $check_data['count'];
        $sql = "INSERT INTO penyuluhan (tanggal, uraian, tema, jumlah, gambar) VALUES ('$tanggal', '$uraian', '$tema', '$jumlah','$nama_p')";

        if (mysqli_query($conn, $sql)) {
            // Jika berhasil, redirect ke halaman promo.php
            echo "<script>
                alert('Data berhasil ditambahkan!');
                window.location.href = 'promo.php';
              </script>";
        } else {
            // Tampilkan pesan error
            echo "<script>
                alert('Error: " . addslashes(mysqli_error($conn)) . "');
                window.location.href = 'tambah_penyuluhan.php'; // Sesuaikan dengan halaman form Anda
              </script>";
        }
    } else {
        echo "<script>alert('Maaf, terjadi kesalahan saat mengupload gambar.'); window.location.href = 'tambah_penyuluhan.php';</script>";
        exit;
    }
}

// Tutup koneksi ke database
mysqli_close($conn);
