<?php
include '../koneksi.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Set max upload size to 10 MB
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');

if (isset($_POST['upload'])) {
    $targetDir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $allowedTypes = array('xls', 'xlsx', 'csv');

    // Periksa apakah file yang diunggah memiliki salah satu ekstensi yang diizinkan
    if (in_array($fileType, $allowedTypes)) {
        // Pindahkan file yang diunggah ke direktori target
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            $uploadedOn = date("Y-m-d H:i:s");
            // Simpan informasi file ke database
            $insert = $conn->query("INSERT INTO ibpr (file_name, file_path, uploaded_on) VALUES ('$fileName', '$targetFilePath', '$uploadedOn')");

            if ($insert) {
                // Baca isi file jika file tersebut adalah file Excel atau CSV
                try {
                    if ($fileType == 'csv') {
                        // Proses file CSV
                        $data = array_map('str_getcsv', file($targetFilePath));
                        // Lakukan sesuatu dengan data CSV
                    } else {
                        // Proses file Excel
                        $spreadsheet = IOFactory::load($targetFilePath);
                        $sheet = $spreadsheet->getActiveSheet();
                        $data = $sheet->toArray();
                        // Lakukan sesuatu dengan data Excel
                    }

                    echo "<script>
                            alert('The file " . $fileName . " has been uploaded and processed successfully.');
                            window.location.href = 'safety_action.php';
                          </script>";
                } catch (Exception $e) {
                    echo "<script>
                            alert('Error reading file: " . $e->getMessage() . "');
                            window.history.back();
                          </script>";
                }
            } else {
                echo "<script>
                        alert('File upload failed, please try again.');
                        window.history.back();
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Sorry, there was an error uploading your file.');
                    window.history.back();
                  </script>";
        }
    } else {
        echo "<script>
                alert('Sorry, only XLS, XLSX, and CSV files are allowed to upload.');
                window.history.back();
              </script>";
    }
}
?>
