<?php
include("dbconnect.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View Artist</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<div id="content">
    <?php
    include("template.php");
    ?>
<h2>Artist Details</h2>
<?php
$variable = $_GET['variable'];

if(is_numeric($variable)) {

    $sql = "SELECT * FROM artists WHERE id = '$variable'";
    $link = "<a href='viewArtist.php'>return</a>";
}else{
    $sql = "SELECT * FROM artists WHERE name = '$variable'";
    $link = "<a href='eventsView.php'>return</a>";
}

    //$sql = "SELECT * FROM artists";
    foreach ($dbh->query($sql) as $row) {
        echo "<h4>Name: ", $row['name']."</h4>", "<h4>Information:</h4>", "<p>" . $row['info'] . "</p>", "<br>";
        if($row['image']!=null){
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" /><br>';
        }

        if ($row['email'] != null) {
            echo "<b>Email: </b>", $row['email']."<br>";
        }

        if ($row['phone'] != null) {
            echo "<b>Phone: </b>", $row['phone']."<br>";
        }

        if ($row['mobile'] != null) {
            echo "<b>Mobile: </b>", $row['mobile']."<br>";
        }
        if ($row['website'] != null) {
            echo "<b>Link: </b><a href='". $row['website']."'>".$row['name']."</a><br>";
        }
    }
    echo "<br><b>$link</b>";
    $dbh = null;

?>
</div>
</body>
</html>






