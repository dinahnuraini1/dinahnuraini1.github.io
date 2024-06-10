<?php
// Include file koneksi ke database
include '../koneksi.php';


// Cek apakah parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    // Tangkap nilai id dari parameter URL
    $id = $_GET['id'];

    // Query untuk mendapatkan data pekerja berdasarkan id
    $query = "SELECT * FROM rikes WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    // Cek apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
        // Ambil data pekerja dari hasil query
        $row = mysqli_fetch_assoc($result);
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1.0" name="viewport">

            <title>Edit Data Rikes Khusus</title>
            <meta content="" name="description">
            <meta content="" name="keywords">

            <!-- Favicons -->
            <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
            <link rel="icon" type="image/png" href="../assets/img/logo1.png">


            <!-- Google Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

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


            <!-- =======================================================
  * Template Name: UpConstruction - v1.2.1
  * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
            <style>

            </style>
        </head>

        <body class="bgimg">
            <!-- <script>
                function validateForm() {
                    var nilaiA = parseInt(document.getElementById('nilaiA').value) || 0;
                    var nilaiB = parseInt(document.getElementById('nilaiB').value) || 0;
                    var nilaiC = parseInt(document.getElementById('nilaiC').value) || 0;
                    var nilaiD = parseInt(document.getElementById('nilaiD').value) || 0;
                    var program = parseInt(document.getElementById('program').value) || 0;

                    if ((nilaiA + nilaiB + nilaiC + nilaiD) !== program) {
                        alert('Total nilai A, B, C, dan D harus sama dengan nilai program.');
                        return false;
                    }
                    return true;
                }
            </script> -->


            <div class="container">

                <!-- Outer Row -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                    <div class="col-lg-12 text-center" style="padding-top:20px;"><img style="width: 100px;" src="../assets/img/logo1.png"></div>
                                    <div class="col-lg-12">
                                        <div class="p-3 pb-4 pt-4">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Edit Rikes Khusus</h1>
                                            </div>

                                            <form class="user" method="post" action="proses_edit_rikes.php" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control form-control-user" name="id" value="<?php echo ($row['id']); ?>">
                                                </div><br>

                                                <div class="form-group">
                                                    <label for="tanggal">Tanggal:</label>
                                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo ($row['tanggal']); ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="nama">nama:</label>
                                                    <input type="text" class="form-control form-control-user" id="nama" name="nama" value="<?php echo ($row['nama']); ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="nipp">Nipp:</label>
                                                    <input type="number" class="form-control form-control-user" id="nipp" name="nipp" value="<?php echo ($row['nipp']); ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="unit">Unit:</label>
                                                    <input type="text" class="form-control form-control-user" id="unit" name="unit" value="<?php echo ($row['unit']); ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="jabatan">Jabatan:</label>
                                                    <input type="text" class="form-control form-control-user" id="jabatan" name="jabatan" value="<?php echo ($row['jabatan']); ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="kedudukan">Kedudukan:</label>
                                                    <input type="text" class="form-control form-control-user" id="kedudukan" name="kedudukan" value="<?php echo ($row['kedudukan']); ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="kelas">Kelas Kesehatan:</label>
                                                    <select class="form-control" name="kelas" id="kelas" required>
                                                        <option value="Kelas Kesehatan I" <?php if ($row['kelas'] == "Kelas Kesehatan I") echo 'selected'; ?>>Kelas Kesehatan I</option>
                                                        <option value="Kelas Kesehatan II" <?php if ($row['kelas']  == "Kelas Kesehatan II") echo 'selected'; ?>>Kelas Kesehatan II</option>
                                                        <option value="Kelas Kesehatan III" <?php if ($row['kelas'] == "Kelas Kesehatan III") echo 'selected'; ?>>Kelas Kesehatan III</option>
                                                        <option value="Kelas Kesehatan IV" <?php if ($row['kelas']  == "Kelas Kesehatan IV") echo 'selected'; ?>>Kelas Kesehatan IV</option>
                                                        <option value="Kelas Kesehatan V" <?php if ($row['kelas']  == "Kelas Kesehatan V") echo 'selected'; ?>>Kelas Kesehatan V</option>
                                                    </select>
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="nilai">Nilai:</label>
                                                    <select class="form-control" name="nilai" id="nilai">
                                                        <option value="A" <?php if ($row['nilai'] == "A") echo "selected"; ?>>A</option>
                                                        <option value="B" <?php if ($row['nilai'] == "B") echo "selected"; ?>>B</option>
                                                        <option value="C" <?php if ($row['nilai'] == "C") echo "selected"; ?>>C</option>
                                                        <option value="D" <?php if ($row['nilai'] == "D") echo "selected"; ?>>D</option>
                                                    </select>
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="pdfFile">File PDF:</label>
                                                    <?php if (!empty($row['pdf'])) : ?>
                                                        <p><a href="<?php echo $row['pdf']; ?>" target="_blank">Lihat PDF </a></p>
                                                    <?php endif; ?>
                                                    <input type="file" class="form-control-file" id="pdfFile" name="pdf_file" accept="application/pdf">
                                                    <p style="color: red; font-style:italic;">*max 5MB</p>
                                                </div><br>

                                                <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                                <a href="rikes.php" class="btn btn-danger btn-user btn-block">Kembali</a>
                                            </form>

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