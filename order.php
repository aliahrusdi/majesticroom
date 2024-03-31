<?php
// to connect to server
require "conn.php";

// save data temporary
// all variable $_SESSION can be used
session_start();

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
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <script src='node_modules/fullcalendar/index.global.min.js'></script>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="cssframework/majesticui.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles/order.css">
    <link rel="shortcut icon" href="image/tablogo.png" type="image/x-icon">
    <script src="node_modules/moment/moment.js"></script>

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
    <div class="ordertitle">
        <h1>MY ORDER</h1>
    </div>

    <br><br>
    <!-- content -->
    <div class="container">
        <div class="innerorder">
            <table class="table table-striped rounded-3 overflow-hidden">
                <thead>
                    <tr class="table-dark">
                        <th class="text-center" colspan="2">Order Details</th>
                    </tr>
                </thead>
                <tbody class="table-primary">
                    <tr>
                        <td>Name</td>
                        <td><?php echo $_SESSION['userName'] ?></td>
                    </tr>
                    <tr>
                        <td>Room</td>
                        <td><?php echo $row['roomName'] ?></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>RM <?php echo strtoupper($row['roomPrice']) ?></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>
                            <div id="calendar" class="calendar"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Check In</td>
                        <td id="checkintable"></td>
                    </tr>
                    <tr>
                        <td>Check Out</td>
                        <td id="checkouttable"></td>
                    </tr>
                    <tr>
                        <td>Stay Period</td>
                        <td id="totaldaytable"></td>
                    </tr>
                    <tr>
                        <td>Total Price</td>
                        <td id="totalpricetable"></td>
                    </tr>
                    <tr class="fw-bold">
                        <td>Total Price (6% tax)</td>
                        <td id="totalpricetaxtable"></td>
                    </tr>
                </tbody>
            </table>

            <!-- button for pay now -->
            <div class="paynowbutton">
                <a href="#" onclick="sendtopayment()">PAY NOW</a>
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
                <a href="https://www.tiktok.com/en/"><i class='bx bxl-tiktok'></i></a>
                <a href="https://www.instagram.com/"><i class='bx bxl-instagram-alt'></i></a>
                <a href="https://twitter.com/?lang=en"><i class='bx bxl-twitter'></i></a>
            </div>
        </div>
    </section>

    <!-- Modal to sign up first -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Incomplete Form</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Please complete the form before proceed to pay.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- calendar -->
    <script>
        var date1post      = null;
        var date2post      = null;
        var totalpricepost = null;
        var roomidpost     = "<?php echo $_GET['id'] ?>";
        
        // display calendar
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                unselectAuto: false,
                select: function(selectionInfo) {
                    const date1    = new Date(selectionInfo.startStr);
                    const date2    = new Date(selectionInfo.endStr);
                    const diffTime = Math.abs(date2 - date1);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                    // tax
                    var tax = 0.06

                    // total price
                    var totalprice = diffDays * <?php echo $row['roomPrice'] ?>;

                    totalpricepost = (totalprice * tax) + totalprice;

                    // cara display tarikh
                    date1post = moment(date1).format("DD/MM/YYYY");
                    date2post = moment(date2).format("DD/MM/YYYY");
                    
                    document.getElementById("checkintable").innerHTML = moment(date1).format("DD/MM/YYYY");
                    document.getElementById("checkouttable").innerHTML = moment(date2).format("DD/MM/YYYY");
                    document.getElementById("totaldaytable").innerHTML = diffDays + " days";
                    document.getElementById("totalpricetable").innerHTML = "RM " + totalprice;
                    document.getElementById("totalpricetaxtable").innerHTML = "RM " + ((totalprice * tax) + totalprice);
                }
            });
            calendar.render();
        });


        function post(path, params, method = 'post') {
            const form = document.createElement('form');
            form.method = method;
            form.action = path;

            for (const key in params) {
                if (params.hasOwnProperty(key)) {
                    const hiddenField = document.createElement('input');
                    hiddenField.type = 'hidden';
                    hiddenField.name = key;
                    hiddenField.value = params[key];

                    form.appendChild(hiddenField);
                }
            }

            document.body.appendChild(form);
            form.submit();
        }

        function sendtopayment() {
            if(date1post == null || date2post == null || totalpricepost == null)
            {
                const orderModal = new bootstrap.Modal(document.getElementById('orderModal'));
                orderModal.show();
                return;
            }
            post("payment.php", {date1: date1post, date2: date2post, totalprice: totalpricepost, roomid: roomidpost})
        }
    </script>


</body>

</html>