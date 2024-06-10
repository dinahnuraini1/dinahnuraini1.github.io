<!DOCTYPE html>
<html>

<head>
    <title>Input Data</title>
    <style>
        .station-block {
            border: 1px solid #000;
            margin-bottom: 20px;
            padding: 10px;
        }
    </style>
</head>

<body>

    <form method="post" action="insert_data.php">
        <label for="date">Tanggal:</label>
        <input type="date" id="date" name="date" required>
        <h1>Input Data untuk 4 Stasiun dan 6 Awak Sarana per Stasiun</h1>

        <?php
        // Daftar stasiun dan awak sarana yang telah ditetapkan
        $stations = array("UPT Crew Ka Madiun", "Stasiun Madiun", "Stasiun Kertosono", "Stasiun Blitar");
        $crews = array("Masinis", "Asmas", "Kondektur", "TKA", "Polsuska", "Serep, Lokrit, Langsir");

        // Perulangan untuk setiap stasiun
        for ($station = 0; $station < count($stations); $station++) :
        ?>
            <div class="station-block">
                <h2><?php echo $stations[$station]; ?></h2>
                <?php
                // Perulangan untuk setiap awak sarana
                for ($crew = 0; $crew < count($crews); $crew++) :
                ?>
                    <h3><?php echo $crews[$crew]; ?></h3>
                    <label for="ms<?php echo $station + 1; ?>_<?php echo $crew + 1; ?>">MS:</label>
                    <input type="number" min=0 id="ms<?php echo $station + 1; ?>_<?php echo $crew + 1; ?>" name="ms<?php echo $station + 1; ?>_<?php echo $crew + 1; ?>" required>
                    <label for="tms<?php echo $station + 1; ?>_<?php echo $crew + 1; ?>">TMS:</label>
                    <input type="number" min=0 id="tms<?php echo $station + 1; ?>_<?php echo $crew + 1; ?>" name="tms<?php echo $station + 1; ?>_<?php echo $crew + 1; ?>" required>
                <?php endfor; ?>
            </div>
        <?php endfor; ?>

        <button type="submit">Submit</button>
    </form>
</body>



</html>