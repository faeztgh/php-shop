<?php

define("BASE_URL", 'http://localhost/ecommerce/');


// setting up cart count
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['CART'], $_SESSION['CART']['USER_ID']) && $_SESSION['CART']['USER_ID'] == $_SESSION['ID']) {
    $cartCount = count($_SESSION['CART']) - 1;
} else {
    $cartCount = 0;
}


$adminLink = "";
$userLink = "";
$logoutLink = "";
$loginLink = "<a class='dropdown-item' href='login.php'><i class='fa fa-user'></i> Login</a>";
$signUpLink = "<a class='dropdown-item' href='signup.php'> <i class='fa fa-user-plus'> Signup</i></a>";
$homeLink = " <li class='nav-item active'>
                       <a class='nav-link' href='" . BASE_URL . "'>Home <span class='sr-only'>(current)</span></a>
                  </li>";
$username = "";
$cart = "";


if (isset($_SESSION['LOGGEDIN']) && $_SESSION['ROLE'] == "admin") {
    $adminLink = " <a class='dropdown-item' href='" . BASE_URL . "admin/products.php'> <i class='fa fa-user-plus'> Dashboard</i></a>";
}

if (isset($_SESSION['LOGGEDIN']) && $_SESSION['ROLE'] == "user") {

    $cart = "<i class='fa fa-shopping-cart' style='font-size:25px'></i>
             <span class='badge badge-danger' id='lblCartCount'> $cartCount </span>";

    $userLink = " <a class='dropdown-item' href='" . BASE_URL . "user/index.php'> <i class='fa fa-user-plus'> Panel</i></a>";

}

if (isset($_SESSION['LOGGEDIN'])) {
    $logoutLink = "<a class='dropdown-item' href='" . BASE_URL . "logout.php'> <i class='fa fa-sign-out'> Logout</i></a>";
    $loginLink = "";
    $signUpLink = "";

    if (isset($_SESSION['USERNAME'])) {
        $username = $_SESSION['USERNAME'];
    }
}


?>

<link rel="stylesheet" href="assets/css/navigation.css?v=2">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark position-sticky " style="z-index: 999;top: 0;">

    <div class='navbar-brand'>
        <a href='<?php echo BASE_URL?>'>
            <?php
            if (file_exists("assets/img/logo.png")) {
                echo "<img src='assets/img/logo.png' alt='Logo'>";
            } else {
                echo "<img src='../assets/img/logo.png' alt='Logo'>";
            }
            ?>
        </a>
    </div>
    <button data-trigger="#navbar_main" class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Products
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="results.php?cat=mobile">Mobile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="results.php?cat=laptop">Laptop</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="results.php?cat=tablet">Tablet</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="results.php?cat=smartWatch">Smart Watch</a>
                </div>
                <?php
                echo $homeLink;
                ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo BASE_URL . "shop.php" ?>">Shop <span
                            class="sr-only">(current)</span></a>
            </li>

            <!--Shopping cart and Badge-->
            <?php
            if ($cart != "") {
            ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo BASE_URL . "user/cart.php" ?>">
                    <?php
                    echo $cart;
                    }
                    ?>
                </a>
            </li>

            </li>
            <?php
            if ($username != "") {
                echo "      <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown'
                   aria-haspopup='true' aria-expanded='false'>
                 <i class='fa fa-user'></i> $username
                </a>
                <div class='dropdown-menu' aria-labelledby='navbarDropdown' style='right: 0'>
                     $adminLink
                     $userLink
                     $loginLink
                     $signUpLink
                     $logoutLink
                </div>
            </li>";

            } else {
                echo "      <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown'
                   aria-haspopup='true' aria-expanded='false'>
                    <i class='fa fa-user'></i>
                </a>
                <div class='dropdown-menu' aria-labelledby='navbarDropdown' style='right: 0'>
                    $loginLink
                    $signUpLink
                    $logoutLink
                 </div>
            </li>";
            }

            ?>
        </ul>

    </div>
</nav>
