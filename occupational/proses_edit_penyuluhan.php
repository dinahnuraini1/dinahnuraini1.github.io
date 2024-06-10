<?php
// Include file koneksi ke database
include '../koneksi.php';

// Cek apakah data telah dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap nilai input dari formulir
    $id = $_POST['id'];
    // $tahun = $_POST['tahun'];
    $tanggal = $_POST['tanggal'];
    $uraian = $_POST['uraian'];
    $tema = $_POST['tema'];
    $jumlah = $_POST['jumlah'];

    $uraian = ucwords(strtolower($uraian));
    $tema = ucwords(strtolower($tema));

    // Proses upload gambar baru jika ada yang diunggah
    if ($_FILES['gambar']['name'] != "") {
        $folder = "../dokumentasi_penyuluhan/";
        $nama_p = $_FILES['gambar']['name'];
        $sumber_p = $_FILES['gambar']['tmp_name'];

        // Cek ukuran gambar
        if ($_FILES["gambar"]["size"] > 2000000) {
            echo "<script>alert('Maaf, ukuran gambar terlalu besar. Maksimum 2MB.'); window.location.href = 'edit_penyuluhan.php?id=$id';</script>";
            exit;
        }

        // Cek tipe file gambar
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check !== false) {
            $imageFileType = strtolower(pathinfo($nama_p, PATHINFO_EXTENSION));

            // Izinkan hanya beberapa format gambar tertentu
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "<script>alert('Maaf, hanya format JPG, JPEG, PNG, dan GIF yang diizinkan.'); window.location.href = 'edit_penyuluhan.php?id=$id';</script>";
                exit;
            }
        } else {
            echo "<script>alert('Maaf, file yang diunggah bukanlah gambar.'); window.location.href = 'edit_penyuluhan.php?id=$id';</script>";
            exit;
        }

        /// Upload gambar baru
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $folder . $nama_p)) {
            // Update data pekerja termasuk gambar
            $sql = "UPDATE penyuluhan SET  tanggal='$tanggal', uraian='$uraian', tema='$tema', jumlah='$jumlah', gambar='$nama_p' WHERE id='$id'";
        } else {
            echo "<script>alert('Maaf, terjadi kesalahan saat mengupload gambar.'); window.location.href = 'edit_penyuluhan.php?id=$id';</script>";
            exit;
        }
    } else {
        // Update data pekerja tanpa mengubah gambar
        $sql = "UPDATE penyuluhan SET tanggal='$tanggal', uraian='$uraian', tema='$tema', jumlah='$jumlah' WHERE id='$id'";
    }

    // Eksekusi query
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Data berhasil diperbarui!');
                window.location.href = 'promo.php';
              </script>";
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Tutup koneksi ke database
    mysqli_close($conn);
} else {
    // Jika tidak, tampilkan pesan bahwa data tidak ditemukan
    echo "Data tidak ditemukan.";
}
