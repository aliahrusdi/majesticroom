<?php
// to connect to server
require '../conn.php';
session_start();

if(!isset($_GET['userid']))
{
    echo "this page has been acessed in error";
    die();
}

$result = mysqli_query($connect, "DELETE FROM `user` WHERE `userID` = '". $_GET['userid'] ."'");
$_SESSION['popuptoast'] = array("Delete Customer", "Customer has been successfully deleted");
header("location:listcust.php");