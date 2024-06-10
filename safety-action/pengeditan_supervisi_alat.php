<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'kesehatan';

$conn = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Periksa apakah data dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    $unit_kerja = $_POST['unit_kerja'];
    $apd = $_POST['apd'];
    $apar = $_POST['apar'];
    $p3k = $_POST['p3k'];
    $rekomendasi = $_POST['rekomendasi'];

    // SQL untuk update data supervisi
    $sql = "UPDATE supervisi_alat_kerja
            SET tanggal = ?, unit_kerja = ?, apd = ?, apar = ?, p3k = ?, rekomendasi = ?
            WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameter ke statement
    mysqli_stmt_bind_param($stmt, "sssissi", $tanggal, $unit_kerja, $apd, $apar, $p3k, $rekomendasi, $id);

    // Eksekusi statement
    if (mysqli_stmt_execute($stmt)) {
        echo "
            <script>
            alert('Data berhasil diubah');
            window.location.href = 'supervisi_alat.php';
            </script>
        ";
        exit();
    } else {
        echo "
            <script>
            alert('Gagal mengubah data');
            window.location.href = 'supervisi_alat.php';
            </script>
        ";
        exit();
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
} else {
    echo "
        <script>
        alert('Data tidak lengkap');
        window.location.href = 'supervisi_alat.php';
        </script>
    ";
}
?>
