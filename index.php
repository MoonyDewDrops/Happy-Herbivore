<?php
session_start();

if (!empty($_GET['category_id'])) {
    $_SESSION['category_id'] = $_GET['category_id'];
} else {
    $_SESSION['category_id'] = 1;
}

include_once 'connection.php';

//checking if there's a post of a product the user wants to add to the cart!
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["dineIn"])) {
        $_SESSION['dineChoice'] = $_POST['dineIn'];
    } else if (isset($_POST["dineOut"])) {
        $_SESSION['dineChoice'] = $_POST['dineOut'];
    }

    if (isset($_POST["add_to_cart"])) {
        $product_id = $_POST["product_id"];
        $quantity = intval($_POST["quantity"]);

        //Fetching product data so we can correctly put it in the session!!
        $stmtSession = $pdo->prepare("SELECT * FROM products WHERE product_id = :product_id");
        $stmtSession->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        $stmtSession->execute();
        $product = $stmtSession->fetch();

        if ($product) {
            //Create a cart session if it doesnt already exist
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            //If said product is already in the cart, update the quantity of the product in said cart
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity'] += $quantity;
            } else {
                //Else we add a new entry
                $_SESSION['cart'][$product_id] = [
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => $quantity
                ];
            }
        }
    }
}

if (!empty($_SESSION['cart'])) {
    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $product_id => $item) {
        $productPriceAddedUp = $item['price'] * $item['quantity'];
        $formatedProductPrice = number_format($productPriceAddedUp, 2, ',', '');
        $totalPrice += $productPriceAddedUp;
        $formattedTotalPrice = number_format($totalPrice, 2, ',', '');
    }
} else {
    $formattedTotalPrice = "0,00";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/overview.css">
    <title>Home</title>
</head>

<body>
    <?php include 'header.php' ?>

    <div class="page-content">
        <div class="categories">
            <?php
            $sqlCategories = "SELECT * FROM categories";

            $stmtCategories = $pdo->query($sqlCategories);
            $categories = $stmtCategories->fetchAll();

            if ($categories) {

            ?>
                <ul class="category-list">
                    <?php
                    foreach ($categories as $category) {
                        //Image thing is temporary, need to do some wack complicated shi to load in the 1st image normally so yk this will change later
                        //(stuff to do w the image not the href n that) 
                    ?>
                        <li>
                            <a class="category" href='index.php?category_id=<?php echo htmlspecialchars($category['category_id']) ?>'>
                                <img class="category-img"
                                    src='assets/img/<?= $category['name'] ?>1.webp'
                                    alt='<?php echo htmlspecialchars($category['name']) ?> img'>
                                <p class="category-txt"><?php echo htmlspecialchars($category['name']) ?></p>
                            </a>
                        </li>

                <?php }
                } ?>
                </ul>
        </div>

        <div class="products">
            <?php
            //Fetch all products
            $sql = "SELECT * FROM products";
            //excecute stmt
            $stmt = $pdo->query($sql);
            //put all the information of the products tabel into the variable of products
            $products = $stmt->fetchAll();

            //if products get returned n there's something in there, display the stuff!!
            if ($products) { ?>

                <h2>Products</h2>
                <ul class="products-list">
                    <?php
                    foreach ($products as $product) {
                        if ($_SESSION['category_id'] && $product['category_id'] == $_SESSION['category_id']) {
                    ?>
                            <li>
                                <?php

                                //Fetching the image details
                                $sql2 = "SELECT * FROM images WHERE image_id = :image_id";
                                // excecuting statement n preparing
                                $stmt2 = $pdo->prepare($sql2);
                                //binding parameters
                                $stmt2->bindParam(':image_id', $product['image_id'], PDO::PARAM_INT);
                                //excecute
                                $stmt2->execute();
                                //fetch() since its only one row
                                $image = $stmt2->fetch();

                                //display image if we find it!!
                                if ($image) {
                                ?>
                                    <!-- using htmlspecialchars for these since apparently thats better -->
                                    <!-- This is bassically just writing the image path, and then proceeding to echo the thingie
        I do the echo part infront of it, because with the special chars it is needed. otherwise the $image doesnt do nun -->
                                    <div class="product">
                                        <img class="product-img"
                                            src='assets/img/<?php echo htmlspecialchars($image['filename']) ?>'
                                            alt='<?php echo htmlspecialchars($image['description']) ?>'> <br>

                                    <?php } ?>
                                    <p class="product-txt"><?php echo htmlspecialchars($product['name']) ?> <br></p>

                                    <div class="price-and-kcal">
                                        <p class="product-txt">Price: <?php echo htmlspecialchars($product['price']) ?> <br></p>
                                        <p class="product-txt">Kcal: <?php echo htmlspecialchars($product['kcal']) ?> <br></p>
                                    </div>

                                    <a class="order" href='product.php?product_id=<?php echo htmlspecialchars($product['product_id']) ?>'>
                                        <p>Order</p>
                                    </a>
                                    </div>
                            </li>

                    <?php
                        }
                    }
                    ?>

                </ul>

            <?php
            } else {
                echo "No products found.";
            }
            ?>
        </div>
    </div>

    <footer class="footer">
        <a href="clear_cart.php" class="cancel">
            <p>Cancel order</p>
        </a>

        <img class="logo" src="assets/img/logodino.webp" alt="logo">

        <a href="cart.php" class="cart">
            <?= $formattedTotalPrice ?>
            <p>Cart</p>
        </a>
    </footer>

    <script src="assets/js/js.js"></script>
</body>

</html>