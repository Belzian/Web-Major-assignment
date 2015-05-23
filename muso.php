<?php
include("dbconnect.php");

if($_GET['current']){
    $currentID=$_GET['current'];
    $sql = "SELECT * FROM artists WHERE id = $currentID";

foreach ($dbh->query($sql) as $row){
    echo "Name: ", $row['name'], "<br>Information: ", $row['info'],"<br>";
    echo '<img src="data:image/jpeg;base64,' . base64_encode( $row['image'] ) . '" />';
}
$dbh = null;
}
?>





