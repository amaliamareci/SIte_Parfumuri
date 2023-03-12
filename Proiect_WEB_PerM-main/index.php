<?php 

// require ($_SERVER['DOCUMENT_ROOT'] . '/web-perm.herokuapp.com/vendor/autoload.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
include_once "AuthController.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Site parfumuri">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfumé</title>
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/styles.css">
</head>

<body>

    <div>
        <?php include "pages/header.php" ?>

        <div class="slideshow-container">

            <div class="mySlides fade">
                <div class="numbertext">1 / 2</div>
                <img width="2000" height="1000" alt="slideshow image" src="https://web-perm.herokuapp.com/img/slideshow/slide1.png">
            </div>

            <div class="mySlides fade">
                <div class="numbertext">1 / 2</div>
                <img width="2000" height="1000" alt="slideshow image" src="https://web-perm.herokuapp.com/img/slideshow/slide3.png">
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>

        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
        </div>

        <?php include "pages/footer.html" ?>

    </div>
    <script src="https://web-perm.herokuapp.com/javascript/slideshow.js"></script>
    <script src="https://web-perm.herokuapp.com/javascript/sidenav.js"></script>
    <script src="https://web-perm.herokuapp.com/javascript/check_user.js"></script>
    <script src="https://kit.fontawesome.com/0f47dad504.js" crossorigin="anonymous"></script>

</body>

</html>