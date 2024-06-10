<?php
// Koneksi database
include '../koneksi.php';

// Fungsi untuk mendapatkan kegiatan
function get_events($conn, $year, $month)
{
    $events = [];
    $sql = "SELECT event_date, event_name, pic, status FROM events WHERE YEAR(event_date) = ? AND MONTH(event_date) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $year, $month);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[$row['event_date']][] = [
                'name' => $row['event_name'],
                'pic' => $row['pic'],
                'status' => $row['status']
            ];
        }
    }

    $stmt->close();
    return $events;
}

// Fungsi untuk menghasilkan kalender
function generate_calendar($events = [], $year, $month)
{
    $daysOfWeek = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];

    $calendar = "<table class='calendar'>";
    $calendar .= "<caption>$monthName $year</caption>";
    $calendar .= "<tr>";

    foreach ($daysOfWeek as $day) {
        $calendar .= "<th>$day</th>";
    }

    $calendar .= "</tr><tr>";

    if ($dayOfWeek > 0) {
        $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>";
    }

    $currentDay = 1;

    while ($currentDay <= $numberDays) {
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $dateStr = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($currentDay, 2, '0', STR_PAD_LEFT);
        $calendar .= "<td data-date='$dateStr'>";
        $calendar .= "<div class='date'>$currentDay</div>";

        if (isset($events[$dateStr])) {
            foreach ($events[$dateStr] as $event) {
                $eventData = htmlspecialchars(json_encode($event), ENT_QUOTES, 'UTF-8');
                $statusClass = strtolower($event['status']); // Menambahkan kelas berdasarkan status
                $calendar .= "<div class='event $statusClass' data-event='$eventData'>{$event['name']}</div>";
            }
        }

        $calendar .= "</td>";

        $currentDay++;
        $dayOfWeek++;
    }

    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>";
    }

    $calendar .= "</tr>";
    $calendar .= "</table>";

    return $calendar;
}
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

        .calendar-container {
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }

        .form-container {
            width: 80%;
            margin: 20px auto;
            text-align: left;
        }

        .form-container h2 {
            text-align: center;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .form-container label {
            margin-top: 10px;
        }

        .form-container input,
        .form-container button,
        .form-container select {
            margin-top: 5px;
            padding: 10px;
            width: 100%;
            max-width: 400px;
        }

        .calendar {
            width: 100%;
            border-radius: 10px;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: hidden;
        }

        .calendar caption {
            text-align: center;
            padding: 10px 0;
            font-size: 24px;
            font-weight: bold;
        }

        .calendar th {
            background: #C6EBC5;
            /* padding: 10px; */
            border: none;
        }

        .calendar td {
            padding: 10px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        .calendar .today {
            background-color: #d4edff;
        }

        .calendar td .date {
            font-weight: bold;
            cursor: pointer;
        }

        .calendar .event {
            margin-top: 5px;
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 12px;
        }

        .calendar .event.done {
            background-color: #d4edda;
            /* Warna hijau untuk status Done */
        }

        .calendar .event.process {
            background-color: #f8d7da;
            /* Warna merah untuk status Process */
        }

        #event-details {
            display: none;
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            padding: 20px;
            border: 1px solid #ddd;
            background: #fff;
            z-index: 1000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #event-details h3 {
            margin-top: 0;
        }

        #event-details .close {
            cursor: pointer;
            color: red;
        }

        #search-button {
            background-color: #C6EBC5;
            color: black;
            width: 80px;
            /* Atur lebar tombol sesuai keinginan */
            height: 40px;
            /* Atur tinggi tombol sesuai keinginan */


        }

        #search-button:hover {
            background-color: #b5d8b4;
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .input-group label,
        .input-group select,
        .input-group-append {
            margin-right: 10px;
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

        .table,
        .table th,
        .table td {
            border: 1px solid black;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: center;
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
                        <span class="nav-link-text ms-1">Flyer</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white active" href="timeline1.php" style="background-color:  #C6EBC5;">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class=""><img src="gambar/doctor-consultation.png" alt="" width="20" height="20"></i>
                        </div>
                        <span class="nav-link-text ms-1">Timeline</span>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link text-white " href="timeline2.php">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class=""><img src="gambar/hospital.png" alt="" width="20" height="20"></i>
                        </div>
                        <span class="nav-link-text ms-1">PIC</span>
                    </a>
                </li> -->
            </ul>
        </div>
        <div class="sidenav-footer position-absolute w-100 bottom-0 ">
            <div class="mx-3">
                <a class="btn w-100" href="../index.php" type="button" style="background-color:  #C6EBC5; color:black">Kembali</a>
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
                            <div class="border-radius-lg pt-4 pb-3" style="background-color:  #C6EBC5;">
                                <h6 class="text-black text-capitalize ps-3">Timeline</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <section id="projects" class="projects">
                                    <div class="container" data-aos="fade-up">
                                        <div class="form-container">
                                            <form method="GET" action="timeline1.php" class="form-inline">
                                                <div class="input-group" style="display: flex; align-items: center; max-width: 500px;">
                                                    <label for="year" style="margin-right: 10px;">Tahun:</label>
                                                    <select id="year" name="year" class="form-control" required style="margin-right: 10px;">
                                                        <?php
                                                        $currentYear = date("Y");
                                                        for ($i = $currentYear - 50; $i <= $currentYear + 100; $i++) {
                                                            $selected = ($i == $currentYear) ? 'selected' : '';
                                                            echo "<option value='$i' $selected>$i</option>";
                                                        }
                                                        ?>
                                                    </select>

                                                    <label for="month" style="margin-right: 10px;">Bulan:</label>
                                                    <select id="month" name="month" class="form-control" required style="margin-right: 10px;">
                                                        <?php
                                                        $currentMonth = date("n");
                                                        for ($i = 1; $i <= 12; $i++) {
                                                            $selected = ($i == $currentMonth) ? 'selected' : '';
                                                            $monthName = date("F", mktime(0, 0, 0, $i, 10));
                                                            echo "<option value='$i' $selected>$monthName</option>";
                                                        }
                                                        ?>
                                                    </select>

                                                    <div class="input-group-append" style="margin-right: 10px;">
                                                        <button id="search-button" class="btn btn-success" type="submit">Cari</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <a href="add_event.php">
                                            <img src="../assets/img/icon/plus.png" alt="Add Event" width="30" height="30">
                                        </a>
                                        <br><br>
                                        <button type="button" style="background-color: #C6EBC5; border-radius:5px; border:none;" onclick="goToToday()">Today</button>
                                    </div>
                                    <div class="container">
                                        <?php
                                        if (isset($_GET['year']) && isset($_GET['month'])) {
                                            $year = $_GET['year'];
                                            $month = $_GET['month'];
                                        } else {
                                            $year = date("Y");
                                            $month = date("n");
                                        }

                                        $events = get_events($conn, $year, $month);
                                        echo generate_calendar($events, $year, $month);
                                        ?>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col-md-15">
                                            <div class="table-responsive">
                                                <div class="calendar-container">
                                                    <!-- <h4>Daftar Kegiatan</h4> -->
                                                    <table id="profilTable" style=" width: 900px; margin-left:-90px;">
                                                        <tr style="background-color: #C6EBC5;">
                                                            <th>No</th>
                                                            <th>Tanggal</th>
                                                            <th>Kegiatan</th>
                                                            <th>Uraian</th>
                                                            <th>PIC</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        <?php
                                                        $i = 1; // Inisialisasi nomor urut
                                                        $sql = "SELECT id, event_date, event_name, pic, status, uraian
                                                                FROM events 
                                                                WHERE YEAR(event_date) = ? AND MONTH(event_date) = ?
                                                                ORDER BY 
                                                                    CASE 
                                                                        WHEN status = 'Process' THEN 1
                                                                        ELSE 2
                                                                    END,
                                                                    event_date ASC";

                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->bind_param("ii", $year, $month);
                                                        $stmt->execute();
                                                        $result = $stmt->get_result();

                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                // Tambahkan kelas CSS berdasarkan status
                                                                $statusClass = strtolower($row['status']) == 'proses' ? 'process' : 'done';
                                                                echo "<tr>";
                                                                echo '<td style="border:1px solid black;">' . $i . '</td>'; // Menampilkan nomor urut
                                                                echo '<td style="border:1px solid black;">' . date('d-m-Y', strtotime($row['event_date'])) . "</td>";
                                                                echo "<td style='border:1px solid black; text-align:left;'>" . $row['event_name'] . "</td>";
                                                                echo "<td style='border:1px solid black;'>" . $row['uraian'] . "</td>";
                                                                echo "<td style='border:1px solid black;'>" . $row['pic'] . "</td>";
                                                                echo "<td style='border:1px solid black; background-color: " . ($row['status'] == 'Process' ? '#f8d7da' : '#d4edda') . "; color: black;'>" . $row['status'] . "</td>";

                                                                echo "<td>
                <a href='edit_event.php?id=" . $row['id'] . "'>
                    <img src='../assets/img/icon/pen.png' alt='Edit' width='30' height='30'>
                </a>
                <a href='delete_event.php?id=" . $row['id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data?\")'>
                    <img src='../assets/img/icon/bin.png' alt='Delete' width='30' height='30'>
                </a>
                </td>";
                                                                echo "</tr>";
                                                                $i++; // Increment nomor urut
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='6'>Tidak ada event pada bulan ini.</td></tr>";
                                                        }
                                                        ?>
                                                    </table>
                                                    <br>

                                                </div>

                                            </div>

                                            <div id="event-details">
                                                <span class="close" onclick="document.getElementById('event-details').style.display='none'">&times;</span>
                                                <h3>Detail Kegiatan</h3>
                                                <p id="event-name"></p>
                                                <p id="event-pic"></p>
                                                <p id="event-status"></p>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </section>
                            <br>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <script>
            function goToToday() {
                var today = new Date();
                var year = today.getFullYear();
                var month = today.getMonth() + 1; // Perhatikan bahwa getMonth() mengembalikan indeks bulan mulai dari 0, sehingga tambahkan 1.

                // Set nilai tahun dan bulan di dropdown ke tahun dan bulan saat ini
                document.getElementById('year').value = year;
                document.getElementById('month').value = month;

                // Submit form untuk menampilkan kalender untuk bulan dan tahun saat ini
                document.querySelector('form').submit();
            }

            document.addEventListener('DOMContentLoaded', (event) => {
                // Ambil tanggal hari ini
                let today = new Date();
                let todayDate = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);

                document.querySelectorAll('.calendar td').forEach((element) => {
                    let date = element.getAttribute('data-date');
                    if (date === todayDate) {
                        element.classList.add('today');
                    }

                    element.addEventListener('click', (e) => {
                        let eventDetails = element.querySelectorAll('.event');
                        if (eventDetails.length > 0) {
                            let eventData = JSON.parse(eventDetails[0].getAttribute('data-event'));
                            document.getElementById('event-name').innerText = 'Kegiatan: ' + eventData.name;
                            document.getElementById('event-pic').innerText = 'PIC: ' + eventData.pic;
                            document.getElementById('event-status').innerText = 'Status: ' + eventData.status;

                            document.getElementById('event-details').style.display = 'block';
                        }
                    });
                });
            });
        </script>

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