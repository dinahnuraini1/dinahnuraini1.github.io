<?php
// Menyertakan file koneksi database
include 'koneksi.php';

// Mulai sesi
session_start();

// Memeriksa apakah formulir telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil input dari formulir
    $nm_user = $_POST['nm_user'];
    $password = $_POST['password'];

    // Menyiapkan pernyataan SQL untuk memeriksa user
    $sql = "SELECT id, nm_user, passwordx FROM user WHERE nm_user = ?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Mengikat variabel ke pernyataan yang disiapkan sebagai parameter
        mysqli_stmt_bind_param($stmt, "s", $nm_user);

        // Mencoba mengeksekusi pernyataan yang disiapkan
        if (mysqli_stmt_execute($stmt)) {
            // Menyimpan hasil
            mysqli_stmt_store_result($stmt);

            // Memeriksa apakah username ada, jika ada maka verifikasi password
            if (mysqli_stmt_num_rows($stmt) == 1) {
                // Mengikat hasil variabel
                mysqli_stmt_bind_result($stmt, $id, $nm_user, $hashed_password);

                if (mysqli_stmt_fetch($stmt)) {
                    // Verifikasi password
                    if (md5($password) == $hashed_password) {
                        // Password benar, mulai sesi baru dan simpan ID user
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["nm_user"] = $nm_user;

                        // Alihkan ke halaman welcome
                        header("location: health_budget_admin/anggaran_percommitmenitem.php");
                        exit;
                    } else {
                        // Tampilkan pesan kesalahan jika password tidak valid
                        echo "<script>alert('Username atau password salah !!')</script>";
                        echo "<script>window.location.href = 'login.php';</script>";
                        exit;
                   }
                }
            } else {
                echo "<script>alert('Username atau password salah !!')</script>";
                echo "<script>window.location.href = 'login.php';</script>";
                exit;
            }
        } else {
            echo "<script>alert('Oops! Terjadi kesalahan. Silakan coba lagi nanti.')</script>";
            echo "<script>window.location.href = 'login.php';</script>";
            exit;
        }

        // Menutup statement
        mysqli_stmt_close($stmt);
    }

}

// Menutup koneksi
mysqli_close($conn);
?>
