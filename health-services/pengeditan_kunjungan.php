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
    $januari = $_POST['januari'];
    $februari = $_POST['februari'];
    $maret = $_POST['maret'];
    $april = $_POST['april'];
    $mei = $_POST['mei'];
    $juni = $_POST['juni'];
    $juli = $_POST['juli'];
    $agustus = $_POST['agustus'];
    $september = $_POST['september'];
    $oktober = $_POST['oktober'];
    $november = $_POST['november'];
    $desember = $_POST['desember'];
    $jenis_kepesertaan = $_POST['jenis_kepesertaan'];

    // SQL untuk update data kunjungan
    $sql = "UPDATE kunjungan 
            SET tahun = ?, januari = ?, februari = ?, maret = ?, april = ?, mei = ?, juni = ?, juli = ?, agustus = ?, september = ?, oktober = ?, november = ?, desember = ?, jenis_kepesertaan = ?
            WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameter ke statement
    mysqli_stmt_bind_param($stmt, "iiiiiiiiiiiiisi", $tahun, $januari, $februari, $maret, $april, $mei, $juni, $juli, $agustus, $september, $oktober, $november, $desember, $jenis_kepesertaan, $id);


    // Eksekusi statement
    if (mysqli_stmt_execute($stmt)) {
        echo "
            <script>
            alert('Data berhasil diubah');
            window.location.href = 'kunjungan_klinik.php';
            </script>
        ";
        exit();
    } else {
        echo "
            <script>
            alert('Gagal mengubah data');
            window.location.href = 'kunjungan_klinik.php';
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
        window.location.href = 'kunjungan_klinik.php';
        </script>
    ";
}
?>
