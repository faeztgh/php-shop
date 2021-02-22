<?php require('../config/db.php'); ?>


<?php
$userId = $errorMsg = $successMsg = "";

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION, $_SESSION['LOGGEDIN'], $_SESSION['ID'])) {
    $userId = $_SESSION['ID'];
}

// Getting data from DB and set it to fields
if (!empty($userId)) {
    $query = "SELECT * FROM t_user WHERE u_id=:userId";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['userId' => $userId]);

    $user = $stmt->fetch();

    $id = $user['u_id'];
    $name = $user['u_name'];
    $lastName = $user['u_lastName'];
    $phoneNo = $user['u_phoneNo'];
    $email = $user['u_email'];
    $userName = $user['u_userName'];
    $password = $user['u_password'];
    $address = $user['u_address'];


}

// Saving Edited data to DB

if (isset($_POST, $_POST['editProfile'])) {

    $u_name = trim(htmlspecialchars($_POST['name']));
    $u_lastName = trim(htmlspecialchars($_POST['lastName']));
    $u_phoneNo = trim(htmlspecialchars($_POST['phoneNo']));
    $u_username = trim(htmlspecialchars($_POST['userName']));
    $u_email = trim(htmlspecialchars($_POST['email']));
    $u_password = trim(htmlspecialchars($_POST['password']));
    $u_address = trim(htmlspecialchars($_POST['address']));

    $u_name = empty($u_name) ? $name : $u_name;
    $u_lastName = empty($u_lastName) ? $lastName : $u_lastName;
    $u_phoneNo = empty($u_phoneNo) ? $phoneNo : $u_phoneNo;
    $u_email = empty($u_email) ? $email : $u_email;
    $u_address = empty($u_address) ? $address : $u_address;

    // checking password
    if (!empty($u_password)) {
        if (strlen($u_password) < 6) {
            $errorMsg = "Your password must be more than 6 character";
            return;
        } else {
            $u_password = password_hash($u_password, PASSWORD_BCRYPT);
        }
    } else {
        $u_password = $password;
    }

    $updateQuery = "UPDATE t_user SET u_name=:u_name,u_lastName=:u_lastname,u_userName=:u_username,
                    u_email=:u_email,u_password=:u_password,u_phoneNo=:u_phoneNo,u_address=:u_address WHERE u_id=:u_id";

    $updateStmt = $pdo->prepare($updateQuery);
    $execRes = $updateStmt->execute(['u_name' => $u_name, 'u_lastname' => $u_lastName, 'u_username' => $u_username, 'u_email' =>
        $u_email, 'u_password' => $u_password, 'u_phoneNo' => $u_phoneNo, 'u_address' => $u_address, 'u_id' => $id]);

    if ($execRes) {
        $successMsg = "Your profile updated successfully";
        header('location:edit_profile.php');
    } else {
        $errorMsg = "Oops! Something went wrong!";
    }
}


?>


<?php
$page_title = "Edit Profile";
include('includes/head.php');
include('includes/sidebar.php');
?>
<div class="d-flex mb-5 mt-5" id="wrapper" style="overflow: unset">
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-5 col-md-5 col-xs-10">

                    <div class="card mt-5">
                        <div class="card-header text-center">
                            <h1><i class="fa fa-edit font-icon"></i>
                                Edit Profile
                            </h1>


                        </div>
                        <div class="card-body">
                            <form id="editProfileForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"
                                  onsubmit="return(editProfileFormValidation());">
                                <?php
                                if (!empty($errorMsg)) {
                                    echo " <div class='alert alert-danger text-center'>$errorMsg</div>";
                                }

                                if (!empty($successMsg)) {
                                    echo " <div class='alert alert-success text-center'>$successMsg</div>";
                                }
                                ?>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-edit font-icon"></i>
                                    </span>
                                        </div>
                                        <input class="form-control" type="text" id="name" name="name"
                                               value="<?php echo $name ?>"
                                               placeholder="Name">
                                    </div>
                                    <span id="nameAlert" class="alert-span"></span>
                                </div>

                                <div class="form-group">
                                    <label for="lastName">Last name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-edit font-icon"></i>
                                    </span>
                                        </div>
                                        <input class="form-control" type="text" id="lastName" name="lastName"
                                               value="<?php echo $lastName ?>"
                                               placeholder="Lastname">
                                    </div>
                                    <span id="lastNameAlert" class="alert-span"></span>
                                </div>

                                <div class="form-group">
                                    <label for="phoneNo">Phone Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-phone font-icon"></i>
                                    </span>
                                        </div>
                                        <input class="form-control" type="text" id="phoneNo" name="phoneNo"
                                               maxlength="11"
                                               value="<?php echo $phoneNo ?>"
                                               minlength="10"
                                               placeholder="Phone">
                                    </div>
                                    <span id="phoneNoAlert" class="alert-span"></span>
                                </div>


                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-user font-icon"></i>
                                    </span>
                                        </div>
                                        <input class="form-control" type="text" id="username" name="userName"
                                               value="<?php echo $userName ?>"
                                               placeholder="Username"

                                        >
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
                                        <input class="form-control" type="email" id="email" name="email"
                                               placeholder="Email"
                                               value="<?php echo $email ?>">
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
                                               minlength="6"
                                               placeholder="Password">
                                    </div>
                                    <span id="passwordAlert" class="alert-span"></span>

                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-location-arrow font-icon"></i>
                                    </span>
                                        </div>
                                        <textarea class="form-control" type="text" id="address" name="address" rows="5"
                                                  placeholder="Address"><?php echo $address ?></textarea>
                                    </div>
                                    <span id="addressAlert" class="alert-span"></span>
                                </div>

                                <button class="btn btn-dark btn-block font-weight-bold font-md mt-5" type="submit"
                                        name="editProfile"
                                        id="registerBtn">Save Changes
                                </button>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/script.js"></script>

<?php
include('includes/tail.php');
?>
