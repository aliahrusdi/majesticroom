<?php
// to connect to server
require "../conn.php";

// save data temporary
// all variable $_SESSION can be used
session_start();

if (
    !isset($_POST['totalpriceinput']) ||
    !isset($_POST['orderid']) ||
    !isset($_POST['roomid']) ||
    !isset($_POST['checkin']) ||
    !isset($_POST['checkout'])
) {
    echo "this page is accessed in error";
    die();
}

// run command
$result =  mysqli_query($connect, "UPDATE `orders` SET `roomID`='".$_POST['roomid']."',
`checkIn`='".$_POST['checkin']."',`checkOut`='".$_POST['checkout']."',`totalPrice`='".$_POST['totalpriceinput']."' 
WHERE `ordersID`='".$_POST['orderid']."'");

if ($result) {
    // success
    $_SESSION['popuptoast'] = array("Update Order", "Customer order has been successfully updated");

    // redirect
    header("location:listorder.php");
} else {
    // error
    $_SESSION['popuptoast'] = array("Update Order", "Failed to update customer order");

    // redirect
    header("location:listorder.php");
}
