<?php

include_once('task.php');
include_once('fetch.php');
include_once('support.php');
include_once('meeting.php');

class teacher
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

    public function changeTecProfileMainMethod()
    {

        extract($_POST);

        $response = "Failed";

        if ($identifier == "changePassword") :

            $sql = "SELECT * FROM `tbl_user` WHERE `user_id` = '{$userID}' AND `user_password` = '{$oldPassword}'";


            if (mysqli_num_rows(mysqli_query($this->conn, $sql)) != 0) :
                $fullName = $first_name . " " . $last_name;

                $updateSql = "UPDATE `tbl_user` SET `user_role`='Teacher',`user_name`='{$fullName}',`user_faculty`='{$faculty}',`user_phone`='{$phoneNum}',`user_email`='{$email}',`user_password`='{$newPassword}'";
                $var = count($_FILES);
                if (count($_FILES) != 0) :
                    $dir =  $_SERVER["DOCUMENT_ROOT"] . '5thproject/php/images/' . $_FILES["image"]["name"][0];
                    move_uploaded_file($_FILES["image"]["tmp_name"][0], $dir);
                    $updateSql .= ",`user_pic`='images/{$_FILES["image"]["name"][0]}'";
                endif;

                $updateSql .= " WHERE `user_id` = '{$userID}'";

                if (mysqli_query($this->conn, $updateSql))
                    $response = "Success";
            endif; {
            }
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
