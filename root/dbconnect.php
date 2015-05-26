<?php
try {
    $dbh = new PDO("sqlite:TCMCdb.sqlite");
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>