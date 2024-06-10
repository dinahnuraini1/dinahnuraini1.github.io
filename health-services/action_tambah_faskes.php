<?php 
include "../koneksi.php";

$jenis_provider = $_POST['jenis_provider'];
$nama_provider = $_POST['nama_provider'];
$lokasi = $_POST['lokasi'];
$masa_berlaku = $_POST['masa_berlaku'];
$no_kontrak = $_POST['no_kontrak'];
$status_faskes = $_POST['status_faskes'];
$keterangan = $_POST['keterangan'];
$sql = "INSERT INTO faskes (jenis_provider, nama_provider, lokasi, masa_berlaku, no_kontrak, status_faskes, keterangan) VALUES ('$jenis_provider', '$nama_provider', '$lokasi', '$masa_berlaku', '$no_kontrak', '$status_faskes', '$keterangan')";
$hasil = mysqli_query($conn, $sql);
if (!$hasil){
    echo "Perintah tambah data";
} else{
    header("Location: ../health-services/faskes.php");
}

?>
