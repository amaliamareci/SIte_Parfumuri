<!DOCTYPE html>
<html lang="ro">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="description" content="Site parfumuri">
    <title>Login / Sign Up Form</title>
    <link rel="shortcut icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/login.css">
    <link rel="stylesheet" href="https://web-perm.herokuapp.com/css/styles.css">
</head>

<body>
    <?php include_once "../header.php"; ?>

    <div class="login-wrapper">
        <div class="container">
            <div class="form--hidden" id="loggedUserInfo">
                <div id="loggedUser__info"></div><br>
                <button id="logout_button">Log out</button>
            </div>

            <form class="form" id="login" method="post">
                <h1 class="form__title">Login</h1>
                <div class="form__message form__message--error"></div>
                <div class="form__input-group">
                    <input id="user" name="username" type="text" class="form__input" placeholder="Username">
                    <div class="form__input-error-message"></div>
                </div>
                <div class="form__input-group">
                    <input id="pass" name="password" type="password" class="form__input" placeholder="Password">
                    <div class="form__input-error-message"></div>
                </div>
                <button class="form__button" type="submit">Continua</button>
                <p class="form__text">
                    <a href="./" class="form__link" id="changePassLink">Schimba parola</a>
                </p>
                <p class="form__text">
                    <a class="form__link" href="./" id="linkCreateAccount">Creaza cont</a>
                </p>
            </form>

            <form class="form form--hidden" id="createAccount">
                <h1 class="form__title">Creaza cont</h1>
                <div class="form__message form__message--error"></div>
                <div class="form__input-group">
                    <input type="text" id="signupUsername" class="form__input" placeholder="Username">
                    <div class="form__input-error-message"></div>
                </div>
                <div class="form__input-group">
                    <input type="text" id="signupEmail" class="form__input" placeholder="Email Address">
                    <div class="form__input-error-message"></div>
                </div>
                <div class="form__input-group">
                    <input type="password" id="signupPassword" class="form__input" placeholder="Password">
                    <div class="form__input-error-message"></div>
                </div>
                <div class="form__input-group">
                    <input type="password" id="signupConfirmPassword" class="form__input" placeholder="Confirm password">
                    <div class="form__input-error-message"></div>
                </div>
                <div class="form__input-group">
                    <input type="text" id="signupFirstName" class="form__input" placeholder="First Name">
                    <div class="form__input-error-message"></div>
                </div>
                <div class="form__input-group">
                    <input type="text" id="signupLastName" class="form__input" placeholder="Last Name">
                    <div class="form__input-error-message"></div>
                </div>
                <div class="form__input-group genderForm">
                    <input type="radio" value="femeie" name="signupGender" id="female">
                    <label>femeie</label>
                    <div class="form__input-error-message"></div>
                </div>
                <div class="form__input-group genderForm">
                    <input type="radio" value="barbat" name="signupGender" id="male">
                    <label>barbat</label>
                    <div class="form__input-error-message"></div>
                </div>
                <div class="form__input-group">
                    <input type="text" id="signupAddress" class="form__input" placeholder="Address">
                    <div class="form__input-error-message"></div>
                </div>
                <div class="form__input-group">
                    <input type="date" id="signupBirthday" class="form__input">
                    <div class="form__input-error-message"></div>
                </div>
                <button class="form__button" type="submit">Continua</button>
                <p class="form__text">
                    <a class="form__link" href="./" id="linkLogin">Log in</a>
                </p>
            </form>

            <form class="form form--hidden" id="change_password" method="post">
                <h1 class="form__title">Schimba parola</h1>
                <div class="form__message form__message--error"></div>
                <div class="form__input-group">
                    <input id="changeUser" name="username" type="text" class="form__input" placeholder="Username">
                    <div class="form__input-error-message"></div>
                </div>
                <div class="form__input-group">
                    <input id="pass_old" name="password_old" type="password" class="form__input" placeholder="Parola veche">
                    <div class="form__input-error-message"></div>
                </div>
                <div class="form__input-group">
                    <input id="pass_new" name="password_new" type="password" class="form__input" placeholder="Parola noua">
                    <div class="form__input-error-message"></div>
                </div>
                <button class="form__button" type="submit">Continua</button>
                <p class="form__text">
                    <a class="form__link" href="./" id="linkLoginFromChangePass">Log in</a>
                </p>
            </form>

        </div>
    </div>

    <?php include_once "../footer.html" ?>

    <script src="https://web-perm.herokuapp.com/javascript/login.js"></script>
    <script src="https://web-perm.herokuapp.com/javascript/check_user.js"></script>
    <script src="https://web-perm.herokuapp.com/javascript/sidenav.js"></script>
    <script src="https://kit.fontawesome.com/0f47dad504.js" crossorigin="anonymous"></script>

</body>

</html>