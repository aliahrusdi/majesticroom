<?php
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
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>
            <?php } else { ?>
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
        <!-- room 1 -->
        <div onclick="location.href='room1.html'" class="row eachroom">
            <div class="col">
                <img class="listroomimage" src="image/standard-1.jpeg">
            </div>
            <div class="col">
                <h3>STANDARD ROOM</h3>
                <p>a room with two double beds <br>
                    or with a queen bed</p>
                <a href="room1.html">Explore</a>
            </div>
        </div>

        <!-- room 2 -->
        <br><br>
        <div onclick="location.href='room2.html'" class="row eachroom">
            <div class="col">
                <h3>QUEEN ROOM</h3>
                <p>a room that has a queen size bed</p>
                <a href="room2.html">Explore</a>
            </div>
            <div class="col">
                <img class="listroomimage" src="image/queen-1.jpeg">
            </div>
        </div>

        <!-- room 3 -->
        <br><br>
        <div onclick="location.href='room3.html'" class="row eachroom">
            <div class="col">
                <img class="listroomimage" src="image/connecting-1.jpeg">
            </div>
            <div class="col">
                <h3>CONNECTING ROOM</h3>
                <p>two rooms that connected</p>
                <a href="room3.html">Explore</a>
            </div>
        </div>

        <!-- room 4 -->
        <br><br>
        <div onclick="location.href='room4.html'" class="row eachroom">
            <div class="col">
                <h3>STUDIO ROOM</h3>
                <p>a rooms duplicate of small house</p>
                <a href="room4.html">Explore</a>
            </div>
            <div class="col">
                <img class="listroomimage" src="image/studio-1.jpeg">
            </div>
        </div>

        <!-- room 5 -->
        <br><br>
        <div onclick="location.href='room5.html'" class="row eachroom">
            <div class="col">
                <img class="listroomimage" src="image/cabana-1.jpeg">
            </div>
            <div class="col">
                <h3>CABANA ROOM</h3>
                <p>a room that feels like in jungle</p>
                <a href="room5.html">Explore</a>
            </div>
        </div>

        <!-- room 6 -->
        <br><br>
        <div onclick="location.href='room6.html'" class="row eachroom">
            <div class="col">
                <h3>DUPLEX ROOM</h3>
                <p>a two-level room</p>
                <a href="room6.html">Explore</a>
            </div>
            <div class="col">
                <img class="listroomimage" src="image/duplex-1.jpeg">
            </div>
        </div>
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