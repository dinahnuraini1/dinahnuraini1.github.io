<?php 
include "../koneksi.php";

// Ambil data dari form
$klinik = $_POST['klinik'];
$tahun = $_POST['tahun'];
$bulan = $_POST['bulan'];
$kapitasi = $_POST['kapitasi'];
$non_kapitasi = $_POST['non_kapitasi'];

// Prepare SQL statement untuk mencegah SQL Injection
$stmt = $conn->prepare("INSERT INTO pendapatan (klinik, tahun, bulan, kapitasi, non_kapitasi) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $klinik, $tahun, $bulan, $kapitasi, $non_kapitasi);

// Eksekusi statement
if ($stmt->execute()) {
    echo "<script>
            alert('Data berhasil ditambahkan');
            window.location.href = '../health_budget_admin/pendapatan.php';
          </script>";
} else {
    echo "<script>
            alert('Error: " . $stmt->error . "');
            window.location.href = '../health_budget_admin/pendapatan.php';
          </script>";
}

// Tutup statement
$stmt->close();

// Tutup koneksi
$conn->close();
?>
