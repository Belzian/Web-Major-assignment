<?php
include("dbconnect.php");
session_start();
error_reporting(E_ALL);
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>List of Artists</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<body>
<div id="content">
    <?php
    include("template.php");
    ?>

    <article class="artist">
        <b><a href="addArtist.php">Add new Artist</a></b><br>
        <b><a href="updateArtist.php">Update Artist</a></b>
    </article>

    <?php

        $sql = "SELECT * FROM artists";
        foreach ($dbh->query($sql) as $row)
        {
            echo '<article class="artist">';
            if ($row['imagethumb']!=null){
                echo '<p>Name: <a href="muso.php?variable=' . $row['id'].'">'.$row['name']." - click for more info ".'<br><img src="data:image/jpeg;base64,' . base64_encode( $row['imagethumb'] ) . '" /></a> <br>';
            }else{
                echo '<p>Name: <a href="muso.php?variable=' . $row['id'].'">'.$row['name']." - click for more info ".'<br>'."</a> <br>";

            }
            echo '</article>';
        }
        $dbh = null;
        ?>

    <article class="artist">
        <h2><a href="addArtist.php">Add new Artist</a></h2>
    </article>
</div>
</body>
</html>