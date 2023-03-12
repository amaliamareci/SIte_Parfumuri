<?php

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
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/cart.css">
</head>

<body>
    <?php include_once "../header.php" ?>

    <h1>Cosul meu</h1>

    <br><br><br>

    <div class="shopping-cart">

        <div class="column-labels">
            <label class="product-image">Imagine</label>
            <label class="product-details">Produs</label>
            <label class="product-price">Pret</label>
            <label class="product-quantity">Cantitate</label>
            <label class="product-removal">Sterge</label>
            <label class="product-line-price">Total</label>
        </div>

        <div id="add_products"> </div>

        <!--
        <div class="product">
            <div class="product-image">
                <img src="https://web-perm.herokuapp.com/img/parfumes/ari.jpg">  
            </div>
            <div class="product-details">
                <div class="product-title">Ari by Ariana Grande</div>    
                <p class="product-description">Eau de Parfum pentru femei</p>  
            </div>
            <div class="product-price">12.99</div>  
            <div class="product-quantity">
                <input type="number" value="2" min="1">     
            </div>
            <div class="product-removal">
                <button class="remove-product">
                    Sterge
                </button>
            </div>
            <div class="product-line-price">25.98</div> 
        </div>
        -->

        <div class="totals">
            <div class="totals-item">
                <label>Subtotal</label>
                <div class="totals-value" id="cart-subtotal"></div>
            </div>
            <div class="totals-item">
                <label>Transport</label>
                <div class="totals-value" id="cart-shipping">14.99</div>
            </div>
            <div class="totals-item totals-item-total">
                <label>Total</label>
                <div class="totals-value" id="cart-total"></div>
            </div>
            <div class="totals-item" id="error__cart--stock"></div>
        </div>

        <a class="checkout" id="checkoutButton" href="#" style="text-decoration:none">
            Checkout
        </a>

    </div>

    <br><br>

    <?php include_once "../footer.html" ?>

    <script src="https://web-perm.herokuapp.com/javascript/cart.js"></script>
    <script src="https://web-perm.herokuapp.com/javascript/sidenav.js"></script>
    <script src="https://web-perm.herokuapp.com/javascript/check_user.js"></script>
    <script src="https://kit.fontawesome.com/0f47dad504.js" crossorigin="anonymous"></script>
    <script>
        getProducts();
    </script>


</body>

</html>