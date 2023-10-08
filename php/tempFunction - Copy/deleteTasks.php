<?php
class deleteTasks
{
    public function deleteTasksMainMethod($conn)
    {

        $taskID = $_POST["taskID"];
        $sql = "DELETE FROM `tbl_task` WHERE `task_id` = {$taskID}";
        $res = mysqli_query($conn, $sql);
        $response = "";
        if ($res) {
            $response = "Success";
        } else {
            $response = "Failed";
        }
        return json_encode($response);
    }
}
