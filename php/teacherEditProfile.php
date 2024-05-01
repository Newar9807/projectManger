<?php

include("usefulFunction/docHead.php");

$sql = "SELECT * FROM `tbl_user` WHERE `user_id` = {$userID}";
if (!mysqli_query($conn, $sql)) :
    return;
endif;
$res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
$name = explode(" ", $res["user_name"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($root . "/5thproject/php/assets/head.php"); ?>

    <link rel="stylesheet" href="../assets/css/tstyle.css" />
    <link rel="stylesheet" href="../assets/css/teacherProfile.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <style>
        .table thead,
        .table th {
            text-align: center;
            align-items: center;
        }

        #back {
            margin: 10px 0 -20px 0;
        }
    </style>
    <title>Teacher Edit Profile</title>
</head>

<body>
    <div class="container">
        <!-- Sidebar Starts -->
        <?php include($root . "/5thproject/php/assets/tecSidebar.php"); ?>
        <!-- Sidebar Ends -->
        <div class="main">
            <!-- Navigation Starts -->
            <div class="topbar"></div>
            <?php
            // include($root . "/5thproject/php/assets/tecNav.php"); 
            ?>
            <!-- Navigation Ends -->

            <!-- mid div start -->

            <div class="profile-container">
                <form action="" autocomplete="off" id="editProfile" enctype="multipart/form-data">
                    <div class="profile">
                        <h2>Profile Information</h2>
                        <div class="profileInformation">
                            <div class="row">
                                <div class="col">
                                    <p><strong>First Name</strong></p>
                                    <input type="text" name="first_name" value="<?= $name[0]; ?>">
                                </div>
                                <div class="col">
                                    <p><strong>Last Name</strong></p>
                                    <input type="text" name="last_name" value="<?= $name[1]; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p><strong>Email</strong></p>
                                    <input type="text" name="email" value="<?= $res["user_email"]; ?>">
                                </div>
                                <div class="col">
                                    <p><strong>Phone Number</strong></p>
                                    <input type="text" name="phoneNum" value="<?= $res["user_phone"]; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p><strong>Faculty</strong></p>
                                    <input type="text" name="faculty" value="<?= $res["user_faculty"]; ?>">
                                </div>
                            </div>
                        </div>
                        <h2>Change Password</h2>
                        <div class="changePassword">
                            <div class="row">
                                <div class="col">
                                    <p><strong>Current Password</strong></p>
                                    <div class="current-password-container">
                                        <input type="password" class="current-password">
                                        <i class="toggle-password fas fa-eye"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p><strong>New Password</strong></p>
                                    <div class="new-password-container">
                                        <input type="password" class="new-password">
                                        <i class="toggle-password fas fa-eye"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <p><strong>Confirm New Password</strong></p>
                                    <div class="confirm-password-container">
                                        <input type="password" class="confirm-password">
                                        <i class="toggle-password fas fa-eye"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button id="save-btn" type="submit">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="file" accept="image/jpeg, image/png image/jpg" id="image" name="image">
                    <!-----------------------------------USER INFO-------------------------------------->
                </form>
                <div class="user-info">
                    <img src="<?= $res["user_pic"]; ?>" id="profile-pic">
                    <h3 id="user-name"><?= $res["user_name"]; ?></h3>
                    <p id="user-email">&#x2709; <?= $res["user_email"]; ?></p>
                    <label for="image">Change Image</label>
                    <a href="teacherDashboard.php">
                        <button id="back" type="submit">Back</button>
                    </a>
                </div>
            </div>

            <!-- end -->

        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script> -->
    <script src="../assets/js/websiteSkeleton.js"></script>

    <script>
        $(document).ready(function() {
            $('.profileInformation input').addClass("successTrack");
            $('#editProfile').submit(function(e) {
                e.preventDefault();
                var success = $("#editProfile .successTrack").length;
                var newPassword = $('.new-password').val();
                var confirmPassword = $('.confirm-password').val();
                var image = $('#image').val();
                var data = new FormData();
                data.append("userID", <?= $userID ?>);

                if (success == 5 && (newPassword == confirmPassword) && newPassword != "") {
                    // var file_data = $('#input-file').prop('files')[0];
                    var form_data = $('#editProfile').serializeArray();

                    data.append("identifier", "changePassword");
                    data.append("oldPassword", $('.current-password').val());
                    data.append("newPassword", newPassword);

                    $.each(form_data, function(key, input) {
                        data.append(input.name, input.value);
                    })


                    if (image != "") {
                        var file_data = $('input[name="image"]')[0].files;

                        for (var i = 0; i < file_data.length; i++) {
                            data.append("image[]", file_data[i]);
                        }
                        data.append("changeTecProfile", 1);
                    }

                    $.ajax({
                        url: 'tempFunction/ajaxHandler.php', // <-- point to server-side PHP script 
                        dataType: 'text', // <-- what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: data,
                        type: 'post',
                        success: function(response) {
                            // display response from the PHP script, if any
                            if (response == "Success") {
                                swal({
                                    title: "Changes Saved",
                                    icon: "success",
                                    closeOnClickOutside: false,
                                    closeOnEsc: true,
                                    timer: 3000,
                                    dangerMode: false,
                                });
                                window.location = "teacherDashboard.php";
                            } else if (response == "Failed") {
                                swal({
                                    title: "Password Error !!",
                                    icon: "error",
                                    closeOnClickOutside: false,
                                    closeOnEsc: true,
                                    timer: 3000,
                                    dangerMode: false,
                                });
                            } else {
                                swal({
                                    title: "Something went wrong !!",
                                    icon: "error",
                                    closeOnClickOutside: false,
                                    closeOnEsc: true,
                                    timer: 3000,
                                    dangerMode: false,
                                });
                            }
                        }
                    });

                    // $.post("tempFunction/changeTecProfile.php", {data}, function(response) {

                    // });

                } else if (image != "") {
                    data.append("identifier", "changePic");
                    var file_data = $('input[name="image"]')[0].files;
                    for (var i = 0; i < file_data.length; i++) {
                        data.append("image[]", file_data[i]);
                    }
                    data.append("changeTecProfile", 1);

                    $.ajax({
                        url: 'tempFunction/ajaxHandler.php', // <-- point to server-side PHP script 
                        dataType: 'text', // <-- what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: data,
                        type: 'post',
                        success: function(response) {
                            // display response from the PHP script, if any
                            if (response == "Success") {
                                swal({
                                    title: "Picture Updated",
                                    icon: "success",
                                    closeOnClickOutside: false,
                                    closeOnEsc: true,
                                    timer: 3000,
                                    dangerMode: false,
                                });
                                window.location = "teacherDashboard.php";
                            } else if (response == "Failed") {
                                swal({
                                    title: "Picture Updation Error",
                                    icon: "error",
                                    closeOnClickOutside: false,
                                    closeOnEsc: true,
                                    timer: 3000,
                                    dangerMode: false,
                                });
                            } else {
                                swal({
                                    title: "Something went wrong !!",
                                    icon: "error",
                                    closeOnClickOutside: false,
                                    closeOnEsc: true,
                                    timer: 3000,
                                    dangerMode: false,
                                });
                            }
                        }
                    });



                } else {
                    swal({
                        title: "Please Check All Fields !!",
                        icon: "warning",
                        closeOnClickOutside: false,
                        closeOnEsc: true,
                        timer: 3000,
                        dangerMode: false,
                    });
                }
            });
        });
    </script>

    <script>
        //--------------------------------PassWord Toggle--------------------------//
        const currentPassword = document.querySelector('.current-password');
        const newPassword = document.querySelector('.new-password');
        const confirmPassword = document.querySelector('.confirm-password');
        const togglePasswordButtons = document.querySelectorAll('.toggle-password');
        togglePasswordButtons.forEach(button => {
            button.addEventListener('click', () => {
                const passwordField = button.previousElementSibling;
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                button.classList.toggle('fa-eye-slash');
            });
        });

        //---------------------------------Save---------------------------------//
        document.getElementById("save-btn").addEventListener("click", function() {
            const firstName = document.querySelector('input[name="first_name"]').value;
            const lastName = document.querySelector('input[name="last_name"]').value;
            const email = document.querySelector('input[name="email"]').value;
            document.getElementById("user-name").textContent = `${firstName} ${lastName}`;
            document.getElementById("user-email").textContent = `${email}`;
        });

        //---------------------------------Upload image-----------------------//
        let profilePic = document.getElementById("profile-pic");
        let inputFile = document.getElementById("image");
        inputFile.onchange = function() {
            profilePic.src = URL.createObjectURL(inputFile.files[0]);
        }
    </script>

</body>

</html>