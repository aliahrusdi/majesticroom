<?php
// to connect to server
require '../conn.php';

// save data temporary
session_start();

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
        // error on adding room
        $_SESSION['popuptoast'] = array("Add Room", "Failed to add romm");
        header("location:listroom.php?error");
        die();
    }
}

if (
    isset($_POST['roomname']) ||
    isset($_POST['roomprice']) ||
    isset($_POST['roomdetail']) ||
    isset($_POST['roomsize']) ||
    isset($_POST['roomavailable'])
) {
    // run command
    $result = mysqli_query($connect, "INSERT INTO `room`(`roomID`, `roomName`, `roomSize`, 
    `roomDetails`, `roomPrice`, `roomAvailable`, 
    `image1`, `image2`, `image3`, `image4`) 
    VALUES (NULL,'" . $_POST['roomname'] . "','" . $_POST['roomsize'] . "',
    '" . $_POST['roomdetail'] . "','" . $_POST['roomprice'] . "','" . $_POST['roomavailable'] . "',
    '','','','')");

    if ($result) {
        $roomid = mysqli_insert_id($connect);

        // file 1
        if (
            file_exists($_FILES['imginput1']['tmp_name']) &&
            is_uploaded_file($_FILES['imginput1']['tmp_name'])
        ) {
            // call method
            uploadFileToFolder($_FILES['imginput1'], $roomid, 1);

            // nama file masuk database
            $imagename = 'imageroom1' . '.' . strtolower(pathinfo($_FILES['imginput1']["name"], PATHINFO_EXTENSION));

            // run command
            $resultimg1 = mysqli_query($connect, "UPDATE `room` SET `image1`='" . $imagename . "' WHERE `roomID`='" . $roomid . "'");
        } else {
            // error on adding room
            $_SESSION['popuptoast'] = array("Add Room", "Failed to add romm");
            header("location:listroom.php?error");
            die();
        }

        // file 2
        if (
            file_exists($_FILES['imginput2']['tmp_name']) &&
            is_uploaded_file($_FILES['imginput2']['tmp_name'])
        ) {
            // call method
            uploadFileToFolder($_FILES['imginput2'], $roomid, 2);

            // nama file masuk database
            $imagename = 'imageroom2' . '.' .  strtolower(pathinfo($_FILES['imginput2']["name"], PATHINFO_EXTENSION));

            // run command
            $resultimg1 = mysqli_query($connect, "UPDATE `room` SET `image2`='" . $imagename . "' WHERE `roomID`='" . $roomid . "'");
        } else {
            // error on adding room
            $_SESSION['popuptoast'] = array("Add Room", "Failed to add romm");
            header("location:listroom.php?error");
            die();
        }

        // file 3
        if (
            file_exists($_FILES['imginput3']['tmp_name']) &&
            is_uploaded_file($_FILES['imginput3']['tmp_name'])
        ) {
            // call method
            uploadFileToFolder($_FILES['imginput3'], $roomid, 3);

            // nama file masuk database
            $imagename = 'imageroom3' . '.' . strtolower(pathinfo($_FILES['imginput3']["name"], PATHINFO_EXTENSION));

            // run command
            $resultimg1 = mysqli_query($connect, "UPDATE `room` SET `image3`='" . $imagename . "' WHERE `roomID`='" . $roomid . "'");
        } else {
            // error on adding room
            $_SESSION['popuptoast'] = array("Add Room", "Failed to add romm");
            header("location:listroom.php?error");
            die();
        }

        // file 4
        if (
            file_exists($_FILES['imginput4']['tmp_name']) &&
            is_uploaded_file($_FILES['imginput4']['tmp_name'])
        ) {
            // call method
            uploadFileToFolder($_FILES['imginput4'], $roomid, 4);

            // nama file masuk database
            $imagename = 'imageroom4' . '.' . strtolower(pathinfo($_FILES['imginput4']["name"], PATHINFO_EXTENSION));

            // run command
            $resultimg1 = mysqli_query($connect, "UPDATE `room` SET `image4`='" . $imagename . "' WHERE `roomID`='" . $roomid . "'");
        } else {
            // error on adding room
            $_SESSION['popuptoast'] = array("Add Room", "Failed to add romm");
            header("location:listroom.php?error");
            die();
        }

        // kalau success
        $_SESSION['popuptoast'] = array("Add Room", "Room has been successfully added");
        header("location:listroom.php");

    } else {
        $_SESSION['popuptoast'] = array("Add Room", "Failed to add romm");
        header("location:listroom.php?error");
        die();
    }
}
