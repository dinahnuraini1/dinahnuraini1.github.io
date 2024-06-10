<?php
// Mulai sesi
session_start();

// Koneksi ke database
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $periode = mysqli_real_escape_string($conn, $_POST['periode']);
    $program = mysqli_real_escape_string($conn, $_POST['program']);
    $realisasi = mysqli_real_escape_string($conn, $_POST['realisasi']);
    $nilaiA = mysqli_real_escape_string($conn, $_POST['nilai_a']);
    $nilaiB = mysqli_real_escape_string($conn, $_POST['nilai_b']);
    $nilaiC = mysqli_real_escape_string($conn, $_POST['nilai_c']);
    $nilaiD = mysqli_real_escape_string($conn, $_POST['nilai_d']);


    $periode = ucwords(strtolower($periode));
   


    // Validasi bulan tidak boleh dobel
    $queryCheckMonth = "SELECT COUNT(*) AS total FROM kebugaran WHERE periode = '$periode' AND YEAR(tanggal) = YEAR('$tanggal')";
    $resultCheckMonth = mysqli_query($conn, $queryCheckMonth);
    $rowCheckMonth = mysqli_fetch_assoc($resultCheckMonth);
    // if ($rowCheckMonth['total'] > 0) {
    //     $_SESSION['error_message'] = "Bulan $bulan untuk tahun ini sudah ada dalam database!";
    //     header("Location: tambah_kebugaran.php");
    //     exit();
    // }

    $totalNilai = (int)$nilaiA + (int)$nilaiB + (int)$nilaiC + (int)$nilaiD;
    if ($totalNilai > (int)$realisasi) {
        // Jika total nilai melebihi realisasi, kembalikan ke form dengan pesan kesalahan
        $_SESSION['error_message'] = "Total nilai A + B + C + D tidak boleh melebihi nilai realisasi!";
        header("Location: tambah_kebugaran.php"); // Kembali ke halaman tambah dengan menyertakan ID
        exit();
    }

    // // Periksa apakah nilai realisasi melebihi program
    // if ((int)$realisasi > (int)$program) {
    //     // Jika nilai realisasi melebihi program, kembalikan ke form dengan pesan kesalahan
    //     $_SESSION['error_message'] = "Nilai realisasi tidak boleh melebihi nilai program!";
    //     header("Location: tambah_kebugaran.php"); // Kembali ke halaman tambah dengan menyertakan ID
    //     exit();
    // }

    // Periksa apakah nilai A + B + C + D sudah mencapai atau melebihi nilai realisasi
    if ($totalNilai < (int)$realisasi) {
        // Jika nilai A + B + C + D belum mencapai nilai realisasi, kembalikan ke form dengan pesan kesalahan
        $_SESSION['error_message'] = "Nilai A + B + C + D belum mencapai nilai realisasi!";
        header("Location: tambah_kebugaran.php"); // Kembali ke halaman tambah dengan menyertakan ID
        exit();
    }

    // Proses file PDF
    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK
    ) {
        $fileTmpPath = $_FILES['pdf_file']['tmp_name'];
        $fileName = $_FILES['pdf_file']['name'];
        $fileSize = $_FILES['pdf_file']['size'];
        $fileType = $_FILES['pdf_file']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Tentukan direktori tujuan
        $uploadFileDir = '../pdf_kebugaran/';
        $dest_path = $uploadFileDir . $fileName;

        // Periksa apakah direktori ada, jika tidak buat baru
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir,
                0777,
                true
            );
        }

        // Pindahkan file ke direktori tujuan
        if (!move_uploaded_file($fileTmpPath, $dest_path)) {
            echo "<script>
                alert('Gagal mengunggah file PDF.');
                window.location.href = 'tambah_kebugaran.php';
              </script>";
            exit();
        }

        $maxFileSize = 5242880;

        if ($fileSize > $maxFileSize) {
            echo "<script>
                alert('Ukuran file melebihi batas maksimum (5MB).');
                window.location.href = 'tambah_kebugaran.php';
              </script>";
            exit();
        }
    } else {
        $dest_path = NULL;
    }

    // Insert new entry
    $stmt = $conn->prepare("INSERT INTO kebugaran (tanggal, periode, program, realisasi, nilai_a, nilai_b, nilai_c, nilai_d,pdf) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param('ssssiiiii', $tanggal, $periode, $program, $realisasi, $nilaiA, $nilaiB, $nilaiC, $nilaiD, $dest_path);
    if ($stmt->execute()) {
        echo "<script>
                alert('Data Hasil Tes Kebugaran berhasil ditambahkan!');
                window.location.href = 'kebugaran.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Gagal menambahkan data: " . $stmt->error . "');
                window.location.href = 'tambah_kebugaran.php';
              </script>";
        exit();
    }

    $stmt->close();
}


// Tutup koneksi
mysqli_close($conn);
