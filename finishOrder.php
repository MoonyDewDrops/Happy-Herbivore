<?php
session_start();
include 'connection.php';

try {
    //this is to select the pickup number
    $stmtPickup = $pdo->query("SELECT MAX(pickup_number) AS last_pickup FROM orders");
    $lastPickup = $stmtPickup->fetch(PDO::FETCH_ASSOC);
    $pickup_number = ($lastPickup['last_pickup'] === null || $lastPickup['last_pickup'] >= 99) ? 1 : ($lastPickup['last_pickup'] + 1);

    //sql prep for isnerting
    $stmt = $pdo->prepare("
    INSERT INTO orders (order_status_id, pickup_number, price, datetime, ordered_product, dineChoice, quantity) 
    VALUES (:order_status_id, :pickup_number, :price, :datetime, :ordered_product, :dineChoice, :quantity)
");

    //this is defining the value of the stuff we need that arent in sessions or in the database :)
    $order_status_id = 2;
    $datetime = date('Y-m-d H:i:s');

    // Looping through each product in the cart
    foreach ($_SESSION['cart'] as $product_id => $product) {
        //checks if the product exists in the product array
        $stmtCheckProduct = $pdo->prepare("SELECT COUNT(*) FROM products WHERE product_id = :product_id");
        $stmtCheckProduct->execute([':product_id' => $product_id]);
        $productExists = $stmtCheckProduct->fetchColumn();
        
        
        //for error
        if ($productExists == 0) {
            echo "Error: Product ID {$product_id} does not exist in the 'order_product' table.";
            exit;
        }

        //this puts the data into the order array
        $stmt->execute([
            ':order_status_id' => $order_status_id,
            ':pickup_number' => $pickup_number,
            ':price' => $product['price'],
            ':datetime' => $datetime,
            ':ordered_product' => $product_id,
            ':dineChoice' => $_SESSION['dineChoice'],
            ':quantity' => $product['quantity'],
        ]);
    }

    $_SESSION['finalOrderNumber'] = $pickup_number;

    header("Location: orderOverlook.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
