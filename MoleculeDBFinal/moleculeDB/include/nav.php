<div id="header">
    <div id="logo">
        <h2><a href="welcome.php">Molecular Models of Boltzmann-Zuse Society</a></h2>
        <?php if (isset($_SESSION['usr'])) { ?>
            <p><strong>&nbsp;&nbsp;&nbsp;Welcome <?php echo $_SESSION['usr'] ?>
                    <a href="logout.php">( Logout )</a></strong></p>
        <?php } else { ?>
            <p>&nbsp;&nbsp;<strong>&nbsp;<a href="index.php" style="text-decoration: underline;">[Sign In]</a> </strong>(Public
                Mode - No
                user logged in) </p>
        <?php } ?>

    </div>
    <!-- end #logo -->
    <?php if (isset($_SESSION['usr'])) { ?>
        <div id="menu">
            <ul>
                <li><a href="welcome.php">Home</a></li>
                <li><a href="mollist.php">Molecule List</a></li>
                <?php if (isset($_SESSION['usr'])) { ?>
                    <li><a href="addmol.php">New Molecule</a></li>
                    <li><a href="addref.php">References</a></li>
                <?php } ?>
                <li><a href="inter.php">Interaction Potentials</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </div>
    <?php } ?>
    <!-- end #menu -->
</div>
<!-- end #header -->