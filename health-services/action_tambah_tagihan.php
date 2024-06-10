<?php 
include "../koneksi.php";

$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$jenis_pasien = $_POST['jenis_pasien'];
$jumlah_pasien = $_POST['jumlah_pasien'];
$biaya = $_POST['biaya'];
$sql = "INSERT INTO tagihan (bulan, tahun, jenis_pasien, jumlah_pasien, biaya) VALUES ('$bulan', '$tahun', '$jenis_pasien', '$jumlah_pasien', '$biaya')";
$hasil = mysqli_query($conn, $sql);
if (!$hasil){
    echo "Perintah tambah data";
} else{
    header("Location: ../health-services/jumlah_tagihan.php");
}

?>
