<?php
// to connect to server
require '../conn.php';
session_start();
if(!isset($_GET['orderid']))
{
    echo "this page has been acessed in error";
    die();
}

$result = mysqli_query($connect, "DELETE FROM `orders` WHERE `ordersID` = '". $_GET['orderid'] ."'");
$_SESSION['popuptoast'] = array("Delete Order", "Customer order has been successfully deleted");
header("location:listorder.php");