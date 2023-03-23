<?php
include("../assets/dbCon.php");

if (isset($_POST["id"])) :
    $ID = $_POST['id'];
    $sql = "SELECT `task_status` FROM `tbl_task` WHERE `task_from_id` = '{$ID}'";
elseif (isset($_POST["projectId"])) :
    $ID = $_POST['projectId'];
    $sql = "SELECT `task_status` FROM `tbl_task` WHERE `task_to_id` = '{$ID}'";
endif;

$response = [];
if (mysqli_query($conn, $sql)) :
    // Query Execution Success
    $response[0] = "Success";
    $pending = 0;
    $completed = 0;
    $lateSubmission = 0;
    $res = mysqli_query($conn, $sql);
    while ($got = mysqli_fetch_assoc($res)) :
        if ($got['task_status'] == "Pending") :
            $pending++;
        elseif ($got['task_status'] == "Completed") :
            $completed++;
        elseif($got['task_status'] == "Submitted Late"):
            $lateSubmission++;
        endif;
    endwhile;
    $response[1] = [
        "pending" => $pending,
        "completed" => $completed,
        "lateSubmitted" => $lateSubmission,
    ];
else :
    // Query Execution Error
    $response[0] = "Failed";
endif;

echo json_encode($response);
