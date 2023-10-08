<?php

class storeTasks
{

    public function storeTasksMainMethod($conn)
    {

        extract($_POST);

        $sql = "INSERT INTO `tbl_task`(`task_from_id`, `task_to_id`, `task_title`, `task_phase`, `task_description`, `task_priority`, `task_status`, `task_file`, `task_created`, `task_deadline`) VALUES ('{$fromID}','{$toID}','{$taskName}','{$sdlcPhase}','{$taskDescription}','{$taskPriority}','Pending','Soon..', now(),'{$dueDate}')";
        $res = mysqli_query($conn, $sql);
        if ($res) :
            return "Success";
        else :
            return "Failed";
        endif;
    }
}
