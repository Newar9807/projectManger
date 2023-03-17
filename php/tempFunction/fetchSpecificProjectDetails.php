<?php
include("../assets/dbCon.php");

$projectID = $_POST["projectID"];

$fetchProjectSql = "SELECT * FROM `tbl_project` WHERE `project_id` = '{$projectID}'";

$fetchQueryExection = mysqli_query($conn, $fetchProjectSql);

$response  = [];

if (mysqli_num_rows($fetchQueryExection) != 0) :
    // Query Execution Success
    $response[] = "Success";
    while ($got = mysqli_fetch_assoc($fetchQueryExection)) :
        $response[] = $got;
    endwhile;
    $fetchMembers = "SELECT * FROM `tbl_ext_user` JOIN `tbl_user` ON `tbl_user`.`user_id` = `tbl_ext_user`.`ext_user_id` AND `tbl_user`.`user_role` = 'Student' AND `tbl_ext_user`.`ext_project_id` = '{$projectID}'";
    $membersFetchQueryExecution = mysqli_query($conn, $fetchMembers);
    if ($membersFetchQueryExecution) :
        // Query Execution Success
        while ($got = mysqli_fetch_assoc($membersFetchQueryExecution)) :
            $response[2][] = $got;
        endwhile;
    else :
        // Query Execution Error
        $response[0] = "Failed";
    endif;
else :
    // Query Execution Error
    $response[] = "Failed";
endif;
echo json_encode($response);
