<?php
// Include file koneksi ke database
include '../koneksi.php';

// Cek apakah parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    // Tangkap nilai id dari parameter URL
    $id = $_GET['id'];

    // Query untuk mendapatkan data pekerja berdasarkan id
    $query = "SELECT * FROM pic_blitar WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    // Cek apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Tampilkan kotak dialog konfirmasi sebelum menghapus data
        echo "<script>
                var confirmation = confirm('Apakah Anda yakin ingin menghapus data?');
                if (confirmation) {
                    // Jika pengguna mengonfirmasi, lanjutkan dengan menghapus data
                    window.location.href = 'proses_hapus_blitar.php?id=$id';
                } else {
                    // Jika pengguna membatalkan, kembali ke halaman sebelumnya
                    window.history.back();
                }
              </script>";
    } else {
        // Jika data tidak ditemukan, tampilkan pesan error
        echo "Data tidak ditemukan.";
    }
} else {
    // Jika parameter id tidak diterima dari URL, tampilkan pesan error
    echo "ID tidak ditemukan.";
}

// Tutup koneksi ke database
mysqli_close($conn);
