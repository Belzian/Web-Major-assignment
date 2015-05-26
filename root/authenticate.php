<?php
session_start();
error_reporting(E_ALL);
include("dbconnect.php");

if (!isset($_SESSION['username']))
{
    if (isset($_POST['username']))
    {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM userlist WHERE username='$username'";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if(($username == $result['username']) and ($password == $result['password'])){
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['msg'] = "Logged in!";
            $_SESSION['level'] = $result['level'];
            session_regenerate_id();
            header("Location: login.php");
        }
        else{
            $_SESSION['msg'] = "Invalid username and/or password!";
            header("Location: login.php");
            exit();
        }
    }
    else // they didn't come from a form - tell them to log in, redirecting to login page
    {
        $_SESSION['msg'] = "You must log in first";
        header("Location: login.php");
        exit();
    }
}

?>