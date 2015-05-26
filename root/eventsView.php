<?php
include("dbconnect.php");
session_start();
error_reporting(E_ALL);
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Current Events</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<body>

<div id="content">
    <?php
    include("template.php");
    ?>

    <article class="artist">
        <b><a href="addEvent.php">Add new Event</a></b>
    </article>
<h2>Current Events</h2>
<?php
$sql = "SELECT * FROM events ORDER BY date ASC";

foreach ($dbh->query($sql) as $row) {
    ?>
    <?php
    echo '<article class="artist">';
    date_default_timezone_set("Australia/Brisbane") ;
    $date = date('Y-m-d');
    $eventDate = $row['date'];

    if($eventDate<$date){
        $id = $row['id'];
        $sql1 = "DELETE FROM events WHERE id='$id'";
        $dbh->exec($sql1);
    }else{
        echo "<li><a href='event.php?id=". $row['id']."'><b>Event: </b>".$row['event']."<b> Date: </b>".$row['date']."<br></a></li>";
    }
    echo '</article>';
    ?>
    <br>
    <?php
}

$dbh = null;
?>
</div>
</body>
</html>