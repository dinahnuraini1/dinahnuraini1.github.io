<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Occupational Health</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/logo1.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
            <div class="col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12 text-center" style="padding-top:20px;"><img style="width: 100px;" src="../assets/img/logo1.png"></div>
                            <div class="col-lg-12">
                                <div class="p-3 pb-4 pt-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Tambah Flyer</h1>
                                    </div>
                                    <form class="user" method="post" enctype="multipart/form-data" action="tambah.php">

                                        <div class="form-group">
                                            <input type="file" class="form-control-file" name="gambar" id="gambar" required>
                                            <p style="color: red; font-style:italic;">*Maksimum 2MB</p>
                                        </div>

                                        <div class="form-group">
                                            <label for="judul">Judul:</label>
                                            <input type="text" class="form-control" id="judul" name="judul" maxlength="50" required>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="tanggal">Tanggal:</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                                        </div><br>

                                        <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                        <a href="flyer.php" class="btn btn-danger btn-user btn-block">Kembali</a>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

   

    <!-- Custom scripts for all pages-->
    <!-- <script src="../assets/js/sb-admin-2.min.js"></script> -->
    <!-- <script>
        $(document).ready(function() {
            // Tangani submit form
            $('form').submit(function(event) {
                event.preventDefault(); // Menghentikan pengiriman form default

                // Buat objek FormData
                var formData = new FormData(this);

                // Lakukan kueri AJAX untuk mengunggah gambar
                $.ajax({
                    type: "POST",
                    url: "proses_tambahgambar.php",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.error) {
                            alert(response.message); // Tampilkan pesan error
                        } else {
                            alert(response.message); // Tampilkan pesan berhasil
                            window.location.href = 'index.php'; // Redirect jika perlu
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script> -->


</body>

</html>