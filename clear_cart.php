<?php
session_start();
unset($_SESSION['cart']);
//CHANGE THE HEADER LOCATION TO THE STARTING SCREEN WHEN FINALIZING!!
header("Location: index.php");
exit;