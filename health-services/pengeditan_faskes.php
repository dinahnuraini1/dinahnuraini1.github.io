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
    // Periksa apakah ID_faskes diberikan
    if(isset($_POST['id_faskes'])) {
        // Ambil data dari form
        $id_faskes = $_POST['id_faskes'];
        $jenis_provider = $_POST['jenis_provider'];
        $nama_provider = $_POST['nama_provider'];
        $lokasi = $_POST['lokasi'];
        $masa_berlaku = $_POST['masa_berlaku'];
        $no_kontrak = $_POST['no_kontrak'];
        $status_faskes = $_POST['status_faskes'];
        $keterangan = $_POST['keterangan'];

        // SQL untuk update data faskes
        $sql = "UPDATE faskes
                SET jenis_provider = ?, nama_provider = ?, lokasi = ?, masa_berlaku = ?, no_kontrak = ?, status_faskes = ?, keterangan = ?
                WHERE id_faskes = ?";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind parameter ke statement
        mysqli_stmt_bind_param($stmt, "sssssssi", $jenis_provider, $nama_provider, $lokasi, $masa_berlaku, $no_kontrak, $status_faskes, $keterangan, $id_faskes);

        // Eksekusi statement
        if (mysqli_stmt_execute($stmt)) {
            echo "
                <script>
                alert('Data berhasil diubah');
                window.location.href = 'faskes.php';
                </script>
            ";
            exit();
        } else {
            echo "
                <script>
                alert('Gagal mengubah data');
                window.location.href = 'faskes.php';
                </script>
            ";
            exit();
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    } else {
        echo "
            <script>
            alert('ID tidak diberikan');
            window.location.href = 'faskes.php';
            </script>
        ";
        exit;
    }
} else {
    echo "
        <script>
        alert('Data tidak lengkap');
        window.location.href = 'faskes.php';
        </script>
    ";
    exit;
}

// Tutup koneksi
mysqli_close($conn);
?>
