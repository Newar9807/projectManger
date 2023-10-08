<?php
class updateTasks{
    public function updateTasksMainMethod($conn){

        extract($_POST);
        $response = [];
        $sql = "UPDATE `tbl_task` SET `task_title`='{$taskName}',`task_phase`='{$sdlcPhase}',`task_description`='{$taskDescription}',`task_priority`='{$taskPriority}',`task_status`='Pending',`task_file`='Soon', `task_deadline`='{$dueDate}' WHERE `task_id`='{$taskID}'";
        $res = mysqli_query($conn, $sql);
        if ($res) :
            // Query Execution Success
            $response[] =  "Success";
        else :
            // Query Execution Error
            $response[] =  "Failed";
        endif;
        
        return json_encode($response);
        
    }
}
