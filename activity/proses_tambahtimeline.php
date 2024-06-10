<?php
include '../koneksi.php';
// // Aktifkan error reporting
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Cek apakah request datang dari metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST"
) {
    // Include file koneksi ke databas 

    // Ambil nilai input dari formulir
    $tanggal = $_POST['tanggal'];
    $uraian = $_POST['uraian'];
    $status = $_POST['status'];
    $ket = $_POST['ket'];
    $pic = $_POST['pic'];
    // $id = $_POST['id'];

    // Mengonversi huruf pertama dari setiap kata menjadi huruf besar
    $uraian = ucwords(strtolower($uraian)); // strtolower() digunakan untuk memastikan bahwa semua huruf kecil sebelumnya diubah menjadi huruf kecil terlebih dahulu
    $ket = ucwords(strtolower($ket));


    switch ($pic) {
        case "Manager Unit Kesehatan":
            // Query untuk menambahkan data ke database
            $sql1 = "INSERT INTO pic_manager (uraian, tanggal, status, ket) VALUES ('$uraian', '$tanggal', '$status', '$ket')";
            // Eksekusi query
            if (mysqli_query($conn, $sql1)) {
                // Menampilkan alert bahwa data berhasil ditambahkan
                echo '<script>alert("Data berhasil ditambahkan!"); window.location.href = "time.php";</script>';
            } else {
                // Tampilkan pesan error
                echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
            }
            break;

        case "Kepala Klinik Mediska Madiun":
            // Query untuk menambahkan data ke database
            $sql2 = "INSERT INTO pic_madiun (uraian, tanggal, status, ket) VALUES ('$uraian', '$tanggal', '$status', '$ket')";
            // Eksekusi query
            if (mysqli_query($conn, $sql2)) {
                // Menampilkan alert bahwa data berhasil ditambahkan
                echo '<script>alert("Data berhasil ditambahkan!"); window.location.href = "time.php";</script>';
            } else {
                // Tampilkan pesan error
                echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
            }
            break;

        case "Kepala Klinik Mediska Blitar":
            // Query untuk menambahkan data ke database
            $sql3 = "INSERT INTO pic_blitar (uraian, tanggal, status, ket) VALUES ('$uraian', '$tanggal', '$status', '$ket')";
            // Eksekusi query
            if (mysqli_query($conn, $sql3)) {
                // Menampilkan alert bahwa data berhasil ditambahkan
                echo '<script>alert("Data berhasil ditambahkan!"); window.location.href = "time.php";</script>';
            } else {
                // Tampilkan pesan error
                echo "Error: " . $sql3 . "<br>" . mysqli_error($conn);
            }
            break;

        case "Kepala Klinik Mediska Kediri":
            // Query untuk menambahkan data ke database
            $sql4 = "INSERT INTO pic_kediri (uraian, tanggal, status, ket) VALUES ('$uraian', '$tanggal', '$status', '$ket')";
            // Eksekusi query
            if (mysqli_query($conn, $sql4)) {
                // Menampilkan alert bahwa data berhasil ditambahkan
                echo '<script>alert("Data berhasil ditambahkan!"); window.location.href = "time.php";</script>';
            } else {
                // Tampilkan pesan error
                echo "Error: " . $sql4 . "<br>" . mysqli_error($conn);
            }
            break;

        case "Kepala Klinik Mediska Kertosono":
            // Query untuk menambahkan data ke database
            $sql5 = "INSERT INTO pic_kertosono (uraian, tanggal, status, ket) VALUES ('$uraian', '$tanggal', '$status', '$ket')";
            // Eksekusi query
            if (mysqli_query($conn, $sql5)) {
                // Menampilkan alert bahwa data berhasil ditambahkan
                echo '<script>alert("Data berhasil ditambahkan!"); window.location.href = "time.php";</script>';
            } else {
                // Tampilkan pesan error
                echo "Error: " . $sql5 . "<br>" . mysqli_error($conn);
            }
            break;
    }
} 
