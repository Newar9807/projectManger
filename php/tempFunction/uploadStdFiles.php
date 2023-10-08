<?php
include("../assets/dbCon.php");
$Database = new dbCon();
$conn = $Database->getConnection();


$taskId = $_GET["id"];
$location = $_FILES["file"]["name"][0];

$today = date("Y-m-d");

$response = "Failed";
if (count($_FILES) != 0) :
    $sql = "INSERT INTO `tbl_ext_task`(`ext_task_id`, `ext_uploaded_file`) VALUES ('{$taskId}','files/{$location}')";

    $getDeadline  = "SELECT `task_deadline`, `task_priority` FROM `tbl_task` WHERE `task_id` = '{$taskId}'";
    $storeDeadline = "";
    $storePriority = "";
    $res = mysqli_query($conn, $getDeadline);
    while ($got = mysqli_fetch_assoc($res)) :
        $storeDeadline = $got["task_deadline"];
        $storePriority = $got["task_priority"];
    endwhile;

    $updateTaskTable = "UPDATE `tbl_task` SET `task_status` = 'Completed' WHERE `task_id` = '{$taskId}' AND `task_deadline` > '{$today}'";
    mysqli_query($conn, $updateTaskTable);

    $updateTaskTable = "UPDATE `tbl_task` SET `task_status` = 'Submitted Late' WHERE `task_id` = '{$taskId}' AND `task_deadline` < '{$today}'";
    mysqli_query($conn, $updateTaskTable);

    if (mysqli_query($conn, $sql)) :
        $dir =  $_SERVER["DOCUMENT_ROOT"] . '6thproject/php/files/' . $location;
        move_uploaded_file($_FILES["file"]["tmp_name"][0], $dir);
        $response = "Success";
    endif;

else :

endif;
// if()
