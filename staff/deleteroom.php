<?php
// to connect to server
require '../conn.php';
session_start();
if(!isset($_GET['roomid']))
{
    echo "this page has been acessed in error";
    die();
}

$result = mysqli_query($connect, "DELETE FROM `room` WHERE `roomID` = '". $_GET['roomid'] ."'");
$_SESSION['popuptoast'] = array("Delete Room", "Room has been successfully deleted");
header("location:listroom.php");