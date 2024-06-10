<?php 
include "../koneksi.php";

// Ambil data dari form
$tanggal = $_POST['tanggal'];
$unit_kerja = $_POST['unit_kerja'];
$apd = $_POST['apd'];
$apar = $_POST['apar'];
$p3k = $_POST['p3k'];
$rekomendasi = $_POST['rekomendasi'];

// Prepare SQL statement untuk mencegah SQL Injection
$stmt = $conn->prepare("INSERT INTO supervisi_alat_kerja (tanggal, unit_kerja, apd, apar, p3k, rekomendasi) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $tanggal, $unit_kerja, $apd, $apar, $p3k, $rekomendasi);

// Eksekusi statement
if ($stmt->execute()) {
    echo "<script>
            alert('Data berhasil ditambahkan');
            window.location.href = '../safety-action/supervisi_alat.php';
          </script>";
} else {
    echo "<script>
            alert('Error: " . $stmt->error . "');
            window.location.href = '../safety-action/supervisi_alat.php';
          </script>";
}

// Tutup statement
$stmt->close();

// Tutup koneksi
$conn->close();
?>
