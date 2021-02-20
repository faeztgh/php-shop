<?php
include('config/db.php');

// Initialize the session
session_start();

$password = $repeatPassword = $msg = "";

if (isset($_POST, $_POST['resetPassword'])) {
    if (isset($_POST['password'], $_POST['password-rep'])) {
        if (isset($_SESSION, $_SESSION['RESET_EMAIL'])) {

            $email = $_SESSION['RESET_EMAIL'];
            $password = $_POST['password'];
            $repeatPassword = $_POST['password-rep'];

            if (empty($password) || empty($repeatPassword) || empty($email)) {
                $msg = "<div class='alert alert-danger'>Please fill all the fields!</div>";
            } else {
                $email = trim(htmlspecialchars($email));
                $password = trim(htmlspecialchars($password));
                $repeatPassword = trim(htmlspecialchars($repeatPassword));

                // Check for existence query
                $query = "SELECT u_id FROM t_user WHERE u_email= :email";

                if ($stmt = $pdo->prepare($query)) {
                    $stmt->execute(['email' => $email]);
                    if ($stmt->rowCount() == 0) {
                        $msg = "<div class='alert alert-danger'>User Not Exist!</div>";
                    } else {

                        // validate password
                        if ($password != $repeatPassword) {
                            $msg = "<div class='alert alert-danger'>Passwords not match!</div>";
                        } elseif (strlen($password) < 6) {
                            $msg = "<div class='alert alert-danger'>Your password must be more than 6 character!</div>";
                        } else {
                            // insert into db
                            $updateQuery = "UPDATE t_user SET (u_password) VALUES (:password)";

                            if ($stmtUpdate = $pdo->prepare($updateQuery)) {
                                $password = password_hash($password, PASSWORD_BCRYPT);
                                $execRes = $stmtUpdate->execute(['password' => $password]);

                                if ($execRes) {
                                    $msg = "<div class='alert alert-danger'>Password Changed!</div>";
                                    // Redirect to login page
                                    header("location: login.php");
                                } else {
                                    $msg = "<div class='alert alert-danger'>Something went wrong. Please try again!</div>";
                                }
                                unset($stmtUpdate);
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
    }
}
?>

<?php
$page_title = "Reset Password";
include('includes/head.php');
?>
    <div class="container">
        <div class="row  m-auto col-sm-12 max-width-600">
            <div class="col-sm-12 col-md">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h1>Reset Password</h1>
                    </div>
                    <div class="card-body">

                        <?php
                        if (!empty($email)) {
                            echo "<div class='alert alert-info'>$email</div>";
                        }
                        if (!empty($msg)) {
                            echo $msg;
                        }
                        ?>
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                            <?php
                            if (!empty($error)) {
                                echo " <div class='alert alert-danger text-center'>$error</div>";
                            }
                            ?>
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-asterisk font-icon"></i>
                                    </span>
                                    </div>
                                    <input class="form-control" type="password" id="password" name="password"
                                           placeholder="New Password">
                                </div>
                                <span id="passwordAlert" class="alert-span"></span>

                            </div>
                            <div class="form-group">
                                <label for="password-rep">Confirm New Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-repeat font-icon"></i>
                                    </span>
                                    </div>
                                    <input class="form-control" type="password" id="password-rep" name="password-rep"
                                           placeholder="Confirm New Password">
                                </div>
                                <span id="passwordRepAlert" class="alert-span"></span>
                            </div>

                            <button class="btn btn-dark btn-block font-weight-bold font-md mt-5" type="submit"
                                    name="resetPassword" id="resetPassword">Reset Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
include('includes/tail.php');
?>