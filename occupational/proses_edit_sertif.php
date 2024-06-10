<?php
// Mulai sesi
session_start();

// Koneksi ke database
include '../koneksi.php';

if (isset($_POST['id'])) {
    // Tangkap nilai id dari form
    $id = $_POST['id'];
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $periode = mysqli_real_escape_string($conn, $_POST['periode']);
    $uraian = mysqli_real_escape_string($conn, $_POST['uraian']);
    $unit = mysqli_real_escape_string($conn, $_POST['unit']);
    $nilaiA = mysqli_real_escape_string($conn, $_POST['nilai_a']);
    $nilaiB = mysqli_real_escape_string($conn, $_POST['nilai_b']);
    $nilaiC = mysqli_real_escape_string($conn, $_POST['nilai_c']);
    $nilaiD = mysqli_real_escape_string($conn, $_POST['nilai_d']);

    $uraian = ucwords(strtolower($uraian));
    $unit = ucwords(strtolower($unit));
    $periode = ucwords(strtolower($periode));

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
        $uploadFileDir = '../pdf_sertif/';
        $newFileName = "sertifikat_$id.$fileExtension"; // Nama file baru dengan format: sertifikat_ID.extensi
        $dest_path = $uploadFileDir . $newFileName;

        // Periksa apakah direktori ada, jika tidak buat baru
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        // Pindahkan file ke direktori tujuan
        if (!move_uploaded_file($fileTmpPath, $dest_path)) {
            // Jika gagal mengunggah, tampilkan pesan kesalahan dan kembali ke halaman edit
            $_SESSION['error_message'] = "Gagal mengunggah file PDF.";
            header("Location: edit_sertif.php?id=$id");
            exit();
        }
        $maxFileSize = 5242880;

        if ($fileSize > $maxFileSize) {
            echo "<script>
                alert('Ukuran file melebihi batas maksimum (5MB).');
                window.location.href = 'edit_sertif.php';
              </script>";
            exit();
        }

        // Perbarui jalur file PDF dalam database
        $query = "UPDATE sertifikasi SET tanggal='$tanggal', periode='$periode', uraian='$uraian', unit='$unit', nilai_a='$nilaiA', nilai_b='$nilaiB', nilai_c='$nilaiC', nilai_d='$nilaiD', pdf='$dest_path' WHERE id='$id'";
    } else {
        // Jika tidak ada file PDF yang diunggah, perbarui data tanpa mengubah file PDF
        $query = "UPDATE sertifikasi SET tanggal='$tanggal', periode='$periode', uraian='$uraian', unit='$unit', nilai_a='$nilaiA', nilai_b='$nilaiB', nilai_c='$nilaiC', nilai_d='$nilaiD' WHERE id='$id'";
    }

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Jika berhasil, arahkan kembali ke halaman rikes
        echo "<script>
            alert('Data Sertifikasi berhasil diperbarui!');
            window.location.href = 'rikes.php';
          </script>";
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan dan kembali ke halaman edit
        $_SESSION['error_message'] = "Terjadi kesalahan: " . mysqli_error($conn);
        header("Location: edit_sertif.php?id=$id");
        exit();
    }
}

// Tutup koneksi
mysqli_close($conn);
