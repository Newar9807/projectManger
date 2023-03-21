<?php

include("../assets/dbCon.php");

$email = $_POST["email"];
$password = $_POST["password"];

$sqlFirst = "SELECT count(`user_email`) as Email FROM `tbl_user` WHERE `user_email` = '{$email}' ";

$resFirst = mysqli_query($conn, $sqlFirst);

$count = -1;

$response = [];

if ($resFirst) :
    while ($fetchFirst = mysqli_fetch_assoc($resFirst))
        $count = $fetchFirst["Email"];
else :
    $response[0] = "Error";
endif;

$sqlSecond = "SELECT `user_id`, `user_role` FROM `tbl_user` WHERE `user_email` = '{$email}' AND `user_password` = '{$password}'";

$resSecond = mysqli_query($conn, $sqlSecond);

if ($resSecond && (mysqli_num_rows($resSecond) == 1)) :
    while ($fetchSecond = mysqli_fetch_assoc($resSecond)) :
        session_start();
        $_SESSION["id"] = $fetchSecond["user_id"];
        $_SESSION["role"] = $fetchSecond["user_role"];
    endwhile;
    $response[1] = $_SESSION["id"];
    $response[2] = $_SESSION["role"];
else :
    $response[0] = "Error";
endif;

if ($count == "0") :
    $response[0] = "emailError";
elseif (!isset($_SESSION["user_id"])) :
    $response[0] = "passwordError";
else :
    $response[0] = "success";
endif;

echo json_encode($response);
