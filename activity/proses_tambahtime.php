<?php
include '../koneksi.php';
// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan data yang diterima sesuai dengan yang diharapkan

    // Cek apakah semua field telah diisi
    if (isset($_POST['pic']) && isset($_POST['tanggal']) && isset($_POST['uraian']) && isset($_POST['status'])) {
        // Tangkap data yang dikirimkan melalui form
        $id = $_POST['id'];
        $pic = $_POST['pic'];
        $tanggal = $_POST['tanggal'];
        $uraian = $_POST['uraian'];
        $status = $_POST['status'];
        $ket=$_POST['ket'];
        $pdfFilename = '';
        $uraian = ucwords(strtolower($uraian));
        // Lakukan validasi data di sini jika diperlukan



        // $query = "INSERT INTO tb_timeline (pic, tanggal, uraian, status,ket) VALUES ('$pic', '$tanggal', '$uraian', '$status','$ket')";
        // Handle PDF file upload
        if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0 ){

            $pdfTmpPath = $_FILES['pdf']['tmp_name'];
            $pdfFilename = $_FILES['pdf']['name'];
            $pdfDestPath = '../pdf_timelinepic/' . $pdfFilename;


            // Pindahkan file ke direktori tujuan
            if (move_uploaded_file($pdfTmpPath, $pdfDestPath)) {
                // File berhasil diunggah
            } else {
                echo "Terjadi kesalahan saat mengunggah file.";
                exit;
            }
        }

        // Simpan data ke database
        $query = "INSERT INTO tb_timeline (pic, tanggal, uraian, ket, status, pdf) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssss', $pic, $tanggal, $uraian, $ket, $status, $pdfFilename);
        $stmt->execute();
            
        if ($stmt->affected_rows > 0) {
            echo "<script>
                alert('Data berhasil ditambahkan!');
                window.location.href = 'timeline2.php';
              </script>";
                    
        } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
                }
                         // Close the statement and connection
            $stmt->close();
            $conn->close();
        }
    }
