<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Majestic Room</title>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
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
            if (!isset($_SESSION['userName'])) 
            {
            ?>
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Book Now</a></li>
            <?php }
            else{ ?>
            <li><a href="listrooms.php" >Book Now</a></li>
            <?php } ?>
        </ul>
    </div>

    <!-- content / brief introduction -->
    <div style="display: flex;">
        <div class="introouter">
            <div class="intro">
                <h2>INTRODUCTION</h2>
                <p>brief about the website</p>
                <a href="aboutus.html">Explore</a>
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
            <h2>LIST ROOM</h2>
            <table align="center">
                <!-- row 1 -->
                <tr>
                    <!-- room 1 -->
                    <td>
                        <img src="image/roomlogo.png"><br>
                        <h4>ROOM 1</h4>
                        <p>description of room 1</p>
                    </td>

                    <!-- room 2 -->
                    <td>
                        <img src="image/roomlogo.png"><br>
                        <h4>ROOM 2</h4>
                        <p>description of room 2</p>
                    </td>

                    <!-- room 3 -->
                    <td>
                        <img src="image/roomlogo.png"><br>
                        <h4>ROOM 3</h4>
                        <p>description of room 3</p>
                    </td>
                </tr>
                <tr>
                    <!-- room 4 -->
                    <td>
                        <a href="room 4">Explore</a>
                        <br><br><br>
                    </td>

                    <!-- room 5 -->
                    <td>
                        <a href="room 5">Explore</a>
                        <br><br><br>
                    </td>

                    <!-- room 6 -->
                    <td>
                        <a href="room 6">Explore</a>
                        <br><br><br>
                    </td>
                </tr>

                <!-- row 2 -->
                <tr>
                    <!-- room 4 -->
                    <td>
                        <img src="image/roomlogo.png"><br>
                        <h4>ROOM 4</h4>
                        <p>description of room 4</p>
                    </td>

                    <!-- room 5 -->
                    <td>
                        <img src="image/roomlogo.png"><br>
                        <h4>ROOM 5</h4>
                        <p>description of room 5</p>
                    </td>

                    <!-- room 6 -->
                    <td>
                        <img src="image/roomlogo.png"><br>
                        <h4>ROOM 6</h4>
                        <p>description of room 6 <br>sdshdsjdh <br>edhjhdhsjdh <br>kdjshdjhjh</p>
                    </td>
                </tr>
                <tr>
                    <!-- room 4 -->
                    <td>
                        <a href="room 4">Explore</a>
                        <br><br><br>
                    </td>

                    <!-- room 5 -->
                    <td>
                        <a href="room 5">Explore</a>
                        <br><br><br>
                    </td>

                    <!-- room 6 -->
                    <td>
                        <a href="room 6">Explore</a>
                        <br><br><br>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- slogan -->
    <div class="sloganouter">
        <div class="slogan">
            <h2>OUR SLOGAN</h2>
            <p>- the slogan -</p>
        </div>
    </div>

    <!-- book now button -->
    <div class="booknowbuttoncontainer">
        <a class="booknowbutton" href="listroom.php" onclick="alert('You need to sign up first')">BOOK NOW</a>
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

    <!-- Modal -->
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