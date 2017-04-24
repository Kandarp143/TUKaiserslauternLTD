<?php include('include/header.php') ?>
<!-- Design by Kandarp -->
<html>
<head> <?php include('include/links.php') ?>
</head>
<body>

<div id="wrapper">
    <?php include('include/nav.php') ?>
    <div id="page">
        <div id="content">
            <div class="post">
                <h1 class="title">Delete a Molecule </h1>
                <div class="entry">
                    <form class="form-horizontal" action="email.php?id=<?php echo $_GET['id'] ?>" method="post">
                        <p class="alert alert-error">Are you sure to delete following molecule ?
                            <?php
                            require_once 'database.php';
                            $message = '';
                            $pdo = Database::connect();
                            $masterSql = 'SELECT DISTINCT * FROM pm_master WHERE master_id =' . $_GET['id'];
                            $message .= "<table>";
                            foreach ($pdo->query($masterSql) as $row) {
                                $fileName = $row['filename'];
                                $message .= "<tr style='text-align: left'><th>Substance</th><td>" . $row['filename'] . "</td></tr>";
                                $message .= "<tr style='text-align: left'><th>CAS-No</th><td>" . $row['cas_no'] . "</td></tr>";
                                $message .= "<tr style='text-align: left'><th>Reference</th><td>[" . $row['bibtex_key'] . "]</td></tr>";
                                $message .= "<tr style='text-align: left'><th>Model Type</th><td>" . $row['model_type'] . "</td></tr>";
                                $message .= "<tr style='text-align: left'><th>Type</th><td>" . $row['type'] . "</td></tr>";
                                $message .= "<tr style='text-align: left'><th>Description</th><td>" . $row['description'] . "</td></tr>";
                            }
                            $message .= "</table>";
                            echo $message;
                            ?>
                            <br/>
                            <input type="password" placeholder="Enter additional password" name='addPass'
                                   class="datagrid"/>
                            <?php
                            if (isset($_GET['pass'])) {
                                echo '<p style="color: red">Password Incorrect</p>';
                            }
                            ?>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-danger">Yes</button>
                            <button class="btn btn-success" href="mollist.php">No</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end #content -->
        <div style="clear:both; margin:0;"></div>
    </div>
    <!-- end #page -->

</div>

<div id="footer">
    <?php include('include/footer.php') ?>
</div>
<!-- end #footer -->
</body>
</html>

