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
    $tahun = $_POST['tahun'];
    $bulan = $_POST['bulan'];
    $jenis_pasien = $_POST['jenis_pasien'];
    $jumlah_pasien = $_POST['jumlah_pasien'];
    $biaya = $_POST['biaya'];

    // SQL untuk update data tagihan
    $sql = "UPDATE tagihan 
            SET tahun = ?, bulan = ?, jenis_pasien = ?, jumlah_pasien = ?, biaya = ?
            WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameter ke statement
    mysqli_stmt_bind_param($stmt, "issiii", $tahun, $bulan, $jenis_pasien, $jumlah_pasien, $biaya, $id);

    // Eksekusi statement
    if (mysqli_stmt_execute($stmt)) {
        echo "
            <script>
            alert('Data berhasil diubah');
            window.location.href = 'jumlah_tagihan.php';
            </script>
        ";
        exit();
    } else {
        echo "
            <script>
            alert('Gagal mengubah data');
            window.location.href = 'jumlah_tagihan.php';
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
        window.location.href = 'jumlah_tagihan.php';
        </script>
    ";
}
?>
