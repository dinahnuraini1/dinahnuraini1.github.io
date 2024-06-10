<?php require_once('db-connect.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scheduling</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <script src="./js/script.js"></script>
    <style>
        :root {
            --bs-success-rgb: 71, 222, 152 !important;
        }

        html,
        body {
            height: 100%;
            width: 100%;
            font-family: Apple Chancery, cursive;
        }

        .btn-info.text-light:hover,
        .btn-info.text-light:focus {
            background: #000;
        }

        table,
        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: #ededed !important;
            border-style: solid;
            border-width: 1px !important;
        }

        .done-event {
            background-color: green !important;
            color: white !important;
            /* Mengubah warna teks agar kontras dengan latar belakang */
        }

        .process-event {
            background-color: red !important;
            color: white !important;
            /* Mengubah warna teks agar kontras dengan latar belakang */
        }
    </style>
</head>

<body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: function(info, successCallback, failureCallback) {
                    var events = [];
                    for (var key in scheds) {
                        var event = {
                            id: scheds[key]['id'],
                            title: scheds[key]['title'],
                            description: scheds[key]['description'],
                            start: scheds[key]['start_datetime'],
                            className: (scheds[key]['status'] == 'Done' ? 'done-event' : 'process-event'),
                            pic: scheds[key]['pic'], // Pastikan properti PIC disertakan di sini
                            status: scheds[key]['status'] // Pastikan properti status disertakan di sini
                        };
                        events.push(event);
                    }
                    successCallback(events);
                },



                eventClick: function(info) {
                    // Menampilkan detail jadwal ketika diklik
                    var modal = new bootstrap.Modal(document.getElementById('event-details-modal'));
                    var modalTitle = document.getElementById('title');
                    var modalDescription = document.getElementById('description');
                    var modalStart = document.getElementById('start');
                    var modalPic = document.getElementById('picDetail');
                    var modalStatus = document.getElementById('statusDetail');

                    modalTitle.innerText = info.event.title;
                    modalDescription.innerText = info.event.extendedProps.description;
                    modalStart.innerText = info.event.start.toLocaleString();
                    modalPic.innerText = info.event.extendedProps.pic; // Menyertakan informasi PIC
                    modalStatus.innerText = info.event.extendedProps.status; // Menyertakan informasi status

                    modal.show();
                }
            });

            calendar.render();
            // Menangani klik pada tanggal di kalender
            calendarEl.addEventListener('click', function(info) {
                if (info.target.classList.contains('fc-daygrid-day')) {
                    var selectedDate = info.target.getAttribute('data-date');
                    var eventsOnSelectedDate = calendar.getEvents().filter(event => event.start.toISOString().split('T')[0] === selectedDate);

                    if (eventsOnSelectedDate.length > 0) {
                        var modal = new bootstrap.Modal(document.getElementById('event-details-modal'));
                        var modalTitle = document.getElementById('title');
                        var modalDescription = document.getElementById('description');
                        var modalStart = document.getElementById('start');
                        var modalPic = document.getElementById('picDetail');
                        var modalStatus = document.getElementById('statusDetail');

                        modalTitle.innerText = eventsOnSelectedDate[0].title;
                        modalDescription.innerText = eventsOnSelectedDate[0].extendedProps.description;
                        modalStart.innerText = eventsOnSelectedDate[0].start.toLocaleString();
                        modalPic.innerText = eventsOnSelectedDate[0].extendedProps.pic;
                        modalStatus.innerText = eventsOnSelectedDate[0].extendedProps.status;

                        modal.show();
                    }
                }
            });
        });
    </script>
    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-0 shadow">
                    <div class="card-header text-light" style="background-color: red;">
                        <h5 class="card-title">Schedule Form</h5>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="save_schedule.php" method="post" id="schedule-form">
                                <input type="hidden" name="id" value="">
                                <div class="form-group mb-2">
                                    <label for="title" class="control-label">Kegiatan</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label">Deskripsi</label>
                                    <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="start_datetime" class="control-label">Date</label>
                                    <input type="date" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div><br>
                                <div class="form-group mb-2">
                                    <label for="pic" class="control-label">PIC</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="pic" id="pic" required>
                                </div><br>
                                <div class="form-group mb-2">
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Done">Done</option>
                                        <option value="Process">Process</option>
                                    </select>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tabel Kegiatan -->
        <div class="row mt-4">
            <div class="col-12">
                <h5 class="text-center">Daftar Kegiatan</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kegiatan</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>PIC</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $schedules = $conn->query("SELECT * FROM `schedule_list`");
                        if ($schedules) {
                            foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
                                echo "<tr>";
                                echo "<td id='row_$i'>$i</td>"; // Memperbaiki bagian ini
                                echo "<td>" . $row['title'] . "</td>";
                                echo "<td>" . $row['description'] . "</td>";
                                echo "<td>" . date("d F, Y", strtotime($row['start_datetime'])) . "</td>";
                                echo "<td>" . $row['pic'] . "</td>";
                                echo "<td>" . $row['status'] . "</td>";
                                echo "</tr>";
                                $i++;
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No schedules found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Modal untuk menampilkan informasi kegiatan -->
    <div class="modal fade" id="event-details-modal" tabindex="-1" aria-labelledby="event-details-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="event-details-modal-label">Event Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Title: </strong><span id="title"></span></p>
                    <p><strong>Description: </strong><span id="description"></span></p>
                    <p><strong>Date: </strong><span id="start"></span></p>
                    <!-- <p><strong>PIC: </strong><span id="picDetail"></span></p>
                    <p><strong>Status: </strong><span id="statusDetail"></span></p> -->
                </div>
            </div>
        </div>
    </div>


    <?php
    $schedules = $conn->query("SELECT * FROM `schedule_list`");
    if ($schedules) {
        $sched_res = [];
        foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
            // Ubah format tanggal tanpa waktu
            $row['sdate'] = date("d F, Y", strtotime($row['start_datetime']));
            $sched_res[$row['id']] = $row;
            // Menyertakan nilai PIC dan status
            $sched_res[$row['id']]['pic'] = $row['pic'];
            $sched_res[$row['id']]['status'] = $row['status'];
        }
        // var_dump($sched_res);
    } else {
        echo "Query returned no results.";
    }
    ?>

    <script>
        var scheds = <?= json_encode($sched_res) ?>;
    </script>


</body>

</html>