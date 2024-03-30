<?php
// to connect to server
require '../conn.php';

// save data temporary
session_start();

if(!isset($_GET['custid']))
{
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
        <form action="updatecust.php" method="post">
            <table class="table table-striped rounded-3 overflow-hidden">
                <thead>
                    <tr class="table-secondary">
                        <th>NO.</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>PASSWORD</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
        
                    // run command
                    $listcustresult = mysqli_query($connect, "SELECT `userID`, `userName`, `userEmail`, `userPassword` FROM `user` WHERE `userID` = '".$_GET['custid']."'");
        
                    $no = 1;
                    while ($customer = mysqli_fetch_array($listcustresult)) {
        
                    ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><input type="hidden" name="custid" value="<?php echo $customer['userID']  ?>"><input type="text" value="<?php echo $customer['userName'] ?>" name="custname"></td>
                            <td><input type="text" value="<?php echo $customer['userEmail'] ?>" name="custemail"></td>
                            <td><input type="text" value="<?php echo $customer['userPassword'] ?>" name="custpassword"></td>
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
</body>

</html>