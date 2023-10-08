<?php
class fetchTaskDetails
{

    public function fetchTaskDetailsMainMethod($conn)
    {

        $taskId = $_POST["taskId"];
        $sql = "SELECT * FROM `tbl_task` WHERE `task_id` = {$taskId}";
        $res = mysqli_query($conn, $sql);
        $html = [];
        $response = [];
        if ($res) :
            // Query Execution Success

            while ($got = mysqli_fetch_assoc($res)) :
                $response[] = $got;
            endwhile;

            foreach ($response as $value) :
                $html[0] = '<div style="display: flex; gap: 200px;">
                            <div class="content-title">
                                <h3>Task Name</h3>
                                <p>' . $value["task_title"] . '</p>
                            </div>
                            <div class="content-title">
                                <h3>Phase</h3>
                                <p>' . $value["task_phase"] . '</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 220px;">
                            <div class="content-title">
                                <h3>Due Date</h3>
                                <p><ion-icon name="calendar-outline" style="margin-right: 5px;"></ion-icon>' . $value["task_deadline"] . '<br>
                                </p>
                            </div>
                            <div class="content-title" style="margin-left: -25px;">
                                <h3>Priority</h3>
                                <p class="priority priority-' . strtolower($value["task_priority"]) . '">' . $value["task_priority"] . '</p>
                            </div>
                        </div>
                        <div class="project-description">
                            <h3>Description</h3>
                            <div class="description-box">
                                <p>' . $value["task_description"] . '</p>
                                    <a href="' . $value["task_file"] . '" download><button type="button">Attached File</button></a>
                                </div>
                        </div>';

                $html[1] = $value["task_status"];
            endforeach;
        else :
            // Query Execution Error
            $html[0] =  "Failed";
        endif;

        return json_encode($html);
    }
}
