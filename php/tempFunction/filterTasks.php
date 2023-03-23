<?php

include("../assets/dbCon.php");

$get = $_POST["response"][1];

$sdlc = $get["project_sdlc"];
$projectId = $get["project_id"];

$prototype = ['Requirement Analysis', 'Quick Design', 'Building ProtoType', 'Customer Evaluation', 'Update', 'Development', 'Testing', 'Maintain'];
$waterfall = ['Requirement Analysis', 'System Design', 'Implementation', 'Testing', 'Deployment', 'Maintenance'];

$allModel = [
    'ProtoType' => $prototype,
    'WaterFall' => $waterfall,
];

$response  = [];

$test = "";

foreach ($allModel as $key => $value) :

        if ($key == $sdlc) :

            $n = 0;
            foreach ($value as $actualValue) :

                
                $fetchTaskSql = "SELECT * FROM `tbl_task` JOIN `tbl_project` ON `tbl_task`.`task_to_id` = `tbl_project`.`project_id` AND `tbl_project`.`project_sdlc` = '{$sdlc}' AND `tbl_task`.`task_to_id` = '{$projectId}' AND `tbl_task`.`task_phase` = '{$actualValue}'";
                
                $fetchTakResult = mysqli_query($conn, $fetchTaskSql);
                $test .= '<section class="content">
            <div class="phases">
                <h4 class="phase-header';

                if (mysqli_num_rows($fetchTakResult) != 0) :
                    $test .= ' notification"><button class="toggle-btn" id="expandPhase' . ++$n.'">+</button>' . $actualValue . '</h4></div><div class="TableArea" id="table-area7">
                    <table>
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Due Date</th>
                            </tr>
                        </thead>
                        <tbody>';
                    while ($got = mysqli_fetch_assoc($fetchTakResult)) :
                        $response[] = $got;
                    endwhile;
                        foreach ($response as $storeVal) :
                            # code...
                            $taskPhase = $storeVal["task_phase"];
                            if($actualValue == $taskPhase):
                                $taskTitle = $storeVal["task_title"];
                                $taskPriority = $storeVal["task_priority"];
                                $taskStatus = $storeVal["task_status"];
                                $taskDeadline = $storeVal["task_deadline"];
                                $taskId = $storeVal["task_id"];
                                $test .='
                                <tr data-id="'.$taskId.'">
                                    <td>'.$taskTitle.'</td>
                                    <td class="'.strtolower($taskPriority).'">'.$taskPriority.'</td>
                                    <td class="status-'.strtolower($taskStatus).'">'.$taskStatus.'</td>
                                    <td>'.$taskDeadline.'</td>
                                </tr>';
                            endif;
                        endforeach;

                        $test.='
                                </tbody>
                            </table>
                        </div></section>';
                else :
                    $test .= '"><button class="toggle-btn" id="expandPhase' . ++$n.'">+</button>' . $actualValue . '</h4></div></section>';
                endif;

            endforeach;

        endif;

endforeach;

echo ($test);
