<?php
// Initialize the session
session_start();


?>
<?php
$page_title = "بازیابی رمز عبور";
include('includes/head.php');
?>
    <div class="container">
        <div class="row  m-auto col-sm-12 max-width-600">
            <div class="col-sm-12 col-md">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h1>بازیابی رمز عبور</h1>
                    </div>
                    <div class="card-body">
                        <form id="registerForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                            <?php
                            if (!empty($error)) {
                                echo " <div class='alert alert-danger text-center'>$error</div>";
                            }
                            ?>
                            <div class="form-group">
                                <label for="email">ایمیل</label>
                                <div class="input-group">
                                    <input class="form-control" type="email" id="email" name="email"
                                           placeholder="ایمیل">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-envelope font-icon"></i>
                                    </span>
                                    </div>
                                </div>
                                <span id="emailAlert" class="alert-span"></span>
                            </div>

                            <button class="btn btn-dark btn-block font-weight-bold font-md mt-5" type="submit"
                                    name="updatePass"
                                    id="registerBtn">تغییر رمز عبور
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