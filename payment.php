<?php
// to connect to server
require "conn.php";

// save data temporary
// all variable $_SESSION can be used
session_start();

if (
    !isset($_POST['roomid']) || !isset($_POST['date1']) || !isset($_POST['date2']) || !isset($_POST['totalprice'])) {
    echo "this page is accessed in error";
    die();
}

// run the coomand
$resultprofile = mysqli_query($connect, "SELECT `userEmail` FROM `user` 
WHERE `userName` = '" . $_SESSION['userName'] . "'");

// display name that same as the email - login
$dataprofile = mysqli_fetch_array($resultprofile);
$useremail = $dataprofile[0];
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="cssframework/majesticui.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles/payment.css">
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
    <div class="paymenttitle">
        <h1>PAYMENT</h1>
    </div>

    <br><br><br>
    <!-- total price -->
    <div class="container">
        <div class="innercontainer">
            <div class="totalpricetaxcontainer">
                <div class="totalpricetax">
                    <div class="row">
                        <div class="col">
                            <div class="totaltitle">
                                <h2>TOTAL PRICE</h2>
                            </div>
                        </div>
                        <div class="col">
                            <div class="pricetax">
                                <p>RM <?php echo $_POST['totalprice'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br>
    <!-- payment content -->
    <div class="container">
        <div class="innerorder">
            <form action="paymentsubmit.php" method="post" onsubmit="return submitpaymentcheck()">
                <input type="hidden" name="date1" value="<?php echo $_POST['date1'] ?>">
                <input type="hidden" name="date2" value="<?php echo $_POST['date2'] ?>">
                <input type="hidden" name="totalprice" id="totalpricevalue" value="<?php echo $_POST['totalprice'] ?>">
                <input type="hidden" name="roomid" value="<?php echo $_POST['roomid'] ?>">

                <table class="table table-striped rounded-3 overflow-hidden">
                    <thead>
                        <tr class="table-dark">
                            <th class="text-center" colspan="2">Payment Details</th>
                        </tr>
                    </thead>
                    <tbody class="table-primary">
                        <tr>
                            <td>Name</td>
                            <td><?php echo $_SESSION['userName'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $useremail ?></td>
                        </tr>
                        <tr class="table-dark">
                            <th class="text-center" colspan="2">Select Payment Method</th>
                        </tr>
                        <tr>
                            <td>Cash</td>
                            <td><input type="radio" class="btn-check" name="paymentmethod" id="cash" value="cash" autocomplete="off" onclick="showcashinput()" required>
                                <label class="btn btn-outline-success" for="cash">Select Payment</label>
                            </td>
                        </tr>
                        <tr>
                            <td>Card</td>
                            <td><input type="radio" class="btn-check" name="paymentmethod" id="card" value="card" autocomplete="off" onclick="hideshowcashinput()" required>
                                <label class="btn btn-outline-success" for="card">Select Payment</label>
                            </td>
                        </tr>
                        <tr>
                            <td>Online Banking</td>
                            <td><input type="radio" class="btn-check" name="paymentmethod" id="onlinebanking" value="online banking" autocomplete="off" onclick="hideshowcashinput()" required>
                                <label class="btn btn-outline-success" for="onlinebanking">Select Payment</label>
                            </td>
                        </tr>
                        <tr style="display: none;" id="cashamountrow">
                            <td>Enter Amount</td>
                            <td>RM <input id="cashinput" type="number" value="0" name="cashvalue" required></td>
                        </tr>
                    </tbody>
                </table>

                <!-- button for print receipt -->
                <div class="paynowbutton">
                    <button type="submit">PRINT RECEIPT</button>
                </div>
            </form>
        </div>
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

    <!-- Modal -->
    <div class="modal fade" id="casherrorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Amount Unsufficient</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Your amount is unsufficient
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- js for cash -->
    <script>
        // show if user choose pay by cash
        function showcashinput() {
            document.getElementById("cashamountrow").style.display = "";
        }

        // hide if user choose pay by card or online banking
        function hideshowcashinput() {
            document.getElementById("cashamountrow").style.display = "none";
        }

        // cash - kurang ke tak
        function submitpaymentcheck() {
            var cashvalue = parseInt(document.getElementById("cashinput").value);
            var totalprice = parseInt(document.getElementById("totalpricevalue").value);

            var selectedpayment = document.querySelector('input[name="paymentmethod"]:checked').value;

            if (selectedpayment != 'cash') {
                return true;
            }

            if (cashvalue < totalprice) {
                const casherrorModal = new bootstrap.Modal(document.getElementById('casherrorModal'));
                casherrorModal.show();
                return false;
            } else {
                return true;
            }
        }
    </script>
</body>

</html>