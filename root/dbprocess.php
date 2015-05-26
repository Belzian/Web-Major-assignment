<?php
include("dbconnect.php");
$debugOn = true;

$name = null;
$info = null;
$email = null;
$phone = null;
$mobile = null;
$website = null;
$image = null;
$imagethumb = null;
$file = null;
$thumbnail = null;
$null = null;


if ($_REQUEST['submit'] == "Insert Entry") {

    $stmt = $dbh->prepare("INSERT INTO artists (name,info,email,phone,mobile,website,image,imagethumb) VALUES (?,?,?,?,?,?,?,?)");

    if ($_REQUEST['name'] != null) {
        $stmt->bindParam(1, $_REQUEST['name']);
    } else {
        $stmt->bindParam(1, $null);
    }

    if ($_REQUEST['info'] != null) {
        $stmt->bindParam(2, $_REQUEST['info']);
    } else {
        $stmt->bindParam(2, $null);
    }

    if ($_REQUEST['email'] != null) {
        $stmt->bindParam(3, $_REQUEST['email']);
    } else {
        $stmt->bindParam(3, $null);
    }

    if ($_REQUEST['phone'] != null) {
        $stmt->bindParam(4, $_REQUEST['phone']);
    } else {
        $stmt->bindParam(4, $null);
    }

    if ($_REQUEST['mobile'] != null) {
        $stmt->bindParam(5, $_REQUEST['mobile']);
    } else {
        $stmt->bindParam(5, $null);
    }
    if ($_REQUEST['website'] != null) {
        $stmt->bindParam(6, $_REQUEST['website']);
    } else {
        $stmt->bindParam(6, $website);
    }


    if ($_FILES["imagefile"]["name"] != null) {
        if ((($_FILES["imagefile"]["type"] == "image/gif")
                || ($_FILES["imagefile"]["type"] == "image/jpeg")
                || ($_FILES["imagefile"]["type"] == "image/png")
                || ($_FILES["imagefile"]["type"] == "image/pjpeg"))
            && ($_FILES["imagefile"]["size"] < 2000000)
        ) {
            // check for any error code in the data
            if ($_FILES["imagefile"]["error"] > 0) {
                echo "Error Code: " . $_FILES["imagefile"]["error"] . "<br />";

            } else {
                // check to see if a file with that name already exists in our destination directory
                if (file_exists("images/" . $_FILES["imagefile"]["name"])) {
                    echo $_FILES["imagefile"]["name"] . " already exists. \n";
                } else {
                    // create a new unique filename using current time and existing filename
                    $newName = time() . $_FILES["imagefile"]["name"];
                    $newFullName = "images/{$newName}";
                    $newThumbName = "images/" . $_FILES["imagefile"]["name"];
                    // move the temporary file to the destination directory (images) and give it its new name
                    move_uploaded_file($_FILES["imagefile"]["tmp_name"], $newFullName);
                    // set the permission on the file
                    chmod($newFullName, 0644);
                    echo "Stored original as: $newFullName<br />\n";

                    //update the new values to the database
                    $file = fopen($newFullName, 'rb');

                    $stmt->bindParam(7, $file, PDO::PARAM_LOB);

                }
            }
        }
    } else {
        $stmt->bindParam(7, $null);
    }

    if ($_FILES["imagethumb"]["name"] != null) {
        if ((($_FILES["imagethumb"]["type"] == "image/gif")
                || ($_FILES["imagethumb"]["type"] == "image/jpeg")
                || ($_FILES["imagethumb"]["type"] == "image/png")
                || ($_FILES["imagethumb"]["type"] == "image/pjpeg"))
            && ($_FILES["imagethumb"]["size"] < 2000000)
        ) {
            // check for any error code in the data
            if ($_FILES["imagethumb"]["error"] > 0) {
                echo "Error Code: " . $_FILES["imagethumb"]["error"] . "<br />";

            } else {
                // check to see if a file with that name already exists in our destination directory
                if (file_exists("images/" . $_FILES["imagethumb"]["name"])) {
                    echo $_FILES["imagethumb"]["name"] . " already exists. \n";
                } else {
                    // create a new unique filename using current time and existing filename
                    $newName = time() . $_FILES["imagethumb"]["name"];
                    $newFullName = "images/{$newName}";
                    $newThumbName = "images/" . $_FILES["imagethumb"]["name"];
                    // move the temporary file to the destination directory (images) and give it its new name
                    move_uploaded_file($_FILES["imagethumb"]["tmp_name"], $newFullName);
                    // set the permission on the file
                    chmod($newFullName, 0644);

                    make_thumb($newFullName, $newFullName, 300);
                    $thumbnail = fopen($newFullName, 'rb');


                    $stmt->bindParam(8, $thumbnail, PDO::PARAM_LOB);

                }
            }
        }
    } else {
        $stmt->bindParam(8, $null);
    }

    $stmt->execute();

    if ($file != null) {
        fclose($file);
        unlink($newFullName);
    }
    if ($thumbnail != null) {
        fclose($thumbnail);
        unlink($newThumbName);
    }



    header("Location: addArtist.php");

}
if ($_REQUEST['submit'] == "Delete Entry") {
    $sql = "DELETE FROM artists WHERE id = '$_REQUEST[id]'";
    if ($dbh->exec($sql)) {
        header("Location: updateArtist.php");
    }

}
if ($_REQUEST['submit'] == "Update Entry") {

    $sql = "SELECT * FROM artists WHERE id='$_REQUEST[id]'";

    foreach ($dbh->query($sql) as $row) {
        $name = $row['name'];
        $info = $row['info'];
        $email = $row['email'];
        $phone = $row['phone'];
        $mobile = $row['mobile'];
        $website = $row['website'];
        $image = $row['image'];
        $imagethumb = $row['imagethumb'];
    }

    $stmt = $dbh->prepare("UPDATE artists SET name = ?, info = ?, email=?, phone =?, mobile=?,website=?,image=?,imagethumb=? WHERE id = '$_REQUEST[id]' ");

    if ($_REQUEST['name'] != null) {
        $stmt->bindParam(1, $_REQUEST['name']);
    } else {
        $stmt->bindParam(1, $name);
    }

    if ($_REQUEST['info'] != null) {
        $stmt->bindParam(2, $_REQUEST['info']);
    } else {
        $stmt->bindParam(2, $info);
    }

    if ($_REQUEST['email'] != null) {
        $stmt->bindParam(3, $_REQUEST['email']);
    } else {
        $stmt->bindParam(3, $email);
    }

    if ($_REQUEST['phone'] != null) {
        $stmt->bindParam(4, $_REQUEST['phone']);
    } else {
        $stmt->bindParam(4, $phone);
    }

    if ($_REQUEST['mobile'] != null) {
        $stmt->bindParam(5, $_REQUEST['mobile']);
    } else {
        $stmt->bindParam(5, $mobile);
    }
    if ($_REQUEST['website'] != null) {
        $stmt->bindParam(6, $_REQUEST['website']);
    } else {
        $stmt->bindParam(6, $website);
    }



    if ($_FILES["imagefile"]["name"] != null) {
        if ((($_FILES["imagefile"]["type"] == "image/gif")
                || ($_FILES["imagefile"]["type"] == "image/jpeg")
                || ($_FILES["imagefile"]["type"] == "image/png")
                || ($_FILES["imagefile"]["type"] == "image/pjpeg"))
            && ($_FILES["imagefile"]["size"] < 2000000)
        ) {
            // check for any error code in the data
            if ($_FILES["imagefile"]["error"] > 0) {
                echo "Error Code: " . $_FILES["imagefile"]["error"] . "<br />";

            } else {
                // check to see if a file with that name already exists in our destination directory
                if (file_exists("images/" . $_FILES["imagefile"]["name"])) {
                    echo $_FILES["imagefile"]["name"] . " already exists. \n";
                } else {
                    // create a new unique filename using current time and existing filename
                    $newName = time() . $_FILES["imagefile"]["name"];
                    $newFullName = "images/{$newName}";
                    $newThumbName = "images/" . $_FILES["imagefile"]["name"];
                    // move the temporary file to the destination directory (images) and give it its new name
                    move_uploaded_file($_FILES["imagefile"]["tmp_name"], $newFullName);
                    // set the permission on the file
                    chmod($newFullName, 0644);
                    echo "Stored original as: $newFullName<br />\n";

                    //update the new values to the database
                    $file = fopen($newFullName, 'rb');

                    $stmt->bindParam(7, $file, PDO::PARAM_LOB);

                }
            }
        }
    } else {
        $stmt->bindParam(7, $image);
    }

    if ($_FILES["imagethumb"]["name"] != null) {
        if ((($_FILES["imagethumb"]["type"] == "image/gif")
                || ($_FILES["imagethumb"]["type"] == "image/jpeg")
                || ($_FILES["imagethumb"]["type"] == "image/png")
                || ($_FILES["imagethumb"]["type"] == "image/pjpeg"))
            && ($_FILES["imagethumb"]["size"] < 2000000)
        ) {
            // check for any error code in the data
            if ($_FILES["imagethumb"]["error"] > 0) {
                echo "Error Code: " . $_FILES["imagethumb"]["error"] . "<br />";

            } else {
                // check to see if a file with that name already exists in our destination directory
                if (file_exists("images/" . $_FILES["imagethumb"]["name"])) {
                    echo $_FILES["imagethumb"]["name"] . " already exists. \n";
                } else {
                    // create a new unique filename using current time and existing filename
                    $newName = time() . $_FILES["imagethumb"]["name"];
                    $newFullName = "images/{$newName}";
                    $newThumbName = "images/" . $_FILES["imagethumb"]["name"];
                    // move the temporary file to the destination directory (images) and give it its new name
                    move_uploaded_file($_FILES["imagethumb"]["tmp_name"], $newFullName);
                    // set the permission on the file
                    chmod($newFullName, 0644);

                    make_thumb($newFullName, $newFullName, 300);
                    $thumbnail = fopen($newFullName, 'rb');


                    $stmt->bindParam(8, $thumbnail, PDO::PARAM_LOB);

                }
            }
        }
    } else {
        $stmt->bindParam(8, $imagethumb);
    }

    $stmt->execute();

    if ($file != null) {
        fclose($file);
        unlink($newFullName);
    }
    if ($thumbnail != null) {
        fclose($thumbnail);
        unlink($newThumbName);
    }

    header("Location: updateArtist.php");
}

function checkImage($image)
{
    $check = false;

    $imageType = exif_imagetype($image);
    $imageSize = getimagesize($image);


    if ($imageType == 1 || $imageType == 2 || $imageType == 3 && $imageSize < 2000000) {
        // check for any error code in the data
        if ($image > 0) {
            echo "Error Code: " . $image . "<br />";

        } else {
            $check = true;
        }
    }
    return $check;
}


function make_thumb($src, $dest, $desired_width)
{

    /* read the source image */
    $imageType = exif_imagetype($src);
    $imageCreateFrom = null;
    if ($imageType == 1) {
        $imageCreateFrom = "imagecreatefromgif";
    }
    if ($imageType == 2) {
        $imageCreateFrom = "imagecreatefromjpeg";
    }
    if ($imageType == 3) {
        $imageCreateFrom = "imagecreatefrompng";
    }

    $source_image = $imageCreateFrom($src);
    $width = imagesx($source_image);
    $height = imagesy($source_image);

    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height * ($desired_width / $width));

    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
    chmod($src, 0644);
    /* create the physical thumbnail image to its destination */
    return imagejpeg($virtual_image, $dest);
}

if ($_REQUEST['submit'] == "Add Event") {
    if ($_REQUEST['event'] != null && $_REQUEST['info'] != null && $_REQUEST['date'] != null && $_REQUEST['artist'] != null) {
        $stmt = $dbh->prepare("INSERT INTO events (event,info,date,artist) VALUES (?,?,?,?)");
        $stmt->bindParam(1, $_REQUEST['event']);
        $stmt->bindParam(2, $_REQUEST['info']);
        $stmt->bindParam(3, $_REQUEST['date']);
        $stmt->bindParam(4, $_REQUEST['artist']);

        $stmt->execute();

    } else {
        $alert = "<script language='javascript'>alert('please fill in all areas')</script>";
        echo $alert;
    }
    header("Location: eventsView.php");
}

if ($_REQUEST['submit'] == "Register") {
    $stmt = $dbh->prepare("INSERT INTO userlist (username,password,level) VALUES (?,?,1)");
    $stmt->bindParam(1, $_REQUEST['username']);
    $stmt->bindParam(2, $_REQUEST['password']);
    $stmt->execute();
    header("Location: login.php");
    $dbh = null;
}
?>
