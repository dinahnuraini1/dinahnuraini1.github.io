<?php
// Mulai sesi
session_start();

// Koneksi ke database
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $nipp = mysqli_real_escape_string($conn, $_POST['nipp']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $unit = mysqli_real_escape_string($conn, $_POST['unit']);
    $diagnosa = mysqli_real_escape_string($conn, $_POST['diagnosa']);
    $rekomendasi = mysqli_real_escape_string($conn, $_POST['rekomendasi']);
   

    // Mengubah nama menjadi format Title Case
    $nama = ucwords(strtolower($nama));
    $diagnosa = ucwords(strtolower($diagnosa));
    $unit = ucwords(strtolower($unit));
    $rekomendasi = ucwords(strtolower($rekomendasi));
        
    // Insert new entry
    $stmt = $conn->prepare("INSERT INTO risiko (tanggal, nipp, nama, unit, diagnosa,rekomendasi) VALUES (?, ?, ?, ?, ?,?)");
    $stmt->bind_param('ssssss', $tanggal, $nipp, $nama, $unit, $diagnosa, $rekomendasi);
    if ($stmt->execute()) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                window.location.href = 'promo.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal menambahkan data: " . $stmt->error . "');
                window.location.href = 'tambah_risiko.php';
              </script>";
        exit();
    }

    $stmt->close();
}

// Tutup koneksi
mysqli_close($conn);
