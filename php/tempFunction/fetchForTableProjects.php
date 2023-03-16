<?php

include("../assets/dbCon.php");

$userID = $_POST["userID"];
// $projectID = $_POST["projectID"];

$fetchProjectSql = "SELECT `project_id` AS 'id', `project_name` AS 'projectTitle', `project_name` AS 'teamMembers', `project_sdlc` AS 'sdlc', `project_status` AS 'status'  FROM `tbl_ext_user` JOIN `tbl_project` ON `tbl_ext_user`.`ext_project_id` = `tbl_project`.`project_id` AND `tbl_ext_user`.`ext_user_id` = '{$userID}'";

$fetchQueryExection = mysqli_query($conn, $fetchProjectSql);

$response  = [];

if (mysqli_num_rows($fetchQueryExection) != 0) :
    while ($got = mysqli_fetch_assoc($fetchQueryExection)) :
        $response[] = [
            'id' => $got['id'],
            'projectTitle' => $got['projectTitle'],
            'teamMembers' => $got['teamMembers'],
            'sdlc' => $got['sdlc'],
            'status' => $got['status'],
            'action' => "hello"
        ];
        // break;
    endwhile;
else :
    // Query Returns 0 Rows
    $response[] =  "Failed";
endif;

echo json_encode($response);
