<?php

class storeAbstract
{

    public function storeAbstractMainMethod($conn)
    {
        extract($_POST);
        $sql = "INSERT INTO `tbl_project`(`project_name`, `project_frontend`, `project_backend`, `project_sdlc`, `project_created`, `project_abstract`, `project_ppt`, `project_status`, `project_priority`) VALUES ('{$projectTitle}','{$frontendTool}','{$backendTool}','{$sdlcModel}', now(),'{$abstract}','Soon..', 'Approved', 'Medium')";
        $response = [];
        if (mysqli_query($conn, $sql)) :
            // Query Execution Success
            $response[0] = "Success";
            $sqlMaxProjectId = "SELECT MAX(`project_id`) AS 'maxID' FROM `tbl_project`";
            if (mysqli_query($conn, $sqlMaxProjectId)) :
                $response[1] = "Success";
                $res = mysqli_query($conn, $sqlMaxProjectId);
                $tmpProjectId = 0;
                while ($got = mysqli_fetch_assoc($res)) :
                    $tmpProjectId = $got['maxID'];
                endwhile;
                $sqlLinkUser = "INSERT INTO `tbl_ext_user`(`ext_user_id`, `ext_project_id`) VALUES ('{$myId}','{$tmpProjectId}'), ('{$firstMember}','{$tmpProjectId}'), ( '3','{$tmpProjectId}')";
                if ($_POST["secondMember"] != "0") :
                    $sqlLinkUser .= ",('{$secondMember}','{$tmpProjectId}')";
                endif;
                if (mysqli_query($conn, $sqlLinkUser)) :
                    $response[2] = "Success";
                else :
                    $response[2] = "Failed";
                endif;
            else :
                $response[1] = "Failed";
            endif;


        else :
            // Query Execution Error
            $response[0] = "Failed";
        endif;
        return json_encode($response);
    }
}
