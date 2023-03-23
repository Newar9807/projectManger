<?php 

$sql = "SELECT * FROM `tbl_user` WHERE `user_id` = '{$userID}'";


if(!mysqli_query($conn, $sql)):
    return;
endif;

$user = mysqli_fetch_assoc(mysqli_query($conn, $sql));

?>
<div class="topbar">
    <div class="toggle">
        <ion-icon name="menu-outline"></ion-icon>
    </div>
    <div class="noti">
        <img src="assets/icons/bell.png" alt="img" onclick="testnoti()">
        <!-- <span name="notify">7</span> -->
    </div>
    <div class="notifi-wrap" id="notifiWrap">
        <div class="notifi-box">

            <h2>Notification<span name="notification">10</span></h2>
            <hr>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Sarowar Malla</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Samir Shrestha</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Melina Rayamajhi</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Samir Shrestha</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Samir Shrestha</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Samir Shrestha</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Samir Shrestha</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Samir Shrestha</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Samir Shrestha</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Samir Shrestha</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Samir Shrestha</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Samir Shrestha</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Samir Shrestha</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Sarowar Malla</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Sarowar Malla</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>
            <div class="notifi-item">
                <img src="assets/icons/user.png" alt="img">
                <div class="text">
                    <h4 name="userName">Melina Rayamajhi</h4>
                    <p>Submitted a file.</p>
                </div>
            </div>

        </div>
    </div>

    <div class="user">
        <img src="<?= $user["user_pic"];?>" id="pro" onclick="toggleMenu()" />
    </div>
    <div class="sub-menu-wrap" id="subMenu">
        <div class="sub-menu">
            <div class="user-info">
                <img src="<?= $user["user_pic"];?>" />
                <h4><?= $user["user_name"]?></h4>
            </div>
            <hr />
            <a href="<?php if($user["user_role"] == "Student"): echo "studentEditProfile.php"; elseif($user["user_role"] == "Teacher"): echo "teacherEditProfile.php"; endif;?>" class="sub-menu-link">
                <img src="assets/icons/profile.png" />
                <p>Edit Profile</p>
                <span><ion-icon name="chevron-forward-outline"></ion-icon></span>
            </a>
            <a href="#" class="sub-menu-link">
                <img src="assets/icons/setting.png" />
                <p>Settings & Privacy</p>
                <span><ion-icon name="chevron-forward-outline"></ion-icon></span>
            </a>
            <a href="#" class="sub-menu-link">
                <img src="assets/icons/help.png" />
                <p>Help & Support</p>
                <span><ion-icon name="chevron-forward-outline"></ion-icon></span>
            </a>
            <a href="../" class="sub-menu-link">
                <img src="assets/icons/logout.png" />
                <p>Logout</p>
                <span><ion-icon name="chevron-forward-outline"></ion-icon></span>
            </a>
        </div>
    </div>
</div>