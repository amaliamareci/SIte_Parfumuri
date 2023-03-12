<?php

include_once '../../api/config/config.php';
include_once "../../api/repository/ProductRepository.php";

$type = "";
if (isset($_GET['type'])) {
    foreach ($_GET['type'] as $var) {
        $type .= $var . ";";
    }
}

$category = "";
if (isset($_GET['category'])) {
    foreach ($_GET['category'] as $var) {
        $category .= $var . ";";
    }
}

$price = "";
if (isset($_GET['price'])) {
    $price = $_GET['price'];
}

$productRepository = new ProductRepository();
$filter_array = $productRepository->getFilterProducts($type, $category, $price);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Site parfumuri">
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

    <h1>Parfumuri</h1>

    <div class="products-container">

        <?php include_once "filter.html" ?>

        <div class="products-grid">

            <?php

            include_once "../parfumes/product_template.php";
            if ($filter_array[0] != null) {
                for ($i = 0; $i < count($filter_array); $i++)
                    if ($filter_array[$i] != "NULL") {
                        getProductByName($filter_array[$i]);
                    }
            } else
                echo '<h1>Nici un rezultat !</h1>';

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