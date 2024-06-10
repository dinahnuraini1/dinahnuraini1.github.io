<?php
// Menyertakan file koneksi database
include 'koneksi.php';

// Memeriksa apakah formulir telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil input dari formulir
    $nm_user = $_POST['nm_user'];
    $password = $_POST['password'];

    // Hash password menggunakan MD5 untuk disimpan di kolom passwordx
    $password_hash = md5($password);

    // Menyiapkan pernyataan SQL untuk memasukkan data
    $sql = "INSERT INTO user (nm_user, password, passwordx) VALUES (?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Mengikat variabel ke pernyataan yang disiapkan sebagai parameter
        mysqli_stmt_bind_param($stmt, "sss", $nm_user, $password, $password_hash);

        // Mencoba mengeksekusi pernyataan yang disiapkan
        if (mysqli_stmt_execute($stmt)) {
            echo "Data user admin berhasil disimpan.";
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($conn);
        }

        // Menutup statement
        mysqli_stmt_close($stmt);
    }
}

// Menutup koneksi
mysqli_close($conn);
?>
