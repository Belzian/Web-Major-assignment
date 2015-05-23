<?php
include("dbconnect.php");
$debugOn = true;


if ($_REQUEST['submit'] == "Insert Entry")
{

// first just print the data we have for this image so you know what's available
	echo "<pre>";
	print_r($_FILES);
	echo "</pre>\n";

// check to see if the image is valid
// check MIME type (GIF or JPEG) and maximum upload size - see phpinfo() for the server's restriction
	if ((($_FILES["imagefile"]["type"] == "image/gif")
			|| ($_FILES["imagefile"]["type"] == "image/jpeg")
			|| ($_FILES["imagefile"]["type"] == "image/png")
			|| ($_FILES["imagefile"]["type"] == "image/pjpeg"))
		&& ($_FILES["imagefile"]["size"] < 2000000))
	{
		// check for any error code in the data
		if ($_FILES["imagefile"]["error"] > 0)
		{
			echo "Error Code: " . $_FILES["imagefile"]["error"] . "<br />";
		}
		else
		{
			// print some information again (in case you're interested in how even though the print_r() shows it above)
			echo "<p>Upload: " . $_FILES["imagefile"]["name"] . "<br />\n";
			echo "MIME Type: " . $_FILES["imagefile"]["type"] . "<br />\n";
			echo "Size: " . round($_FILES["imagefile"]["size"] / 1024, 1) . " KB<br />\n";
			// uploaded files are stored in a temporary location on the server until we move them (if we want to)
			echo "Temp file: " . $_FILES["imagefile"]["tmp_name"] . "</p>\n";

			// check to see if a file with that name already exists in our destination directory
			if (file_exists("images/" . $_FILES["imagefile"]["name"]))
			{
				echo $_FILES["imagefile"]["name"] . " already exists. \n";
			}
			else
			{
				// create a new unique filename using current time and existing filename
				$newName = time() . $_FILES["imagefile"]["name"];
				$newFullName = "images/{$newName}";
				// move the temporary file to the destination directory (images) and give it its new name
				move_uploaded_file($_FILES["imagefile"]["tmp_name"], $newFullName);
				// set the permission on the file
				chmod($newFullName, 0644);
				echo "Stored original as: $newFullName<br />\n";
				//insert the new values to the database
				$file = fopen($newFullName, 'rb');


				$stmt = $dbh->prepare("INSERT INTO artists (name,info,image) VALUES (?,?,?)");

				$stmt->bindParam(1, $_REQUEST[name]);
				$stmt->bindParam(2, $_REQUEST[info]);
				$stmt->bindParam(3, $file, PDO::PARAM_LOB);

				$stmt->execute();

				fclose($file);

				unlink($newFullName);

				header("Location: index.php");

			}
		}
	}
	else
	{
		//insert the new values to the database without image

		$stmt = $dbh->prepare("INSERT INTO artists (name,info) VALUES (?,?)");

		$stmt->bindParam(1, $_REQUEST[name]);
		$stmt->bindParam(2, $_REQUEST[info]);

		$stmt->execute();

		header("Location: index.php");
	}
}
else if ($_REQUEST['submit'] == "Delete Entry")
{
	$sql = "DELETE FROM artists WHERE id = '$_REQUEST[id]'";
	if ($dbh->exec($sql))
		header("Location: index.php");
}
else if ($_REQUEST['submit'] == "Update Entry")
{
	echo "<pre>";
	print_r($_FILES);
	echo "</pre>\n";

// check to see if the image is valid
// check MIME type (GIF or JPEG) and maximum upload size - see phpinfo() for the server's restriction
	if ((($_FILES["imagefile"]["type"] == "image/gif")
			|| ($_FILES["imagefile"]["type"] == "image/jpeg")
			|| ($_FILES["imagefile"]["type"] == "image/png")
			|| ($_FILES["imagefile"]["type"] == "image/pjpeg"))
		&& ($_FILES["imagefile"]["size"] < 2000000))
	{
		// check for any error code in the data
		if ($_FILES["imagefile"]["error"] > 0)
		{
			echo "Error Code: " . $_FILES["imagefile"]["error"] . "<br />";

		}
		else
		{
			// print some information again (in case you're interested in how even though the print_r() shows it above)
			echo "<p>Upload: " . $_FILES["imagefile"]["name"] . "<br />\n";
			echo "MIME Type: " . $_FILES["imagefile"]["type"] . "<br />\n";
			echo "Size: " . round($_FILES["imagefile"]["size"] / 1024, 1) . " KB<br />\n";
			// uploaded files are stored in a temporary location on the server until we move them (if we want to)
			echo "Temp file: " . $_FILES["imagefile"]["tmp_name"] . "</p>\n";

			// check to see if a file with that name already exists in our destination directory
			if (file_exists("images/" . $_FILES["imagefile"]["name"]))
			{
				echo $_FILES["imagefile"]["name"] . " already exists. \n";
			}
			else
			{
				// create a new unique filename using current time and existing filename
				$newName = time() . $_FILES["imagefile"]["name"];
				$newFullName = "images/{$newName}";
				// move the temporary file to the destination directory (images) and give it its new name
				move_uploaded_file($_FILES["imagefile"]["tmp_name"], $newFullName);
				// set the permission on the file
				chmod($newFullName, 0644);
				echo "Stored original as: $newFullName<br />\n";

				//update the new values to the database
				$file = fopen($newFullName, 'rb');

				$stmt = $dbh->prepare("UPDATE artists SET name = ?, info = ?,image = ? WHERE id = '$_REQUEST[id]' ");

				$stmt->bindParam(1, $_REQUEST[name]);
				$stmt->bindParam(2, $_REQUEST[info]);
				$stmt->bindParam(3, $file, PDO::PARAM_LOB);

				$stmt->execute();

				fclose($file);

				unlink($newFullName);

				header("Location: index.php");


			}
		}
	}
	else
	{
		//update the new values to the database without image

		$stmt = $dbh->prepare("UPDATE artists SET name = ?, info = ? WHERE id = '$_REQUEST[id]'");

		$stmt->bindParam(1, $_REQUEST[name]);
		$stmt->bindParam(2, $_REQUEST[info]);

		$stmt->execute();

		header("Location: index.php");
	}

}
?>
