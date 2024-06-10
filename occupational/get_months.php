<?php
include '../koneksi.php';

if (isset($_GET['year'])) {
    $year = $_GET['year'];

    $sqlMonths = "SELECT DISTINCT MONTH(date) AS month FROM records WHERE YEAR(date) = ? ORDER BY month";
    $stmt = $conn->prepare($sqlMonths);
    $stmt->bind_param("i", $year);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['month'] . '">' . date('F', mktime(0, 0, 0, $row['month'], 1)) . '</option>';
    }

    $stmt->close();
    $conn->close();
}
