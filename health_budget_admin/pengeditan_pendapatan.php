<?php
// Koneksi ke database
include "../koneksi.php";

// Periksa apakah koneksi berhasil
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Periksa apakah data yang dibutuhkan telah dikirim
if (isset($_POST['id_pendapatan']) && isset($_POST['kapitasi']) && isset($_POST['non_kapitasi'])) {
    // Ambil data dari POST
    $id_pendapatan = $_POST['id_pendapatan'];
    $kapitasi = $_POST['kapitasi'];
    $non_kapitasi = $_POST['non_kapitasi'];

    // Validasi data sebelum menggunakannya dalam query
    if (!is_numeric($kapitasi) || !is_numeric($non_kapitasi) || !is_numeric($id_pendapatan)) {
        echo "<script>
            alert('Data harus berupa angka yang valid');
            window.location.href = 'pendapatan.php';
            </script>";
        exit();
    }

    // Prepared statement untuk menghindari SQL Injection
    $sql = "UPDATE pendapatan SET kapitasi = ?, non_kapitasi = ? WHERE id_pendapatan = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Prepare statement gagal: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ddi", $kapitasi, $non_kapitasi, $id_pendapatan);

    // Jalankan statement
    if ($stmt->execute()) {
        // Jika berhasil, alihkan pengguna
        echo "<script>
            alert('Data berhasil diubah');
            window.location.href = 'pendapatan.php';
            </script>";
        exit();
    } else {
        echo "<script>
            alert('Gagal mengubah data');
            window.location.href = 'pendapatan.php';
            </script>";
        exit();
    }

    // Tutup statement
    $stmt->close();
} else {
    // Jika data tidak lengkap, kembalikan ke halaman sebelumnya
    echo "<script>
        alert('Data tidak lengkap');
        window.location.href = 'pendapatan.php';
        </script>";
    exit();
}

// Tutup koneksi
$conn->close();
?>
