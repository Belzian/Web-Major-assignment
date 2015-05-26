<?php
include("dbconnect.php")
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Notice</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<div id="content">
    <?php
    include("template.php");
    ?>
    <form id="addNotice" name="addNotice" method="post" action="dbprocess.php" enctype="multipart/form-data">
        <fieldset>
            <h2>Add new notice: </h2>

            <label for="notice">*Notice: </label>
            <input type="text" name="notice"/>
            <br>
            <label for="summary">*Summary: </label>
            <input type="text" name="summary"/>
            <br>
            <label for="info">*Information: </label>
            <input type="text" name="info"/>
            <br>

            <input type="submit" name="submit" id="submit" value="Add Notice"/>

            <p>*required fields</p>
        </fieldset>
    </form>
</div>
</body>
</html>