<?php
// Include file koneksi ke database
include '../koneksi.php';

// Inisialisasi array untuk respons
$response = array();

// Cek apakah data telah dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Proses upload gambar
    if ($_FILES['gambar']['name'] != "") {
        $folder = "gambar_perkegiatan/";
        $nama_gambar = $_FILES['gambar']['name'];
        $sumber_gambar = $_FILES['gambar']['tmp_name'];

        // Cek ukuran gambar
        if ($_FILES["gambar"]["size"] > 2000000) {
            $response['error'] = true;
            $response['message'] = "Maaf, ukuran gambar terlalu besar. Maksimum 2MB.";
        } else {
            // Cek tipe file gambar
            $check = getimagesize($_FILES["gambar"]["tmp_name"]);
            if ($check !== false) {
                $imageFileType = strtolower(pathinfo($nama_gambar, PATHINFO_EXTENSION));

                // Izinkan hanya beberapa format gambar tertentu
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    $response['error'] = true;
                    $response['message'] = "Maaf, hanya format JPG, JPEG, PNG, dan GIF yang diizinkan.";
                } else {
                    // Ambil data nama kegiatan dan tanggal
                    $nama_kegiatan = mysqli_real_escape_string($conn, $_POST['nama_kegiatan']);
                    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);

                    // Upload gambar
                    if (move_uploaded_file($sumber_gambar, $folder . $nama_gambar)) {
                        // Insert data gambar dan informasi kegiatan ke database
                        $sql = "INSERT INTO anggaran_perkegiatan (gambar, nama_kegiatan, tanggal) VALUES ('$nama_gambar', '$nama_kegiatan', '$tanggal')";
                        if (mysqli_query($conn, $sql)) {
                            $response['error'] = false;
                            $response['message'] = "Gambar berhasil diunggah!";
                        } else {
                            $response['error'] = true;
                            $response['message'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    } else {
                        $response['error'] = true;
                        $response['message'] = "Maaf, terjadi kesalahan saat mengupload gambar.";
                    }
                }
            } else {
                $response['error'] = true;
                $response['message'] = "Maaf, file yang diunggah bukanlah gambar.";
            }
        }
    } else {
        $response['error'] = true;
        $response['message'] = "Maaf, silakan pilih gambar terlebih dahulu.";
    }
} else {
    // Jika tidak, tampilkan pesan bahwa data tidak ditemukan
    $response['error'] = true;
    $response['message'] = "Data tidak ditemukan.";
}

// Mengembalikan respons dalam format JSON
echo json_encode($response);
