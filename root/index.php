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


		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
	</article>

	<?php
	include("featuredArtist.php");
	?>
	<footer></footer>
</div>




</body>
</html>