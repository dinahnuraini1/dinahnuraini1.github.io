<?php
// Include file koneksi ke database
include '../koneksi.php';

session_start();

// Cek apakah parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    // Tangkap nilai id dari parameter URL
    $id = $_GET['id'];

    // Query untuk mendapatkan data narkoba berdasarkan id
    $query = "SELECT * FROM risiko WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    // Tambahkan debugging
    if (!$result) {
        die("Query Error: " . mysqli_error($conn));
    }

    // Cek apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Ambil data narkoba dari hasil query
        $row = mysqli_fetch_assoc($result);
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
            <title>Edit Data Pekerja</title>
            <meta content="" name="description">
            <meta content="" name="keywords">
            <!-- Favicons -->
            <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
            <link rel="icon" type="image/png" href="../assets/img/logo1.png">
            <!-- Google Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
            <!-- Vendor CSS Files -->
            <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
            <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
            <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
            <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
            <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
            <!-- Template Main CSS File -->
            <link href="../assets/css/main2.css" rel="stylesheet">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        </head>

        <body class="bgimg">
            <div class="container">
                <!-- Outer Row -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                    <div class="col-lg-12 text-center" style="padding-top:20px;">
                                        <img style="width: 100px;" src="../assets/img/logo1.png">
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="p-3 pb-4 pt-4">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Edit Data Pekerja Risiko Tinggi</h1>
                                            </div>
                                            <form class="user" method="post" id="nilaiForm" enctype="multipart/form-data" action="proses_edit_risiko.php">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control form-control-user" name="id" value="<?php echo $row['id']; ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="tanggal">Tahun:</label>
                                                    <input type="number" class="form-control" id="tanggal" name="tanggal" min="0" value="<?php echo ($row['tanggal']); ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="nipp">Nipp:</label>
                                                    <input type="number" class="form-control form-control-user" id="nipp" name="nipp" value="<?php echo ($row['nipp']); ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="nama">Nama:</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="unit">Unit Kerja:</label>
                                                    <input type="text" class="form-control" id="unit" name="unit" value="<?php echo $row['unit']; ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="rekomendasi">Diagnosa:</label>
                                                    <textarea class="form-control form-control-user" maxlength="200" id="rekomendasi" name="rekomendasi" maxlength="100" rows="4"><?php echo $row['rekomendasi']; ?></textarea>
                                                    <p style="color: red; font-style:italic;">*max 200 kata</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="diagnosa">Level:</label>
                                                    <select class="form-control" name="diagnosa" id="diagnosa" required>
                                                        <option value="Ringan" <?php if ($row['diagnosa'] == "Ringan") echo 'selected'; ?>>Ringan</option>
                                                        <option value="Sedang" <?php if ($row['diagnosa'] == "Sedang") echo 'selected'; ?>>Sedang</option>
                                                        <option value="Berat" <?php if ($row['diagnosa']  == "Berat") echo 'selected'; ?>>Berat</option>
                                                    </select>
                                                </div><br>

                                                <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                                <a href="promo.php" class="btn btn-danger btn-user btn-block">Kembali</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>

        </html>
<?php
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
?>