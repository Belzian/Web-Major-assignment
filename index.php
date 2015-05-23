<?php
include("dbconnect.php")

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>CP2010 Group 2 PHP</title>
<style type="text/css">
.subtleSet {
	border-radius:25px;
	width: 34em;
}
</style>
</head>

<body>
<h1>TEST database</h1>


<form id="insert" name="insert" method="post" action="dbprocess.php" enctype="multipart/form-data">
<fieldset class="subtleSet">
    <h2>Insert new artist:</h2>
    <p>
        <label for="name">Name: </label>
        <input type="text" name="name" id="name"
    </p>
    <p>
      <label for="info">Information: </label>
      <input type="text" maxlength="10000" name="info" id="info">
    </p>

    <p>
        <label for="file">Filename:</label>
        <input type="file" name="imagefile" id="imagefile" />
	</p>

    <p>
      <input type="submit" name="submit" id="submit" value="Insert Entry">
    </p>

</fieldset>
</form>


<h2>Update Artists:</h2>

<?php
$sql = "SELECT * FROM artists";
foreach ($dbh->query($sql) as $row)
{
?>
<form id="deleteForm" name="deleteForm" method="post" action="dbprocess.php" enctype="multipart/form-data">
<?php
	echo "<input type='text' name='name' value='$row[name]'>
    <input type='text' name='info' value='$row[info]'>
    <input type='file' name='imagefile' value='image' />";
	echo "<input type='hidden' name='id' value='$row[id]'>";
?>
<input type="submit" name="submit" value="Update Entry">
<input type="submit" name="submit" value="Delete Entry" class="deleteButton">
</form>
<?php
}
?>


<h2>Current Artists:</h2>
<?php
$sql = "SELECT * FROM artists";
foreach ($dbh->query($sql) as $row)
{
?>
<?php
    echo '<p>Name: <a href="muso.php?current='. $row['id'].'">'.$row['name']." - click for more info ".'</a> <br>';
    echo '<img src="data:image/jpeg;base64,' . base64_encode( $row['image'] ) . '" />';


?>
<br>
<?php
}
$dbh = null;
?>

</body>
</html>