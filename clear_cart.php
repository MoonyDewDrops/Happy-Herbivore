<?php
session_start();
unset($_SESSION['cart']);
unset($_SESSION);
//CHANGE THE HEADER LOCATION TO THE STARTING SCREEN WHEN FINALIZING!!
header("Location: start.php");
exit;