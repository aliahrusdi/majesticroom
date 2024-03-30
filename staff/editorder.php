<?php
// to connect to server
require '../conn.php';

// save data temporary
session_start();

if (!isset($_GET['orderid'])) {
    echo "this page is accessed in error";
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff - Edit Customer</title>
    <link rel="shortcut icon" href="../image/tablogo.png" type="image/x-icon">
    <script src="../js/jquery.js"></script>
    <link rel="stylesheet" href="../cssframework/majesticui.css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/moment/moment.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="styles/menu.css" />
</head>

<body>
    <!-- header -->
    <div class="headerroom">
        <div>
            <img src="../image/roomlogo.png">
        </div>
        <ul>
            <!-- if user login -->
            <li><a href="menu.php">Menu</a></li>
            <li><a href="logout.php">Log Out</a></li>
            <li><a class="userprofile" href="profile.php"><?php echo $_SESSION['staffUserName'] ?></a></li>
        </ul>
    </div>

    <br><br><br>
    <!-- title -->
    <div class="menutitle">
        <h1>EDIT</h1>
    </div>

    <br><br>

    <!-- content -->
    <div class="container">
        <form action="updateorder.php" method="post">
            <table class="table table-striped rounded-3 overflow-hidden">
                <thead>
                    <tr class="table-secondary">
                        <th>NO.</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>ROOM NAME</th>
                        <th>CHECK IN</th>
                        <th>CHECK OUT</th>
                        <th>TOTAL PRICE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // run command
                    $listorderresult = mysqli_query($connect, "SELECT `user`.`userName`, `user`.`userEmail`, 
                    `room`.`roomName`, `room`.`roomPrice`, 
                    `orders`.`checkIn`, `orders`.`checkOut`, `orders`.`totalPrice`, `orders`.`ordersID`, `room`.`roomID` 
                    FROM `orders` 
                    INNER JOIN `user` ON `orders`.`userName` = `user`.`userName`
                    INNER JOIN `room` ON `room`.`roomID` = `orders`.`roomID` 
                    WHERE `orders`.`ordersID` = '" . $_GET['orderid'] . "'");

                    $no = 1;
                    $roomprice = 0;
                    while ($order = mysqli_fetch_array($listorderresult)) {
                        $checkindateobj = DateTime::createFromFormat('d/m/Y', $order[4]);
                        $checkoutdateobj = DateTime::createFromFormat('d/m/Y', $order[5]);
                        $roomresult = mysqli_query($connect, "SELECT `roomID`, `roomName`, `roomPrice` FROM `room`");

                    ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><input type="hidden" name="totalpriceinput" id="totalpriceinput" value="<?php echo $order[6] ?>"><input type="hidden" name="orderid" value="<?php echo $order[7] ?>"><?php echo $order[0] ?></td>
                            <td><?php echo $order[1] ?></td>
                            <td>
                                <select name="roomid" id="" onchange="setroomprice(this.value)">
                                    <?php
                                    while ($room = mysqli_fetch_array($roomresult)) {
                                    ?>
                                        <option roomprice="<?php echo $room[2] ?>" id="optionroom<?php echo $room[0] ?>" value="<?php echo $room[0] ?>" <?php if($room[0] == $order[8]){echo "selected"; $roomprice = $room[2];} ?>><?php echo $room[1] ?></option>
                                    <?php
                                    } ?>
                                </select>
                            </td>
                            <td><input type="date" onclick="editprice()" onchange="editprice()" value="<?php echo $checkindateobj->format('Y-m-d'); ?>" name="checkin" id="checkindate"></td>
                            <td><input type="date" onclick="editprice()" onchange="editprice()" value="<?php echo $checkoutdateobj->format('Y-m-d'); ?>" name="checkout" id="checkoutdate"></td>
                            <td id="pricedisplay">RM <?php echo $order[6] ?></td>
                            <td>
                                <button class="btn btn-primary btn-sm" type="submit">Update</button>
                            </td>
                        </tr>
                    <?php
                    } ?>
                </tbody>
            </table>
        </form>
    </div>

    <br><br><br><br><br><br><br>
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
        var roomprice = <?php echo $roomprice ?>;

        function editprice() {
            var date1input = document.getElementById("checkindate").value;
            var date2input = document.getElementById("checkoutdate").value;
            const date1 = new Date(date1input);
            const date2 = new Date(date2input);
            const diffTime = Math.abs(date2 - date1);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            var tax = 0.06;
            var totalprice = diffDays * roomprice;

            document.getElementById("totalpriceinput").value = ((totalprice * tax) + totalprice);
            document.getElementById("pricedisplay").innerHTML = "RM " + ((totalprice * tax) + totalprice);
        }

        function setroomprice(roomid)
        {
            var selectedoptionobject = document.getElementById("optionroom"+roomid);
            roomprice = selectedoptionobject.getAttribute("roomprice"); 
            editprice();
        }
    </script>
</body>

</html>