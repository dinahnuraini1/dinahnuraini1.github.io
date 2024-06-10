<?php
// Lakukan koneksi ke database
include '../koneksi.php';

// Periksa apakah parameter tahun ada dalam URL
if (isset($_GET['tahun'])) {
    // Tangkap nilai tahun dari parameter URL
    $tahun = $_GET['tahun'];

    // Lakukan query pencarian data berdasarkan tahun
    $query = "SELECT * FROM sertifikasi WHERE YEAR(tahun) = $tahun";
    $result = mysqli_query($conn, $query);

    // Buat tabel untuk menampilkan hasil pencarian
    echo '<table class="table table-bordered table-sm" style="text-align: center;">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>No</th>';
    echo '<th>Uraian</th>';
    echo '<th>Unit Kerja</th>';
    echo '<th>Program</th>';
    echo '<th>Nilai A</th>';
    echo '<th>Nilai B</th>';
    echo '<th>Nilai C</th>';
    echo '<th>Nilai D</th>';
    echo '<th>Action</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Jika query berhasil dieksekusi
    if ($result) {
        // Inisialisasi nomor urut
        $nomor_urut = 1;

        // Proses data yang ditemukan
        while ($row = mysqli_fetch_assoc($result)) {
            // Tampilkan data dalam baris tabel
            echo '<tr>';
            echo '<td>' . $nomor_urut . '</td>';
            echo '<td>' . $row['uraian'] . '</td>';
            echo '<td>' . $row['unit'] . '</td>';
            echo '<td>' . $row['program'] . '</td>';
            echo '<td>' . $row['nilai_A'] . '</td>';
            echo '<td>' . $row['nilai_B'] . '</td>';
            echo '<td>' . $row['nilai_C'] . '</td>';
            echo '<td>' . $row['nilai_D'] . '</td>';
            echo '<td>';
            echo '<a href="edit_madiun.php?id=' . $row['id'] . '"><i class="fa-solid"><img src="../assets/img/icon/pen.png" alt="" width="30" height="30"></i></a>';
            echo '<a href="hapus_madiun.php?id=' . $row['id'] . '"><i class="fa-solid"><img src="../assets/img/icon/bin.png" alt="" width="30" height="30"></i></a>';
            echo '</td>';
            echo '</tr>';

            // Tingkatkan nomor urut
            $nomor_urut++;
        }
    } else {
        // Jika query gagal dieksekusi
        echo '<tr><td colspan="9">Data tidak ditemukan</td></tr>';
    }

    echo '</tbody>';
    echo '</table>';

    // Tutup koneksi ke database
    mysqli_close($conn);
} else {
    // Jika parameter tahun tidak ada dalam URL
    echo "Tahun tidak dipilih";
}
