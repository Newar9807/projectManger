<?php

include("../assets/dbCon.php");

$userID = $_POST["userID"];
$projectID = $_POST["projectID"];

$fetchProjectSql = "SELECT `tbl_project`.`project_sdlc`, `tbl_project`.`project_name`, `tbl_project`.`project_id` FROM `tbl_ext_user` JOIN `tbl_project` ON `tbl_ext_user`.`ext_project_id` = `tbl_project`.`project_id` AND `tbl_ext_user`.`ext_user_id` = '{$userID}'";

$fetchQueryExection = mysqli_query($conn, $fetchProjectSql);

$response  = [];

if (mysqli_num_rows($fetchQueryExection) != 0) :
    while ($got = mysqli_fetch_assoc($fetchQueryExection)) :
        $response[$got["project_id"]] = [$got["project_sdlc"], $got["project_name"]];
    endwhile;
else :
endif;
echo json_encode($response);
