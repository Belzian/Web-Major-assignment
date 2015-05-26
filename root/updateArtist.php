<?php
include("dbconnect.php")
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Update Artist</title>
    <link rel="stylesheet" type="text/css" href="main.css">

</head>
<body>


<div id="content">
    <?php
    include("template.php");
    ?>
    <h2>Update Artists:</h2>
    <?php
    $sql = "SELECT * FROM artists";
    foreach ($dbh->query($sql) as $row) {
        ?>
        <form id="update/DeleteForm" name="update/DeleteForm" method="post" action="dbprocess.php"
              enctype="multipart/form-data">
            <fieldset>
                <?php
                echo "<b>$row[name] </b><br>
        <label for='name'>Name: </label>
        <input type='text' name='name'/>
        <br>
        <label for='info'>Information: </label>
        <input type='text' name='info'/>
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
        <input type='file' name='imagefile' />
        <br>
        <label for='imagethumb'>Image Thumbnail: </label>
        <input type='file' name='imagethumb' />
        <br>
        <input type='hidden' name='id' value='$row[id]'/>";
                ?>
                <input type="submit" name="submit" value="Update Entry">
                <input type="submit" name="submit" value="Delete Entry" class="deleteButton">
                <br>
                <br>

            </fieldset>
        </form>

        <?php
    }
    ?>
</div>
</body>
</html>