<?php
require('config/db.php');

?>

<?php
// initializing variables
$username = $password = $error = $welcomeMsg = "";

// setting up cookies
if (isset($_COOKIE['NEW_USER'])) {
    $isNewUser = $_COOKIE['NEW_USER'];
    if ($isNewUser == true) {
        $welcomeMsg = "You registered successfully!";
    }
}


// setting up session
if (!isset($_SESSION)) {
    session_start();

} else {
    header("location: login.php");
}

if (isset($_SESSION)) {

    if (isset($_SESSION['LOGGEDIN']) && $_SESSION['LOGGEDIN'] === true) {
        if ($_SESSION['ROLE'] === "admin") {
            header("location: admin/index.php");
        }
        if ($_SESSION['ROLE'] === "user") {
            header("location: shop.php");
        }
    }
}

if (isset($_POST['login'])) {
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));

    if (empty($username) || empty($password)) {
        $error = "Please fill all the fields!";
    } else {
        $query = "SELECT * FROM t_user WHERE u_userName=:username";

        if ($stmt = $pdo->prepare($query)) {
            $stmt->execute(['username' => $username]);

            if ($stmt->rowCount() != 1) {
                $error = "User not exist!";

            } else {

                if ($row = $stmt->fetch()) {
                    $id = $row['u_id'];
                    $role = $row['u_role'];
                    $username = $row['u_userName'];
                    $hashed_password = $row['u_password'];

                    // validate password
                    if (password_verify($password, $hashed_password)) {

                        // save user data in session
                        session_start();
                        $_SESSION['LOGGEDIN'] = true;
                        $_SESSION['ID'] = $id;
                        $_SESSION['USERNAME'] = $username;

                        // set the time for LAST_ACTIVITY
                        $_SESSION['LAST_ACTIVITY'] = time();

                        // check if user is admin or simple user
                        if ($role == "admin") {
                            $_SESSION['ROLE'] = "admin";
                            header("location: admin/");
                        }
                        if ($role == "user") {
                            $_SESSION['ROLE'] = "user";
                            $_SESSION['CART']['USER_ID'] = $id;
                            header("location: index.php");
                        }
                    } else {
                        $error = "Wrong Password!";
                    }

                    // close the statement
                    unset($stmt);
                }
            }
        }
    }
}

//close connection
unset($pdo);

?>

<?php
//including header
$page_title = "Login";
include('includes/head.php');
?>


<div class="container">
    <div class="row  m-auto col-sm-12 max-width-600">
        <div class="col-sm-12 col-md">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Login</h1>
                </div>
                <div class="card-body">

                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"
                          onsubmit="return(loginFormValidation());">
                        <?php
                        if (!empty($error)) {
                            echo " <div class='alert alert-danger text-center'>$error</div>";
                        }
                        if (!empty($welcomeMsg)) {
                            echo " <div class='alert alert-success text-center'>$welcomeMsg</div>";
                        }

                        ?>

                        <!--Username-->
                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-user font-icon"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" id="username" name="username"
                                       placeholder="Username" style="direction: ltr">
                            </div>
                            <span id="usernameAlert" class="alert-span"></span>
                        </div>

                        <!--Password-->
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-asterisk font-icon"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="password" id="password" name="password"
                                       placeholder="Password">
                            </div>
                            <a href="reset-password.php" class="btn btn-link">Forgot Password?</a>
                            <span id="passwordAlert" class="alert-span d-inline-block"></span>
                        </div>


                        <button class="btn btn-dark btn-block font-weight-bold font-md mt-5" type="submit" name="login">
                            Login
                        </button>

                        <a href="signup.php" class="btn btn-outline-secondary btn-block font-weight-bold font-md"
                           type="button">Sign Up</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Scripts -->


<script src="assets/js/script.js"></script>

<script>
    // remove welcome message of new user after certain time ;
    const welcomeMsg = document.querySelector(".alert-success");
    if (welcomeMsg !== null) {
        setTimeout(() => {
            welcomeMsg.remove();
        }, 5000)
    }
</script>


<?php
//including footer
include('includes/tail.php');
?>
