<?php
include '../koneksi.php';

if (isset($_GET['year']) && isset($_GET['month'])) {
    $year = $_GET['year'];
    $month = $_GET['month'];

    // Mengambil semua tanggal unik untuk bulan dan tahun yang dipilih
    $sqlDates = "SELECT DISTINCT DAY(date) AS day FROM records WHERE YEAR(date) = ? AND MONTH(date) = ? ORDER BY day";
    $stmt = $conn->prepare($sqlDates);
    $stmt->bind_param("is", $year, $month);

    $stmt->execute();
    $result = $stmt->get_result();

    // Tampilkan opsi tanggal
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['day'] . '">' . $row['day'] . '</option>';
    }

    $stmt->close();
    $conn->close();
}
