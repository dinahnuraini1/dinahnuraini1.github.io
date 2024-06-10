<?php
// Include file koneksi ke database
include '../koneksi.php';

// Cek apakah parameter id telah diterima dari URL
if (isset($_GET['id'])) {
    // Tangkap nilai id dari parameter URL
    $id = $_GET['id'];

    // Query untuk mendapatkan data pekerja berdasarkan id
    $query = "SELECT * FROM user_uk WHERE nipp = '$id'";
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
        </head>

        <body class="bgimg">

            <div class="container">

                <!-- Outer Row -->
                <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12 col-md-9">
                        <div class="card o-hidden border-0 shadow-lg my-5">
                            <div class="card-body p-0">
                                <!-- Nested Row within Card Body -->
                                <div class="row">
                                    <div class="col-lg-12 text-center" style="padding-top:20px;"><img style="width: 100px;" src="../assets/img/logo1.png"></div>
                                    <div class="col-lg-12">
                                        <div class="p-3 pb-4 pt-4">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Edit Data Pekerja</h1>
                                            </div>

                                            <form class="user" method="post" action="proses_edit.php" onsubmit="return validateForm()" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control form-control-user" name=" id" value="<?php echo $row['nipp']; ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user" id="nama" name="nama" value="<?php echo $row['nama']; ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <select class="form-control" name="jabatan" id="jabatan">
                                                        <option value="Manager Kesehatan" <?php if ($row['jabatan'] == "Manager Kesehatan") echo "selected"; ?>>Manager Kesehatan</option>
                                                        <option value="Dokter Fungsional 3" <?php if ($row['jabatan'] == "Dokter Fungsional 3") echo "selected"; ?>>Dokter Fungsional 3</option>
                                                        <option value="Assistant Manager Kesehatan Kerja" <?php if ($row['jabatan'] == "Assistant Manager Kesehatan Kerja") echo "selected"; ?>>Assistant Manager Kesehatan Kerja</option>
                                                        <option value="Assistant Manager Pelayanan & Kepesertaan" <?php if ($row['jabatan'] == "Assistant Manager Pelayanan & Kepesertaan") echo "selected"; ?>>Assistant Manager Pelayanan & Kepesertaan</option>
                                                        <option value="Pelaksana Kesehatan Kerja" <?php if ($row['jabatan'] == "Pelaksana Kesehatan Kerja") echo "selected"; ?>>Pelaksana Kesehatan Kerja</option>
                                                        <option value="Kepala Klinik Pratama Kelas I Madiun" <?php if ($row['jabatan'] == "Kepala Klinik Pratama Kelas I Madiun") echo "selected"; ?>>Kepala Klinik Pratama Kelas I Madiun</option>
                                                        <option value="Paramedis Klinik Pratama Kelas I Madiun" <?php if ($row['jabatan'] == "Paramedis Klinik Pratama Kelas I Madiun") echo "selected"; ?>>Paramedis Klinik Pratama Kelas I Madiun</option>
                                                        <option value="Apoteker Klinik Pratama Kelas I Madiun" <?php if ($row['jabatan'] == "Apoteker Klinik Pratama Kelas I Madiun") echo "selected"; ?>>Apoteker Klinik Pratama Kelas I Madiun</option>
                                                        <option value="Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Madiun" <?php if ($row['jabatan'] == "Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Madiun") echo "selected"; ?>>Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Madiun</option>
                                                        <option value="Paramedis Pos Pemeriksaan Kesehatan Crew KA Madiun" <?php if ($row['jabatan'] == "Paramedis Pos Pemeriksaan Kesehatan Crew KA Madiun") echo "selected"; ?>>Paramedis Pos Pemeriksaan Kesehatan Crew KA Madiun</option>
                                                        <option value="Asisten Apoteker Klinik Pratama Kelas I Madiun" <?php if ($row['jabatan'] == "Asisten Apoteker Klinik Pratama Kelas I Madiun") echo "selected"; ?>>PAsisten Apoteker Klinik Pratama Kelas I Madiun</option>
                                                        <option value="Kepala Klinik Pratama Kelas II Blitar" <?php if ($row['jabatan'] == "Kepala Klinik Pratama Kelas II Blitar") echo "selected"; ?>>Kepala Klinik Pratama Kelas II Blitar</option>
                                                        <option value="Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Blitar" <?php if ($row['jabatan'] == "Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Blitar") echo "selected"; ?>>Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Blitar</option>
                                                        <option value="Kepala Klinik Pratama Kelas II Kediri" <?php if ($row['jabatan'] == "Kepala Klinik Pratama Kelas II Kediri") echo "selected"; ?>>Kepala Klinik Pratama Kelas II Kediri</option>
                                                        <option value="Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Kediri" <?php if ($row['jabatan'] == "Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Kediri") echo "selected"; ?>>Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Kediri</option>
                                                        <option value="Kepala Klinik Pratama Kelas II Kertosono" <?php if ($row['jabatan'] == "Kepala Klinik Pratama Kelas II Kertosono") echo "selected"; ?>>Kepala Klinik Pratama Kelas II Kertosono</option>
                                                        <option value="Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Kertosono" <?php if ($row['jabatan'] == "Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Kertosono") echo "selected"; ?>>Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Kertosono</option>
                                                        <option value="Pelaksana Administrasi Klinik Pratama Kelas II Kertosono" <?php if ($row['jabatan'] == "Pelaksana Administrasi Klinik Pratama Kelas II Kertosono") echo "selected"; ?>>Pelaksana Administrasi Klinik Pratama Kelas II Kertosono</option>
                                                    </select>
                                                </div><br>
                                                <div class="form-group">
                                                    <!-- <input type="text" class="form-control form-control-user" id="kedudukan" name="kedudukan" value="<?php echo $row['kedudukan']; ?>"> -->
                                                    <select class="form-control" name="kedudukan" id="kedudukan" required>
                                                        <option value="Kantor Unit Kesehatan" <?php if ($row['kedudukan'] == "Kantor Unit Kesehatan") echo "selected"; ?>>Kantor Unit Kesehatan</option>
                                                        <option value="Klinik Mediska Madiun" <?php if ($row['kedudukan'] == "Klinik Mediska Madiun") echo "selected"; ?>>Klinik Mediska Madiun</option>
                                                        <option value="Pos Kesehatan / Pos Pemeriksaan Stasiun Madiun" <?php if ($row['kedudukan'] == "Pos Kesehatan / Pos Pemeriksaan Stasiun Madiun") echo "selected"; ?>>Pos Kesehatan / Pos Pemeriksaan Stasiun Madiun</option>
                                                        <option value="Pos Pemeriksaan Kesehatan Crew KA Madiun" <?php if ($row['kedudukan'] == "Pos Pemeriksaan Kesehatan Crew KA Madiun") echo "selected"; ?>>Pos Pemeriksaan Kesehatan Crew KA Madiun</option>
                                                        <option value="Klinik Mediska Blitar" <?php if ($row['kedudukan'] == "Klinik Mediska Blitar") echo "selected"; ?>>Klinik Mediska Blitar</option>
                                                        <option value="Pos Kesehatan / Pos Pemeriksaan Stasiun Blitar" <?php if ($row['kedudukan'] == "Pos Kesehatan / Pos Pemeriksaan Stasiun Blitar") echo "selected"; ?>>Pos Kesehatan / Pos Pemeriksaan Stasiun Blitar</option>
                                                        <option value="Klinik Mediska Kediri" <?php if ($row['kedudukan'] == "Klinik Mediska Kediri") echo "selected"; ?>>Klinik Mediska Kediri</option>
                                                        <option value="Pos Kesehatan / Pos Pemeriksaan Stasiun Kediri" <?php if ($row['kedudukan'] == "Pos Kesehatan / Pos Pemeriksaan Stasiun Kediri") echo "selected"; ?>></option>
                                                        <option value="Klinik Mediska Kertosono" <?php if ($row['kedudukan'] == "Klinik Mediska Kertosono") echo "selected"; ?>>Klinik Mediska Kertosono</option>
                                                        <option value="Pos Kesehatan / Pos Pemeriksaan Stasiun Kertosono" <?php if ($row['kedudukan'] == "Pos Kesehatan / Pos Pemeriksaan Stasiun Kertosono") echo "selected"; ?>>Pos Kesehatan / Pos Pemeriksaan Stasiun Kertosono</option>
                                                    </select>
                                                </div><br>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-user" id="tempat_lhr" name="tempat_lhr" value="<?php echo $row['tempat_lhr']; ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <!-- <input type="text" class="form-control form-control-user" id="pend" name="pend" value="<?php echo $row['pend']; ?>"> -->
                                                    <select class="form-control" name="pend" id="pend" required>
                                                        <option value="SLTP" <?php if ($row['pend'] == "SLTP") echo "selected"; ?>>SLTP</option>
                                                        <option value="SLTA" <?php if ($row['pend'] == "SLTA") echo "selected"; ?>>SLTA</option>
                                                        <option value="D3" <?php if ($row['pend'] == "D3") echo "selected"; ?>>D3</option>
                                                        <option value="D4" <?php if ($row['pend'] == "D4") echo "selected"; ?>>D4</option>
                                                        <option value="S1" <?php if ($row['pend'] == "S1") echo "selected"; ?>>S1</option>
                                                        <option value="S2" <?php if ($row['pend'] == "S2") echo "selected"; ?>>S2</option>
                                                        <option value="S3" <?php if ($row['pend'] == "S3") echo "selected"; ?>>S3</option>
                                                    </select>
                                                </div><br>
                                                <div class="form-group">

                                                    <input type="text" class="form-control form-control-user" id="profesi" name="profesi" value="<?php echo $row['profesi']; ?>">
                                                </div><br>
                                                <div class="form-group">
                                                    <input type="file" class="form-control-file" name="gambar" id="gambar">
                                                </div><br>
                                                <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                                <a href="human_capital.php" class="btn btn-danger btn-user btn-block">Kembali</a>
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