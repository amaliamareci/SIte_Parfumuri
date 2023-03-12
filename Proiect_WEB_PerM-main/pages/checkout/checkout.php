<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Site parfumuri">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/checkout.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/styles.css">
</head>

<body>

    <?php include_once "../header.php" ?>
    <div class="row">
        <div class="col-75">
            <div class="container">
                <form action="https://web-perm.herokuapp.com/pages/checkout/checkout_action.php" method='POST'>

                    <div class="row">
                        <div class="col-50">
                            <h3>Adresa de livrare</h3>
                            <label for="fname"><i class="fa fa-user"></i>Nume</label>
                            <input type="text" id="fname" name="firstname" placeholder="nume">
                            <label for="email"><i class="fa fa-envelope"></i> Email</label>
                            <input type="text" id="email" name="email" placeholder="email">
                            <label for="adr"><i class="fa fa-address-card-o"></i> Adresa</label>
                            <input type="text" id="adr" name="address" placeholder="adresa">
                            <label for="city"><i class="fa fa-institution"></i> Oras</label>
                            <input type="text" id="city" name="city" placeholder="oras">

                            <div class="row">
                                <div class="col-50">
                                    <label for="state">Judet</label>
                                    <input type="text" id="state" name="state" placeholder="judet">
                                </div>
                                <div class="col-50">
                                    <label for="zip">Cod postal</label>
                                    <input type="text" id="zip" name="zip" placeholder="123456">
                                </div>
                            </div>
                        </div>

                        <div class="col-50">
                            <h3>Plata</h3>

                            <label for="cname">Numele detinatorului</label>
                            <input type="text" id="cname" name="cardname" placeholder="nume">
                            <label for="ccnum">Numarul cardului</label>
                            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">

                            <div class="row">
                                <div class="col-50">
                                    <label for="expyear">Anul expirarii</label>
                                    <input type="text" id="expyear" name="expyear" placeholder="2018">
                                </div>
                                <div class="col-50">
                                    <label for="expmonth">Luna expirarii</label>
                                    <input type="text" id="expmonth" name="expmonth" placeholder="01">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-50">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="352">
                                </div>
                            </div>
                        </div>

                    </div>
                    <label>
                        <input type="checkbox" checked="checked"> Livrare in regim de cadou
                    </label>
                    <button type="submit" class="btn">Checkout</button>
                </form>
            </div>
        </div>
    </div>

    <br>
    <?php include_once "../footer.html" ?>

    <script type="text/javascript" src="https://web-perm.herokuapp.com/javascript/sidenav.js"></script>
    <script type="text/javascript" src="https://web-perm.herokuapp.com/javascript/checkout.js"></script>
    <script src="https://kit.fontawesome.com/0f47dad504.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</body>

</html>