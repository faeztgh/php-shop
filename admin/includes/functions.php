<?php

// this function will logging user out if it was inactive for specific seconds
function clearSessionWhileInactive($timeout)
{
    if (isset($_SESSION["LAST_ACTIVITY"]) && (time() - $_SESSION["LAST_ACTIVITY"] > $timeout)) {
        session_unset();
        session_destroy();
    }
}

function setupSession()
{
    // setting up session
    if (!isset($_SESSION)) {
        session_start();
    } else {
        header("location: ../login.php");
    }

    if (isset($_SESSION)) {
        // if user be inactive for specified second session will be cleared
        // and user will be logged out automatically
        clearSessionWhileInactive((60*30));

        if (isset($_SESSION["LOGGEDIN"]) && $_SESSION['LOGGEDIN'] == true) {
            if ($_SESSION['ROLE'] == "user") {
                header('location: ../login.php');
            }
        } else {
            header('location: ../login.php');
        }
    }
    $_SESSION['LAST_ACTIVITY'] = time();
}


?>