<div class="header">
    <div class="logo">
        <h2><a href="welcome.php">Molecular Models of Boltzmann-Zuse Society</a></h2>
        <?php if (isset($_SESSION['usr'])) { ?>
            <p><strong>&nbsp;&nbsp;&nbsp;Welcome <?php echo $_SESSION['usr'] ?>
                    <a href="logout.php">( Logout )</a></strong></p>
        <?php } else { ?>
            <p>&nbsp;&nbsp;<strong>&nbsp;<a href="index.php"><u>[Sign In]</u></a> </strong>(Public
                Mode - No
                user logged in) </p>
        <?php } ?>
    </div>
    <!-- end #logo -->

    <?php if (isset($_SESSION['usr'])) { ?>
        <div class="menu">
            <ul>
                <?php if (isset($_SESSION['usr']) && $_SESSION['act'] == 'true') { ?>
                    <li class="dropdown"><a href="#" class="a-success">Admin Panel</a>
                        <div class="dropdown-content">
                            <a href="molAdd.php" class="a-success">New Molecule</a>
                            <a href="addref.php?act=insert" class="a-success">New References</a>
                        </div>
                    </li>
                <?php } ?>
                <li><a href="welcome.php">Home</a></li>
                <li><a href="mollist.php">Molecule List</a></li>
                <li><a href="reference.php">References</a></li>
                <li><a href="inter.php">Normenclature</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div>
    <?php } ?>
    <!-- end #menu -->
</div>
<!-- end #header -->