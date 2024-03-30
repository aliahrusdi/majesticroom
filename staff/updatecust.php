<?php
// to connect to server
require "../conn.php";

// save data temporary
// all variable $_SESSION can be used
session_start();

if (
    !isset($_POST['custid']) ||
    !isset($_POST['custname']) ||
    !isset($_POST['custemail']) ||
    !isset($_POST['custpassword'])
) {
    echo "this page is accessed in error";
    die();
}

// run command
$result =  mysqli_query($connect, "UPDATE `user` SET `userName`='".$_POST['custname']."',
`userEmail`='".$_POST['custemail']."',`userPassword`='".$_POST['custpassword']."' 
WHERE `userID`='".$_POST['custid']."'");

if ($result) {
    $_SESSION['popuptoast'] = array("Update Customer", "Customer has been successfully updated");
    header("location:listcust.php");
} else {
    $_SESSION['popuptoast'] = array("Update Customer", "Failed to update customer");
    header("location:listcust.php");
}
