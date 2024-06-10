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
                            pic: scheds[key]['pic'],
                            className: (scheds[key]['description'] == 'Done' ? 'done-event' : 'process-event') // Menambahkan kelas berdasarkan deskripsi
                        };
                        events.push(event);
                    }
                    successCallback(events);
                },
                eventClick: function(info) {
                    var modal = new bootstrap.Modal(document.getElementById('event-details-modal'));
                    var modalTitle = document.getElementById('title');
                    var modalDescription = document.getElementById('description');
                    var modalStart = document.getElementById('start');
                    var modalPic = document.getElementById('picDetail');

                    modalTitle.innerText = info.event.title;
                    modalDescription.innerText = info.event.extendedProps.description;
                    modalStart.innerText = info.event.start.toLocaleString();
                    modalPic.innerText = info.event.extendedProps.pic;

                    modal.show();
                }
            });

            calendar.render();
        });
    </script>
    <div class="container py-5" id="page-container">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-0 shadow">
                    <div class="card-header text-light" style="background-color: #3788d8;">
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
                                    <label for="start_datetime" class="control-label">Date</label>
                                    <input type="date" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
                                </div><br>
                                <div class="form-group mb-2">
                                    <label for="pic" class="control-label">PIC</label>
                                    <input type="text" class="form-control form-control-sm rounded-0" name="pic" id="pic" required>
                                </div><br>
                                <div class="form-group mb-2">
                                    <label for="description" class="control-label">Status</label>
                                    <select class="form-control" name="description" id="description" required>
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
                                echo "<td>" . date("d F, Y", strtotime($row['start_datetime'])) . "</td>";
                                echo "<td>" . $row['pic'] . "</td>";
                                echo "<td>" . $row['description'] . "</td>";
                                echo "</td>";
                                $i++;
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No schedules found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Event Details Modal -->
    <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header rounded-0">
                    <h5 class="modal-title">Detail Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body rounded-0">
                    <div class="container-fluid">
                        <dl>
                            <dt class="text-muted">Kegiatan</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Tanggal</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">Status</dt>
                            <dd id="description" class=""></dd>


                        </dl>
                    </div>
                </div>
                <div class="modal-footer rounded-0">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
                        <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                    </div>
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
            // $sched_res[$row['id']]['status'] = $row['status'];
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