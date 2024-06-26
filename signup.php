<?php
// to connect to server
require 'conn.php';

// requirement in signing up
if (
    isset($_POST['username']) &&
    isset($_POST['emailaddress']) &&
    isset($_POST['password']) &&
    isset($_POST['confirmpassword'])
) {
    try {

        // run the command
        $result = mysqli_query($connect, "INSERT INTO `user`(`userID`, `userName`, `userEmail`, `userPassword`) 
        VALUES (NULL,'" . $_POST['username'] . "','" . $_POST['emailaddress'] . "','" . $_POST['password'] . "')");

        // url display - success
        header('location: login.php?success');
    } catch (Exception $e) {

        // url display - error
        header('location: signup.php?error&errmsg=' . mysqli_error($connect));
    }
    //SAMA DENGAN location.href='login.php?success';
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="shortcut icon" href="image/tablogo.png" type="image/x-icon">
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="cssframework/majesticui.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="styles/signup.css" />
</head>

<body>
    <div class="containersignup">
        <form action="" method="post" onsubmit="return checksamepass()">
            <div class="form signup">

                <!-- title -->
                <h2>SIGN UP</h2>

                <!-- username -->
                <div class="inputBox">
                    <input type="text" name="username" required="required" />
                    <i class="fa-regular fa-user"></i>
                    <span>username</span>
                </div>

                <!-- email address -->
                <div class="inputBox">
                    <input type="text" name="emailaddress" required="required" />
                    <i class="fa-regular fa-envelope"></i>
                    <span>email address</span>
                </div>

                <!-- create password -->
                <div class="inputBox">
                    <input type="password" name="password" id="password" required="required" />
                    <i class="fa-solid fa-lock"></i>
                    <span>create password</span>
                </div>

                <!-- confirm password -->
                <div class="inputBox">
                    <input type="password" name="confirmpassword" id="confirmpassword" required="required" />
                    <i class="fa-solid fa-lock"></i>
                    <span>confirm password</span>
                </div>

                <!-- create account -->
                <div class="inputBox">
                    <!-- submit -> login -->
                    <input type="submit" value="create account" />
                </div>

                <!-- member -->
                <p>Already a member ? <a href="login.php" class="login">Log in</a></p>
            </div>
        </form>
    </div>

    <!-- Modal Error -->
    <div class="modal fade" id="signuperrormodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Sign Up error</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <!-- error message -->
                    Error to Sign Up: <?php if(isset($_GET['errmsg']))
                    {
                        echo $_GET['errmsg'];
                    } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Password Not Same -->
    <div class="modal fade" id="passworderror" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Invalid Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Please enter the same password
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- js for botstrap -->
    <?php
    if (isset($_GET['error'])) {

    ?>

    <!-- js for error message -->
        <script>
            const modalerror = new bootstrap.Modal(document.getElementById('signuperrormodal'));
            modalerror.show();
        </script>
    <?php
    }
    ?>

    <!-- js for not same password -->
    <script>
        function checksamepass() {
            var password = document.getElementById('password').value;
            var comfirmpassword = document.getElementById('confirmpassword').value;

            if(password == comfirmpassword)
            {
                return true;
            }
            else 
            {
                const passworderror = new bootstrap.Modal(document.getElementById('passworderror'));
                passworderror.show();
                return false;
            }
        }
    </script>
</body>

</html>