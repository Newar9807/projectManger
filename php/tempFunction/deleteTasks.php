<?php
include("../assets/dbCon.php");
$taskID = $_POST["taskID"];
$sql = "DELETE FROM `tbl_task` WHERE `task_id` = {$taskID}";
$res = mysqli_query($conn, $sql);
$response = "";
if ($res) {
    $response = "Success";
} else {
    $response = "Failed";
}
echo json_encode($response);
