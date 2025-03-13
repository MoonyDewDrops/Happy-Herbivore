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
    <link rel="stylesheet" href="assets/css/product.css">
    <title>Document</title>
</head>

<body>
    <?php include 'header.php' ?>
    <main>
        <?php
        if (!empty($_GET['product_id'])) {

            $product_id = $_GET['product_id'];

            //Fetch all products
            $sql = "SELECT * FROM products";
            //excecute stmt
            $stmt = $pdo->query($sql);
            //put all the information of the products tabel into the variable of products
            $products = $stmt->fetchAll();

            //if products get returned n there's something in there, display the stuff!!
            if ($products) {
                foreach ($products as $product) {
                    if ($product['product_id'] == $product_id) { ?>
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

                            ?>
                            <div class="name-and-img">
                                <div class="info">
                                    <h1 class="name"><?php echo htmlspecialchars($product['name']) ?></h1>
                                    <p class="description">Description: <?php echo htmlspecialchars($product['description']) ?></p>
                                </div>

                                <?php
                                //display image if we find it!!
                                if ($image) {
                                ?>
                                    <img class="img" src='assets/img/<?php echo htmlspecialchars($image['filename']) ?>'
                                        alt='<?php echo htmlspecialchars($image['description']) ?>'> <br>

                                <?php } ?>
                            </div>

                            <div class="add-item">
                                <p class="price"><span id="total-price">€<?php echo number_format($product['price'], 2, ',', ''); ?></span></p>

                                <form class="form" action="index.php?category_id=<?php echo htmlspecialchars($product['category_id']) ?>" method="post" id="product-form">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <button type="button" class="minus">-</button>
                                    <input class="quantity" type="number" name="quantity" id="quantity" value="1" min="1" max="99" readonly>
                                    <button type="button" class="plus">+</button>

                            </div>
    </main>

    <footer class="footer">
        <a href="index.php?category_id=<?php echo htmlspecialchars($product['category_id']) ?>" class="cancel">
            <p>Go back</p>
        </a>

        <img class="logo" src="assets/img/logodino.webp" alt="logo">

        <button class="cart" type="submit" name="add_to_cart">Add to Cart</button>

    </footer>
    </form>
    </li>
<?php
                    }
                }
            }
        } else {
            echo 'product not found!';
        }
?>

<script src="assets/js/productJS.js"></script>

</body>

</html>