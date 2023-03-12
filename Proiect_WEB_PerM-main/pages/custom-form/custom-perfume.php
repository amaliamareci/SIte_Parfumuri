<?php
include_once '../../api/config/config.php';
include_once "../parfumes/product_template.php";
include_once "../../api/repository/ProductRepository.php";

$productRepository = new ProductRepository();
$custom_perfume = $productRepository -> getCustomPerfume($_GET['step1'],$_GET['step2'],$_GET['step3'],$_GET['step4']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Site parfumuri">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produse</title>
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/styles.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/filter.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/products.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/product.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/heart.css">
</head>
<body>
    <?php include_once "../header.php" ?>

    <h1>Parfumul recomandat ! :)</h1>

    <div class="products-container"  style="display: flex;justify-content: center;margin-bottom: 2em;">
            
        <?php 
            getProductByName($custom_perfume);
        ?>

    </div>

    <?php include_once "../footer.html" ?>
    <script src="https://web-perm.herokuapp.com/javascript/filter.js"></script>
    <script src="https://web-perm.herokuapp.com/javascript/sidenav.js"></script>
    <script src="https://kit.fontawesome.com/0f47dad504.js" crossorigin="anonymous"></script>
</body>
</html>






