<?php
include("dbconnect.php")
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Artists</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<div id="content">
    <?php
    include("template.php");
    ?>
    <form id="insert" name="insert" method="post" action="dbprocess.php" enctype="multipart/form-data">
        <fieldset>
            <h2>Insert new artist:</h2>

            <label for="name">Name: </label>
            <input type="text" name="name" id="name"/>
            <br>
            <label for="info">Information: </label>
            <input type="text" name="info" id="info"/>
            <br>
            <label for='email'>Email: </label>
            <input type='text' name='email'/>
            <br>
            <label for='phone'>Phone: </label>
            <input type='text' name='phone'/>
            <br>
            <label for='mobile'>Mobile: </label>
            <input type='text' name='mobile'/>
            <br>
            <label for='website'>Website: </label>
            <input type='text' name='website'/>
            <br>
            <label for='imagefile'>Image: </label>
            <input type='file' name='imagefile'/>
            <br>
            <label for='imagethumb'>Thumbnail: </label>
            <input type='file' name='imagethumb'/>
            <br>
            <input type="submit" name="submit" id="submit" value="Insert Entry"/>
        </fieldset>
    </form>
</div>
</body>
</html>