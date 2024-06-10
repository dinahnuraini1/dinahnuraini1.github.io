<?php
// Proses form untuk menambahkan kegiatan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $event = $_POST['event'];
    $pic = $_POST['pic'];
    $status = $_POST['status'];
    $uraian = $_POST['uraian'];

    $event = ucwords(strtolower($event)); // strtolower() digunakan untuk memastikan bahwa semua huruf kecil sebelumnya diubah menjadi huruf kecil terlebih dahulu
    $pic = ucwords(strtolower($pic));
    $uraian = ucwords(strtolower($uraian));
    // Validasi data di sini jika diperlukan

    // Koneksi database
    include '../koneksi.php';

    // Query untuk menambahkan kegiatan ke database
    $stmt = $conn->prepare("INSERT INTO events (event_date, event_name, pic, status,uraian) VALUES (?, ?, ?, ?,?)");
    $stmt->bind_param("sssss", $date, $event, $pic, $status, $uraian);
    $stmt->execute();
    $stmt->close();

    // Redirect untuk menghindari pengulangan form submission
    echo '<script>alert("Data berhasil di Tambah!"); window.location.href = "timeline1.php";</script>';
    exit();
}
