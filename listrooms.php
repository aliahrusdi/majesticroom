<?php
// to connect to server
require "conn.php";

// save data temporary
// all variable $_SESSION can be used
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Room</title>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles/listroom.css">
    <link rel="shortcut icon" href="image/tablogo.png" type="image/x-icon">

    <!-- icon link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>

<body>
    <!-- header -->
    <div class="headerroom">
        <div>
            <img src="image/roomlogo.png">
        </div>
        <ul>
            <li><a href="landingpage.php">Home</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <?php
            if (!isset($_SESSION['userName'])) {
            ?>
            <!-- if user did not sign up or login -->
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>
            <?php } else { ?>
                <!-- if user login -->
                <li><a href="logout.php">Log Out</a></li>
                <li><a class="userprofile" href="profile.php"><?php echo $_SESSION['userName'] ?></a></li>
            <?php } ?>
        </ul>
    </div>

    <br><br>
    <!-- content / brief introduction -->
    <div class="listroomstitle">
        <h1>LIST ROOM</h1>
    </div>

    <br><br><br><br>
    <div class="container">
        <?php

        // run command
        $result = mysqli_query($connect, "SELECT `roomID`, `roomName`, `roomSize`, `roomDetails`, 
        `roomPrice`, `roomAvailable`, `image1`, `image2`, `image3`, `image4` 
        FROM `room`");

        // list room - display
        $invert = false;
        while ($row = mysqli_fetch_array($result)) {
            if (!$invert) {
        ?>
                <!-- room 1 / 3 / 5 -->
                <br><br>
                <div class="row eachroom">
                    <div class="col">
                        <img class="listroomimage" src="image/<?php echo $row['image1'] ?>">
                    </div>
                    <div class="col">
                        <h3><?php echo strtoupper($row['roomName']) ?></h3>
                        <p><?php echo $row['roomDetails'] ?></p>
                        <a href="roomdetail.php?id=<?php echo $row['roomID'] ?>">Explore</a>
                    </div>
                </div>
            <?php
                $invert = true;
            } else {
            ?>
                <!-- room 2 / 4 / 6 -->
                <br><br>
                <div class="row eachroom">
                    <div class="col">
                        <h3><?php echo strtoupper($row['roomName']) ?></h3>
                        <p><?php echo $row['roomDetails'] ?></p>
                        <a href="roomdetail.php?id=<?php echo $row['roomID'] ?>">Explore</a>
                    </div>
                    <div class="col">
                        <img class="listroomimage" src="image/<?php echo $row['image1'] ?>">
                    </div>
                </div>
        <?php
        $invert = false;
            }
        } ?>
    </div>

    <br><br><br><br>
    <!-- footer -->
    <section class="footer">
        <div class="footercontent">
            <div class="logo">aliah<span>rusdi</span></div>
            <p class="footername">Majestic Room</p>

            <div class="icon">
                <a href="#"><i class='bx bxl-tiktok'></i></a>
                <a href="#"><i class='bx bxl-instagram-alt'></i></a>
                <a href="#"><i class='bx bxl-twitter'></i></a>
            </div>
        </div>
    </section>
</body>

</html>