<?php include('include/header.php');
//if user tried to login
if (!isset($_GET['err'])) {
//to clear previous session
    session_unset();
    session_destroy();
}
?>
<!-- Design by Kandarp -->
<html>
<head>
    <?php include('include/links.php') ?>
</head>
<body>
<div class="wrapper">
    <?php include('include/nav.php') ?>
    <div class="page">
        <div class="header-pic"></div>
        <div class="content">
            <?php include('include/home.php') ?>
        </div>
        <!-- end #content -->
        <div class="sidebar">
            <div class="sidebar-content">
                <div class="sidebar-bgbtm">
                    <ul>
                        <li class="search">
                            <?php include('include/login.php') ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end #sidebar -->
        <div class="clear"></div>
    </div>
    <!-- end #page -->
</div>

<div class="footer">
    <?php include('include/footer.php') ?>
</div>
<!-- end #footer -->
</body>
</html>
