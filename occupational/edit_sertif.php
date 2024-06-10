<?php
// Include file koneksi ke database
include '../koneksi.php';


// Cek apakah parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    // Tangkap nilai id dari parameter URL
    $id = $_GET['id'];

    // Query untuk mendapatkan data pekerja berdasarkan id
    $query = "SELECT * FROM sertifikasi WHERE id = '$id'";
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

            <title>Edit Data Pekerja</title>
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
            <script>
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
            </script>


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
                                                <h1 class="h4 text-gray-900 mb-4">Edit Sertifikasi</h1>
                                            </div>

                                            <form class="user" method="post" action="proses_edit_sertif.php" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control form-control-user" name="id" value="<?php echo ($row['id']); ?>">
                                                </div><br>

                                                <div class="form-group">
                                                    <label for="tanggal">Tahun:</label>
                                                    <input type="number" class="form-control" id="tanggal" name="tanggal" value="<?php echo ($row['tanggal']); ?>">

                                                </div><br>
                                                <div class="form-group">
                                                    <label for="periode">Periode:</label>
                                                    <input type="text" class="form-control form-control-user" id="periode" name="periode" value="<?php echo ($row['periode']); ?>">

                                                </div><br>
                                                <div class="form-group">
                                                    <label for="uraian">Uraian:</label>
                                                    <textarea class="form-control form-control-user" id="uraian" name="uraian" maxlength="100" rows="4" style="white-space: pre-wrap;"><?php echo ($row['uraian']); ?></textarea>
                                                    <p style="color: red; font-style:italic;">*max 100 kata</p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="unit">Unit:</label>
                                                    <input class="form-control form-control-user" id="unit" name="unit" maxlength="100" rows="4" style="white-space: pre-wrap;" value="<?php echo ($row['unit']); ?>">
                                                </div><br>

                                                <!-- <div class="form-group">
                                                    <label for="program">Program:</label>
                                                    <input type="text" class="form-control" id="program" name="program" value="<?php echo ($row['program']); ?>">
                                                </div><br> -->
                                                <div class="form-group">
                                                    <label for="nilaiA">Nilai A:</label>
                                                    <input type="text" class="form-control form-control-user" id="nilaiA" name="nilai_a" value="<?php echo ($row['nilai_a']); ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="nilaiB">Nilai B:</label>
                                                    <input type="text" class="form-control form-control-user" id="nilaiB" name="nilai_b" value="<?php echo ($row['nilai_b']); ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="nilaiC">Nilai C:</label>
                                                    <input type="text" class="form-control form-control-user" id="nilaiC" name="nilai_c" value="<?php echo ($row['nilai_c']); ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <label for="nilaiD">Nilai D:</label>
                                                    <input type="text" class="form-control form-control-user" id="nilaiD" name="nilai_d" value="<?php echo ($row['nilai_d']); ?>">
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