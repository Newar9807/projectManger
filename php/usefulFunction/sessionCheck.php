<?php
require_once("assets/dbCon.php");
session_start();
if (!isset($_SESSION["id"])) :
    // echo "Session Not Set !!";
    header("location:../");
    return;
endif;

$userID = $_SESSION['id'];

$fetchProjectSql = "SELECT `tbl_project`.`project_id` FROM `tbl_ext_user` JOIN `tbl_project` ON `tbl_ext_user`.`ext_project_id` = `tbl_project`.`project_id` AND `tbl_ext_user`.`ext_user_id` = '{$userID}'";

$fetchQueryExection = mysqli_query($conn, $fetchProjectSql);

$projectId  = [];

if (mysqli_num_rows($fetchQueryExection) != 0) :
    while ($got = mysqli_fetch_assoc($fetchQueryExection)) :
        $projectId[] = $got["project_id"];
    endwhile;
else :
endif;
$projectId = $projectId;
