<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>Unit Kesehatan | Daop 7 Madiun
  </title>
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
  <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="services.php" target="_blank">
        <span class="ms-1 font-weight-bold text-white">Dashboard Safety Action</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="safety_action.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class=""><img src="gambar/recovery.png" alt="" width="25" height="25"></i>
            </div>
            <span class="nav-link-text ms-1">IBPR</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="supervisi_alat.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class=""><img src="gambar/health.png" alt="" width="25" height="25"></i>
            </div>
            <span class="nav-link-text ms-1">Hasil supervisi alat kerja</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="supervisi_lingkungan.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class=""><img src="gambar/environmental.png" alt="" width="25" height="25"></i>
            </div>
            <span class="nav-link-text ms-1">Hasil Supervisi lingkungan</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-gradient-primary w-100" href="../index.php" type="button">Back To Home</a>
      </div>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
   <!-- Navbar -->
   <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Safety Action</li>
      </ol>
      <h6 class="font-weight-bolder mb-0">Safety Action</h6>
      
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
        <li class="nav-item dropdown pe-2 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">          
          </a>
          <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <!-- End Navbar -->
    <div class="card my-4" >
  <div class="card-body">
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-8">
          <div class="form-group mb-0">
            <h5>Upload Files Excel (xls, csv, .xlsx) max 10mb</h5>
            Pilih File: <input type="file" name="file" accept=".xls,.xlsx,.csv" class="btn btn-primary" required>
      </form>
          </div>
        </div>
        <div class="col-4 d-flex align-items-end">
          <button class="btn btn-primary w-50" type="submit" name="upload" value="Upload">Upload</button>
        </div>
      </div>
    </form>
  </div>
</div>
        

    <h6>Uploaded Files</h6>
    <ul>
        <?php
        $directory = 'uploads/';
        $scanned_directory = array_diff(scandir($directory), array('..', '.'));

        if (!empty($scanned_directory)) {
            foreach ($scanned_directory as $file) {
                echo '<li><a href="' . $directory . $file . '" target="_blank">' . $file . '</a></li>';
            }
        } else {
            echo '<li>No files uploaded yet.</li>';
        }
        ?>
        
    </ul>
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
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>

</body>

</html>