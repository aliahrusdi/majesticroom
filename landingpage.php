<?php
// to connect to server
require "conn.php";

// save data temporary
// all variable $_SESSION can be used
session_start();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Majestic Room</title>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="cssframework/majesticui.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles/landingpage.css">
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
            <li><a href="aboutus.php">About Us</a></li>
            <?php
            if (!isset($_SESSION['userName'])) {
            ?>

                <!-- if user did not sign up -->
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>

                <!-- pop up to sign up -->
                <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Book Now</a></li>
            <?php } else { ?>

                <!-- if user already sign up -->
                <li><a href="listrooms.php">Book Now</a></li>
            <?php } ?>
        </ul>
    </div>

    <!-- content / brief introduction -->
    <div style="display: flex;">
        <div class="introouter">
            <div class="intro">
                <h2>INTRODUCTION</h2>
                <p><i>Welcome to Majestic Room by <strong>aliahrusdi</strong></i></p>
                <a href="aboutus.php">Explore</a>
            </div>
        </div>


        <!-- image for introduction -->
        <div class="imageintroouter">
            <div class="imgsquare"></div>
        </div>
    </div>

    <!-- list for category room -->
    <br>
    <br>
    <br>
    <br>
    <div class="listcategoryroomouter">
        <div class="listcategoryroom">
            <h2><u>LIST ROOM</u></h2>
            <?php

            // run command
            $result = mysqli_query($connect, "SELECT `roomID`, `roomName`, `roomSize`, `roomDetails`, 
            `roomPrice`, `roomAvailable`, `image1`, `image2`, `image3`, `image4` 
            FROM `room` 
            LIMIT 3");
            ?>
            <table align="center">

                <!-- display room -->
                <tr>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <td>
                            <img src="image/<?php echo $row['roomID'] ?>/<?php echo $row['image1'] ?>"><br>
                            <h4><?php echo strtoupper($row['roomName']) ?></h4>
                            <p><?php echo $row['roomDetails'] ?></p>
                        </td>
                    <?php
                    } ?>
                </tr>

                <!-- button explore for each room -->
                <tr>
                    <?php

                    // run command
                    $result = mysqli_query($connect, "SELECT `roomID`, `roomName`, `roomSize`, `roomDetails`, 
                    `roomPrice`, `roomAvailable`, `image1`, `image2`, `image3`, `image4` 
                    FROM `room` 
                    LIMIT 3");

                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <td>
                            <a href="roomdetail.php?id=<?php echo $row['roomID'] ?>">Explore</a>
                            <br><br><br>
                        </td>
                    <?php
                    } ?>
                </tr>
            </table>

            <!-- button for explore more -->
            <div class="exploremorebutton">
                <a href="listrooms.php">EXPLORE MORE ROOM</a>
            </div>
        </div>
    </div>

    <!-- slogan -->
    <div class="sloganouter">
        <div class="slogan">
            <h2>OUR SLOGAN</h2>
            <p class="text-center"><i>WE MAKE YOU FEEL LIKE HOME</i></p>
        </div>
    </div>

    <!-- book now button -->
    <div class="booknowbuttoncontainer">
        <a class="booknowbutton" data-bs-toggle="modal" data-bs-target="#exampleModal">BOOK NOW</a>
    </div>

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

    <!-- Modal to sign up first -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Sign Up Required</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Please sign up first before proceed to book.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a class="btn btn-primary" href="signup.php">Sign Up</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

</html>