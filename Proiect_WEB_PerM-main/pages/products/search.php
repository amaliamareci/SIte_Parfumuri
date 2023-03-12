<?php
include_once '../../api/config/config.php';
include_once "../../api/repository/ProductRepository.php";

$productRepository = new ProductRepository();
$search_array = $productRepository->getSearchProducts($_GET['search']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site parfumuri">
    <title>Produse</title>
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/styles.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/filter.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/products.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/product.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/heart.css">
</head>

<body>
    <?php include_once "../header.php" ?>

    <h1>Parfumuri pentru femei</h1>

    <div class="products-container">

        <?php include_once "filter.html" ?>

        <div class="products-grid">

            <?php
            include_once "../parfumes/product_template.php";
            for ($i = 0; $i < 3; $i++)
                if ($search_array[$i] != "NULL")
                    getProductByName($search_array[$i]);

            ?>

        </div>

    </div>

    <?php include_once "../footer.html" ?>
    <script src="https://web-perm.herokuapp.com/javascript/filter.js"></script>
    <script src="https://web-perm.herokuapp.com/javascript/sidenav.js"></script>
    <script src="https://web-perm.herokuapp.com/javascript/check_user.js"></script>
    <script src="https://kit.fontawesome.com/0f47dad504.js" crossorigin="anonymous"></script>

</body>

</html>