<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Site parfumuri">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfumé</title>
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/styles.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/custom-form.css">
</head>

<body>

    <?php include "../header.php" ?>

    <form class="form-container" action="https://web-perm.herokuapp.com/pages/custom-form/custom-perfume.php" method="get">

        <h3>Unde doriti sa purtati acest parfum?</h3>
        <div class="question-container">
            <label class="img-container"> 
                <input type="radio" name="step1" value="date_night">
                <img alt="date_night" src="https://web-perm.herokuapp.com/img/custom-form/step_1_date_night.webp">
                <span>Intalnire</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step1" value="everyday">
                <img alt="everyday" src="https://web-perm.herokuapp.com/img/custom-form/step_1_everyday.webp">
                <span>Zi de zi</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step1" value="night_out">
                <img alt="night_out" src="https://web-perm.herokuapp.com/img/custom-form/step_1_night_out.webp">
                <span>In oras</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step1" value="office">
                <img alt="office" src="https://web-perm.herokuapp.com/img/custom-form/step_1_office.webp">
                <span>Birou</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step1" value="special_occasion">
                <img alt="special_occasion" src="https://web-perm.herokuapp.com/img/custom-form/step_1_special_occasion.webp">
                <span>Ocazie speciala</span>
            </label>
        </div>

        <h3>Care este mirosul dumneavoastra favorit?</h3>
        <div class="question-container">
            <label class="img-container"> 
                <input type="radio" name="step2" value="chai">
                <img alt="chai" src="https://web-perm.herokuapp.com/img/custom-form/step_3_chai.webp">
                <span>Cafea</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step2" value="cookie">
                <img alt="cookie" src="https://web-perm.herokuapp.com/img/custom-form/step_3_cookie.webp">
                <span>Prajituri</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step2" value="cut_grass">
                <img alt="cut_grass" src="https://web-perm.herokuapp.com/img/custom-form/step_3_cut_grass.webp">
                <span>Iarba</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step2" value="mulled_wine">
                <img alt="mulled_wine" src="https://web-perm.herokuapp.com/img/custom-form/step_3_mulled_wine.webp">
                <span>Vin fiert</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step2" value="ocean">
                <img alt="ocean" src="https://web-perm.herokuapp.com/img/custom-form/step_3_ocean.webp">
                <span>Ocean</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step2" value="pina">
                <img alt="pina" src="https://web-perm.herokuapp.com/img/custom-form/step_3_pina.webp">
                <span>Cocktail</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step2" value="rose">
                <img alt="rose" src="https://web-perm.herokuapp.com/img/custom-form/step_3_rose_garden.webp">
                <span>Trandafiri</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step2" value="wood">
                <img alt="wood" src="https://web-perm.herokuapp.com/img/custom-form/step_3_wood.webp">
                <span>Lemn</span>
            </label>
        </div>

        <h3>Unde ati prefera sa va petreceti vacanta?</h3>
        <div class="question-container">
            <label class="img-container"> 
                <input type="radio" name="step3" value="beach">
                <img alt="beach" src="https://web-perm.herokuapp.com/img/custom-form/step_4_beach.webp">
                <span>La mare</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step3" value="hiking">
                <img alt="hiking" src="https://web-perm.herokuapp.com/img/custom-form/step_4_hiking.webp">
                <span>La munte</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step3" value="ski">
                <img alt="ski" src="https://web-perm.herokuapp.com/img/custom-form/step_4_ski.webp">
                <span>Ski</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step3" value="versailles">
                <img alt="versailles" src="https://web-perm.herokuapp.com/img/custom-form/step_4_versailles.webp">
                <span>Gradinile din Versailles</span>
            </label>
        </div>

        <h3>Ce bautura ati prefera?</h3>
        <div class="question-container">
            <label class="img-container"> 
                <input type="radio" name="step4" value="coffee">
                <img alt="coffee" src="https://web-perm.herokuapp.com/img/custom-form/step_5_coffee.webp">
                <span>Cafea</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step4" value="mimosa">
                <img alt="mimosa" src="https://web-perm.herokuapp.com/img/custom-form/step_5_mimosa.webp">
                <span>Mimosa</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step4" value="rose">
                <img alt="rose" src="https://web-perm.herokuapp.com/img/custom-form/step_5_rose.webp">
                <span>Vin rose</span>
            </label>
            <label class="img-container"> 
                <input type="radio" name="step4" value="scotch">
                <img alt="scotch" src="https://web-perm.herokuapp.com/img/custom-form/step_5_scotch.webp">
                <span>Scotch</span>
            </label>
        </div>

        <input class="submit-button" type="submit" value="Submit">
    
    </form>


    <br><br>
    <?php include "../footer.html" ?>
    
    <script src="https://web-perm.herokuapp.com/javascript/sidenav.js"></script>
    <script src="https://kit.fontawesome.com/0f47dad504.js" crossorigin="anonymous"></script>
</body>

</html>