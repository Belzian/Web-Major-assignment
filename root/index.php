<?php
session_start();
error_reporting(E_ALL);
?>

<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Index</title>
	<link rel="stylesheet" type="text/css" href="main.css" />
</head>

<body>

<div id="content">
	<?php
	include("template.php");
	?>


	<article>
		<h2>Welcome!</h2>
		<p>Home information required</p>

	</article>

	<?php
	include("featuredArtist.php");
	?>
	<footer></footer>
</div>




</body>
</html>