<?php

class fetchForTableProjects
{

    public function fetchForTableProjectsMainMethod($conn)
    {
        $userID = $_POST["userID"];
        // $projectID = $_POST["projectID"];

        $testFetch = "SELECT `tbl_ext_user`.`ext_project_id` FROM `tbl_ext_user` WHERE `tbl_ext_user`.`ext_user_id` = '{$userID}'";

        $resTestFetch = mysqli_query($conn, $testFetch);

        $storeTestFetch = [];

        if ($resTestFetch) :
            // Query Execution Success
            while ($got = mysqli_fetch_assoc($resTestFetch)) :
                $storeTestFetch[] = $got["ext_project_id"];
            endwhile;
        else :
            // Query Execution Error
            $storeTestFetch[] = "Failed";
        endif;

        $response  = [];
        foreach ($storeTestFetch as $key => $val) :

            $fetchProjectSql = "SELECT * FROM `tbl_ext_user` JOIN `tbl_project` ON `tbl_ext_user`.`ext_project_id` = `tbl_project`.`project_id` AND `tbl_ext_user`.`ext_project_id` = '{$val}' AND `tbl_ext_user`.`ext_user_id` != '{$userID}'";

            $fetchQueryExection = mysqli_query($conn, $fetchProjectSql);

            if (mysqli_num_rows($fetchQueryExection) != 0) :
                $count = 0;
                $tmpMembers = "";

                $id = "";
                $projectName = "";
                $projectSdlc = "";
                $projectStatus = "";
                $actualMembers = "";

                while ($got = mysqli_fetch_assoc($fetchQueryExection)) :
                    $fetchMemberName = "SELECT `user_name` FROM `tbl_user` WHERE `user_id` = '{$got["ext_user_id"]}'";
                    $resFetchMemberName = mysqli_query($conn, $fetchMemberName);
                    if ($resFetchMemberName) :
                        // Query Execution Success
                        $tmpMembers = mysqli_fetch_assoc($resFetchMemberName);
                    else :
                        // Query Execution Error
                        $tmpMembers = "Error";
                    endif;

                    if ($count == 0) :
                        $id = $got['project_id'];
                        $projectName = $got['project_name'];
                        $projectSdlc = $got['project_sdlc'];
                        $projectStatus = $got['project_status'];
                        $actualMembers = $tmpMembers['user_name'];
                    else :
                        $actualMembers .= ", " . $tmpMembers['user_name'];
                    endif;
                    $count++;
                endwhile;
                $response[$key] = [
                    'id' => $id,
                    'projectTitle' => $projectName,
                    'sdlc' => $projectSdlc,
                    'teamMembers' => $actualMembers,
                    'status' => $projectStatus,
                ];

            else :
                // Query Returns 0 Rows
                $response[] =  "Failed";
            endif;

        endforeach;

        return json_encode($response);
    }
}
