<?php
// to connect to server
require '../conn.php';

// save data temporary
session_start();

if(!isset($_GET['userid']))
{
    echo "this page has been acessed in error";
    die();
}

// run command
$result = mysqli_query($connect, "DELETE FROM `user` WHERE `userID` = '". $_GET['userid'] ."'");

// toast popup
$_SESSION['popuptoast'] = array("Delete Customer", "Customer has been successfully deleted");

// redirect
header("location:listcust.php");