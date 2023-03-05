<?php
// This will be set while login process
$_SESSION["user"] = "Student";
$_SESSION["userId"] = 6;

$userId = $_SESSION["userId"];

include("../assets/dbCon.php");
// $conn = mysqli_connect('localhost', 'root', '', 'pms') or die("Error in database connection");

if ($_SESSION["user"] = "Student") :
    // If meeting is requested by student
    // $stdSql = "SELECT `user_project_id` as 'PID' FROM `tbl_user` WHERE `user_id` = {$userId}";
    $stdSql = "SELECT `tbl_ext_user`.`ext_project_id` as 'PID' FROM `tbl_user` JOIN `tbl_ext_user` ON `tbl_user`.`user_id` = `tbl_ext_user`.`ext_user_id` AND `tbl_ext_user`.`ext_user_id` = '{$userId}' AND `tbl_user`.`user_role` = 'Student'";
    $stdRes = mysqli_query($conn, $stdSql);
    if (mysqli_num_rows($stdRes) == 1) :
        $stdRes = mysqli_fetch_assoc($stdRes);
    else :
    // Error in Query Execution or More than 1 rows are fetched
    endif;
    $fromID = $stdRes["PID"];

    // $tecSql = "SELECT `user_id` as 'tecID' FROM `tbl_user` WHERE `user_project_id` = '{$fromID}' AND `user_role` = 'Teacher'";
    $tecSql = "SELECT `tbl_ext_user`.`ext_user_id` as 'tecID' FROM `tbl_user`  JOIN `tbl_ext_user` ON `tbl_user`.`user_id` = `tbl_ext_user`.`ext_user_id` AND `tbl_ext_user`.`ext_project_id` = '{$fromID}' AND `tbl_user`.`user_role` = 'Teacher'";
    $tecRes = mysqli_query($conn, $tecSql);
    if (mysqli_num_rows($tecRes) == 1) :
        $tecRes = mysqli_fetch_assoc($tecRes);
    else :
    // Error in Query Execution or More than 1 rows are fetched
    endif;
    $toID = $tecRes["tecID"];
elseif ($_SESSION["user"] = "Teacher") :
// If meeting is requested by teacher
endif;

// Events Table Work
$events_description = $_POST["description"];
$events_date = $_POST["date"];

$sql = "INSERT INTO `tbl_events`(`events_from_id`, `events_to_id`, `events_description`, `events_date`, `events_status`) VALUES ('{$fromID}', '{$toID}', '{$events_description}', '{$events_date}', 'Meeting Requested')";

$res = mysqli_query($conn, $sql);

if ($res) :
    $_SESSION["comment"] = "Request Sent..";
    echo "Request Sent..";
else :
    // Query Execution Error
    $_SESSION["comment"] = "Query Execution Sent..";
    echo "Query Execution Error..";
endif;
