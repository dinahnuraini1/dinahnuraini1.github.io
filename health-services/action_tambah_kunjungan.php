<?php 
include "../koneksi.php";

$jenis_kepesertaan = $_POST['jenis_kepesertaan'];
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

$sql = "INSERT INTO kunjungan (jenis_kepesertaan, januari, februari, maret, april, mei, juni, juli, agustus, september, oktober, november, desember, tahun) 
        VALUES ('$jenis_kepesertaan', '$januari', '$februari', '$maret', '$april', '$mei', '$juni', '$juli', '$agustus', '$september', '$oktober', '$november', '$desember', '$tahun')";

$hasil = mysqli_query($conn, $sql);
if (!$hasil){
    echo "Perintah tambah data gagal: " . mysqli_error($conn);
} else{
    header("Location: ../health-services/kunjungan_klinik.php");
}
?>
