<?php include('include/header.php') ?>
<html>
<head> <?php include('include/links.php') ?>
</head>
<body>

<div id="wrapper">
    <?php include('include/nav.php') ?>
    <div id="page">
        <div id="content">
            <div class="post">
                <h1 class="title">Add New Molecule</h1>
                <div class="entry">
                    <!--        molecule master data-->
                    <form action="insert.php" method="post">
                        <table class=" table-bordered" id="dis">
                            <tr>
                                <th colspan="2"> Step 1 : Insert master data & Referencess</th>
                            </tr>
                            <tr>
                                <td>Substance :</td>
                                <td><input name="substance" type="text" placeholder="should be same as PM file name"
                                           size="50"></td>
                            </tr>
                            <tr>
                                <td>CAS-No :</td>
                                <td><input name="casno" type="text" placeholder="casno"
                                           size="50"></td>
                            </tr>
                            <tr>
                                <td>Name :</td>
                                <td><input name="name" type="text" placeholder="Name"
                                           size="50"></td>
                            </tr>
                            <tr>
                                <td>Reference :</td>
                                <td><input name="reference" type="text" placeholder="reference eg[Vravec 2001]"
                                           size="50"></td>
                            </tr>
                            <tr>
                                <td>Model Type :</td>
                                <td><input name="modeltype" type="text" placeholder="modeltype"
                                           size="50"></td>
                            </tr>
                            <tr>
                                <td>Description :</td>
                                <td><input name="description" type="text" placeholder="description"
                                           size="50"></td>
                            </tr>
                            <tr>
                                <td>Type :</td>
                                <td><input type="radio" name="type" value="rigid"> Rigid&nbsp
                                    <input type="radio" name="type" value="flexible"> Flexible
                                </td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <th colspan="2">References</th>
                            </tr>
                            <tr>
                                <td>Author :</td>
                                <td><input name="author" type="text" placeholder="Author"
                                           size="50"></td>
                            </tr>
                            <tr>
                                <td>Title :</td>
                                <td><input name="bibtitle" type="text" placeholder="Title"
                                           size="50"></td>
                            </tr>
                            <tr>
                                <td>Journal :</td>
                                <td><input name="journal" type="text" placeholder="Journal"
                                           size="50"></td>
                            </tr>
                            <tr>
                                <td>Volume :</td>
                                <td><input name="volume" type="text" placeholder="Volume"
                                           size="50"></td>
                            </tr>
                            <tr>
                                <td>Number :</td>
                                <td><input name="number" type="text" placeholder="Number"
                                           size="50"></td>
                            </tr>
                            <tr>
                                <td>Pages :</td>
                                <td><input name="pages" type="text" placeholder="Pages"
                                           size="50"></td>
                            </tr>
                            <tr>
                                <td>Year :</td>
                                <td><input name="year" type="text" placeholder="Year"
                                           size="50"></td>
                            </tr>
                            <tr>
                                <td colspan="2">

                                    <button type="submit" class="btn-success" id="mstsub"><strong>Save</strong></button>

                                    <?php
                                    $ans = $_GET['master'];
                                    if ($ans == "true") {
                                        echo "<p style='color: green'> Master data uploaded successfully, Now upload file  </p>";
                                    } else if ($ans == "false") {
                                        echo "<p style='color: red;' > Upload Error !  </p>";
                                        echo $_SESSION['submit_msg'];
                                    }
                                    ?>
                                    <?php
                                    if (isset($_SESSION['submit_msg'])) {
                                        echo $_SESSION['submit_msg'];
                                        unset($_SESSION['submit_msg']);
                                    }
                                    ?>
                            </tr>
                        </table>

                    </form>
                    </br></br>
                    <!--        molecule file upload-->
                    <form action="upload.php?update=false" method="post" enctype="multipart/form-data">
                        <table class="table-bordered">
                            <tr>
                                <th colspan="2"> Step 2 : Upload PM file (Please keep filename same as substance name
                                    )
                                </th>
                            </tr>

                            <tr>
                                <td>
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="btn-success" type="submit" value="UploadFile" name="submit">
                                    <?php
                                    $ans = $_GET['uploaded'];
                                    if ($ans == "true") {
                                        echo "<p style='color: green'> File uploaded successfully  </p>";
                                    } else if ($ans == "false") {
                                        echo "<p style='color: red;' > Upload Error !  </p>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
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

