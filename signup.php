<?php require('config/db.php'); ?>

<?php
// initializing variables
$username = $password = $repeatPassword = $error = "";
$role = "user";


if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['password-rep'];

    if (empty($username) || empty($password) || empty($repeatPassword) || empty($email)) {
        $error = "Please fill all the fields!";

    } else {
        $username = trim(htmlspecialchars($username));
        $email = trim(htmlspecialchars($email));
        $password = trim(htmlspecialchars($password));
        $repeatPassword = trim(htmlspecialchars($repeatPassword));

        // Check for existence query
        $query = "SELECT u_id FROM t_user WHERE u_userName= :username OR u_email= :email";

        if ($stmt = $pdo->prepare($query)) {
            $stmt->execute(['username' => $username, 'email' => $email]);
            if ($stmt->rowCount() > 0) {
                $error = "User Exist!";
            } else {

                // validate password
                if ($password != $repeatPassword) {
                    $error = "Passwords not match!";
                } elseif (strlen($password) < 6) {
                    $error = "Your password must be more than 6 character!";
                } else {
                    // insert into db
                    $insertQuery = "INSERT INTO t_user (u_userName,u_email, u_password, u_role) 
                            VALUES (:username,:email,:password,:role)";

                    if ($stmtInsert = $pdo->prepare($insertQuery)) {
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        $execRes = $stmtInsert->execute(['username' => $username, 'email' => $email,
                            'password' => $password, 'role' => $role]);

                        if ($execRes) {
                            // set cookie for new user to show proper message
                            $cookie_name = "NEW_USER";
                            $cookie_value = true;
                            setcookie($cookie_name, $cookie_value, time() + 15);

                            // Redirect to login page
                            header("location: login.php");

                        } else {
                            $error = "Something went wrong. Please try again!";
                        }
                        unset($stmtInsert);
                    }
                }
            }
        }
        // close the statement
        unset($stmt);
    }
}
// close connection to db
unset($pdo);

?>

<?php
$page_title = "Sign Up";
include('includes/head.php');
?>

<div class="container">
    <div class="row  m-auto col-sm-12 max-width-600">
        <div class="col-sm-12 col-md">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h1>Sign Up</h1>
                </div>
                <div class="card-body">
                    <form id="registerForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"
                          onsubmit="return(registerFormValidation());">
                        <?php
                        if (!empty($error)) {
                            echo " <div class='alert alert-danger text-center'>$error</div>";
                        }
                        ?>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-user font-icon"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" id="username" name="username"
                                       placeholder="Username">
                            </div>
                            <span id="usernameAlert" class="alert-span"></span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-envelope font-icon"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="email" id="email" name="email" placeholder="Email">
                            </div>
                            <span id="emailAlert" class="alert-span"></span>
                        </div>
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
                            <span id="passwordAlert" class="alert-span"></span>

                        </div>
                        <div class="form-group">
                            <label for="password-rep">Confirm Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-repeat font-icon"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="password" id="password-rep" name="password-rep"
                                       placeholder="Confirm Password">
                            </div>
                            <span id="passwordRepAlert" class="alert-span"></span>
                        </div>

                        <button class="btn btn-dark btn-block font-weight-bold font-md mt-5" type="submit"
                                name="register"
                                id="registerBtn">Sign Up
                        </button>

                        <a href="login.php" class="btn btn-outline-secondary btn-block font-weight-bold font-md"
                           type="button">Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    <?php
    include('assets/js/script.js');
    ?>
</script>
<?php
include('includes/tail.php');
?>
