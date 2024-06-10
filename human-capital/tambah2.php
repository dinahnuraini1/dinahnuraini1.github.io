<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Human Capital</title>
    <meta content="" name="description">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/logo1.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../assets/css/main2.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="bgimg">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="col-lg-12 text-center" style="padding-top:20px;">
                    <img style="width: 100px;" src="../assets/img/logo1.png">
                </div>
                <div class="p-3 pb-4 pt-4">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Tambah Data Pekerja</h1>
                    </div>
                    <form class="user" method="post" action="proses_tambah2.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="kedudukan">Pilih Kedudukan:</label>
                            <select class="form-control" name="kedudukan" id="kedudukan" onchange="showHideJobOptions()" required>
                                <option value="">
                                    << Pilih >>
                                </option>
                                <option value="Kantor Unit Kesehatan">Kantor Unit Kesehatan</option>
                                <option value="Klinik Mediska Madiun">Klinik Mediska Madiun</option>
                                <option value="Klinik Mediska Blitar">Klinik Mediska Blitar</option>
                                <option value="Klinik Mediska Kediri">Klinik Mediska Kediri</option>
                                <option value="Klinik Mediska Kertosono">Klinik Mediska Kertosono</option>
                            </select>
                        </div><br>
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control form-control-user" name="nama" id="nama" placeholder="Nama" required>
                        </div><br>
                        <div class="form-group">
                            <label for="nipp">NIPP:</label>
                            <input type="number" class="form-control form-control-user" id="nipp" name="nipp" required>
                        </div><br>
                        <div class="form-group">
                            <label for="jabatan">Jabatan:</label>
                            <input type="text" class="form-control form-control-user" name="jabatan" id="jabatan" required>
                            <!-- <select class="form-control" name="jabatan" id="jabatan">
                                                <option value="">Pilih Jabatan</option>
                                                <option value="Manager Kesehatan" data-group="kantor unit kesehatan">Manager Kesehatan</option>
                                                <option value="Assistant Manager Kesehatan Kerja" data-group="kantor unit kesehatan">Assistant Manager Kesehatan Kerja</option>
                                                <option value="Assistant Manager Pelayanan & Kepesertaan" data-group="kantor unit kesehatan">Assistant Manager Pelayanan & Kepesertaan</option>
                                                <option value="Pelaksana Kesehatan Kerja" data-group="kantor unit kesehatan">Pelaksana Kesehatan Kerja</option>
                                                <option value="Asisten Apoteker Klinik Mediska Madiun" data-group="kantor unit kesehatan">Asisten Apoteker Klinik Mediska Madiun</option>


                                                <option value="Kepala Klinik Mediska Madiun" data-group="klinik mediska madiun">Kepala Klinik Mediska Madiun</option>
                                                <option value="Dokter Fungsional 3" data-group="klinik mediska madiun">Dokter Fungsional 3</option>
                                                <option value="Paramedis Klinik Mediska Madiun" data-group="klinik mediska madiun">Paramedis Klinik Mediska Madiun</option>
                                                <option value="Apoteker Klinik Mediska Madiun" data-group="klinik mediska madiun">Apoteker Klinik Mediska Madiun</option>
                                                <option value="Paramedis Pos Kesehatan Stasiun Madiun" data-group="klinik mediska madiun">Paramedis Pos Kesehatan Stasiun Madiun</option>
                                                <option value="Paramedis Pos Pemeriksaan Kesehatan Crew KA Madiun" data-group="klinik mediska madiun">Paramedis Pos Pemeriksaan Kesehatan Crew KA Madiun</option>


                                                <option value="Kepala Klinik Mediska Blitar" data-group="klinik mediska blitar">Kepala Klinik Mediska Blitar</option>
                                                <option value="Paramedis Pos Kesehatan Stasiun Blitar" data-group="klinik mediska blitar">Paramedis Pos Kesehatan Stasiun Blitar</option>


                                                <option value="Kepala Klinik Mediska Kediri" data-group="klinik mediska kediri">Kepala Klinik Mediska Kediri</option>
                                                <option value="Paramedis Pos Kesehatan Stasiun Kediri" data-group="klinik mediska kediri">Paramedis Pos Kesehatan Stasiun Kediri</option>


                                                <option value="Kepala Klinik Mediska Kertosono" data-group="klinik mediska kertosono">Kepala Klinik Mediska Kertosono</option>
                                                <option value="Paramedis Pos Kesehatan Stasiun Kertosono" data-group="klinik mediska kertosono">Paramedis Pos Kesehatan Stasiun Kertosono</option>
                                                <option value="Pelaksana Administrasi Klinik Mediska Kertosono" data-group="klinik mediska kertosono">Pelaksana Administrasi Klinik Mediska Kertosono</option>
                                            </select> -->

                        </div><br>


                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="">
                                    << Pilih >>
                                </option>
                                <option value="Organik">Organik</option>
                                <option value="Kontrak profesi">Kontrak Profesi</option>

                            </select>
                        </div><br>
                        <div class="form-group">
                            <label for="tempat_lhr">Tempat Lahir:</label>
                            <input type="text" class="form-control form-control-user" name="tempat_lhr" id="tempat_lhr" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="tgl">Tanggal Lahir:</label>
                            <input type="date" class="form-control form-control-user" name="tgl" id="tgl" placeholder=" Tanggal Lahir" required>
                        </div>
                        <br>
                        <div class="form-group" style="margin-top: 10px;">
                            <label for="pend">Pendidikan Terakhir:</label>
                            <select class="form-control" name="pend" id="pend" required>
                                <option value="">
                                    << Pilih >>
                                </option>
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
                            <label for="profesi">Profesi:</label>
                            <input type="text" class="form-control form-control-user" name="profesi" id="profesi" placeholder="Profesi" required>
                        </div><br>
                        <div class="form-group">
                            <label for="gambar">Upload Gambar:</label><br>
                            <input type="file" class="form-control-file" name="gambar" id="gambar" required>
                        </div><br>
                        <button type="submit" class="btn btn-primary btn-user btn-block" onclick=" submitForm()">Simpan</button>
                        <a href="coba.php" class="btn btn-danger btn-user btn-block">Kembali</a>
                    </form>
                    <script>
                        function capitalizeWords(input) {
                            input.value = input.value.replace(/\b\w/g, function(char) {
                                return char.toUpperCase();
                            });
                        }
                    </script>
                </div>
                <script>
                    function showHideJobOptions() {
                        var kedudukan = document.getElementById("kedudukan").value;
                        var jabatanOptions = document.getElementById("jabatan").getElementsByTagName("option");

                        // Semua opsi jabatan disembunyikan terlebih dahulu
                        for (var i = 0; i < jabatanOptions.length; i++) {
                            jabatanOptions[i].style.display = "none";
                        }
                        switch (kedudukan) {
                            case "Kantor Unit Kesehatan":
                                document.querySelectorAll("[data-group='kantor unit kesehatan']").forEach(function(option) {
                                    option.style.display = "block";
                                });
                                break;
                            case "Klinik Mediska Madiun":
                                document.querySelectorAll("[data-group='klinik mediska madiun']").forEach(function(option) {
                                    option.style.display = "block";
                                });
                                break;
                            case "Klinik Mediska Kertosono":
                                document.querySelectorAll("[data-group='klinik mediska kertosono']").forEach(function(option) {
                                    option.style.display = "block";
                                });
                                break;
                            case "Klinik Mediska Kediri":
                                document.querySelectorAll("[data-group='klinik mediska kediri']").forEach(function(option) {
                                    option.style.display = "block";
                                });
                                break;
                            case "Klinik Mediska Blitar":
                                document.querySelectorAll("[data-group='klinik mediska blitar']").forEach(function(option) {
                                    option.style.display = "block";
                                });
                                break;

                            default:
                                break;
                        }
                    }
                </script>
            </div>
        </div>
    </div>
    </div>
</body>

</html>