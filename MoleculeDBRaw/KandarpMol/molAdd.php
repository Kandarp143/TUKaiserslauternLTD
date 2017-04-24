<?php include('include/header.php') ?>
<html>
<head> <?php include('include/links.php') ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> <!-- load jquery via CDN -->
    <script src="js/molAdd.js"></script> <!-- load our javascript file -->
</head>
<body>

<div class="wrapper">
    <?php include('include/nav.php') ?>
    <div class="page">
        <div class="content">
            <div class="post">
                <h1 class="title">Add New Molecule</h1>
                <!-- multistep form -->
                <form id="msform" action="process/processMolAdd.php" enctype="multipart/form-data" method="post">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active">Molecule Master Data</li>
                        <li>Force Fields</li>
                        <li>References</li>
                    </ul>
                    <!-- fieldsets -->
                    <fieldset>
                        <?php include 'include/molAddMst.php' ?>
                        <br/> <input type="button" name="next" class="next action-button btn btn-primary" value="Next"/>
                    </fieldset>
                    <fieldset>
                        <?php include 'include/molAddDet.php' ?>
                        <br/> <input type="button" name="previous" class="previous action-button btn btn-primary"
                                     value="Previous"/>
                        <input type="submit" value="Submit" class=" action-button btn btn-success" name="submit">
                    </fieldset>
                    <fieldset>
                        <p> No References found : <a class="a-button" href="mapref.php?id=' . $master_id . '">Add
                                Reference</a></p>
                        <br/> <input type="button" name="previous" class="previous action-button btn btn-primary"
                                     value="Previous"/>
                        <input type="submit" name="submit" class="submit action-button btn btn-success" value="Submit"/>
                    </fieldset>
                </form>
                <!--                <script type="text/javascript">-->
                <!--                    var frm = $('#msform');-->
                <!--                    frm.submit(function (ev) {-->
                <!--                        $.ajax({-->
                <!--                            type: frm.attr('method'),-->
                <!--                            url: frm.attr('action'),-->
                <!--                            data: frm.serialize(),-->
                <!--                      -->
                <!--                            success: function (data) {-->
                <!--                                alert(data);-->
                <!--                            }-->
                <!--                        });-->
                <!---->
                <!--                        ev.preventDefault();-->
                <!--                    });-->
                <!--                </script>-->
                <!-- jQuery -->
                <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
                <!-- jQuery easing plugin -->
                <script src="js/jquery.easing.min.js" type="text/javascript"></script>
                <!-- jQuery custom funcation -->
                <script src="js/formwizard.js" type="text/javascript"></script>

            </div>
        </div>
        <!-- end #content -->
        <div style="clear:both; margin:0;"></div>
    </div>
    <!-- end #page -->

</div>

<div class="footer">
    <?php include('include/footer.php') ?>
</div>
<!-- end #footer -->
</body>
</html>

