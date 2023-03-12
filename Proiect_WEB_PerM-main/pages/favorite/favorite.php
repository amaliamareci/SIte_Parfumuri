<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Site parfumuri">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produse</title>
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/styles.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/heart.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/favorite.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/products.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/product.css">
</head>

<body>
    <?php include_once "../header.php" ?>

    <h1>Produse favorite</h1>

    <div class="products-container">

        <div class="products-grid" id="favorite_products_container"></div>

    </div>

    <?php include_once "../footer.html" ?>

    <script src="https://web-perm.herokuapp.com/javascript/sidenav.js"></script>
    <script src="https://web-perm.herokuapp.com/javascript/favorites.js"></script>
    <script src="https://kit.fontawesome.com/0f47dad504.js" crossorigin="anonymous"></script>
    <script>
        getFavoriteProducts();
    </script>
</body>

</html>