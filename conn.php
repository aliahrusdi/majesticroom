<?php
// connect to server
$connect = mysqli_connect("localhost", "root", "", "majesticroom");

// if it do not connet to server
if (!$connect) {
    die('ERROR : ' . mysqli_connect_error());
}