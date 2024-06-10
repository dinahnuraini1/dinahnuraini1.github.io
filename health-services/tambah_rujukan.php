<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>Unit Kesehatan | Daop 7 Madiun</title>
  <!-- Fonts and icons -->
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
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    .card {
      max-width: 600px;
      margin: auto;
    }
    .form-select, .form-control {
      border: 1px solid #ced4da !important;
    }
  </style>
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
                                    <form class="user" method="post" action="action_tambah_rujukan.php">
                                        <div class="form-group">
                                            <select class="form-select" name="jenis_rujukan" required>
                                                <option value="">Pilih Jenis Rujukan</option>
                                                <option value="RJTL">Rujukan Pasien Rawat Jalan Tingkat Lanjut (RJTL)</option>
                                                <option value="RI">Rujukan Pasien Rawat Inap (RI) </option>
                                            </select>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="text" name="ppk_provider" placeholder="Provider" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="number" name="januari" placeholder="Januari" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="number" name="februari" placeholder="Februari" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="number" name="maret" placeholder="Maret" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="number" name="april" placeholder="April" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="number" name="mei" placeholder="Mei" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="number" name="juni" placeholder="Juni" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="number" name="juli" placeholder="Juli" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="number" name="agustus" placeholder="Agustus" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="number" name="september" placeholder="September" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="number" name="oktober" placeholder="Oktober" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="number" name="november" placeholder="November" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="number" name="desember" placeholder="Desember" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input class="form-control" type="number" name="tahun" placeholder="Tahun" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                        <a href="kunjungan_klinik.php" class="btn btn-danger btn-user btn-block">Kembali</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
