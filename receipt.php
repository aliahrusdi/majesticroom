<?php
// to connect to server
require 'conn.php';

// save data temporary
// all variable $_SESSION can be used
session_start();

if (!isset($_GET['receiptid'])) {
    echo "this page is accessed in error";
    die();
}

// run command
$result = mysqli_query($connect, "SELECT `user`.`userName`, `user`.`userEmail`, 
`room`.`roomName`, `room`.`roomPrice`, 
`orders`.`checkIn`, `orders`.`checkOut`, `orders`.`totalPrice` 
FROM `orders` 
INNER JOIN `user` ON `orders`.`userName` = `user`.`userName`
INNER JOIN `room` ON `room`.`roomID` = `orders`.`roomID` 
WHERE `orders`.`ordersID` = " . $_GET['receiptid']);

$row = mysqli_fetch_array($result);

// difference between days - stay period
$date1 = DateTime::createFromFormat('d/m/Y', $row[4]);
$date2 = DateTime::createFromFormat('d/m/Y', $row[5]);

$interval = $date1->diff($date2);

// Get the difference in days
$stayperiod = $interval->days;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="cssframework/majesticui.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles/receipt.css">
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

    <br><br><br><br>
    <!-- receipt structure -->
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="receipt-main col">
                    <div class="row">
                        <div class="col">
                            <div class="receipt-left">
                                <img class="img-responsive" alt="iamgurdeeposahan" src="image/roomlogo.png">
                            </div>
                        </div>
                        <div class="col text-right">
                            <div class="receipt-right">
                                <h5>MAJESTIC ROOM</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-left">
                            <div class="receipt-right">
                                <h5><?php echo $_SESSION['userName'] ?></h5>
                                <p><?php echo $row[1] ?></p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="receipt-left">
                                <h3>ORDER # <?php echo $_GET['receiptid'] ?></h3>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="bg-secondary">Description</th>
                                    <th class="bg-secondary">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-md-9">Room Name : <strong><?php echo strtoupper($row[2]) ?></strong><br>
                                        Check In : <strong><?php echo $row[4] ?></strong><br>
                                        Check Out : <strong><?php echo $row[5] ?></strong><br>
                                        Stay Period : <strong><?php echo $stayperiod ?> days</strong>
                                    </td>
                                    <td class="col-md-3"><i class="fa fa-inr"></i><?php echo $row[3] ?></td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <p>
                                            <strong>Total Amount: </strong>
                                        </p>
                                        <p>
                                            <strong>Tax: </strong>
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            <strong><i class="fa fa-inr"></i><?php echo $row[3] * $stayperiod ?></strong>
                                        </p>
                                        <p>
                                            <strong><i class="fa fa-inr"></i>6%</strong>
                                        </p>
                                    </td>
                                </tr>
                                <tr>

                                    <td class="text-right">
                                        <h2><strong>Total: </strong></h2>
                                    </td>
                                    <td class="text-left text-danger">
                                        <h2><strong><i class="fa fa-inr"></i><?php echo $row[6] ?></strong></h2>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="receipt-header receipt-header-mid receipt-footer">
                            <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                                <div class="receipt-right">
                                    <h5 style="color: rgb(140, 140, 140);">Thanks for your booking!</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- book more button -->
                    <div class="bookmorebutton float-start">
                        <a href="landingpage.php">BOOK AGAIN</a>
                    </div>

                    <!-- print button -->
                    <div class="printbutton float-end">
                        <a href="#" onclick="window.print()">PRINT</a>
                    </div>
                </div>
            </div>
        </div>
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
</body>

</html>