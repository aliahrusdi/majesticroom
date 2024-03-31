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
    <title>Staff - List Customer</title>
    <link rel="shortcut icon" href="../image/tablogo.png" type="image/x-icon">
    <script src="../js/jquery.js"></script>
    <link rel="stylesheet" href="../cssframework/majesticui.css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- icon link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

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
            <li><a class="userprofile" href="#"><?php echo $_SESSION['staffUserName'] ?></a></li>
        </ul>
    </div>

    <br><br><br>
    <!-- title -->
    <div class="menutitle">
        <h1>CUSTOMER LIST</h1>
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
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // run command
                $listcustresult = mysqli_query($connect, "SELECT `userID`, `userName`, `userEmail`, `userPassword` FROM `user`");

                $no = 1;
                while ($customer = mysqli_fetch_array($listcustresult)) {

                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $customer['userName'] ?></td>
                        <td><?php echo $customer['userEmail'] ?></td>
                        <td>
                            <!-- edit button -->
                            <a class="btn btn-primary btn-sm" href="editcust.php?custid=<?php echo $customer['userID'] ?>">Edit</a>
                            <!-- <a class="btn btn-secondary btn-sm" onclick="return confirm('are you sure want to delete this customer ?')" href="deletecust.php?userid=<?php echo $customer['userID'] ?>">Delete</a> -->

                            <!-- keluar modal untuk confirm -->
                            <a class="btn btn-secondary btn-sm" href="#" data-bs-toggle="modal" onclick="confirmDelete(<?php echo $customer['userID'] ?>)" data-bs-target="#deletemodal">Delete</a>
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
                <a href="https://www.tiktok.com/en/"><i class='bx bxl-tiktok'></i></a>
                <a href="https://www.instagram.com/"><i class='bx bxl-instagram-alt'></i></a>
                <a href="https://twitter.com/?lang=en"><i class='bx bxl-twitter'></i></a>
            </div>
        </div>
    </section>

    <?php
    // toast popup
    if (isset($_SESSION['popuptoast'])) {
    ?>
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="successpopup" class="toast text-bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header text-bg-secondary">
                    <img src="../image/tablogo.png" width="15px" class="rounded me-2">

                    <!-- ikut array - updatecust.php (tajuk) -->
                    <strong class="me-auto"><?php echo $_SESSION['popuptoast'][0]; ?></strong>
                    <small>Now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>

                <!-- ikut array - updateroom.php (description) -->
                <div class="toast-body">
                    <?php echo $_SESSION['popuptoast'][1]; ?>
                </div>
            </div>
        </div>

        <!-- toast - success -->
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete this customer
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a type="button" class="btn btn-danger" id="deletemodalbutton">Yes</a>
                </div>
            </div>
        </div>
    </div>

    <!-- set link in modal button -->
    <script>
        function confirmDelete(id) {
            var yesdelbtn = document.getElementById("deletemodalbutton");
            yesdelbtn.setAttribute("href", "deletecust.php?userid=" + id);
        }
    </script>
</body>

</html>