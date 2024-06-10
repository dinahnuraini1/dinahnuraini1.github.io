<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Kalender</title>
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/main.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            display: flex;
        }

        .calendar {
            flex: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-left: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .completed {
            background-color: #d4edda;
        }

        .in-progress {
            background-color: #fff3cd;
        }

        .pending {
            background-color: #f8d7da;
        }
    </style>
</head>

<body>
    <h1>Timeline Kalender</h1>
    <div class="container">
        <div id="calendar" class="calendar"></div>
        <table>
            <thead>
                <tr>
                    <th>Kegiatan</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>PIC</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="event-list">
                <tr>
                    <td>Contoh Kegiatan 1</td>
                    <td>Deskripsi kegiatan 1</td>
                    <td>2024-06-02</td>
                    <td>Nama PIC 1</td>
                    <td class="completed">Selesai</td>
                </tr>
                <tr>
                    <td>Contoh Kegiatan 2</td>
                    <td>Deskripsi kegiatan 2</td>
                    <td>2024-06-05</td>
                    <td>Nama PIC 2</td>
                    <td class="in-progress">Sedang Berlangsung</td>
                </tr>
                <tr>
                    <td>Contoh Kegiatan 3</td>
                    <td>Deskripsi kegiatan 3</td>
                    <td>2024-06-10</td>
                    <td>Nama PIC 3</td>
                    <td class="pending">Tertunda</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [{
                        title: 'Contoh Kegiatan 1',
                        start: '2024-06-02',
                        description: 'Deskripsi kegiatan 1',
                        extendedProps: {
                            pic: 'Nama PIC 1',
                            status: 'Selesai'
                        },
                        className: 'completed'
                    },
                    {
                        title: 'Contoh Kegiatan 2',
                        start: '2024-06-05',
                        description: 'Deskripsi kegiatan 2',
                        extendedProps: {
                            pic: 'Nama PIC 2',
                            status: 'Sedang Berlangsung'
                        },
                        className: 'in-progress'
                    },
                    {
                        title: 'Contoh Kegiatan 3',
                        start: '2024-06-10',
                        description: 'Deskripsi kegiatan 3',
                        extendedProps: {
                            pic: 'Nama PIC 3',
                            status: 'Tertunda'
                        },
                        className: 'pending'
                    }
                ],
                eventDidMount: function(info) {
                    var tooltip = new Tooltip(info.el, {
                        title: info.event.extendedProps.description + '<br>PIC: ' + info.event.extendedProps.pic + '<br>Status: ' + info.event.extendedProps.status,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                }
            });
            calendar.render();
        });
    </script>
</body>

</html>