<?php

include("../assets/dbCon.php");

$email = $_POST["email"];
$password = $_POST["password"];

$sqlFirst = "SELECT count(`user_email`) as Email FROM `tbl_user` WHERE `user_email` = '{$email}' ";

$resFirst = mysqli_query($conn, $sqlFirst);

$count = -1;

if ($resFirst) :
    while ($fetchFirst = mysqli_fetch_assoc($resFirst))
        $count = $fetchFirst["Email"];
else :
    echo "Error";
endif;

$sqlSecond = "SELECT `user_id` FROM `tbl_user` WHERE `user_email` = '{$email}' AND `user_password` = '{$password}'";

$resSecond = mysqli_query($conn, $sqlSecond);

if ($resSecond) :
    while ($fetchSecond = mysqli_fetch_assoc($resSecond)) :
        session_start();
        $_SESSION["user_id"] = $fetchSecond["user_id"];
    endwhile;
else :
    echo "Error";
endif;

if ($count == "0") :
    echo "emailError";
elseif (!isset($_SESSION["user_id"])) :
    echo "passwordError";
else :
    echo "success";
endif;
