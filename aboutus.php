<?php
// save data temporary
// all variable $_SESSION can be used
session_start();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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
            <?php
            if (!isset($_SESSION['userName'])) 
            {
            ?>

            <!-- if user did not sign up -->
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>

                <!-- pop up to sign up -->
                <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Book Now</a></li>
            <?php }
            else{ ?>

            <!-- if user already sign up -->
            <li><a href="listrooms.php" >Book Now</a></li>
            <?php } ?>
        </ul>
    </div>

    <br>
    <br>
    <br>
    
    <!-- content / brief introduction -->
    <div class="aboutustitle">
        <h1>ABOUT US</h1>
    </div>

    <br>
    <br>

    <!-- image -->
    <div class="aboutusimage">
        <img src="image/intro.jpeg">
    </div>

    <br>
    <br>
    <br>

    <!-- content -->
    <div class="aboutuscontent">
        <p>This online room booking project features a variety of room types displayed in a <br>
            neatly organized design. Users can easily navigate through visually appealing boxes, <br>
            each presenting clear pictures and concise descriptions. The user-friendly interface <br>
            includes intuitive buttons for seamless interaction, and accessible forms enhance the <br>
            overall booking experience. The emphasis is on simplicity and organization to <br>
            provide users with a straightforward and enjoyable room booking process</p>
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

    <!-- Modal for user to sign up first -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Sign Up Required</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    please sign up first before proceed to book.
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