<?php
include('config/db.php');
require('includes/PHPMailer/src/PHPMailer.php');
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


// Initialize the session
session_start();

$msg = "";
if (isset($_POST, $_POST['resetPass'])) {
    if (isset($_POST['email'])) {
        $email = trim(htmlspecialchars($_POST['email']));
        print_r($email);

        $code = rand(10000, 9999999);

        //Load Composer's autoloader
        require 'includes/vendor/autoload.php';

        //Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'supp.shop2021@gmail.com';
            $mail->Password = 'S12345678P';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('supp.shop2021@gmail.com', 'F&Co. Shop');
            $mail->addAddress($email);


            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password Code';
            $mail->Body = 'Your reset password code is: <b>' . $code . '</b>';

            $mail->send();
            $msg = '<div class="alert alert-success">Message has been sent</div>';

            // set the code in session
            $_SESSION['RESET_CODE'] = $code;
            $_SESSION['RESET_EMAIL'] = $email;

            // resirect to next step
            header("location: reset-password2.php");
        } catch (Exception $e) {
            $msg = "<div class='alert alert-danger'>Message could not be sent email!</div>";
        }


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
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope font-icon"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" type="email" id="email" name="email"
                                           placeholder="Email" style="direction: ltr">
                                </div>
                                <span id="emailAlert" class="alert-span"></span>
                            </div>

                            <button class="btn btn-dark btn-block font-weight-bold font-md mt-5" type="submit"
                                    name="resetPass" id="resetBtn">Reset Password
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