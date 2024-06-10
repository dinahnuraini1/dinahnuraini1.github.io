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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
            border-collapse: collapse;
            margin-top: 20px;
        }

        .calendar caption {
            text-align: center;
            padding: 10px 0;
            font-size: 24px;
            font-weight: bold;
        }

        .calendar th {
            background: #f4f4f4;
            padding: 10px;
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
    </style>
</head>

<body>
    <div class="calendar-container">
        <h2>Pilih Tahun dan Bulan</h2>
        <form method="GET" action="cal.php">
            <label for="year">Tahun:</label>
            <select id="year" name="year" required>
                <?php
                $currentYear = date("Y");
                for ($i = $currentYear - 50; $i <= $currentYear + 100; $i++) {
                    $selected = ($i == $currentYear) ? 'selected' : '';
                    echo "<option value='$i' $selected>$i</option>";
                }
                ?>
            </select>

            <label for="month">Bulan:</label>
            <select id="month" name="month" required>
                <?php
                $currentMonth = date("n");
                for ($i = 1; $i <= 12; $i++) {
                    $selected = ($i == $currentMonth) ? 'selected' : '';
                    $monthName = date("F", mktime(0, 0, 0, $i, 10));
                    echo "<option value='$i' $selected>$monthName</option>";
                }
                ?>
            </select>

            <button type="submit">Tampilkan Kalender</button>
        </form>
        <a href="add_event.php">
            <i class="fa-solid"><img src="../assets/img/icon/plus.png" alt="" width="30" height="30"></i>
        </a>
        <br>
        <button type="button" onclick="goToToday()">Today</button>

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
        <div class="calendar-container">
            <h2>Daftar Kegiatan</h2>
            <table border="1">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kegiatan</th>
                    <th>PIC</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                $i = 1; // Inisialisasi nomor urut
                $sql = "SELECT id, event_date, event_name, pic, status 
                            FROM events 
                            WHERE YEAR(event_date) = ? AND MONTH(event_date) = ?
                            ORDER BY event_date ASC, 
                                    CASE 
                                        WHEN status = 'Proses' THEN 1
                                        ELSE 2
                                    END";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $year, $month);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Tambahkan kelas CSS berdasarkan status
                        $statusClass = strtolower($row['status']) == 'proses' ? 'process' : 'done';
                        echo "<tr>";
                        echo "<td>" . $i . "</td>"; // Menampilkan nomor urut
                        echo "<td>" . date('d-m-Y', strtotime($row['event_date'])) . "</td>";
                        echo "<td>" . $row['event_name'] . "</td>";
                        echo "<td>" . $row['pic'] . "</td>";
                        $statusClass = strtolower($row['status']) == 'done' ? 'done' : 'process';
                        echo "<td class='$statusClass'>" . $row['status'] . "</td>";

                        echo "<td>
            <a href='edit_event.php?id=" . $row['id'] . "'>
                <img src='../assets/img/icon/pen.png' alt='Edit' width='20' height='20'>
            </a>
            <a href='delete_event.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this event?\")'>
                <img src='../assets/img/icon/bin.png' alt='Delete' width='20' height='20'>
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


        </div>
    </div>

    <div id="event-details">
        <span class="close" onclick="document.getElementById('event-details').style.display='none'">&times;</span>
        <h3>Detail Kegiatan</h3>
        <p id="event-name"></p>
        <p id="event-pic"></p>
        <p id="event-status"></p>
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
</body>

</html>