<?php
session_start();

include_once 'connection.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
</head>

<body>
    <h2>Cart</h2>
    <?php
    if (!empty($_SESSION['cart'])) { ?>
        <ul id='cart-list'>
            <?php
            foreach ($_SESSION['cart'] as $product_id => $item) { ?>
                <li>
                    <!-- all the product stuff -->
                    <span><?php echo $item['name'] ?> - €<?php echo $item['price'] ?> each</span>
                    <button class='minus' data-id='<?php echo $product_id ?>'>-</button>
                    <span class='quantity' data-id='<?php echo $product_id ?>'><?php echo $item['quantity'] ?></span>
                    <button class='plus' data-id='<?php echo $product_id ?>'>+</button>
                    <span class='total-price' data-id='<?php echo $product_id ?>'>€ <?php echo ($item['price'] * $item['quantity']) ?></span>
                </li>
            <?php } ?>
        </ul>
        <!-- not permanent, this needs to only be on the index.php to discrad it -->
        <a href="clear_cart.php" id="clear-cart">Discard order</a>
    <?php
    } else {
        echo "Your cart is empty!";
    }
    ?>

    <!-- href to go ahead and continue ordering -->
    <a href="index.php">Continue ordering!</a>
    <script src="assets/js/js.js"></script>

</body>

</html>