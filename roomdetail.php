<?php
// to connect to server
require "conn.php";

// save data temporary
// all variable $_SESSION can be used
session_start();

if (!isset($_SESSION['userName'])) {
    header("location:signup.php");
}

if (!isset($_GET['id'])) {
    echo "this page is accessed in error";
    die();
}

// run command
$result = mysqli_query($connect, "SELECT `roomID`, `roomName`, `roomSize`, `roomDetails`, 
`roomPrice`, `roomAvailable`, `image1`, `image2`, `image3`, `image4` 
FROM `room`
WHERE `roomID` = '" . $_GET['id'] . "'");

$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="cssframework/majesticui.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles/roomdetail.css">
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
    <!-- content -->
    <div class="productcontainer">
        <section class="product">
            <div class="product__photo">
                <div class="photo-container">
                    <div class="photo-main">
                        <img id="selectroomimage" class="roomimages" src="image/<?php echo $_GET['id'] ?>/<?php echo $row['image1'] ?>">
                    </div>
                    <div class="photo-album">
                        <ul>
                            <li><img class="roomimages" onclick="selectimage('<?php echo $row['image1'] ?>', <?php echo $_GET['id'] ?>)" src="image/<?php echo $_GET['id'] ?>/<?php echo $row['image1'] ?>"></li>
                            <li><img class="roomimages" onclick="selectimage('<?php echo $row['image2'] ?>', <?php echo $_GET['id'] ?>)" src="image/<?php echo $_GET['id'] ?>/<?php echo $row['image2'] ?>"></li>
                            <li><img class="roomimages" onclick="selectimage('<?php echo $row['image3'] ?>', <?php echo $_GET['id'] ?>)" src="image/<?php echo $_GET['id'] ?>/<?php echo $row['image3'] ?>"></li>
                            <li><img class="roomimages" onclick="selectimage('<?php echo $row['image4'] ?>', <?php echo $_GET['id'] ?>)" src="image/<?php echo $_GET['id'] ?>/<?php echo $row['image4'] ?>"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="product__info">
                <div class="title">
                    <h1><?php echo strtoupper($row['roomName']) ?></h1>
                </div>
                <div class="price">
                    RM <span><?php echo strtoupper($row['roomPrice']) ?></span>
                </div>
                <div class="description">
                    <h3 class="roomnametitle">ABOUT THIS ROOM</h3>
                    <ul>
                        <li>&nbsp;Details : <br>
                            <?php echo $row['roomDetails'] ?></li>
                        <li>&nbsp;Size : <br>
                            <?php echo $row['roomSize'] ?> sq</li>
                        <li>&nbsp;Availability : <strong><?php echo strtoupper($row['roomAvailable']) ?></strong></li>
                    </ul>
                </div>

                <?php
                if ($row['roomAvailable'] == 'yes') {
                ?>
                    <button onclick="window.location='order.php?id=<?php echo $_GET['id'] ?>'" class="buy--btn">BOOK NOW</button>
                <?php } else {
                ?>
                    <button onclick="window.location='order.php?id=<?php echo $_GET['id'] ?>'" class="buy--btn" disabled>NOT AVAILABLE</button>
                <?php
                } ?>
            </div>
        </section>
    </div>

    <br><br><br><br><br>
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

    <script>
        function selectimage(srcimage, id) {
            var path = "image/" + id + "/" + srcimage;
            document.getElementById("selectroomimage").src = path;
        }
    </script>
</body>

</html>