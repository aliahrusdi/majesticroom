<?php
function uploadFileToFolder($image, $roomid, $roomimgnumber)
{
    // path
    $target_dir = "../image/" . $roomid . '/';

    // file location to store image
    $target_file = $target_dir . 'imageroom' . $roomimgnumber . '.' . strtolower(pathinfo($image["name"], PATHINFO_EXTENSION));
    
    // buat folder
    if (!file_exists($target_dir)) {
        mkdir($target_dir);
    }

    // padam file tak perlu
    $unusedfile = glob("../image/" . $roomid . '/imageroom' . $roomimgnumber . ".*");
    foreach ($unusedfile as $file) {
        unlink($file);
    }

    // masukkan gambar baru
    if (!move_uploaded_file($image["tmp_name"], $target_file)) {
        return;
    }
}

// to connect to server
require "../conn.php";

// save data temporary
// all variable $_SESSION can be used
session_start();

if (
    !isset($_POST['roomid']) ||
    !isset($_POST['roomname']) ||
    !isset($_POST['roomprice']) ||
    !isset($_POST['roomdetail']) ||
    !isset($_POST['roomsize']) ||
    !isset($_POST['roomavailable'])
) {
    echo "this page is accessed in error";
    die();
}

// run command
$result =  mysqli_query($connect, "UPDATE `room` SET `roomName`='" . $_POST['roomname'] . "',
`roomSize`='" . $_POST['roomsize'] . "',`roomDetails`='" . $_POST['roomdetail'] . "',
`roomPrice`='" . $_POST['roomprice'] . "',`roomAvailable`='" . $_POST['roomavailable'] . "' 
WHERE `roomID`='" . $_POST['roomid'] . "'");

// check file uploaded
if ($result) {

    // file 1
    if (
        file_exists($_FILES['imginput1']['tmp_name']) &&
        is_uploaded_file($_FILES['imginput1']['tmp_name'])
    ) {
        // call method
        uploadFileToFolder($_FILES['imginput1'], $_POST['roomid'], 1);

        // nama file masuk database
        $imagename = 'imageroom1' . '.' . strtolower(pathinfo($_FILES['imginput1']["name"], PATHINFO_EXTENSION));

        // run command
        $resultimg1 = mysqli_query($connect, "UPDATE `room` SET `image1`='" . $imagename . "' WHERE `roomID`='" . $_POST['roomid'] . "'");
    }

    // file 2
    if (
        file_exists($_FILES['imginput2']['tmp_name']) &&
        is_uploaded_file($_FILES['imginput2']['tmp_name'])
    ) {
        // call method
        uploadFileToFolder($_FILES['imginput2'], $_POST['roomid'], 2);

        // nama file masuk database
        $imagename = 'imageroom2' . '.' .  strtolower(pathinfo($_FILES['imginput2']["name"], PATHINFO_EXTENSION));

        // run command
        $resultimg1 = mysqli_query($connect, "UPDATE `room` SET `image2`='" . $imagename . "' WHERE `roomID`='" . $_POST['roomid'] . "'");
    }

    // file 3
    if (
        file_exists($_FILES['imginput3']['tmp_name']) &&
        is_uploaded_file($_FILES['imginput3']['tmp_name'])
    ) {
        // call method
        uploadFileToFolder($_FILES['imginput3'], $_POST['roomid'], 3);

        // nama file masuk database
        $imagename = 'imageroom3' . '.' . strtolower(pathinfo($_FILES['imginput3']["name"], PATHINFO_EXTENSION));

        // run command
        $resultimg1 = mysqli_query($connect, "UPDATE `room` SET `image3`='" . $imagename . "' WHERE `roomID`='" . $_POST['roomid'] . "'");
    }

    // file 4
    if (
        file_exists($_FILES['imginput4']['tmp_name']) &&
        is_uploaded_file($_FILES['imginput4']['tmp_name'])
    ) {
        // call method
        uploadFileToFolder($_FILES['imginput4'], $_POST['roomid'], 4);

        // nama file masuk database
        $imagename = 'imageroom4' . '.' . strtolower(pathinfo($_FILES['imginput4']["name"], PATHINFO_EXTENSION));

        // run command
        $resultimg1 = mysqli_query($connect, "UPDATE `room` SET `image4`='" . $imagename . "' WHERE `roomID`='" . $_POST['roomid'] . "'");
    }

    // kalau success
    $_SESSION['popuptoast'] = array("Update Room", "Room has been successfully updated");

    // redirect
    header("location:listroom.php?roomid=" . $_POST['roomid']);
} else {
    // kalau error
    $_SESSION['popuptoast'] = array("Update Room", "Failed to update romm");

    // redirect
    header("location:listroom.php?roomid=" . $_POST['roomid'] . "&error");
}
