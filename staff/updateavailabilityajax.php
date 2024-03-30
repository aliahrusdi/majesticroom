<?php
require '../conn.php';
if (!isset($_GET['roomID']) || !isset($_GET['availablestate'])) {
    echo "this page accessed in error";
    die();
}

$result = mysqli_query($connect, "UPDATE `room` SET `roomAvailable`= '" . $_GET['availablestate'] . "' WHERE `roomID`=" . $_GET['roomID']);
if(!$result){
    http_response_code(400);
}