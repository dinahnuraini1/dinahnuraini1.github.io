<?php
// Mulai sesi
session_start();

// Koneksi ke database
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $jumlah = mysqli_real_escape_string($conn, $_POST['jumlah']);
    $positif = mysqli_real_escape_string($conn, $_POST['positif']);
    $negatif = mysqli_real_escape_string($conn, $_POST['negatif']);

    // Mengubah lokasi menjadi format Title Case
    $lokasi = ucwords(strtolower($lokasi));

    // Hitung jumlah dari positif dan negatif
    $calculatedJumlah = $positif + $negatif;

    // Periksa apakah calculatedJumlah sama dengan jumlah yang diinputkan
    if ($calculatedJumlah != $jumlah) {
        echo "<script>
            alert('Jumlah positif dan negatif harus sama dengan jumlah peserta yang diinputkan.');
            window.location.href = 'tambah_narkoba.php';
          </script>";
        exit();
    }

    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['pdf_file']['tmp_name'];
        $fileName = $_FILES['pdf_file']['name'];
        $fileSize = $_FILES['pdf_file']['size'];
        $fileType = $_FILES['pdf_file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Tentukan direktori tujuan
        $uploadFileDir = '../pdf_narkoba/';
        $dest_path = $uploadFileDir . $fileName;

        // Periksa apakah direktori ada, jika tidak buat baru
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        // Pindahkan file ke direktori tujuan
        if (!move_uploaded_file($fileTmpPath, $dest_path)) {
            echo "<script>
                alert('Gagal mengunggah file PDF.');
                window.location.href = 'tambah_narkoba.php';
              </script>";
            exit();
        }

        $maxFileSize = 5242880;

        if ($fileSize > $maxFileSize) {
            echo "<script>
                alert('Ukuran file melebihi batas maksimum (5MB).');
                window.location.href = 'tambah_narkoba.php';
              </script>";
            exit();
        }
    } else {
        $dest_path = NULL;
    }

    // Insert new entry
    $stmt = $conn->prepare("INSERT INTO narkoba (tanggal, lokasi, jumlah, positif, negatif, pdf) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssss', $tanggal, $lokasi, $jumlah, $positif, $negatif, $dest_path);
    if ($stmt->execute()) {
        echo "<script>
                alert('Data Hasil Tes Narkoba berhasil ditambahkan!');
                window.location.href = 'narkoba.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal menambahkan data: " . $stmt->error . "');
                window.location.href = 'tambah_narkoba.php';
              </script>";
        exit();
    }

    $stmt->close();
}

// Tutup koneksi
mysqli_close($conn);
