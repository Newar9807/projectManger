<?php

include("../assets/dbCon.php");

$name = ucwords(strtolower($_POST["name"]));
$faculty = $_POST["faculty"];
$phone = $_POST["phone"];
$email = strtolower($_POST["email"]);
$password = ($_POST["password"]);

if (isset($_POST["program"])) :
    $program = $_POST["program"];
    $role = "Student";
    $sql = "INSERT INTO `tbl_user`(`user_role`, `user_name`, `user_faculty`, `user_phone`, `user_email`, `user_password`, `user_program`) VALUES ('{$role}','{$name}','{$faculty}','{$phone}','{$email}','{$password}','{$program}')";
else :
    $role = "Teacher";
    $sql = "INSERT INTO `tbl_user`(`user_role`, `user_name`, `user_faculty`, `user_phone`, `user_email`, `user_password`) VALUES ('{$role}','{$name}','{$faculty}','{$phone}','{$email}','{$password}')";
endif;
$res = mysqli_query($conn, $sql);
if ($res) :
    // $data = "Insertion Successfull";
    $data = $role . " SignUp Successfully";
else :
    $data = "Insertion Failed";
endif;
echo ($data);
