<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kesehatan";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_klinik = $_POST["id_klinik"];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Periksa apakah file adalah gambar
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File adalah gambar - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Periksa jika file sudah ada
    if (file_exists($target_file)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    // Batasi ukuran file (misalnya 500KB)
if ($_FILES["fileToUpload"]["size"] > 20000000) {
        echo "Maaf, file Anda terlalu besar.";
        $uploadOk = 0;
    }

    // Batasi jenis file yang diizinkan
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Maaf, hanya JPG, JPEG, PNG & GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Periksa apakah $uploadOk adalah 0 karena error
    if ($uploadOk == 0) {
        echo "Maaf, file Anda tidak terunggah.";
    // Jika semuanya baik, coba unggah file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "File ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " telah diunggah.";

            // Perbarui database
            $sql = "UPDATE klinik_mediska SET foto='$target_file' WHERE id_klinik=$id_klinik";

            if ($conn->query($sql) === TRUE) {
                echo "Rekam telah diperbarui.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Maaf, ada kesalahan dalam mengunggah file Anda.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<body>

<h2>Unggah Gambar Klinik</h2>
<form action="upload.php" method="post" enctype="multipart/form-data">
    Pilih gambar untuk diunggah:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="hidden" name="id_klinik" value="1"> <!-- Sesuaikan dengan ID klinik -->
    <input type="submit" value="Unggah Gambar" name="submit">
</form>

</body>
</html>
