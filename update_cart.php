<?php
session_start();
header('Content-Type: application/json'); // Set JSON content type

//checks if stuff was sent via post
if (isset($_POST['product_id']) && isset($_POST['action'])) {
    $product_id = $_POST['product_id'];
    $action = $_POST['action'];

    //If the product doesn't exist in the cart yet, give error
    if (!isset($_SESSION['cart'][$product_id])) {
        http_response_code(400);
        echo json_encode(['error' => 'Product not found in cart']);
        exit;
    }

    //handling increase (first one) and decrease (second one)
    if ($action === "increase") {
        $_SESSION['cart'][$product_id]['quantity']++;
    } elseif ($action === "decrease") {
        $_SESSION['cart'][$product_id]['quantity']--;

        //if the quantity reaches 0, remove the product from cart
        if ($_SESSION['cart'][$product_id]['quantity'] <= 0) {
            $isOnlyProduct = count($_SESSION['cart']) <= 1;
            unset($_SESSION['cart'][$product_id]);

            //checks if the cart is empty after removal
            echo json_encode([
                "confirmRemoval" => true,
                "isOnlyProduct" => $isOnlyProduct
            ]);
            exit;
        }
    }

    $quantity = $_SESSION['cart'][$product_id]['quantity'];
    $price = $_SESSION['cart'][$product_id]['price'];
    $total_price = $quantity * $price;

    //returning the stuff as json response
    echo json_encode([
        "quantity" => $quantity,
        "total_price" => number_format($total_price, 2)
    ]);
    exit;
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}
