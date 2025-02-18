<?php
session_start();

//checking if the product id was sent via post
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    //checks is product exists in cart session
    if (isset($_SESSION['cart'][$product_id])) {
        //remove the product from le cart
        unset($_SESSION['cart'][$product_id]); // Remove the product from the cart
    }

    //sending json response back to the js.js to indicate succes
    echo json_encode(["success" => true]);
} else {
    //if not, send failure
    echo json_encode(["success" => false]);
}
