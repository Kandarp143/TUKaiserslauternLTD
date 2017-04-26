<?php include('include/header.php') ?>
<?php
require 'database.php';
$id = 0;
$act = '';
$header = '';
$submit = '';
isset($_GET['id']) ? $id = $_GET['id'] : '';
isset($_GET['act']) ? $act = $_GET['act'] : '';

//setting header
if ($act == 'insert') {
    $header = 'Add New Reference';
    $submit = 'Save';

} else if ($act == 'update') {
    $header = 'Update Reference';
    $submit = 'Update';
} else if ($act == 'delete') {
    $header = 'Delete Reference';
}

//if update get data from db
//prepare dummmy array
$ref = array(
    'Bib_Title' => '',
    'Bib_Type' => '',
    'Title' => '',
    'Author' => '',
    'Publisher' => '',
    'Year' => '',
    'Address' => '',
    'Owner' => '',
    'Timestamp' => '',
    'Journal' => '',
    'Number' => '',
    'Pages' => '',
    'Volume' => '',
    'Doi' => '',
    'Editor' => '',
    'Edition' => '',
    'Url' => '',
    'School' => ''
);


if ($act == 'update') {
    $pdo = Database::connect();
//db thing
    $bibq = "SELECT DISTINCT * FROM pm_bib WHERE  pm_bib.bib_key =" . $id;
    $result = $pdo->query($bibq);

    if ($result->rowCount() > 0) {

        foreach ($result as $row) {
            $ref['Bib_Type'] = $row['bib_type'];
            $ref['Bib_Title'] = $row['bib_title'];
            $ref[$row['param']] = $row['value'];
        }


    }
}
?>

<link rel="stylesheet" type="text/css" href="css/tooltip.css" media="screen"/>
<html>
<head> <?php include('include/links.php') ?>
</head>
<body>
<div id="wrapper">
    <?php include('include/nav.php') ?>
    <div id="page">
        <div id="content">
            <div class="post">
                <h1 class="title"><?php echo $header ?></h1>

                <?php if ($act != 'delete') {
                    include('include/formref.php');
                } else {
                    include('include/delref.php');
                } ?>

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

