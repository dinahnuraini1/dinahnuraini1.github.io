<?php
// Mulai sesi
session_start();

// Koneksi ke database
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $nama = $_POST['nama'];
    $nipp =  $_POST['nipp'];
    $unit =  $_POST['unit'];
    $jabatan =  $_POST['jabatan'];
    $kedudukan =  $_POST['kedudukan'];
    $kelas =  $_POST['kelas'];
    $nilai =  $_POST['nilai'];



    $unit = ucwords(strtolower($unit));
    $nama = ucwords(strtolower($nama));
    $kedudukan = ucwords(strtolower($kedudukan));
    $kelas = ucwords(strtolower($kelas));
    $nilai = ucwords(strtolower($nilai));
    $jabatan = ucwords(strtolower($jabatan));



    // Proses file PDF
    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['pdf_file']['tmp_name'];
        $fileName = $_FILES['pdf_file']['name'];
        $fileSize = $_FILES['pdf_file']['size'];
        $fileType = $_FILES['pdf_file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Tentukan direktori tujuan
        $uploadFileDir = '../pdf_rikes/';
        $dest_path = $uploadFileDir . $fileName;

        // Periksa apakah direktori ada, jika tidak buat baru
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        // Pindahkan file ke direktori tujuan
        if (!move_uploaded_file($fileTmpPath, $dest_path)) {
            echo "<script>
                alert('Gagal mengunggah file PDF.');
                window.location.href = 'tambah_rikes.php';
              </script>";
            exit();
        }

        $maxFileSize = 5242880;

        if ($fileSize > $maxFileSize) {
            echo "<script>
                alert('Ukuran file melebihi batas maksimum (5MB).');
                window.location.href = 'tambah_rikes.php';
              </script>";
            exit();
        }
    } else {
        $dest_path = NULL;
    }

    // Insert new entry
    $stmt = $conn->prepare("INSERT INTO rikes (tanggal, nipp, nama, unit, jabatan, kedudukan, kelas, nilai, pdf) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssssss', $tanggal, $nipp, $nama, $unit, $jabatan, $kedudukan, $kelas, $nilai, $dest_path);

    if ($stmt->execute()) {
        echo "<script>
            alert('Data Rikes Khusus berhasil ditambahkan!');
            window.location.href = 'rikes.php';
          </script>";
        exit();
    } else {
        echo "<script>
            alert('Gagal menambahkan data: " . $stmt->error . "');
            window.location.href = 'tambah_rikes.php';
          </script>";
        exit();
    }

    // Tutup prepared statement
    $stmt->close();
}

// Tutup koneksi
mysqli_close($conn);
