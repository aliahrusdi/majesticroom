<?php
// to connect to server
require "../conn.php";

// save data temporary
// all variable $_SESSION can be used
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff - Edit Room</title>
    <link rel="shortcut icon" href="../image/tablogo.png" type="image/x-icon">
    <script src="../js/jquery.js"></script>
    <link rel="stylesheet" href="../cssframework/majesticui.css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- icon link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <link rel="stylesheet" href="styles/roomdetail.css" />
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

    <br><br>
    <!-- content -->
    <div class="productcontainer">
        <section class="product">
            <div class="product__photo">
                <div class="photo-container">
                    <div class="photo-main">
                        <img id="selectroomimage" class="roomimages" src="../image/emptyimage.jpg">
                        <label for="imginput1" id="labelimg1" class="form-label" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Upload image 1">
                        <!-- image button -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                            </svg>
                        </label>
                        <label for="imginput2" id="labelimg2" class="form-label" style="display: none;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Upload image 2">
                        <!-- image button -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                            </svg>
                        </label>
                        <label for="imginput3" id="labelimg3" class="form-label" style="display: none;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Upload image 3">
                        <!-- image button -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                            </svg>
                        </label>
                        <label for="imginput4" id="labelimg4" class="form-label" style="display: none;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Upload image 4">
                        <!-- image button -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z" />
                            </svg>
                        </label>
                    </div>
                    <div class="photo-album">
                        <!-- gambar nak tekan -->
                        <ul>
                            <li><img class="roomimages" id="1" onclick="selectimage(this.id)" src="../image/emptyimage.jpg"></li>
                            <li><img class="roomimages" id="2" onclick="selectimage(this.id)" src="../image/emptyimage.jpg"></li>
                            <li><img class="roomimages" id="3" onclick="selectimage(this.id)" src="../image/emptyimage.jpg"></li>
                            <li><img class="roomimages" id="4" onclick="selectimage(this.id)" src="../image/emptyimage.jpg"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="product__info">
                <form action="addroomprocess.php" method="post" enctype="multipart/form-data">
                    <!-- tempat nak simpan image sementara -->
                    <input class="form-control form-control-sm visually-hidden" onchange="setPreviewImage(this.id, 1)" id="imginput1" name="imginput1" type="file" accept="image/*" required>
                    <input class="form-control form-control-sm visually-hidden" onchange="setPreviewImage(this.id, 2)" id="imginput2" name="imginput2" type="file" accept="image/*" required>
                    <input class="form-control form-control-sm visually-hidden" onchange="setPreviewImage(this.id, 3)" id="imginput3" name="imginput3" type="file" accept="image/*" required>
                    <input class="form-control form-control-sm visually-hidden" onchange="setPreviewImage(this.id, 4)" id="imginput4" name="imginput4" type="file" accept="image/*" required>

                    <div class="title">
                        <!-- room name -->
                        <h1><input type="text" placeholder="Room Name" name="roomname" required></h1>
                    </div>
                    <div class="price">
                        <!-- room price -->
                        RM <span><input type="text" name="roomprice" required></span>
                    </div>
                    <div class="description">
                        <h3 class="roomnametitle">ABOUT THIS ROOM</h3>
                        <ul>
                            <li>&nbsp;Details : <br>
                            <!-- room description -->
                                <input type="text" name="roomdetail" required>
                            </li>
                            <li>&nbsp;Size : <br>
                            <!-- room size -->
                                <input type="text" name="roomsize" required> sq
                            </li>
                            <li>&nbsp;Availability : <strong>
                                <!-- available or not -->
                                    <select name="roomavailable" required>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </strong></li>
                        </ul>
                    </div>
                    <button class="buy--btn" type="submit">ADD ROOM</button>
                </form>
            </div>
        </section>
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

    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

        // js untuk tukar image
        function selectimage(id) {
            var path = document.getElementById(id).src;
            document.getElementById("selectroomimage").src = path;

            document.getElementById("labelimg1").style.display = 'none';
            document.getElementById("labelimg2").style.display = 'none';
            document.getElementById("labelimg3").style.display = 'none';
            document.getElementById("labelimg4").style.display = 'none';

            document.getElementById("labelimg" + id).style.display = '';
        }

        // preview gambar yang dah pilih
        function setPreviewImage(id, selectorid) {
            const imageInput = document.getElementById(id);
            const selectedImage = document.getElementById('selectroomimage');
            const selectedSelectorImage = document.getElementById(selectorid);
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    selectedImage.src = e.target.result;
                    selectedSelectorImage.src = e.target.result;
                }
                reader.readAsDataURL(file);
            } else {
                window.location.reload();
            }
        }
    </script>
</body>

</html>