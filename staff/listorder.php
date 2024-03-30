<?php
// to connect to server
require '../conn.php';

// save data temporary
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff - List Order</title>
    <link rel="shortcut icon" href="../image/tablogo.png" type="image/x-icon">
    <script src="../js/jquery.js"></script>
    <link rel="stylesheet" href="../cssframework/majesticui.css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


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
        <h1>ORDER LIST</h1>
    </div>

    <br><br>

    <!-- content -->
    <div class="container">
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
                `orders`.`checkIn`, `orders`.`checkOut`, `orders`.`totalPrice`, `orders`.`ordersID` 
                FROM `orders` 
                INNER JOIN `user` ON `orders`.`userName` = `user`.`userName`
                INNER JOIN `room` ON `room`.`roomID` = `orders`.`roomID`");

                $no = 1;
                while ($order = mysqli_fetch_array($listorderresult)) {

                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $order[0] ?></td>
                        <td><?php echo $order[1] ?></td>
                        <td><?php echo $order[2] ?></td>
                        <td><?php echo $order[4] ?></td>
                        <td><?php echo $order[5] ?></td>
                        <td>RM <?php echo $order[6] ?></td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="editorder.php?orderid=<?php echo $order[7] ?>">Edit</a>
                            <!-- <a class="btn btn-secondary btn-sm" onclick="return confirm('are you sure want to delete this customer ?')" href="deleteorder.php?orderid=<?php echo $order['orderID'] ?>">Delete</a> -->
                            <a class="btn btn-secondary btn-sm" href="#" data-bs-toggle="modal" onclick="confirmDelete(<?php echo $order[7] ?>)" data-bs-target="#deletemodal">Delete</a>
                        </td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
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

    <?php
    if (isset($_SESSION['popuptoast'])) {
    ?>
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="successpopup" class="toast text-bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header text-bg-secondary">
                    <img src="../image/tablogo.png" width="15px" class="rounded me-2">
                    <strong class="me-auto"><?php echo $_SESSION['popuptoast'][0]; ?></strong>
                    <small>Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <?php echo $_SESSION['popuptoast'][1]; ?>
                </div>
            </div>
        </div>
        <script>
            const successpopup = document.getElementById('successpopup');
            const toastsuccess = bootstrap.Toast.getOrCreateInstance(successpopup);
            toastsuccess.show();
        </script>
    <?php
        unset($_SESSION['popuptoast']);
    }
    ?>

    <!-- Modal Delete -->
    <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Order</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete this customer order ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a type="button" class="btn btn-danger" id="deletemodalbutton">Yes</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            var yesdelbtn = document.getElementById("deletemodalbutton");
            yesdelbtn.setAttribute("href", "deleteorder.php?orderid=" + id);
        }
    </script>
</body>

</html>