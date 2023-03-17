<?php

include("../assets/dbCon.php");
$samir = 1;
$userID = $_POST['id'];
$sql = "SELECT `task_status` FROM `tbl_task` WHERE `task_from_id` = '{$userID}'";
$response = [];
if (mysqli_query($conn, $sql)) :
    // Query Execution Success
    $response[0] = "Success";
    $pending = 0;
    $completed = 0;
    $res = mysqli_query($conn, $sql);
    while ($got = mysqli_fetch_assoc($res)) :
        if ($got['task_status'] == "Pending") :
            $pending++;
        elseif ($got['task_status'] == "Completed") :
            $completed++;
        endif;
    endwhile;
    $response[1] = [
        "pending" => $pending,
        "completed" => $completed,
    ];
else :
    // Query Execution Error
    $response[0] = "Failed";
endif;

echo json_encode($response);
