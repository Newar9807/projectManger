<?php
include("../assets/dbCon.php");
$taskId = $_POST["taskId"];
$sql = "SELECT * FROM `tbl_task` WHERE `task_id` = '{$taskId}'";
$res = mysqli_query($conn, $sql);
$html = [];
$response = [];
if ($res) :
    // Query Execution Success
    while ($got = mysqli_fetch_assoc($res)) :
        $response[] = $got;
    endwhile;

    foreach ($response as $value) :
        $html[0] = '<div class="project-data1">
                <div style="display: flex; gap: 200px;">
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
                        </div>
                </div>
            </div>
            <div class="project-upload">
            <h3 style="text-align: center;">View Files Submitted</h3>
            <div class="view-container">';

        $nextSql  = "SELECT `tbl_ext_task`.`ext_uploaded_file` FROM `tbl_task` JOIN `tbl_ext_task` ON `tbl_task`.`task_id` = `tbl_ext_task`.`ext_task_id` AND `tbl_task`.`task_id` = '{$taskId}'";

        if (mysqli_query($conn, $nextSql)) :
            $nextres = mysqli_query($conn, $nextSql);
            if (mysqli_num_rows($nextres) != 0) :
                $dir = [];
                while ($got = mysqli_fetch_assoc($nextres)) :
                    $fileName = str_replace("files/", "", $got["ext_uploaded_file"]);
                    $dir[] =  $fileName;
                endwhile;
                $dir = array_unique($dir);
                foreach($dir as $val){
                    if ($val != "") :
                        $html[0] .= '<a class="fileOpen" target="_blank" href="files/' . $val . '" rel="noopener noreferrer">
                                <div class="firstRow">
                                    ' . $val . '
                                </div>
                            </a>';
                    endif;
                }
            else :
                $html[0] .= '<div class="firstRow">Empty</div>';
            endif;
            $html[0] .= '</div></div>';
        else :
            $html[0] = "Failed";
        endif;
        // = '';

        $html[1] = $value["task_status"];
    endforeach;
else :
    // Query Execution Error
    $html[0] =  "Failed";
endif;

echo json_encode($html);
