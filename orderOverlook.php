<?php
session_start();

include_once 'connection.php';

if (isset($_SESSION['finalOrderNumber'])){
    $orderNumber = $_SESSION['finalOrderNumber'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order overlook</title>
</head>
<body>
    <div>
        Order has been placed!<br>
        Order number: <?=$orderNumber?> <br>
        <!-- Need to add like a time thigny that sends it back after 5 seconds have passed or so -->
        <a href="clear_cart.php">Go to start screen!</a>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = 'start.php';
        }, 5000);
    </script>

</body>
</html>