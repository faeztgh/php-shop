<?php
define("BASE_URL", 'http://localhost/ecommerce/');

if (!isset($_SESSION)) {
    session_start();
}

$adminLink = "";
$logoutLink = "";
$loginLink = "<a class='dropdown-item' href='login.php'><i class='fa fa-user'></i> Login</a>";
$signUpLink = "<a class='dropdown-item' href='signup.php'> <i class='fa fa-user-plus'> Signup</i></a>";
$homeLink = " <li class='nav-item active'>
                       <a class='nav-link' href='" . BASE_URL . "'>Home <span class='sr-only'>(current)</span></a>
                  </li>";
$username = "";


if (isset($_SESSION['LOGGEDIN']) && $_SESSION['ROLE'] == "admin") {
    $adminLink = " <a class='dropdown-item' href='" . BASE_URL . "admin'> <i class='fa fa-user-plus'> Dashboard</i></a>";
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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark position-sticky " style="z-index: 999;top: 0;">

    <div class='navbar-brand><a ' href='index.php'><img src="assets/img/logo.png" alt="Logo"></a></div>
    <button data-trigger="#navbar_main" class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav ml-auto">
            <form class="form-inline my-2 my-lg-0 mx-5" method="get">
                <div class="input-group">
                    <input class="form-control" type="search" placeholder="Search">
                    <div class="input-group-append input-group-prepend">
                        <button class="btn  btn-secondary " type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Products
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
                <?php
                echo $homeLink;
                ?>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo BASE_URL . "shop.php" ?>">Shop <span
                            class="sr-only">(current)</span></a>
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
