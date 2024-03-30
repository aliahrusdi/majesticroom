<?php
// to connect to server
require 'conn.php';

// save data temporary
// all variable $_SESSION can be used
session_start();

// get data from payment
if (
    !isset($_POST['roomid']) ||
    !isset($_POST['date1']) ||
    !isset($_POST['date2']) ||
    !isset($_POST['totalprice']) ||
    !isset($_SESSION['userName']) ||
    !isset($_POST['paymentmethod'])
) {
    echo "this page is accessed in error";
    die();
}

// run the command
$updateroom = mysqli_query($connect, "UPDATE `room` SET `roomAvailable`='no' WHERE `roomID`='". $_POST['roomid'] ."'");

if($updateroom)
{
    $result = mysqli_query($connect, "INSERT INTO `orders`(`ordersID`, `userName`, `roomID`, 
    `checkIn`, `checkOut`, `totalPrice`, `paymentMethod`) 
    VALUES (NULL,'" . $_SESSION['userName'] . "','" . $_POST['roomid'] . "',
    '" . $_POST['date1'] . "','" . $_POST['date2'] . "','" . $_POST['totalprice'] . "','" . $_POST['paymentmethod'] . "')");
    
    if($result)
    {
        header("location:receipt.php?receiptid=". mysqli_insert_id($connect));
    }
    
    else
    {
        header("location:receipt.php");
    }
}
else
{
    header("location:receipt.php");
}