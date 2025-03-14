<?php
session_start();

include_once 'connection.php';

if (isset($_SESSION['finalOrderNumber'])) {
    $orderNumber = $_SESSION['finalOrderNumber'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/overlook.css">
    <title>Order overlook</title>
</head>

<body>
    <?php include 'header.php' ?>

    <main class="centered">
        <div class="text">
            <p>Order has been placed!</p>
            <p>Order number: <?= $orderNumber ?></p>
            <!-- Need to add like a time thigny that sends it back after 5 seconds have passed or so -->
            <a class="button" href="clear_cart.php">
                Return to start screen!
            </a>
        </div>

        <script>
            // setTimeout(function() {
            //     window.location.href = 'index.php';
            // }, 5000);
        </script>
    </main>

</body>

</html>