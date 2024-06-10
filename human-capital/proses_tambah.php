<?php
// // Aktifkan error reporting
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Cek apakah request datang dari metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include file koneksi ke database
    include '../koneksi.php';

    // Ambil nilai input dari formulir
    $nipp = $_POST['nipp'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $kedudukan = $_POST['kedudukan'];
    $tgl=$_POST['tgl'];
    $tempat_lhr = $_POST['tempat_lhr'];
    $pend = $_POST['pend'];
    $profesi = $_POST['profesi'];

    // $gambar=$_POST['gambar'];

    // Proses upload gambar
    // $gambar = $_FILES['gambar']; // Perubahan ini
    $folder = "../daftar_gambar/";
    $nama_p = $_FILES['gambar']['name'];
    $sumber_p = $_FILES['gambar']['tmp_name'];
    // move_uploaded_file($sumber_p, $folder . $nama_p);
    // $target_file = $target_dir . basename($gambar["name"]); // Perubahan ini
    // $uploadOk = 1;
    // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Mengonversi huruf pertama dari setiap kata menjadi huruf besar
    $nama = ucwords(strtolower($nama)); // strtolower() digunakan untuk memastikan bahwa semua huruf kecil sebelumnya diubah menjadi huruf kecil terlebih dahulu
    $tempat_lhr = ucwords(strtolower($tempat_lhr));
    $profesi = ucwords(strtolower($profesi));


    // Cek ukuran gambar
    if ($_FILES["gambar"]["size"] > 2000000) {
        echo "<script>alert('Maaf, ukuran gambar terlalu besar. Maksimum 2MB.'); window.location.href = 'tambah.php';</script>";
        exit;
    }

    // Cek tipe file gambar
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check !== false) {
        // Ambil tipe file gambar
        $imageFileType = strtolower(pathinfo($nama_p, PATHINFO_EXTENSION));

        // Izinkan hanya beberapa format gambar tertentu
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<script>alert('Maaf, hanya format JPG, JPEG, PNG, dan GIF yang diizinkan.'); window.location.href = 'tambah.php';</script>";
        }
    } else {
        echo "<script>alert('Maaf, file yang diunggah bukanlah gambar.'); window.location.href = 'tambah.php';</script>";
    }

    // Coba upload gambar
    $path_gambar = $folder . '/' . $nama_p;
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $path_gambar)) {
        // Query untuk mengecek apakah NIPP sudah ada dalam database
        $check_query = "SELECT COUNT(*) AS count FROM user_uk WHERE nipp = '$nipp'";
        $check_result = mysqli_query($conn, $check_query);
        $check_data = mysqli_fetch_assoc($check_result);
        $nipp_count = $check_data['count'];

        // Jika NIPP sudah ada dalam database, arahkan kembali ke halaman tambah.php
        if ($nipp_count > 0) {
            echo "<script>alert('NIPP sudah ada dalam database'); window.location.href = 'tambah.php';</script>";
            exit; // Hentikan eksekusi skrip setelah mengarahkan
        } else {
            // Query untuk menambahkan data ke database
            $sql = "INSERT INTO user_uk (nipp, nama, jabatan, kedudukan, tempat_lhr, tgl, pend, profesi, gambar) VALUES ('$nipp', '$nama', '$jabatan', '$kedudukan', '$tempat_lhr','$tgl', '$pend', '$profesi', '$nama_p')";

            // Eksekusi query
            if (mysqli_query($conn, $sql)) {
                // Jika berhasil, redirect ke halaman human_capital.php
                header("Location: human_capital.php");
                // Panggil fungsi untuk menyortir tabel berdasarkan jabatan setelah data berhasil ditambahkan
                echo "<script>sortTableByJobPosition()</script>";
            } else {
                // Tampilkan pesan error
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        echo "<script>alert('Maaf, terjadi kesalahan saat mengupload gambar.'); window.location.href = 'tambah.php';</script>";
        exit;
    }

    // Tutup koneksi ke database
    mysqli_close($conn);
}

