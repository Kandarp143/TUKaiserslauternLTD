<?php
// First start a session. This should be right at the top of your login page.
session_start();

// Check to see if this run of the script was caused by our login submit button being clicked.
if (isset($_POST['login-submit'])) {

    // Also check that our email address and password were passed along. If not, jump
    // down to our error message about providing both pieces of information.
    if (isset($_POST['inputUser']) && isset($_POST['inputPassword'])) {
        $usr = $_POST['inputUser'];
        $pass = $_POST['inputPassword'];
        if ($usr == "admin" && $pass == "admin") {
            // Once the sessions variables have been set, redirect them to the landing page / home page.
            header('location: detail.php');
            exit;
        } else {
            $error = "Invalid email or password. Please try again.";
        }
    } else {
        $error = "Please enter an email and password to login.";
    }
}
?>