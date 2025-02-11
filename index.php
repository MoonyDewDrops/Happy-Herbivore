<?php
session_start();

if (!empty($_GET['category_id'])) {
    $_SESSION['category_id'] = $_GET['category_id'];
} else {
    $_SESSION['category_id'] = 1;
}

include_once 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>

    <?php
    $sqlCategories = "SELECT * FROM categories";

    $stmtCategories = $pdo->query($sqlCategories);
    $categories = $stmtCategories->fetchAll();

    if ($categories) {

    ?>
        <h2>Categories</h2>
        <ul>
            <?php
            foreach ($categories as $category) {
                //Image thing is temporary, need to do some wack complicated shi to load in the 1st image normally so yk this will change later
                //(stuff to do w the image not the href n that) 
            ?>
                <li>
                    <img src='assets/img/<?= $category['name'] ?>1.webp'
                        alt='<?php echo htmlspecialchars($category['name']) ?> img'
                        style='width:100px;height:auto;'>
                    <a href='index.php?category_id=<?php echo htmlspecialchars($category['category_id']) ?>'>
                        <?php echo htmlspecialchars($category['name']) ?>.</a>
                </li>

            <?php } ?>
        </ul>
    <?php
    }


    //Fetch all products
    $sql = "SELECT * FROM products";
    //excecute stmt
    $stmt = $pdo->query($sql);
    //put all the information of the products tabel into the variable of products
    $products = $stmt->fetchAll();

    //if products get returned n there's something in there, display the stuff!!
    if ($products) { ?>

        <h2>Products</h2>
        <ul>
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
                            <img src='assets/img/<?php echo htmlspecialchars($image['filename']) ?>'
                                alt='<?php echo htmlspecialchars($image['description']) ?>'
                                style='width:100px;height:auto;'> <br>

                        <?php } ?>

                        ID: <?php echo htmlspecialchars($product['image_id']) ?> <br>
                        Name: <?php echo htmlspecialchars($product['name']) ?> <br>
                        Description: <?php echo htmlspecialchars($product['description']) ?> <br>
                        Price: <?php echo htmlspecialchars($product['price']) ?> <br>
                        Kcal: <?php echo htmlspecialchars($product['kcal']) ?> <br>
                        <a href='product.php?product_id=<?php echo htmlspecialchars($product['product_id'])?>'>Order</a>
                        <br>
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

</body>

</html>