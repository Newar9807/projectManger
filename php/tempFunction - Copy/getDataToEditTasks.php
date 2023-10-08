<?php
class getDataToEditTasks
{

    public function getDataToEditTasksMainMethod($conn)
    {

        $taskID = $_POST["taskID"];
        $sql = "SELECT * FROM `tbl_task` JOIN `tbl_project` ON `tbl_task`.`task_to_id` = `tbl_project`.`project_id` AND `tbl_task`.`task_id` = '{$taskID}' ORDER BY `tbl_task`.`task_id` DESC";
        $res = mysqli_query($conn, $sql);
        $response = [];
        if ($res) :
            // Query Execution Success
            while ($got = mysqli_fetch_assoc($res)) :
                $response = [
                    $got['task_id'] => $got['task_title'],
                    $got['project_id'] => $got['project_name'],
                    'sdlc' => $got['project_sdlc'],
                    'phase' => $got['task_phase'],
                    'dueDate' => $got['task_deadline'],
                    'priority' => $got['task_priority'],
                    'description' => $got['task_description'],
                    'status' => $got['task_status'],
                ];
            endwhile;
        else :
            // Query Execution Error
            $response[] =  "Failed";
        endif;

        return json_encode($response);
    }
}
