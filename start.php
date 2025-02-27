<?php
session_start();

include_once 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">
    <title>Start</title>
</head>

<body>

    <?php include 'header.php' ?>

    <form action="index.php" method="post">
        <input type="hidden" name="dineIn" value="1">
        <button type="submit" name="dineChoiceButton">Dine in</button>
    </form>

    <form action="index.php" method="post">
        <input type="hidden" name="dineOut" value="2">
        <button type="submit" name="dineChoiceButton">Dine out</button>
    </form>

</body>

</html>