<?php

include_once('task.php');
include_once('fetch.php');
include_once('support.php');
include_once('meeting.php');

class student
{

    use fetch, support, task, meeting;
    
    private $conn;
    
    public function __construct()
    {
        // DB connection
        include_once("../assets/dbCon.php");
        $Database = new dbCon();
        $this->conn = $Database->getConnection();
    }

    public function storeAbstractMainMethod()
    {
        extract($_POST);
        $sql = "INSERT INTO `tbl_project`(`project_name`, `project_frontend`, `project_backend`, `project_sdlc`, `project_created`, `project_abstract`, `project_ppt`, `project_status`, `project_priority`) VALUES ('{$projectTitle}','{$frontendTool}','{$backendTool}','{$sdlcModel}', now(),'{$abstract}','Soon..', 'Approved', 'Medium')";
        $response = [];
        if (mysqli_query($this->conn, $sql)) :
            // Query Execution Success
            $response[0] = "Success";
            $sqlMaxProjectId = "SELECT MAX(`project_id`) AS 'maxID' FROM `tbl_project`";
            if (mysqli_query($this->conn, $sqlMaxProjectId)) :
                $response[1] = "Success";
                $res = mysqli_query($this->conn, $sqlMaxProjectId);
                $tmpProjectId = 0;
                while ($got = mysqli_fetch_assoc($res)) :
                    $tmpProjectId = $got['maxID'];
                endwhile;
                $sqlLinkUser = "INSERT INTO `tbl_ext_user`(`ext_user_id`, `ext_project_id`) VALUES ('{$myId}','{$tmpProjectId}'), ('{$firstMember}','{$tmpProjectId}'), ( '3','{$tmpProjectId}')";
                if ($_POST["secondMember"] != "0") :
                    $sqlLinkUser .= ",('{$secondMember}','{$tmpProjectId}')";
                endif;
                if (mysqli_query($this->conn, $sqlLinkUser)) :
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

    public function changeStdProfileMainMethod()
    {
        extract($_POST);

        $response = "Failed";

        if ($identifier == "changePassword") :

            $sql = "SELECT * FROM `tbl_user` WHERE `user_id` = '{$userID}' AND `user_password` = '{$oldPassword}'";


            if (mysqli_num_rows(mysqli_query($this->conn, $sql)) != 0) :
                $fullName = $first_name . " " . $last_name;

                $updateSql = "UPDATE `tbl_user` SET `user_role`='Student',`user_name`='{$fullName}',`user_faculty`='{$faculty}', `user_program_id`='{$programId}', `user_phone`='{$phoneNum}',`user_email`='{$email}',`user_password`='{$newPassword}'";
                $var = count($_FILES);
                if (count($_FILES) != 0) :
                    $dir =  $_SERVER["DOCUMENT_ROOT"] . '5thproject/php/images/' . $_FILES["image"]["name"][0];
                    move_uploaded_file($_FILES["image"]["tmp_name"][0], $dir);
                    $updateSql .= ",`user_pic`='images/{$_FILES["image"]["name"][0]}'";
                endif;

                $updateSql .= " WHERE `user_id` = '{$userID}'";

                if (mysqli_query($this->conn, $updateSql))
                    $response = "Success";
            endif;

        elseif ($identifier == "changePic") :
            $dir =  $_SERVER["DOCUMENT_ROOT"] . '5thproject/php/images/' . $_FILES["image"]["name"][0];
            move_uploaded_file($_FILES["image"]["tmp_name"][0], $dir);
            $updateSql = "UPDATE `tbl_user` SET `user_pic`='images/{$_FILES["image"]["name"][0]}' WHERE `user_id` = '{$userID}'";
            if (mysqli_query($this->conn, $updateSql))
                $response = "Success";
        endif;
        return $response;
    }
}
