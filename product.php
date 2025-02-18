<?php
session_start();

include_once 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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

                        //display image if we find it!!
                        if ($image) {
                        ?>



                            <img src='assets/img/<?php echo htmlspecialchars($image['filename']) ?>'
                                alt='<?php echo htmlspecialchars($image['description']) ?>'
                                style='width:100px;height:auto;'> <br>

                        <?php } ?>


                        Name: <?php echo htmlspecialchars($product['name']) ?> <br>
                        Description: <?php echo htmlspecialchars($product['description']) ?> <br>
                        Price: <?php echo htmlspecialchars($product['price']) ?> <br>
                        <form action="index.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="99"> <br>
                            <button type="submit" name="add_to_cart">Add to Cart</button>
                        </form>
                        <a href="index.php?category_id=<?php echo htmlspecialchars($product['category_id']) ?>">Go back</a>

                        <br>
                    </li>
    <?php
                }
            }
        }
    } else {
        echo 'product not found!';
    }
    ?>

</body>
</html>