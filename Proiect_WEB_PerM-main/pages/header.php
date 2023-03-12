
<header id="mySidenav">

    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

    <div class="header__top">
        <div class="logo-holder">
            <a href="https://web-perm.herokuapp.com/index.php" class="logo">
                <img width="200" height="60" alt="logo" src="https://web-perm.herokuapp.com/img/logos/logo.png">
            </a>
        </div>

        <div class="item">
            <a href="https://web-perm.herokuapp.com/pages/favorite/favorite.php">FAVORITE</a>
            <i class="fa-solid fa-heart"></i>
        </div>

        <div class="item">
            <a href="https://web-perm.herokuapp.com/pages/login/login.php">CONTUL MEU</a>
            <i class="fa-solid fa-user"></i>
        </div>

        <div class="item">
            <a href="https://web-perm.herokuapp.com/pages/cart/cart.php">COSUL MEU</a>
            <i class="fa-solid fa-cart-shopping"></i>
        </div>

    </div>

    <div class="header__nav">
        <div class="item-nav"><a href="https://web-perm.herokuapp.com/pages/products/noutati.php">NOUTATI</a></div>
        <div class="item-nav"><a href="https://web-perm.herokuapp.com/pages/products/femei.php">FEMEI</a></div>
        <div class="item-nav"><a href="https://web-perm.herokuapp.com/pages/products/barbati.php">BARBATI</a></div>
        <div class="item-nav"><a href="https://web-perm.herokuapp.com/pages/products/copii.php">COPII</a></div>
        <div class="item-nav"><a href="https://web-perm.herokuapp.com/pages/custom-form/custom-form.php">RECOMANDARI</a></div>

        <form class="search-container" action="https://web-perm.herokuapp.com/pages/products/search.php" method="get">
            <input type="text" placeholder="Search..." name="search">
            <button aria-label="search" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>
</header>

<div class="header__phone">
    <div class="menu" onclick="openNav()">&#9776; meniu</div>
    <div class="logo-phone">
        <a href="https://web-perm.herokuapp.com/index.php" class="logo">
            <img width="200" height="60" alt="logo" src="https://web-perm.herokuapp.com/img/logos/logo.png">
        </a>
    </div>
</div>