<?php 
include "../koneksi.php";

$jenis_rujukan = $_POST['jenis_rujukan'];
$ppk_provider = $_POST['ppk_provider'];
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
$tahun = $_POST['tahun'];

$sql = "INSERT INTO rujukan (jenis_rujukan, ppk_provider, januari, februari, maret, april, mei, juni, juli, agustus, september, oktober, november, desember, tahun) 
        VALUES ('$jenis_rujukan', '$ppk_provider', '$januari', '$februari', '$maret', '$april', '$mei', '$juni', '$juli', '$agustus', '$september', '$oktober', '$november', '$desember', '$tahun')";

$hasil = mysqli_query($conn, $sql);
if (!$hasil){
    echo "<script>alert('Perintah tambah data gagal: " . mysqli_error($conn) . "'); window.location.href='../health-services/jumlah_rujukan.php';</script>";
} else{
    echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='../health-services/jumlah_rujukan.php';</script>";
}
?>
