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
    <link rel="stylesheet" href="assets/css/cart.css">
    <title>cart</title>
</head>

<body>
    <?php include 'header.php' ?>

    <h1>Review your order</h1>

    <div class="popup-overlay" id="clearCartOverlay">
        <h3>Clear Cart</h3>
        <p>Do you wish to clear the cart?</p>
        <div>
            <button onclick="closePopup('clearCartOverlay')">No</button>
            <button onclick="confirmClearCart()">Yes</button>
        </div>
    </div>

    <div class="popup-overlay" id="removeItemOverlay">
        <h3>Remove Item</h3>
        <p>Do you wish to remove this product?</p>
        <div>
            <button onclick="closePopup('removeItemOverlay')">No</button>
            <button id="confirmRemoveItem">Yes</button>
        </div>
    </div>

    <?php
    if (!empty($_SESSION['cart'])) {
        // var_dump($_SESSION['cart']);
    ?>
        <div class="products">
            <ul id='cart-list'>
                <?php
                $totalPrice = 0;
                foreach ($_SESSION['cart'] as $product_id => $item) {
                    $productPriceAddedUp = $item['price'] * $item['quantity'];
                    $formatedProductPrice = number_format($productPriceAddedUp, 2, ',', '');
                ?>
                    <li>
                        <!-- all the product stuff -->
                        <div class="product-info">
                            <p><?php echo $item['name'] ?></p>
                            <p class='total-price' data-id='<?php echo $product_id ?>'>€ <?= $formatedProductPrice ?></p>
                        </div>

                        <div class="amount">
                            <button class='minus' data-id='<?php echo $product_id ?>'>-</button>
                            <p class='quantity' data-id='<?php echo $product_id ?>'><?php echo $item['quantity'] ?></p>
                            <button class='plus' data-id='<?php echo $product_id ?>'>+</button>
                        </div>
                    </li>
                <?php
                    $totalPrice += $productPriceAddedUp;
                    $formattedTotalPrice = number_format($totalPrice, 2, ',', '');
                } ?>
            </ul>
        </div>
        Total: <?php
                echo $formattedTotalPrice;
                ?>

        <form action="finishOrder.php">
            <button type="submit" name="finishOrder">Checkout</button>
        </form>

        <br>
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