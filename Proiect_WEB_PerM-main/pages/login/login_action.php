<?php 

include_once '../../includes/config.php';
include_once "../../database/UserRepository.php";

$userRepository = new UserRepository();
$username = $_POST['username'];
$password = $_POST['password'];
$loogedUser = $userRepository -> login($username, $password);

?>

<!DOCTYPE html>

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

    <div class="header__phone">
        <div class="menu" onclick="openNav()">&#9776; meniu</div>
        <div class="logo-phone">
            <a href="https://web-perm.herokuapp.com/index.php" class="logo">
                <img src="https://web-perm.herokuapp.com/img/logos/logo.png">
            </a>
        </div>
    </div>

    <p> You are logged in! </p>

    <script type="text/javascript" src="https://web-perm.herokuapp.com/javascript/login.js"></script>
    <script type="text/javascript" src="https://web-perm.herokuapp.com/javascript/check_user.js"></script>
    <script src="https://kit.fontawesome.com/0f47dad504.js" crossorigin="anonymous"></script>

</body>