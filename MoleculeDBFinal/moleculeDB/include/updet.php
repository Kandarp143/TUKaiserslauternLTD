<style type="text/css">
    #Div2 {
        display: none;
    }
</style>
<script type="text/javascript">;
    function switchVisible() {
        if (document.getElementById('Div1')) {

            if (document.getElementById('Div1').style.display == 'none') {
                document.getElementById('Div1').style.display = 'block';
                document.getElementById('Div2').style.display = 'none';
            }
            else {
                document.getElementById('Div1').style.display = 'none';
                document.getElementById('Div2').style.display = 'block';
            }
        }
    }
</script>
<?php $ans = isset($_GET['uploaded']) ? $_GET['uploaded'] : ''; ?>
<table style="width: 100%;">
    <!--    --><?php //if ($ans != "true") { ?>
    <tr>
        <td>
            <a href="#" class="a-button" onclick="switchVisible();">Edit Online</a>
        </td>

    </tr>
    <tr>
        <td>
            <div id="Div2">
                <form action="processOnlinePM.php?update=true&id=<?php echo $master_id ?>" method="post">
                <textarea id="confirmationText" class="text" cols="86" rows="20"
                          name="confirmationText"><?php include('updetonline.php') ?>
                </textarea>
                    <input class="button" type="submit" name="submit">
                </form>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div id="Div1">
                Download old PM file :<a class="a-button"
                                         href="generate.php?id=<?php echo $master_id ?>">Download</a>
                <br/><br/>
                <form action="processUpload.php?update=true&id=<?php echo $master_id ?>" method="post"
                      enctype="multipart/form-data">
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input class="button" type="submit" value="UploadFile" name="submit">
                </form>
            </div>
        </td>
    </tr>
    <!--    --><?php //} ?>
    <tr>
        <td colspan="2">
            <?php
            if ($ans == "true") {
                echo "<p style='color: green'> File uploaded successfully  </p><a class='a-button'
href='moldetail.php?id=$master_id '>Go to Detail</a>";
            } else if ($ans == "false") {
                echo "<p style='color: red;' > Upload Error !  </p>";
            }
            ?>
        </td>
    </tr>
</table>