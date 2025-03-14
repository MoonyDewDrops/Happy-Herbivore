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
    <link rel="stylesheet" href="assets/css/start.css">
    <title>Start</title>
</head>

<body>

    <?php include 'header.php' ?>

    <main class="start-page">
        <img class="food" src="assets/img/food.png" alt="food">

        <div class="options">
            <h1>Where will you be eating today?</h1>

            <div class="dining-options">
                <form action="menu.php" method="post">
                    <input type="hidden" name="dineIn" value="1">
                    <button class="button" type="submit" name="dineChoiceButton">
                        <img class="option-img" src="assets/img/tray.png" alt="tray">
                        <div class="text-and-arrow">
                            <p>Dine in</p>
                            <img class="arrow" src="assets/img/arrow-right.svg" alt="arrow-right">
                        </div>
                    </button>
                </form>

                <form action="menu.php" method="post">
                    <input type="hidden" name="dineOut" value="2">
                    <button class="button" type="submit" name="dineChoiceButton">
                        <img class="option-img" src="assets/img/paper-bag.png" alt="paper-bag">
                        <div class="text-and-arrow">
                            <p>Take out</p>
                            <img class="arrow" src="assets/img/arrow-right.svg" alt="arrow-right">
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script src="assets/js/imageRotator.js"></script>
</body>

</html>