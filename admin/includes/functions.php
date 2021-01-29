<?php



// this function will loggin user out if it was inactive for specific seconds
function clearSessionWhileInactive($timeout)
{
    if (isset($_SESSION["LAST_ACTIVITY"]) && (time() - $_SESSION["LAST_ACTIVITY"] > $timeout)) {

        session_unset();
        session_destroy();
    }
}


?>