<?php
include("dbconnect.php")
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Events</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<div id="content">
    <?php
    include("template.php");
    ?>
    <form id="addEvent" name="addEvent" method="post" action="dbprocess.php" enctype="multipart/form-data">
        <fieldset>
            <h2>Add new event:</h2>

            <label for="event">Event Name: </label>
            <input type="text" name="event"/>
            <br>
            <label for="info">Information: </label>
            <input type="text" name="info"/>
            <br>
            <label for='date'>Date: </label>
            <input type='date' name='date'/>
            <br>
            <label for='artist'>Artist: </label>
            <select name="artist">
                <?php
                $sql = "SELECT * FROM artists";
                foreach ($dbh->query($sql) as $row) {
                    $name = $row['name'];
                    echo "<option value='$name'>$name</option>";
                }
                ?>
            </select>
            <br>
            <input type="submit" name="submit" id="submit" value="Add Event"/>
        </fieldset>
    </form>
</div>
</body>
</html>