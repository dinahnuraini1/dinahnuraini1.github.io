<?php
// Konfigurasi koneksi database
include '../koneksi.php';

$dateFilter = isset($_POST['date']) ? $_POST['date'] : null;

$records = [];
$totalMs = 0;
$totalTms = 0;
$cumulativeMsBefore = []; // Total kumulatif MS sebelumnya per awak sarana
$cumulativeTmsBefore = []; // Total kumulatif TMS sebelumnya per awak sarana

// Query untuk mendapatkan nilai unik tahun, bulan, dan tanggal dari kolom date di tabel records
$sql = "SELECT DISTINCT YEAR(date) AS year, MONTH(date) AS month, DAY(date) AS day FROM records";
$result = $conn->query($sql);

if ($dateFilter) {
    // Menguraikan tanggal untuk digunakan dalam binding parameter
    $explodedDate = explode('-', $dateFilter);
    $year = $explodedDate[0];
    $month = $explodedDate[1];
    $day = $explodedDate[2];

    // Query untuk mendapatkan data pada tanggal yang difilter
    $sqlFiltered = "SELECT s.name AS station_name, c.name AS crew_name, r.ms, r.tms
                    FROM records r
                    JOIN stations s ON r.station_id = s.id
                    JOIN crew c ON r.crew_id = c.id
                    WHERE DAY(r.date) = ? AND MONTH(r.date) = ? AND YEAR(r.date) = ?";
    $stmt = $conn->prepare($sqlFiltered);
    $stmt->bind_param("iii", $day, $month, $year);
    $stmt->execute();
    $resultFiltered = $stmt->get_result();

    // Memasukkan hasil query ke dalam array records dan menghitung total MS dan TMS
    while ($row = $resultFiltered->fetch_assoc()) {
        $records[] = $row;
        $totalMs += $row['ms'];
        $totalTms += $row['tms'];
    }
    $stmt->close();

    // Query untuk mendapatkan jumlah kumulatif sebelumnya per awak sarana
    $sqlCumulativeBefore = "SELECT c.name AS crew_name, SUM(r.ms) AS cumulative_ms, SUM(r.tms) AS cumulative_tms
                            FROM records r
                            JOIN crew c ON r.crew_id = c.id
                            WHERE DATE(r.date) < ?
                            GROUP BY c.name";
    $stmtCumulativeBefore = $conn->prepare($sqlCumulativeBefore);
    $stmtCumulativeBefore->bind_param("s", $dateFilter);
    $stmtCumulativeBefore->execute();
    $resultCumulativeBefore = $stmtCumulativeBefore->get_result();
    while ($rowCumulativeBefore = $resultCumulativeBefore->fetch_assoc()) {
        $cumulativeMsBefore[$rowCumulativeBefore['crew_name']] = $rowCumulativeBefore['cumulative_ms'] ?? 0;
        $cumulativeTmsBefore[$rowCumulativeBefore['crew_name']] = $rowCumulativeBefore['cumulative_tms'] ?? 0;
    }
    $stmtCumulativeBefore->close();
}

// Query untuk mendapatkan tahun unik dari kolom date
$sqlYears = "SELECT DISTINCT YEAR(date) AS year FROM records ORDER BY year";
$resultYears = $conn->query($sqlYears);

// Query untuk mendapatkan bulan unik dari kolom date
$sqlMonths = "SELECT DISTINCT MONTH(date) AS month, YEAR(date) AS year FROM records ORDER BY year, month";
$resultMonths = $conn->query($sqlMonths);

// Query untuk mendapatkan tanggal unik dari kolom date
$sqlDates = "SELECT DISTINCT DAY(date) AS day, MONTH(date) AS month, YEAR(date) AS year FROM records ORDER BY year, month, day";
$resultDates = $conn->query($sqlDates);

$conn->close();
?>


<!DOCTYPE html>
<html>

<head>
    <title>Display Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="border-radius-lg pt-4 pb-3" style="background-color: #A3D8FF;">
                            <h6 class="text-capitalize ps-3">Awak KA</h6>
                        </div>
                        <br>
                        <form method="GET" action="rikes.php">
                            <div class="row justify-content-center">
                                <div class="col-md-2">
                                    <select name="year" id="year" class="form-control" required>
                                        <option value="" selected>Pilih Tahun</option>
                                        <?php
                                        // Loop untuk menampilkan opsi tahun
                                        while ($rowYear = $resultYears->fetch_assoc()) {
                                            echo "<option value=\"" . $rowYear['year'] . "\">" . $rowYear['year'] . "</option>";
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="month" id="month" class="form-control" required disabled>
                                        <option value="" selected>Pilih Bulan</option>
                                        <?php
                                        // Loop untuk menampilkan opsi bulan
                                        while ($rowMonth = $resultMonths->fetch_assoc()) {
                                            echo "<option value=\"" . $rowMonth['month'] . "\">" . date('F', mktime(0, 0, 0, $rowMonth['month'], 1)) . "</option>";
                                        }
                                        // $resultMonths->data_seek(0);
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="day" id="day" class="form-control" required disabled>
                                        <option value="" selected>Pilih Tanggal</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button id="search-button" class="btn" type="submit" style="background-color: #A3D8FF;">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#year').change(function() {
                const selectedYear = $(this).val();
                $('#month').empty().append('<option value="" selected>Pilih Bulan</option>');
                $('#day').empty().append('<option value="" selected>Pilih Tanggal</option>').prop('disabled', true);

                if (selectedYear) {
                    // Enable dropdown bulan
                    $('#month').prop('disabled', false);
                    // Lakukan AJAX request untuk mendapatkan bulan-bulan yang sesuai dengan tahun yang dipilih
                    $.ajax({
                        type: 'GET',
                        url: 'get_months.php',
                        data: {
                            year: selectedYear
                        },
                        success: function(response) {
                            $('#month').html(response);
                        }
                    });
                } else {
                    $('#month').prop('disabled', true);
                    $('#day').prop('disabled', true);
                }
            });

            $('#month').change(function() {
                const selectedMonth = $(this).val();
                const selectedYear = $('#year').val();
                $('#day').empty().append('<option value="" selected>Pilih Tanggal</option>');

                if (selectedMonth && selectedYear) {
                    // Enable dropdown tanggal
                    $('#day').prop('disabled', false);
                    // Lakukan AJAX request untuk mendapatkan tanggal-tanggal yang sesuai dengan tahun dan bulan yang dipilih
                    $.ajax({
                        type: 'GET',
                        url: 'get_dates.php',
                        data: {
                            year: selectedYear,
                            month: selectedMonth
                        },
                        success: function(response) {
                            $('#day').html(response);
                        }
                    });
                } else {
                    $('#day').prop('disabled', true);
                }
            });
        });
    </script>
</body>


</html>