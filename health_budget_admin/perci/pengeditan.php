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

// Periksa apakah data yang dibutuhkan telah dikirim
if (isset($_POST['id_perci'], $_POST['kode_ci'], $_POST['uraian'], $_POST['program'], $_POST['penyerapan'])) {
    $id_perci = $_POST['id_perci'];
    $kode_ci = $_POST['kode_ci'];
    $uraian = $_POST['uraian'];
    $program = $_POST['program'];
    $penyerapan = $_POST['penyerapan'];

    // Prepared statement untuk menghindari SQL Injection
    $sql = "UPDATE anggaran_perci SET id_perci = ?, kode_ci = ?, uraian = ?, program = ?, penyerapan = ? WHERE kode_ci = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssis", $id_perci, $kode_ci, $uraian, $program, $penyerapan, $kode_ci);

    // Jalankan statement
    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, alihkan pengguna
        echo "
            <script>
            alert('Data berhasil diubah');
            window.location.href = '../anggaran_percommitmenitem.php';
            </script>
        ";
        exit(); // Penting: pastikan tidak ada output sebelum header() dipanggil
    } else {
        echo "
            <script>
            alert('Gagal mengubah data');
            window.location.href = '../anggaran_percommitmenitem.php';
            </script>
        ";
        exit();
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}

// Jika data yang dibutuhkan tidak lengkap
echo "
    <script>
    alert('Data tidak lengkap');
    window.location.href = '../anggaran_percommitmenitem.php';
    </script>
";
?>
