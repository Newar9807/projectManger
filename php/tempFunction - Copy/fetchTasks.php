<?php
class fetchTasks
{

    public function fetchTasksMainMethod($conn)
    {

        $userID = $_POST["userID"];
        $sql = "SELECT * FROM `tbl_task` JOIN `tbl_project` ON `tbl_task`.`task_to_id` = `tbl_project`.`project_id` AND `tbl_task`.`task_from_id` = '{$userID}' ORDER BY `tbl_task`.`task_id` DESC";
        $res = mysqli_query($conn, $sql);
        $response = [];
        if ($res) :
            // Query Execution Success
            while ($got = mysqli_fetch_assoc($res)) :
                $response[] = [
                    'taskID' => $got['task_id'],
                    'projectName' => $got['project_name'],
                    'taskName' => $got['task_title'],
                    'duration' => $got['task_deadline'],
                    'status' => $got['task_status']
                ];
            endwhile;
        else :
            // Query Execution Error
            $response[] =  "Failed";
        endif;

        return json_encode($response);
    }
}
