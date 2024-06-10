<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>Unit Kesehatan | Daop 7 Madiun</title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
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
                            <div class="col-lg-12 text-center" style="padding-top:20px;">
                                <img style="width: 100px;" src="gambar/logo1.png">
                            </div>
                            <div class="col-lg-12">
                                <div class="p-3 pb-4 pt-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Tambah Data</h1>
                                    </div>
                                    <form class="user" method="post" action="action_tambah_faskes.php">
                                        <div class="form-group">
                                            <select class="form-select" name="jenis_provider" required>
                                                <option value="">Pilih Jenis Provider</option>
                                                <option value="Rumah Sakit">Rumah Sakit</option>
                                                <option value="Laboratorium">Laboratorium</option>
                                                <option value="Optik">Optik</option>
                                                <option value="Kontrak Profesi Dokter Praktik">Kontrak Profesi Dokter Praktik</option>
                                                <option value="Kontrak Profesi Dokter Penganggung Jawab">Kontrak Profesi Dokter Penganggung Jawab</option>
                                                <option value="Kontrak Profesi Apoteker">Kontrak Profesi Apoteker</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input style="border: 1px solid #ced4da;" class="form-control" type="text"  name="nama_provider" placeholder="Nama Provider" required>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input style="border: 1px solid #ced4da;" class="form-control" type="text"  name="lokasi" placeholder="Lokasi" required>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input style="border: 1px solid #ced4da;" class="form-control" type="text"  name="masa_berlaku" placeholder="Masa Berlaku" required>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input style="border: 1px solid #ced4da;" class="form-control" type="text"  name="no_kontrak" placeholder="Nomor Kontrak" required>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <select class="form-select" name="status_faskes" required>
                                                <option value="">Pilih Status</option>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Non Aktif">Non Aktif</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input style="border: 1px solid #ced4da;" class="form-control" type="text"  name="keterangan" placeholder="Keterangan" required>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                        <a href="faskes.php" class="btn btn-danger btn-user btn-block">Kembali</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</html>