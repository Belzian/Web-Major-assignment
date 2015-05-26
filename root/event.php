<?php
include("dbconnect.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Event Details</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<div id="content">
    <?php
    include("template.php");
    ?>
<h2>Event Details</h2>
<?php

    $ID = $_GET['id'];
    $sql = "SELECT * FROM events WHERE id = $ID";



foreach ($dbh->query($sql) as $row) {
    $event = $row['event'];
    $info = $row['info'];
    $location = $row['location'];
    $phone = $row['phone'];
    $mobile = $row['mobile'];
    $link = $row['link'];
    $date = $row['date'];
    $artist = $row['artist'];


    echo "<h4>Event: </h4>$event
    <br><h4>Information: </h4>$info
    <br><h4>Location: </h4>$location
    <br><a href='muso.php?variable=" .$row["artist"]."'>
    <br><h4>Performing Artist: </h4>".$row["artist"]." - click for artist info</a>
    <br><h4>Date: $date</h4>";

    if($phone!=null||$mobile!=null||$link!=null){
        echo "<h2>Further Information</h2>";
    }
    if($phone!=null){
        echo "<br><h4>Phone: </h4>$phone";
    }
    if($mobile!=null){
        echo "<br><h4>Mobile: </h4>$phone";
    }
    if($link!=null){
        echo "<br><h4>Link: </h4><a href='$link'>Click for more information</a>";
    }

}


echo '<br><b><a href="eventsView.php">Return</a></b>';
$dbh = null;

?>
</div>
</body>
</html>



