<?php
// to connect to server
require "conn.php";

// save data temporary
// all variable $_SESSION can be used
session_start();

// run the coomand
$result = mysqli_query($connect, "SELECT `userEmail` FROM `user` WHERE `userName` = '" . $_SESSION['userName'] . "'");

// display name that same as the email - login
$dataprofile = mysqli_fetch_array($result);
$useremail = $dataprofile[0];
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="cssframework/majesticui.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles/aboutus.css">
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
                <!-- if user did not sign up -->
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>
            <?php } else { ?>
                <!-- if user already login - display their name -->
                <li><a href="listrooms.php">Book Now</a></li>
                <li><a href="logout.php">Log Out</a></li>
                <li><a class="userprofile" href="profile.php"><?php echo $_SESSION['userName'] ?></a></li>
            <?php } ?>
        </ul>
    </div>

    <br><br><br>
    <!-- content / brief introduction -->
    <div class="aboutustitle">
        <h1>USER PROFILE</h1>
    </div>

    <br><br>

    <!-- USER INFORMATION -->
    <div class="container-sm">
        <!-- Content profile here -->
        <table class="table rounded-3 overflow-hidden">
            <thead class="table-secondary">
                <tr>
                    <th class="text-center" colspan="2">User Profile</th>
                </tr>
            </thead>
            <tbody>
                <!-- display user info -->
                <tr class="table-primary">
                    <td>User Name</td>
                    <td><?php echo $_SESSION['userName'] ?></td>
                </tr>
                <tr class="table-info">
                    <td>Email</td>
                    <td><?php echo $useremail ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Content my order here -->
        <table class="table table-striped rounded-3 overflow-hidden">
            <thead>
                <tr class="table-secondary">
                    <th class="text-center" colspan="4">My Order</th>
                </tr>
                <tr class="table-info">
                    <th>Room</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Total Payment</th>
                </tr>
            </thead>
            <tbody class="table-primary">
                <?php
                $result2 = mysqli_query($connect, "SELECT `user`.`userName`, `user`.`userEmail`, 
                `room`.`roomName`, `room`.`roomPrice`, 
                `orders`.`checkIn`, `orders`.`checkOut`, `orders`.`totalPrice` 
                FROM `orders` 
                INNER JOIN `user` ON `orders`.`userName` = `user`.`userName`
                INNER JOIN `room` ON `room`.`roomID` = `orders`.`roomID` 
                WHERE `user`.`userName` = '".$_SESSION['userName']."'");

                while($order = mysqli_fetch_array($result2))
                {
                ?>
                <tr>
                    <td><?php echo $order[2] ?></td>
                    <td><?php echo $order[4] ?></td>
                    <td><?php echo $order[5] ?></td>
                    <td><?php echo $order[6] ?></td>
                </tr>
                <?php 
                } ?>
            </tbody>
        </table>
    </div>

    <br><br><br><br><br>
    <!-- footer -->
    <section class="footer">
        <div class="footercontent">
            <div class="logo">aliah<span>rusdi</span></div>
            <p class="footername">Majestic Room</p>

            <div class="icon">
                <a href="https://www.tiktok.com/en/"><i class='bx bxl-tiktok'></i></a>
                <a href="https://www.instagram.com/"><i class='bx bxl-instagram-alt'></i></a>
                <a href="https://twitter.com/?lang=en"><i class='bx bxl-twitter'></i></a>
            </div>
        </div>
    </section>

</body>

</html>

</html>