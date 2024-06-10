<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Human Capital</title>
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
    <script>
        function sortTableByJobPosition(newJobPosition) {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("profilTable");
            switching = true;
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("td")[2]; // Kolom jabatan berada di indeks 2 (kolom ke-3)
                    y = rows[i + 1].getElementsByTagName("td")[2]; // Kolom jabatan berada di indeks 2 (kolom ke-3)

                    // Penanganan khusus untuk memasukkan data baru
                    if (newJobPosition && y.innerHTML.toLowerCase() === newJobPosition.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }

                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }
        // Setelah menambahkan data karyawan baru, panggil fungsi sortTableByJobPosition() untuk menyortir tabel berdasarkan jabatan
        sortTableByJobPosition();
    </script>



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
                                        <h1 class="h4 text-gray-900 mb-4">Tambah Data Pekerja</h1>
                                    </div>
                                    <form class="user" method="post" action="proses_tambah.php" onsubmit="handleSubmitForm()" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="nipp" name="nipp" placeholder="NIPP" required>
                                        </div><br>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="nama" id="nama" placeholder="Nama" required>
                                        </div><br>
                                        <div class="form-group">

                                            <select class="form-control" name="jabatan" id="jabatan" required onchange="sortTableByJobPosition(this.value)">
                                                <option value="">Pilih Jabatan</option>
                                                <option value="Manager Kesehatan">Manager Kesehatan</option>
                                                <option value="Dokter Fungsional 3">Dokter Fungsional 3</option>
                                                <option value="Assistant Manager Kesehatan Kerja">Assistant Manager Kesehatan Kerja</option>
                                                <option value="Assistant Manager Pelayanan & Kepesertaan">Assistant Manager Pelayanan & Kepesertaan</option>
                                                <option value="Pelaksana Kesehatan Kerja">Pelaksana Kesehatan Kerja</option>
                                                <option value="Kepala Klinik Pratama Kelas I Madiun">Kepala Klinik Pratama Kelas I Madiun</option>
                                                <option value="Paramedis Klinik Pratama Kelas I Madiun">Paramedis Klinik Pratama Kelas I Madiun</option>
                                                <option value="Apoteker Klinik Pratama Kelas I Madiun">Apoteker Klinik Pratama Kelas I Madiun</option>
                                                <option value="Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Madiun">Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Madiun</option>
                                                <option value="Paramedis Pos Pemeriksaan Kesehatan Crew KA Madiun">Paramedis Pos Pemeriksaan Kesehatan Crew KA Madiun</option>
                                                <option value="Asisten Apoteker Klinik Pratama Kelas I Madiun">Asisten Apoteker Klinik Pratama Kelas I Madiun</option>
                                                <option value="Kepala Klinik Pratama Kelas II Blitar">Kepala Klinik Pratama Kelas II Blitar</option>
                                                <option value="Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Blitar">Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Blitar</option>
                                                <option value="Kepala Klinik Pratama Kelas II Kediri">Kepala Klinik Pratama Kelas II Kediri</option>
                                                <option value="Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Kediri">Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Kediri</option>
                                                <option value="Kepala Klinik Pratama Kelas II Kertosono">Kepala Klinik Pratama Kelas II Kertosono</option>
                                                <option value="Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Kertosono">Paramedis Pos Kesehatan / Pos Pemeriksaan Stasiun Kertosono</option>
                                                <option value="Pelaksana Administrasi Klinik Pratama Kelas II Kertosono">Pelaksana Administrasi Klinik Pratama Kelas II Kertosono</option>
                                            </select>

                                        </div><br>


                                        <div class="form-group">
                                            <select class="form-control" name="kedudukan" id="kedudukan" required>
                                                <option value="">Pilih Kedudukan</option>
                                                <option value="Kantor Unit Kesehatan">Kantor Unit Kesehatan</option>
                                                <option value="Klinik Mediska Madiun">Klinik Mediska Madiun</option>
                                                <option value="Pos Kesehatan / Pos Pemeriksaan Stasiun Madiun">Pos Kesehatan / Pos Pemeriksaan Stasiun Madiun</option>
                                                <option value="Pos Pemeriksaan Kesehatan Crew KA Madiun">Pos Pemeriksaan Kesehatan Crew KA Madiun</option>
                                                <option value="Klinik Mediska Blitar">Klinik Mediska Blitar</option>
                                                <option value="Pos Kesehatan / Pos Pemeriksaan Stasiun Blitar">Pos Kesehatan / Pos Pemeriksaan Stasiun Blitar</option>
                                                <option value="Klinik Mediska Kediri">Klinik Mediska Kediri</option>
                                                <option value="Pos Kesehatan / Pos Pemeriksaan Stasiun Kediri">Pos Kesehatan / Pos Pemeriksaan Stasiun Kediri</option>
                                                <option value="Klinik Mediska Kertosono">Klinik Mediska Kertosono</option>
                                                <option value="Pos Kesehatan / Pos Pemeriksaan Stasiun Kertosono">Pos Kesehatan / Pos Pemeriksaan Stasiun Kertosono</option>
                                            </select>
                                        </div><br>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="tempat_lhr" id="tempat_lhr" placeholder="Tempat Lahir" required>
                                            <br>
                                            <input type="date" class="form-control form-control-user" name="tgl" id="tgl" placeholder=" Tanggal Lahir" required>
                                            <br>
                                            <div class="form-group" style="margin-top: 10px;">
                                                <select class="form-control" name="pend" id="pend" required>
                                                    <option value="">Pilih Pendidikan Terakhir</option>
                                                    <option value="SLTP">SLTP</option>
                                                    <option value="SLTA">SLTA</option>
                                                    <option value="D3">D3</option>
                                                    <option value="D4">D4</option>
                                                    <option value="S1">S1</option>
                                                    <option value="S2">S2</option>
                                                    <option value="S3">S3</option>
                                                </select>
                                            </div><br>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" name="profesi" id="profesi" placeholder="profesi" required>
                                            </div><br>
                                            <div class="form-group">
                                                <input type="file" class="form-control-file" name="gambar" id="gambar" required>
                                            </div><br>
                                            <button type="submit" class="btn btn-primary btn-user btn-block" onclick=" submitForm()">Simpan</button>
                                            <a href="human_capital.php" class="btn btn-danger btn-user btn-block">Kembali</a>
                                    </form>
                                    <script>
                                        function capitalizeWords(input) {
                                            input.value = input.value.replace(/\b\w/g, function(char) {
                                                return char.toUpperCase();
                                            });
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>