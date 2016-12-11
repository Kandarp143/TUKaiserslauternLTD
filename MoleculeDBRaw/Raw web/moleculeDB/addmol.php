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
<?php include 'include/nav.php'; ?>

<div class="container">
    <div class="starter-template">

        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select file to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            </br></br>
            <input type="submit" value="Upload File" name="submit">
            </br>
        </form>
        <?php
        $ans = $_GET['uploaded'];
        if ($ans == "true") {
            echo "<p style='color: green'> File uploaded successfully  </p>";
        } else if ($ans == "false") {
            echo "<p style='color: red;' > Upload Error !  </p>";
        }
        ?>


    </div>

</div><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include 'include/bootcore.php'; ?>
</body>
</html>