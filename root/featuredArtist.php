<?php
include("dbconnect.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View Artist</title>

</head>
<body>
<h2>Featured Artist</h2>
<?php
$array = array();
$sql = "SELECT id FROM artists";
foreach ($dbh->query($sql) as $row) {
    array_push($array,$row['id']);
}
$randomNum = rand(0,count($array)-1);
$randomId = $array[$randomNum];

$sql1 = "SELECT * FROM artists WHERE id = $randomId";

foreach ($dbh->query($sql1) as $row) {
    echo "<h4>Name: ", $row['name']."</h4>", "<h4>Information:</h4>", "<p>" . $row['info'] . "</p>", "<br>";
    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" /><br>';
    if ($row['email'] != null) {
        echo "<b>Email: </b>", $row['email']."<br>";
    }

    if ($row['phone'] != null) {
        echo "<b>Phone: </b>", $row['phone']."<br>";
    }

    if ($row['mobile'] != null) {
        echo "<b>Mobile: </b>", $row['mobile']."<br>";
    }
}
echo '<br><b><a href="viewArtist.php">return</a></b>';
$dbh = null;

?>

</body>
</html>



