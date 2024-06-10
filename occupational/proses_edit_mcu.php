<?php
// Mulai sesi
session_start();

// Koneksi ke database
include '../koneksi.php';

if (isset($_POST['id'])) {
    // Tangkap nilai id dari form
    $id = $_POST['id'];
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $program = mysqli_real_escape_string($conn, $_POST['program']);
    $realisasi = mysqli_real_escape_string($conn, $_POST['realisasi']);
    $nilai_a = mysqli_real_escape_string($conn, $_POST['nilai_a']);
    $nilai_b = mysqli_real_escape_string($conn, $_POST['nilai_b']);
    $nilai_c = mysqli_real_escape_string($conn, $_POST['nilai_c']);
    $nilai_d = mysqli_real_escape_string($conn, $_POST['nilai_d']);


    $totalNilai = (int)$nilai_a + (int)$nilai_b + (int)$nilai_c + (int)$nilai_d;
    if ($totalNilai > (int)$realisasi) {
        // Jika total nilai melebihi realisasi, kembalikan ke form dengan pesan kesalahan
        echo "<script>
                alert('Total nilai A + B + C + D tidak boleh melebihi nilai realisasi!');
                window.location.href = 'tambah_mcu.php';
              </script>";

        exit();
    }


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
        $uploadFileDir = '../pdf_mcu/';
        $newFileName = "mcu_$id.$fileExtension"; // Nama file baru dengan format: sertifikat_ID.extensi
        $dest_path = $uploadFileDir . $newFileName;

        // Periksa apakah direktori ada, jika tidak buat baru
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0777, true);
        }

        // Pindahkan file ke direktori tujuan
        if (!move_uploaded_file($fileTmpPath, $dest_path)) {
            // Jika gagal mengunggah, tampilkan pesan kesalahan dan kembali ke halaman edit
            $_SESSION['error_message'] = "Gagal mengunggah file PDF.";
            header("Location: edit_mcu.php?id=$id");
            exit();
        }
        $maxFileSize = 5242880;

        if ($fileSize > $maxFileSize) {
            echo "<script>
                alert('Ukuran file melebihi batas maksimum (5MB).');
                window.location.href = 'edit_mcu.php';
              </script>";
            exit();
        }

        // Perbarui jalur file PDF dalam database
        $query = "UPDATE mcu SET tanggal='$tanggal', kelas='$kelas', program='$program', realisasi='$realisasi', nilai_a='$nilai_a', nilai_b='$nilai_b', nilai_c='$nilai_c', nilai_d='$nilai_d', pdf='$dest_path' WHERE id='$id'";
    } else {
        // Jika tidak ada file PDF yang diunggah, perbarui data tanpa mengubah file PDF
        $query = "UPDATE mcu SET tanggal='$tanggal', kelas='$kelas', program='$program', realisasi='$realisasi', nilai_a='$nilai_a', nilai_b='$nilai_b', nilai_c='$nilai_c', nilai_d='$nilai_d' WHERE id='$id'";
    }

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Jika berhasil, arahkan kembali ke halaman mcu
        echo "<script>
            alert('Data mcu berhasil diperbarui!');
            window.location.href = 'hasilmcu.php';
          </script>";
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan kesalahan dan kembali ke halaman edit
        echo "<script>
            alert('Terjadi kesalahan!');
            window.location.href = 'edit_mcu.php';
          </script>";
        exit();
    }
}

// Tutup koneksi
mysqli_close($conn);
