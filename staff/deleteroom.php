<?php
function deleteDir(string $dirPath): void {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
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
session_start();
if (!isset($_GET['roomid'])) {
    echo "this page has been acessed in error";
    die();
}

$result = mysqli_query($connect, "DELETE FROM `room` WHERE `roomID` = '" . $_GET['roomid'] . "'");
deleteDir('../image/' . $_GET['roomid']);
$_SESSION['popuptoast'] = array("Delete Room", "Room has been successfully deleted");
header("location:listroom.php");
