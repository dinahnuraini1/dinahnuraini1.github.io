<?php
// Include file koneksi.php untuk menghubungkan ke database
include '../koneksi.php';

// Mendapatkan id event dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil detail event berdasarkan id
    $sql = "SELECT * FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Memeriksa apakah event dengan id yang diberikan ada
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $event_date = $row['event_date'];
        $event_name = $row['event_name'];
        $pic = $row['pic'];
        $status = $row['status'];
        $uraian = $row['uraian'];
    } else {
        // Jika tidak ada event dengan id yang diberikan, redirect ke halaman lain atau tampilkan pesan kesalahan
        echo "Event tidak ditemukan.";
        exit();
    }
} else {
    // Jika tidak ada id yang diberikan, redirect ke halaman lain atau tampilkan pesan kesalahan
    echo "ID event tidak diberikan.";
    exit();
}

// Proses edit event
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirim melalui form
    $new_event_date = $_POST['event_date'];
    $new_event_name = $_POST['event_name'];
    $new_pic = ucfirst($_POST['pic']);
    $new_event_name = ucfirst($_POST['event_name']); // Mengubah huruf depan menjadi kapital
    $new_status = $_POST['status'];
    $new_uraian = $_POST['uraian']; // Menambah kolom uraian

    $event_name = ucwords(strtolower($event_name)); // strtolower() digunakan untuk memastikan bahwa semua huruf kecil sebelumnya diubah menjadi huruf kecil terlebih dahulu
    $new_pic = ucwords(strtolower($new_pic));
    $new_uraian = ucwords(strtolower($new_uraian));

    // Query untuk update detail event
    $update_sql = "UPDATE events SET event_date = ?, event_name = ?, pic = ?, status = ?, uraian = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssi", $new_event_date, $new_event_name, $new_pic, $new_status, $new_uraian, $id); // Menambahkan parameter untuk uraian

    // Eksekusi query
    if ($update_stmt->execute()) {
        // Jika berhasil diupdate, redirect ke halaman lain atau tampilkan pesan sukses
        echo '<script>alert("Data Timeline berhasil di Edit!"); window.location.href = "timeline1.php";</script>';
        exit();
    } else {
        // Jika gagal diupdate, tampilkan pesan kesalahan
        echo "Gagal mengupdate event.";
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Edit Data Timeline</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/logo1.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/main2.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        label {
            text-align: left;
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-lg-5 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12 text-center" style="padding-top:20px;"><img style="width: 100px;" src="../assets/img/logo1.png">

                                <div class="p-3 pb-4 pt-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Edit Timeline</h1>
                                    </div>
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>">
                                        <div class="form-group">
                                            <label for="event_date">Dateline:</label>
                                            <input type="date" id="event_date" class="form-control" name="event_date" value="<?php echo $event_date; ?>" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="event_name">Kegiatan:</label>
                                            <input type="text" id="event_name" class="form-control" name="event_name" value="<?php echo $event_name; ?>" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="uraian">Uraian:</label>
                                            <textarea class="form-control form-control-user" id="uraian" name="uraian" maxlength="100" rows="4"><?php echo $row['uraian']; ?></textarea>

                                        </div><br>
                                        <div class="form-group">
                                            <label for="pic">PIC:</label>
                                            <input type="text" class="form-control" id="pic" name="pic" value="<?php echo $pic; ?>" required>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="status">Status:</label>
                                            <select id="status" name="status" class="form-control" required>
                                                <!-- <option value="Pending" <?php if ($status == "Pending") echo "selected"; ?>>Pending</option> -->
                                                <option value="Process" <?php if ($status == "Process") echo "selected"; ?>>Process</option>
                                                <option value="Done" <?php if ($status == "Done") echo "selected"; ?>>Done</option>
                                            </select>
                                        </div><br>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Simpan</button>
                                        <a href="timeline1.php" class="btn btn-danger btn-user btn-block">Kembali</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>