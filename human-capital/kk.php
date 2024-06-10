<?php

include '../koneksi.php';
// Query untuk mengambil data dari database

$query = "SELECT * FROM user_uk ORDER BY 
 CASE 
                                                    WHEN Jabatan LIKE '%Manager Kesehatan%' THEN 1
                                                    WHEN Jabatan LIKE '%Assistant Manager%' THEN 2
                                                    WHEN Jabatan LIKE '%Kepala%' THEN 3
                                                    WHEN Jabatan LIKE '%Pelaksana' THEN 4
                                                    ELSE 5
                                                END";
$result = mysqli_query($conn, $query);
$totalRows = mysqli_num_rows($result);
// $query1 = "SELECT * FROM user_mediska_madiun ORDER BY 
//                                                 CASE 
//                                                     WHEN Jabatan LIKE '%Manager Kesehatan%' THEN 1
//                                                     WHEN Jabatan LIKE '%Assistant Manager%' THEN 2
//                                                     WHEN Jabatan LIKE '%Kepala%' THEN 3
//                                                     WHEN Jabatan LIKE '%Pelaksana' THEN 4
//                                                     ELSE 5
//                                                 END";
// $result1 = mysqli_query($conn, $query1);
// mysqli_data_seek($result1, 0);

// $i = 1;
// // Melakukan iterasi untuk setiap baris data yang diambil dari database
// while ($row = mysqli_fetch_assoc($result)) {
//     $totalRows = mysqli_num_rows($result);
// }
// while ($row1 = mysqli_fetch_assoc($result1)) {
//     $totalRows1 = mysqli_num_rows($result1);
// }
?>

<div class="card-body px-0 pb-2 table-body hidden">
    <div class="table-responsive p-0">

        <table id="profilTable" class="table table-bordered table-sm" style="text-align: center;"> <!-- Tambahkan kelas table-sm untuk merampingkan tabel -->
            <thead>
                <tr>

                    <!-- <th>No</th> -->
                    <th>NIPP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Kedudukan</th>
                    <th>Status</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Pendidikan</th>
                    <th>Profesi</th>
                    <th>Detail</th>
                    <th style="width: 100px;">Action</th> <!-- Atur lebar kolom Action -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Tampilkan data dari tabel kedua
                while ($row = mysqli_fetch_assoc($result)) {



                ?>
                    <tr>


                        <td><?php echo $row['nipp']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['jabatan']; ?></td>
                        <td><?php echo $row['kedudukan']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['tempat_lhr']; ?></td>
                        <td><?php echo $row['tgl']; ?></td>
                        <td><?php echo $row['pend']; ?></td>
                        <td><?php echo $row['profesi']; ?></td>

                        <td>
                            <center>
                                <a href="data_pekerja.php?id=<?php echo $row['nipp']; ?>">
                                    <i class="fa-solid"><img src="../assets/img/icon/search.png" alt="" width="30" height="30"></i>
                                </a>
                            </center>
                        </td>
                        <td>
                            <center>
                                <!-- Tombol edit -->
                                <a href="edit2.php?id=<?php echo $row['nipp']; ?>">
                                    <i class="fa-solid"><img src="../assets/img/icon/pen.png" alt="" width="30" height="30"></i>
                                </a>
                                <!-- Tombol hapus -->
                                <a href="hapus2.php?id=<?php echo $row['nipp']; ?>">
                                    <i class="fa-solid"><img src="../assets/img/icon/bin.png" alt="" width="30" height="30"></i>
                                </a>
                            </center>
                        </td>

                    </tr>
                <?php
                }
                // echo "<script>sortTableByJobPosition();</script>";
                ?>
            </tbody>

        </table><br>
    </div>

</div>