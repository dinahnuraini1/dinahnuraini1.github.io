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

// Periksa apakah data yang dibutuhkan telah dikirim dan tidak kosong
if (isset($_POST['id_program'], $_POST['uraian_kegiatan'], $_POST['rincian'], $_POST['program'], $_POST['penyerapan']) &&
    !empty($_POST['id_program']) && !empty($_POST['uraian_kegiatan']) && !empty($_POST['rincian']) &&
    !empty($_POST['program']) && !empty($_POST['penyerapan'])) {

    $id_program = $_POST['id_program'];
    $uraian_kegiatan = $_POST['uraian_kegiatan'];
    $rincian = $_POST['rincian'];
    $program = $_POST['program'];
    $penyerapan = $_POST['penyerapan'];

    // Prepared statement untuk menghindari SQL Injection
    $sql = "UPDATE program_dan_realisasi SET uraian_kegiatan = ?, rincian = ?, program = ?, penyerapan = ? WHERE id_program = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssii", $uraian_kegiatan, $rincian, $program, $penyerapan, $id_program);

    // Jalankan statement
    if (mysqli_stmt_execute($stmt)) {
        // Jika berhasil, alihkan pengguna
        echo "
            <script>
            alert('Data berhasil diubah');
            window.location.href = '../program_realisasi.php';
            </script>
        ";
        exit(); // Penting: pastikan tidak ada output sebelum header() dipanggil
    } else {
        echo "
            <script>
            alert('Gagal mengubah data');
            window.location.href = '../program_realisasi.php';
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
    window.location.href = '../program_realisasi.php';
    </script>
";
?>
