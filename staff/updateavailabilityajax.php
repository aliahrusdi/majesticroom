<?php
// untuk update room availability

// to connect to server
require '../conn.php';

if (
    !isset($_GET['roomID']) ||
    !isset($_GET['availablestate'])
) {
    echo "this page accessed in error";
    die();
}

// run command
$result = mysqli_query($connect, "UPDATE `room` 
SET `roomAvailable`= '" . $_GET['availablestate'] . "' 
WHERE `roomID`=" . $_GET['roomID']);

// check command succes ke tak
if (!$result) {
    http_response_code(400);
}
