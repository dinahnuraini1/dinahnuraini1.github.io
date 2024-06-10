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
    <style>
        .display {
            /* white-space: pre-wrap; */
            /* Preserve line breaks */
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>


<body class="bgimg">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const programInput = document.getElementById("program");
            const nilaiInputs = document.querySelectorAll(".nilai-input");
            const totalWarning = document.getElementById("totalWarning");
            const form = document.getElementById("nilaiForm");
            const bulanInput = document.getElementById("bulan");
            const tahunInput = document.getElementById("tahun");
            const bulanTahunWarning = document.getElementById("bulanTahunWarning");

            // This should be populated from server-side to include all existing combinations
            const existingEntries = [{
                    year: "2024",
                    month: "Januari"
                },
                // Add other existing entries here
            ];

            function checkTotal() {
                let total = 0;
                nilaiInputs.forEach(input => {
                    total += parseInt(input.value) || 0;
                });
                return total;
            }

            function checkDuplicate() {
                const selectedYear = tahunInput.value;
                const selectedMonth = bulanInput.value;
                return existingEntries.some(entry => entry.year === selectedYear && entry.month === selectedMonth);
            }

            form.addEventListener("submit", function(event) {
                const programValue = parseInt(programInput.value) || 0;
                const totalNilai = checkTotal();

                if (totalNilai !== programValue || checkDuplicate()) {
                    event.preventDefault();
                    if (totalNilai !== programValue) {
                        totalWarning.style.display = "block";
                    } else {
                        totalWarning.style.display = "none";
                    }
                    if (checkDuplicate()) {
                        bulanTahunWarning.style.display = "block";
                    } else {
                        bulanTahunWarning.style.display = "none";
                    }
                } else {
                    totalWarning.style.display = "none";
                    bulanTahunWarning.style.display = "none";
                }
            });

            nilaiInputs.forEach(input => {
                input.addEventListener("input", function() {
                    const programValue = parseInt(programInput.value) || 0;
                    const totalNilai = checkTotal();

                    if (totalNilai !== programValue) {
                        totalWarning.style.display = "block";
                    } else {
                        totalWarning.style.display = "none";
                    }
                });
            });

            programInput.addEventListener("input", function() {
                const programValue = parseInt(programInput.value) || 0;
                const totalNilai = checkTotal();

                if (totalNilai !== programValue) {
                    totalWarning.style.display = "block";
                } else {
                    totalWarning.style.display = "none";
                }
            });

            bulanInput.addEventListener("input", function() {
                if (checkDuplicate()) {
                    bulanTahunWarning.style.display = "block";
                } else {
                    bulanTahunWarning.style.display = "none";
                }
            });

            tahunInput.addEventListener("input", function() {
                if (checkDuplicate()) {
                    bulanTahunWarning.style.display = "block";
                } else {
                    bulanTahunWarning.style.display = "none";
                }
            });
        });
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
                                        <h1 class="h4 text-gray-900 mb-4">Tambah Sertifikasi</h1>
                                    </div>
                                    <form class="user" method="post" id="nilaiForm" enctype="multipart/form-data" action="proses_tambah_sertif.php">
                                        <div class="form-group">
                                            <label for="tanggal">Tahun:</label>
                                            <input type="number" min="0" class="form-control" id="tanggal" name="tanggal" required>

                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="bulan">Bulan:</label>
                                            <select class="form-control" id="bulan" name="bulan" required>
                                                <option value="" selected>Pilih Bulan</option>
                                                <option value="Januari">Januari</option>
                                                <option value="Februari">Februari</option>
                                                <option value="Maret">Maret</option>
                                                <option value="April">April</option>
                                                <option value="Mei">Mei</option>
                                                <option value="Juni">Juni</option>
                                                <option value="Juli">Juli</option>
                                                <option value="Agustus">Agustus</option>
                                                <option value="September">September</option>
                                                <option value="Oktober">Oktober</option>
                                                <option value="November">November</option>
                                                <option value="Desember">Desember</option>
                                            </select>
                                        </div> -->
                                        <br>
                                        <div class="form-group">
                                            <label for="periode">Periode:</label>
                                            <input type="text" class="form-control" id="periode" name="periode" required>
                                            <br>
                                        </div>
                                        <div class="form-group">
                                            <label for="uraian">Uraian:</label>
                                            <textarea class="form-control form-control-user" maxlength=100 name="uraian" id="uraian" rows="4" required></textarea>
                                            <p style="color: red; font-style:italic;">*max 100 kata</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="unit">Unit:</label>
                                            <input type="text" class="form-control" id="unit" name="unit" required>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label for="program">Program:</label>
                                            <input type="number" class="form-control" id="program" name="program" min="0" required>
                                        </div> -->
                                        <br>
                                        <div class="form-group">
                                            <label for="nilaiA">Nilai A:</label>
                                            <input type="number" class="form-control nilai-input" id="nilaiA" name="nilai_a" min="0" required>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="nilaiB">Nilai B:</label>
                                            <input type="number" class="form-control nilai-input" id="nilaiB" name="nilai_b" min="0" required>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="nilaiC">Nilai C:</label>
                                            <input type="number" class="form-control nilai-input" id="nilaiC" name="nilai_c" min="0" required>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <label for="nilaiD">Nilai D:</label>
                                            <input type="number" class="form-control nilai-input" id="nilaiD" name="nilai_d" min="0" required>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input type="hidden" name="MAX_FILE_SIZE" value="5242880"> <!-- 5MB dalam byte -->
                                            <label for="pdfFile">Upload PDF:</label>
                                            <input type="file" class="form-control-file" id="pdfFile" name="pdf_file" accept="application/pdf">
                                            <p style="color: red; font-style:italic;">*max 5MB</p>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <p id="totalWarning" style="color: red; display: none;">Total nilai harus berjumlah sama dengan nilai program!</p>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                        <a href="rikes.php" class="btn btn-danger btn-user btn-block">Kembali</a>
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