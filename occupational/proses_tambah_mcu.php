<?php
// Mulai sesi
session_start();

// Koneksi ke database
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $program = mysqli_real_escape_string($conn, $_POST['program']);
    $realisasi = mysqli_real_escape_string($conn, $_POST['realisasi']);
    $nilaiA = mysqli_real_escape_string($conn, $_POST['nilai_a']);
    $nilaiB = mysqli_real_escape_string($conn, $_POST['nilai_b']);
    $nilaiC = mysqli_real_escape_string($conn, $_POST['nilai_c']);
    $nilaiD = mysqli_real_escape_string($conn, $_POST['nilai_d']);


    
    $totalNilai = (int)$nilaiA + (int)$nilaiB + (int)$nilaiC + (int)$nilaiD;
    if ($totalNilai > (int)$realisasi) {
        // Jika total nilai melebihi realisasi, kembalikan ke form dengan pesan kesalahan
        echo "<script>
                alert('Total nilai A + B + C + D tidak boleh melebihi nilai realisasi!');
                window.location.href = 'tambah_mcu.php';
              </script>";

        exit();
    }

    // Proses file PDF
    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['pdf_file']['tmp_name'];
        $fileName = $_FILES['pdf_file']['name'];
        $fileSize = $_FILES['pdf_file']['size'];
        $fileType = $_FILES['pdf_file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Tentukan direktori tujuan
        $uploadFileDir = '../pdf_mcu/';
        $dest_path = $uploadFileDir . $fileName;

        // Periksa apakah direktori ada, jika tidak buat baru
        if (!is_dir($uploadFileDir)) {
            mkdir(
                $uploadFileDir,
                0777,
                true
            );
        }

        // Pindahkan file ke direktori tujuan
        if (!move_uploaded_file($fileTmpPath, $dest_path)) {
            echo "<script>
                alert('Gagal mengunggah file PDF.');
                window.location.href = 'tambah_mcu.php';
              </script>";
            exit();
        }

        $maxFileSize = 5242880;

        if ($fileSize > $maxFileSize) {
            echo "<script>
                alert('Ukuran file melebihi batas maksimum (5MB).');
                window.location.href = 'tambah_mcu.php';
              </script>";
            exit();
        }
    } else {
        // Jika tidak ada file PDF yang diunggah atau terjadi kesalahan dalam pengunggahan
        // Atur nilai path PDF ke NULL
        $dest_path = NULL;
    }

    // Insert new entry
    $stmt = $conn->prepare("INSERT INTO mcu (tanggal, kelas, program, realisasi, nilai_a, nilai_b, nilai_c, nilai_d, pdf) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssssss', $tanggal, $kelas, $program, $realisasi, $nilaiA, $nilaiB, $nilaiC, $nilaiD, $dest_path);
    if ($stmt->execute()) {
        echo "<script>
                alert('Data Hasil Tes MCU berhasil ditambahkan!');
                window.location.href = 'hasilmcu.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal menambahkan data: " . $stmt->error . "');
                window.location.href = 'tambah_mcu.php';
              </script>";
        exit();
    }

    $stmt->close();
}

// Tutup koneksi
mysqli_close($conn);
?>