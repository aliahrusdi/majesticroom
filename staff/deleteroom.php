<?php
// delete file -  image
function deleteDir(string $dirPath): void {
    // check adakah tu folder
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
   
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        // delete file
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

// to connect to server
require '../conn.php';

// save data temporary
session_start();

if (!isset($_GET['roomid'])) {
    echo "this page has been acessed in error";
    die();
}

// run command
$result = mysqli_query($connect, "DELETE FROM `room` WHERE `roomID` = '" . $_GET['roomid'] . "'");

//  delete folder
deleteDir('../image/' . $_GET['roomid']);

// toast popup
$_SESSION['popuptoast'] = array("Delete Room", "Room has been successfully deleted");

// redirect
header("location:listroom.php");
