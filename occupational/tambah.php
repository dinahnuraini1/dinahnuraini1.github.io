<?php
include '../koneksi.php';

// Cek apakah request datang dari metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai input dari formulir
    $tanggal = $_POST['tanggal'];
    $judul = $_POST['judul'];

    // Mengonversi huruf pertama dari setiap kata menjadi huruf besar
    $judul = ucwords(strtolower($judul));

    // Proses upload gambar
    if ($_FILES['gambar']['name'] != "") {
        $folder = "../gambar_flyer/";
        $nama_gambar = $_FILES['gambar']['name'];
        $sumber_gambar = $_FILES['gambar']['tmp_name'];

        // Pindahkan file gambar ke folder yang ditentukan
        if (move_uploaded_file($sumber_gambar, $folder . $nama_gambar)) {
            // Query untuk menyimpan data ke database
            $query = "INSERT INTO flyer (tanggal, judul, gambar) VALUES ('$tanggal', '$judul', '$nama_gambar')";

            // Eksekusi query
            if (mysqli_query($conn, $query)) {
                echo "Data berhasil disimpan.";
                // Redirect ke halaman lain atau lakukan tindakan lainnya setelah proses selesai
                header("Location: flyer.php");
                exit();
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
            }
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload gambar.";
            header("Location: flyer.php");
        }
    } else {
        echo "Maaf, silakan pilih gambar terlebih dahulu.";
        header("Location: flyer.php");
    }
} else {
    // Jika request bukan dari metode POST, tampilkan pesan kesalahan
    echo "Metode yang digunakan tidak valid.";
    header("Location: flyer.php");
}
