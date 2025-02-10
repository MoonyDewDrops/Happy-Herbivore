<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>

<?php
include_once 'connection.php';

//Fetch all products
$sql = "SELECT * FROM products";
//excecute stmt
$stmt = $pdo->query($sql);
//put all the information of the products tabel into the variable of products
$products = $stmt->fetchAll();

//if products get returned n there's something in there, display the stuff!!
if ($products) {?>

    <h2>Products</h2>
    <ul>
    <?php
    foreach ($products as $product) {?>
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
        <img src='assets/img/<?php echo htmlspecialchars($image['filename'])?>' 
        alt='<?php echo htmlspecialchars($image['description'])?>'
        style='width:100px;height:auto;'> <br>

        <?php } ?>

        ID: <?php echo htmlspecialchars($product['image_id'])?> <br>
        Name: <?php echo htmlspecialchars($product['name'])?> <br>
        Description: <?php echo htmlspecialchars($product['description'])?> <br>
        Price: <?php echo htmlspecialchars($product['price'])?> <br>
        Kcal: <?php echo htmlspecialchars($product['kcal'])?> <br>
        <br>
        </li>

        <?php
    } ?>
    
    </ul>

    <?php
} else {
    echo "No products found.";
}
?>

</body>
</html>