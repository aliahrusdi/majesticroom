<?php
// to connect to server
require 'conn.php';

// save data temporary
session_start();

// requirement for login
if (
    isset($_POST['username']) &&
    isset($_POST['password'])
) {
    try {

        // run the command
        $result = mysqli_query($connect, "SELECT `userID`, `userName`, `userEmail`, `userPassword` 
        FROM `user` WHERE `userName` = '".$_POST['username']."' AND `userPassword` = '".$_POST['password']."'");
        if(mysqli_num_rows($result) == 1){

            // if success - name will display at header
            $_SESSION['userName'] = $_POST['username'];

            // go to listroom page
            header('location: listrooms.php');
        }else{

            // if not - error
            header('location: login.php?error');
        }
    } catch (Exception $e) {
        header('location: login.php?error');
    }
    //SAMA DENGAN location.href='login.php?success';
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="image/tablogo.png" type="image/x-icon">
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="styles/login.css" />
</head>

<body>
    <div class="containerlogin signinForm">
        <form action="" method="post">
            <div class="form signin">
    
                <!-- title -->
                <h2>LOGIN</h2>
    
                <!-- username -->
                <div class="inputBox">
                    <input type="text" name="username" required="required" />
                    <i class="fa-regular fa-user"></i>
                    <span>username</span>
                </div>
    
                <!-- password -->
                <div class="inputBox">
                    <input type="password" name="password" required="required" />
                    <i class="fa-solid fa-lock"></i>
                    <span>password</span>
                </div>
    
                <!-- login -->
                <div class="inputBox">
                    <!-- login -> list rooms -->
                    <input type="submit" value="login" />
                </div>
    
                <!-- not register yet -->
                <p>Not Registered ? <a href="signup.php" class="create">Create an account</a></p>
            </div>
        </form>
    </div>

    <!-- Modal Success Signup -->
    <div class="modal fade" id="successsignupmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Successfully Sign up</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    You are success to signup. Please log in
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Login Error -->
    <div class="modal fade" id="loginerrormodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Login Error</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Error in login. Please try again
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_GET['success'])) {

    ?>

    <!-- js for sign up succes -->
        <script>
            const successsignupmodal = new bootstrap.Modal(document.getElementById('successsignupmodal'));
            successsignupmodal.show();
        </script>
    <?php
    }
    ?>
    <?php
    if (isset($_GET['error'])) {

    ?>

    <!-- js for sign up error -->
        <script>
            const loginerrormodal = new bootstrap.Modal(document.getElementById('loginerrormodal'));
            loginerrormodal.show();
        </script>
    <?php
    }
    ?>
</body>

</html>