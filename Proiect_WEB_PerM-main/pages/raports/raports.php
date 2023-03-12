<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Site parfumuri">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produse</title>
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/styles.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/raport.css">
</head>

<body>
    <?php include_once "../header.php" ?>
    <h2>Raports</h2>
    <form class="raports__container" action="https://web-perm.herokuapp.com/pages/raports/raport.php" method="post">
        <div>
            <select name="formType">
                <option value="">Select...</option>
                <option value="stock">stock</option>
                <option value="sold">sold</option>
            </select>
        </div>
        <div>
            <select name="formGender">
                <option value="">Select...</option>
                <option value="toate">toate</option>
                <option value="barbati">barbati</option>
                <option value="femei">femei</option>
                <option value="copii">copii</option>
            </select>
        </div>
        <div>
            <select name="formCategory">
                <option value="">Select...</option>
                <option value="toate">toate</option>
                <option value="orientale">orientale</option>
                <option value="florale">florale</option>
                <option value="lemnoase">lemnoase</option>
                <option value="aromatice">aromatice</option>
                <option value="altele">altele</option>
            </select>
        </div>
        <div>
            <select name="formFormat">
                <option value="">Select...</option>
                <option value="HTML">HTML</option>
                <option value="JSON">JSON</option>
                <option value="PDF">PDF</option>
            </select>
        </div>
        <div>
            <button type="submit">Creaza</button>
        </div>
    </form>

    <h2 style="margin-left:1em;">Adauga produs</h2>
    <form id="insert_product_form"  method="POST">
        <label for="name">Numele parfumului</label><br>
        <input id="name" name="name" type="text" class="form__input" placeholder="Numele parfumului"><br><br>

        <label for="manufacturer">Numele producatorului</label><br>
        <input id="manufacturer" name="manufacturer" type="text" class="form__input" placeholder="Numele producatorului"><br><br>

        <label for="stock">Stocul</label><br>
        <input id="stock" name="stock" type="number" class="form__input" placeholder="Stocul" min="1"><br><br>

        <label for="new_price">Pretul nou</label><br>
        <input id="new_price" name="new_price" type="number" class="form__input" placeholder="Pretul nou" min="1"><br><br>

        <label for="old_price">Pretul vechi</label><br>
        <input id="old_price" name="old_price" type="number" class="form__input" placeholder="Pretul vechi" min="1"><br><br>

        <label for="category">Categoria parfumului</label><br>
        <input id="category" name="category" type="text" class="form__input" placeholder="Categoria parfumului"><br><br>

        <label for="quantity">Cantitatea parfumului</label><br>
        <input id="quantity" name="quantity" type="number" class="form__input" placeholder="Cantitatea parfumului" min="1"><br><br>

        <label for="gender">Genul</label><br>
        <div class="gender" class="form__input-group">
            <input type="radio" value="femei" name="femei" id="femei">
            <label for="femei" >femeie</label><br>
        </div>
        <div class="gender" class="form__input-group">
            <input type="radio" value="barbati" name="barbati" id="barbati">
            <label for="barbati">barbat</label><br>
        </div>
        <div class="gender" class="form__input-group">
            <input type="radio" value="copii" name="copii" id="copii">
            <label for="copii">copii</label><br><br>
        </div>

        <label for="type">Tipul parfumului</label><br>
        <input id="type" name="type" type="text" class="form__input" placeholder="Tipul parfumului"><br><br>

        <!-- <label for="info_url">info_url</label><br>
        <input id="info_url" name="info_url" type="text" class="form__input" placeholder="info_url"><br><br> -->

        <label for="realease_date">Data lansarii</label><br>
        <input id="realease_date" name="realease_date" type="date" class="form__input" placeholder="Data lansarii"><br><br>

        <label for="ingredients">Ingredientele (separate prin ';')</label><br>
        <input id="ingredients" name="ingredients" type="text" class="form__input" placeholder="Ingrediente"><br><br>

        <!-- <label for="photo">Poza cu parfmul</label><br>
        <input id="photo" name="photo" type="file" class="form__input" placeholder="Poza cu parfmul"><br><br>

        <label for="description">Descrierea parfumului</label><br>
        <input id="description" name="description" type="text" class="form__input" placeholder="Descrierea"><br><br> -->

        <input class="insert_product" type="submit" value="Submit">


    </form>


    <?php include_once "../footer.html" ?>

    <script type="text/javascript" src="https://web-perm.herokuapp.com/javascript/insert_product.js"></script>
    <script type="text/javascript" src="https://web-perm.herokuapp.com/javascript/sidenav.js"></script>
    <script type="text/javascript" src="https://web-perm.herokuapp.com/javascript/check_user.js"></script>
    <script src="https://kit.fontawesome.com/0f47dad504.js" crossorigin="anonymous"></script>

</body>

</html>