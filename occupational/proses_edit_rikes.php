<?php
// Mulai sesi
session_start();

// Koneksi ke database
include '../koneksi.php';

if (isset($_POST['id'])) {
    // Tangkap nilai id dari form
    $id = $_POST['id'];
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $nipp = mysqli_real_escape_string($conn, $_POST['nipp']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $unit = mysqli_real_escape_string($conn, $_POST['unit']);
    $jabatan = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $kedudukan = mysqli_real_escape_string($conn, $_POST['kedudukan']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $nilai = mysqli_real_escape_string($conn, $_POST['nilai']);

    $nama = ucwords(strtolower($nama));
    $unit = ucwords(strtolower($unit));
    $jabatan = ucwords(strtolower($jabatan));
    $kedudukan = ucwords(strtolower($kedudukan));
    // $kelas = ucwords(strtolower($kelas));
    $nilai = ucwords(strtolower($nilai));

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
        $uploadFileDir = '../pdf_rikes/';
        $newFileName = "rikes_$id.$fileExtension"; // Nama file baru dengan format: sertifikat_ID.extensi
        $dest_path = $uploadFileDir . $newFileName;

        // Periksa apakah direktori ada, jika tidak buat baru
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        // Pindahkan file ke direktori tujuan
        if (!move_uploaded_file($fileTmpPath, $dest_path)) {
            // Jika gagal mengunggah, tampilkan pesan kesalahan dan kembali ke halaman edit
            $_SESSION['error_message'] = "Gagal mengunggah file PDF.";
            header("Location: edit_rikes.php?id=$id");
            exit();
        }
        $maxFileSize = 5242880;

        if ($fileSize > $maxFileSize) {
            echo "<script>
                alert('Ukuran file melebihi batas maksimum (5MB).');
                window.location.href = 'edit_rikes.php';
              </script>";
            exit();
        }

        // Perbarui jalur file PDF dalam database
        $query = "UPDATE rikes SET tanggal='$tanggal', nipp='$nipp', nama='$nama', unit='$unit', jabatan='$jabatan', kedudukan='$kedudukan', kelas='$kelas', nilai='$nilai', pdf='$dest_path' WHERE id='$id'";
    } else {
        // Jika tidak ada file PDF yang diunggah, perbarui data tanpa mengubah file PDF
        $query = "UPDATE rikes SET tanggal='$tanggal', nipp='$nipp', nama='$nama', unit='$unit', jabatan='$jabatan', kedudukan='$kedudukan', kelas='$kelas', nilai='$nilai' WHERE id='$id'";
    }

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Jika berhasil, arahkan kembali ke halaman rikes
        echo "<script>
            alert('Data rikes berhasil diperbarui!');
            window.location.href = 'rikes.php';
          </script>";
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan dan kembali ke halaman edit
        $_SESSION['error_message'] = "Terjadi kesalahan: " . mysqli_error($conn);
        header("Location: edit_rikes.php?id=$id");
        exit();
    }
}

// Tutup koneksi
mysqli_close($conn);
