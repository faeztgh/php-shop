<?php
include('config/db.php');

// Initialize the session
session_start();

$msg = "";


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
                        if ($msg != "" || !empty($msg)) {
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
                                    name="resetPassword" id="resetPassword">Check Code
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