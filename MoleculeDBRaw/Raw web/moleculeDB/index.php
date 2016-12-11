<!DOCTYPE html>

<html lang="en" class="gr__v4-alpha_getbootstrap_com">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Welcome to Molecule</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/starter-template.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">

</head>

<body data-gr-c-s-loaded="true">
<?php include 'include/nav_login.php'; ?>
<?php $error = $_GET['invalid']; ?>

<div class="container">
    <div class="starter-template">

            <?php
            if ($error=='true') {
                echo "<div class='errormsg'>Invalid email or password. Please try again.</div>";
            }
            ?>

        <form class="form-signin" method="post" action="">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" class="sr-only">UserID</label>
            <input type="text" id="inputUser" name="inputUser" class="form-control" placeholder="Enter User ID"
                   required=""
                   autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password"
                   required="">
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="login-submit" id="login-submit">Sign
                in
            </button>
        </form>
    </div>

</div><!-- /.container -->

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
            header('location: index.php?invalid=true');
        }
    } else {
        header('location: index.php?invalid=true');
    }
}
?>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include 'include/bootcore.php'; ?>
</body>
</html>