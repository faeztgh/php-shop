<?php
include('config/db.php');

// Initialize the session
session_start();

$msg = "";
if (isset($_SESSION, $_SESSION['RESET_CODE'])) {

    $code = $_SESSION['RESET_CODE'];
    print_r($code);
}


if (isset($_POST, $_POST['code'])) {
    if (isset($_POST['codeInput'])) {
        $receivedCode = $_POST['codeInput'];
        print_r($receivedCode);
    }
}

if (!empty($code) && !empty($receivedCode)) {
    if ($code == $receivedCode) {
        header("location: reset-password3.php");
    } else {
        $msg = "<div class='alert alert-danger'>Wrong Code!</div>";
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
                                <label for="code">Enter the Code</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-qrcode font-icon"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" type="text" id="code" name="codeInput"
                                           placeholder="Code" style="direction: ltr">
                                </div>
                                <span id="emailAlert" class="alert-span"></span>
                            </div>

                            <button class="btn btn-dark btn-block font-weight-bold font-md mt-5" type="submit"
                                    name="code" id="checkCode">Check Code
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