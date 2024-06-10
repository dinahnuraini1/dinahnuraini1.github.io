<?php
// Include file koneksi ke database
include '../koneksi.php';

// Cek apakah parameter id telah diterima dari form
if (isset($_POST['id'])) {
    // Tangkap nilai id dari form
    $id = $_POST['id'];

    // Tangkap nilai-nlai lain dari form
    $pic = $_POST['pic'];
    $tanggal = $_POST['tanggal'];
    $uraian = $_POST['uraian'];
    $status = $_POST['status'];
    $ket=$_POST['ket'];

    $uraian = ucwords(strtolower($uraian));
    // Cek apakah ada file PDF yang diunggah
    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
        // Proses unggah file PDF baru
        $fileTmpPath = $_FILES['pdf_file']['tmp_name'];
        $fileName = $_FILES['pdf_file']['name'];
        $fileSize = $_FILES['pdf_file']['size'];
        $fileType = $_FILES['pdf_file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Tentukan direktori tujuan
        $uploadFileDir = '../pdf_timelinepic/';
        $newFileName = "timelinepic_$id.$fileExtension"; // Nama file baru dengan format: sertifikat_ID.extensi
        $dest_path = $uploadFileDir . $newFileName;

        // Periksa apakah direktori ada, jika tidak buat baru
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        // Pindahkan file ke direktori tujuan
        if (!move_uploaded_file($fileTmpPath, $dest_path)) {
            // Jika gagal mengunggah, tampilkan pesan kesalahan dan kembali ke halaman edit
            $_SESSION['error_message'] = "Gagal mengunggah file PDF.";
            header("Location: edit.php?id=$id");
            exit();
        }
        $maxFileSize = 5242880;

        if ($fileSize > $maxFileSize) {
            echo "<script>
                alert('Ukuran file melebihi batas maksimum (5MB).');
                window.location.href = 'edit.php';
              </script>";
            exit();
        }

        // Perbarui jalur file PDF dalam database
        $query = "UPDATE tb_timeline SET uraian='$uraian', tanggal='$tanggal', pic='$pic', status='$status', ket='$ket', pdf='$dest_path' WHERE id='$id'";
    } else {
        // Jika tidak ada file PDF yang diunggah, perbarui data tanpa mengubah file PDF
        $query = "UPDATE tb_timeline SET uraian='$uraian', tanggal='$tanggal', pic='$pic', status='$status', ket='$ket' WHERE id='$id'";
    }

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Jika berhasil, arahkan kembali ke halaman rikes
        echo "<script>
            alert('Data Timeline berhasil diperbarui!');
            window.location.href = 'timeline2.php';
          </script>";
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan dan kembali ke halaman edit
        $_SESSION['error_message'] = "Terjadi kesalahan: " . mysqli_error($conn);
        header("Location: edit.php?id=$id");
        exit();
    }
}

// Tutup koneksi
mysqli_close($conn);
