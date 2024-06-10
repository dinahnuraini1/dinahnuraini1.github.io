<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto HTML Tag</title>
</head>

<body>
    <!-- Form pencarian -->
    <?php
    include '../koneksi.php';

    $select_tahun = '';
    $hasil1 = [];

    // Ambil data tahun untuk opsi dropdown
    $sql = 'SELECT DISTINCT tahun FROM sertifikasi';
    $hasil = mysqli_query($conn, $sql);
    $options = [];
    while ($row = mysqli_fetch_assoc($hasil)) {
        $options[] = $row['tahun'];
    }
    ?>
    <form action="coba.php" method="post" class="form-inline" style="margin-left: 20px;">
        <div class="input-group">
            <select name='tahun'>
                <option value="">Pilih Tahun</option>
                <?php foreach ($options as $option) : ?>
                    <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="input-group-append" style="margin-right: 20px;">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
            </div>
        </div>
    </form>



</body>

</html>