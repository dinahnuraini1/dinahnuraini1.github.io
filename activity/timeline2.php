<?php
include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Unit Kesehatan | Daop 7 Madiun</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/logo1.png">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">



    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">




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
    <style>
        .icon-white {
            filter: brightness(0) invert(1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #C6EBC5;
            color: black;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="services.php" target="_blank">
                <span class="ms-1 font-weight-bold text-white">Activity Plan</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-white" href="dashboard.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">dashboard</i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="timeline1.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class=""><img src="gambar/doctor-consultation.png" alt="" width="20" height="20"></i>
                        </div>
                        <span class="nav-link-text ms-1">TimeLine</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="timeline2.php" style="background-color: #C6EBC5;">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class=""><img src="gambar/hospital.png" alt="" width="20" height="20"></i>
                        </div>
                        <span class="nav-link-text ms-1">PIC</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidenav-footer position-absolute w-100 bottom-0 ">
            <div class="mx-3">
                <a class="btn w-100" href="../index.php" type="button" style="background-color: #C6EBC5; color:black">Kembali</a>
            </div>
        </div>
    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                </nav>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            </div>
        </nav>

        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="border-radius-lg pt-4 pb-3" style="background-color: #C6EBC5;">
                                <h6 class="text-black text-capitalize ps-3">Activity Plan PIC</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <section id="service-details" class="service-details">

                                    <?php
                                    include '../koneksi.php';
                                    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                                    $displayKeyword = $keyword; // Save original keyword for displaying in the search box

                                    // Modify query to filter by keyword if provided
                                    if (!empty($keyword)) {
                                        $query = "SELECT * FROM tb_timeline WHERE pic LIKE ?";
                                        $stmt = $conn->prepare($query);
                                        $keyword = "%" . $keyword . "%"; // Add wildcard for SQL query
                                        $stmt->bind_param('s', $keyword);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                    } else {
                                        $query = "SELECT * FROM tb_timeline";
                                        $result = mysqli_query($conn, $query);
                                    }
                                    ?>

                                    <div class="container" data-aos="fade-up" data-aos-delay="100">
                                        <div class="form-container">
                                            <form action="timeline2.php" method="GET" class="form-inline">
                                                <div class="input-group" style="max-width: 300px;"> <!-- Set the width of the input group -->
                                                    <input type="text" name="keyword" class="form-control" placeholder="Cari..." value="<?php echo htmlspecialchars($displayKeyword); ?>">
                                                    <div class="input-group-append">
                                                        <button id="search-button" class="btn btn-success" type="submit" style="background-color: #C6EBC5; color:black">Cari</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <br>
                                        <a href="tambah.php">
                                            <i class="fa-solid"><img src="../assets/img/icon/plus.png" alt="" width="30" height="30"></i>
                                        </a>
                                        <br><br>
                                        <!-- TABLE IP -->
                                        <div class="row">
                                            <div class="col-md-15">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-sm" style="text-align: center; border:1px;">
                                                        <thead>
                                                            <tr style="background-color: #C6EBC5;">
                                                                <th style="border:1px solid black;">No</th>
                                                                <th style="border:1px solid black;">Uraian</th>
                                                                <th style="border:1px solid black;">Dateline</th>
                                                                <th style="border:1px solid black;">PIC</th>
                                                                <th style="border:1px solid black;">Status</th>
                                                                <th style="width: 100px; border:1px solid black;">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $i = 1;
                                                            $processRows = [];
                                                            $otherRows = [];

                                                            // Separate rows into 'Process' and others
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                if ($row['status'] == 'Process') {
                                                                    $processRows[] = $row;
                                                                } else {
                                                                    $otherRows[] = $row;
                                                                }
                                                            }

                                                            // Function to sort rows by date
                                                            function sortByDate($a, $b)
                                                            {
                                                                $dateA = strtotime($a['tanggal']);
                                                                $dateB = strtotime($b['tanggal']);
                                                                return $dateA - $dateB;
                                                            }

                                                            // Sort rows by date
                                                            usort($processRows, 'sortByDate');
                                                            usort($otherRows, 'sortByDate');

                                                            // Merge 'Process' rows at the top followed by other rows
                                                            $allRows = array_merge($processRows, $otherRows);

                                                            foreach ($allRows as $row) {
                                                                $icon = '';
                                                                if ($row['status'] == 'Done') {
                                                                    $bg_color = '#d4edda'; // green color for 'Done' status
                                                                } else if ($row['status'] == 'Process') {
                                                                    $bg_color = ' #f8d7da'; // red color for 'Process' status
                                                                }
                                                            ?>
                                                                <tr>
                                                                    <td style="border:1px solid black;"><?php echo $i; ?></td>
                                                                    <td style="border:1px solid black; white-space: pre-wrap; width: 80%; text-align:left;"><?php echo $row['uraian']; ?></td>
                                                                    <td style="border:1px solid black;"><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                                                    <td style="border:1px solid black;width: 10%;"><?php echo $row['pic']; ?></td>

                                                                    <td style="color:black; border:1px solid black; background-color: <?php echo $bg_color; ?>"><?php echo $row['status']; ?></td>
                                                                    <td style="border:1px solid black;">
                                                                        <center>
                                                                            <!-- Edit button -->
                                                                            <a href="edit.php?id=<?php echo $row['id']; ?>">
                                                                                <i class="fa-solid"><img src="../assets/img/icon/pen.png" alt="" width="30" height="30"></i>
                                                                            </a>
                                                                            <!-- Delete button -->
                                                                            <a href="hapus.php?id=<?php echo $row['id']; ?>">
                                                                                <i class="fa-solid"><img src="../assets/img/icon/bin.png" alt="" width="30" height="30"></i>
                                                                            </a>
                                                                        </center>
                                                                    </td>
                                                                </tr>
                                                            <?php $i++;
                                                            } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div><br>
                                        <!-- <a href="../index.php">
                                            <i class="fa-solid"><img src="../assets/img/icon/undo.png" alt="" width="30" height="30"></i>
                                        </a> -->
                                    </div>
                                </section>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>






        <footer class="footer py-4  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            © <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            by
                            <a href="#" class="font-weight-bold" target="_blank">PT Kereta Api Indonesia.</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    </div>
                </div>
            </div>
        </footer>
        </div>
    </main>
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="material-icons py-2">settings</i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Material UI Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3 d-flex">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-3">
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
                <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard-pro">Free Download</a>
                <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View documentation</a>
                <div class="w-100 text-center">
                    <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
                    <h6 class="mt-3">Thank you for sharing!</h6>
                    <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

</body>

</html>