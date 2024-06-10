<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input User Admin</title>
</head>
<body>
    <h2>Form Input User Admin</h2>
    <form action="proses_input_user.php" method="post">
        <label for="nm_user">Username:</label><br>
        <input type="text" id="nm_user" name="nm_user" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
