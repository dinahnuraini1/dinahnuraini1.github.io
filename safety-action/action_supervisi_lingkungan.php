<?php 
include "../koneksi.php";

// Ambil data dari form
$tanggal = $_POST['tanggal'];
$unit_kerja = $_POST['unit_kerja'];
$air = $_POST['air'];
$pencahayaan = $_POST['pencahayaan'];
$kebisingan = $_POST['kebisingan'];
$getaran = $_POST['getaran'];
$rekomendasi = $_POST['rekomendasi'];

// Prepare SQL statement untuk mencegah SQL Injection
$stmt = $conn->prepare("INSERT INTO supervisi_lingkungan (tanggal, unit_kerja, air, pencahayaan, kebisingan, getaran, rekomendasi) VALUES (?, ?, ?, ?, ?, ?, ?)");

// Bind parameter ke statement
$stmt->bind_param("sssssss", $tanggal, $unit_kerja, $air, $pencahayaan, $kebisingan, $getaran, $rekomendasi);

// Eksekusi statement
if ($stmt->execute()) {
    echo "<script>
            alert('Data berhasil ditambahkan');
            window.location.href = '../safety-action/supervisi_lingkungan.php';
          </script>";
} else {
    echo "<script>
            alert('Error: " . $stmt->error . "');
            window.location.href = '../safety-action/supervisi_lingkungan.php';
          </script>";
}

// Tutup statement
$stmt->close();

// Tutup koneksi
$conn->close();
?>
