<?php
require_once('db-connect.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "<script> alert('Error: No data to save.'); location.replace('./') </script>";
    $conn->close();
    exit;
}

extract($_POST);

if (empty($id)) {
    // Insert query
    $sql = "INSERT INTO `schedule_list` (`title`, `description`, `start_datetime`, `pic`) VALUES ('$title', '$description', '$start_datetime', '$pic')";
} else {
    // Update query
    $sql = "UPDATE `schedule_list` SET `title` = '$title', `description` = '$description', `start_datetime` = '$start_datetime', `pic` = '$pic' WHERE `id` = '$id'";
}

$save = $conn->query($sql);

if ($save) {
    echo "<script> alert('Schedule Successfully Saved.'); location.replace('./') </script>";
} else {
    echo "<pre>";
    echo "An Error occured.<br>";
    echo "Error: " . $conn->error . "<br>";
    echo "SQL: " . $sql . "<br>";
    echo "</pre>";
}

$conn->close();
