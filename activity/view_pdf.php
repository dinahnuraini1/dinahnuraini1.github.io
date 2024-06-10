<?php
if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];
    $fileDir = '../pdf_kebugaran/';
    $filePath = $fileDir . $filename;

    if (file_exists($filePath)) {
?>
        <!DOCTYPE html>
        <html lang="id">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Tampilkan PDF</title>
            <style>
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                }

                iframe {
                    width: 80%;
                    height: 90%;
                }
            </style>
        </head>

        <body>
            <iframe src="<?php echo $filePath; ?>" frameborder="0"></iframe>
        </body>

        </html>
<?php
    } else {
        echo "File tidak ditemukan!";
    }
} else {
    echo "Tidak ada file yang ditentukan!";
}
?>