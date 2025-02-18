<?php
session_start();

//checks if stuff was sent via post
if (isset($_POST['product_id']) && isset($_POST['action'])) {
    $product_id = $_POST['product_id'];
    $action = $_POST['action'];

    //If the product doesn't exist in the cart yet, create it with the quantity 1
    if (!isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = 1;
    }

    //handling increase (first one) and decrease (second one)
    if ($action === "increase") {
        $_SESSION['cart'][$product_id]++;
    } elseif ($action === "decrease") {
        $_SESSION['cart'][$product_id]--;

        //if the quantity reaches 0, remove the product from cart
        if ($_SESSION['cart'][$product_id] <= 0) {
            unset($_SESSION['cart'][$product_id]);

            //checks if the cart is empty after removal
            echo json_encode([
                "confirmRemoval" => true, 
                "isOnlyProduct" => empty($_SESSION['cart'])
            ]);
            exit;
        }
    }

    //need to change in final. Replace the 10 with the product price later
    $total_price = $_SESSION['cart'][$product_id] * 10;

    //returning the stuff as json response
    echo json_encode([
        "quantity" => $_SESSION['cart'][$product_id],
        "total_price" => number_format($total_price, 2)
    ]);
}
