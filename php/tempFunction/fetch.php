<?php

trait fetch
{

    public function fetchFacultyMainMethod()
    {

        $sql = "SELECT `faculty_id`,`faculty_name` FROM `tbl_faculty`";
        $res = mysqli_query($this->conn, $sql);
        $fetchFaculties = [];
        if ($res) :
            while ($got = mysqli_fetch_assoc($res)) :
                $fetchFaculties[$got["faculty_id"]] = $got["faculty_name"];
            endwhile;
            return json_encode($fetchFaculties);
        else :

        endif;
    }

    public function fetchProgramMainMethod()
    {

        $facultyId = $_POST["facultyId"];
        $sql = "SELECT `program_name`, `program_id` FROM `tbl_program` WHERE `program_faculty_id` = '{$facultyId}'";
        $res = mysqli_query($this->conn, $sql);
        $fetchPrograms = [];
        if ($res) :
            while ($got = mysqli_fetch_assoc($res)) :
                $fetchPrograms[$got["program_id"]] = $got["program_name"];
            endwhile;
            return json_encode($fetchPrograms);
        else :

        endif;
    }

    public function fetchTasksMainMethod()
    {

        $userID = $_POST["userID"];
        $sql = "SELECT * FROM `tbl_task` JOIN `tbl_project` ON `tbl_task`.`task_to_id` = `tbl_project`.`project_id` AND `tbl_task`.`task_from_id` = '{$userID}' ORDER BY `tbl_task`.`task_id` DESC";
        $res = mysqli_query($this->conn, $sql);
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

    public function fetchProjectsMainMethod()
    {

        $userID = $_POST["userID"];
        // $projectID = $_POST["projectID"];

        $fetchProjectSql = "SELECT `tbl_project`.`project_sdlc`, `tbl_project`.`project_name`, `tbl_project`.`project_id` FROM `tbl_ext_user` JOIN `tbl_project` ON `tbl_ext_user`.`ext_project_id` = `tbl_project`.`project_id` AND `tbl_ext_user`.`ext_user_id` = '{$userID}'";

        $fetchQueryExection = mysqli_query($this->conn, $fetchProjectSql);

        $response  = [];

        if (mysqli_num_rows($fetchQueryExection) != 0) :
            while ($got = mysqli_fetch_assoc($fetchQueryExection)) :
                $response[$got["project_id"]] = [$got["project_sdlc"], $got["project_name"]];
            endwhile;
        else :
            $response[] = "Failed";
        endif;
        return json_encode($response);
    }

    public function fetchSpecificProjectDetailsMainMethod()
    {

        $projectID = $_POST["projectID"];

        $fetchProjectSql = "SELECT * FROM `tbl_project` WHERE `project_id` = '{$projectID}'";

        $fetchQueryExection = mysqli_query($this->conn, $fetchProjectSql);

        $response  = [];

        if (mysqli_num_rows($fetchQueryExection) != 0) :
            // Query Execution Success
            $response[0] = "Success";
            while ($got = mysqli_fetch_assoc($fetchQueryExection)) :
                $response[1] = $got;
            endwhile;
            $fetchMembers = "SELECT * FROM `tbl_ext_user` JOIN `tbl_user` ON `tbl_user`.`user_id` = `tbl_ext_user`.`ext_user_id` AND `tbl_user`.`user_role` = 'Student' AND `tbl_ext_user`.`ext_project_id` = '{$projectID}'";
            $membersFetchQueryExecution = mysqli_query($this->conn, $fetchMembers);
            if ($membersFetchQueryExecution) :
                // Query Execution Success
                while ($got = mysqli_fetch_assoc($membersFetchQueryExecution)) :
                    $response[2][] = $got;
                endwhile;
            else :
                // Query Execution Error
                $response[0] = "Failed";
            endif;
        else :
            // Query Execution Error
            $response[0] = "Failed";
        endif;
        return json_encode($response);
    }

    public function fetchTaskDetailsMainMethod()
    {

        $taskId = $_POST["taskId"];
        $sql = "SELECT * FROM `tbl_task` WHERE `task_id` = {$taskId}";
        $res = mysqli_query($this->conn, $sql);
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



    public function fetchTaskPointsMainMethod()
    {

        $projectID = $_POST["projectID"];

        $fetchTaskPointsSql = "SELECT * FROM `tbl_task` WHERE `task_to_id` = '{$projectID}'";

        $fetchQueryExection = mysqli_query($this->conn, $fetchTaskPointsSql);

        $response  = [];
        $marks = [];

        if (mysqli_num_rows($fetchQueryExection) != 0) :
            $pattern = "/-/";
            $month = [];
            // while ($got = mysqli_fetch_assoc($fetchQueryExection)) :

            // endwhile;
            while ($got = mysqli_fetch_assoc($fetchQueryExection)) :

                $task_priority = $got["task_priority"];
                $points = 0;
                if ($got["task_status"] == "Completed") :
                    if ($task_priority == "High") :
                        $points = 100;
                    elseif ($task_priority == "Medium") :
                        $points = 75;
                    elseif ($task_priority == "Low") :
                        $points = 50;
                    endif;

                elseif ($got["task_status"] == "Submitted Late") :
                    if ($task_priority == "High") :
                        $points = 75;
                    elseif ($task_priority == "Medium") :
                        $points = 50;
                    elseif ($task_priority == "Low") :
                        $points = 25;
                    endif;

                endif;
                $date = $got["task_submitted"];
                $components = preg_split($pattern, $date, -1, PREG_SPLIT_OFFSET_CAPTURE);
                // $month[] = [$components[1][0] => $points];
                // $month += [$components[1][0] => $points];
                $month[$components[1][0]] += $points;
            endwhile;

        else :
            $month = ["03" => 0];
        // $month = json_decode($month);
        endif;

        ksort($month);

        return json_encode($month);
    }

    public function fetchForTableProjectsMainMethod()
    {
        $userID = $_POST["userID"];
        // $projectID = $_POST["projectID"];

        $testFetch = "SELECT `tbl_ext_user`.`ext_project_id` FROM `tbl_ext_user` WHERE `tbl_ext_user`.`ext_user_id` = '{$userID}'";

        $resTestFetch = mysqli_query($this->conn, $testFetch);

        $storeTestFetch = [];

        if ($resTestFetch) :
            // Query Execution Success
            while ($got = mysqli_fetch_assoc($resTestFetch)) :
                $storeTestFetch[] = $got["ext_project_id"];
            endwhile;
        else :
            // Query Execution Error
            $storeTestFetch[] = "Failed";
        endif;

        $response  = [];
        foreach ($storeTestFetch as $key => $val) :

            $fetchProjectSql = "SELECT * FROM `tbl_ext_user` JOIN `tbl_project` ON `tbl_ext_user`.`ext_project_id` = `tbl_project`.`project_id` AND `tbl_ext_user`.`ext_project_id` = '{$val}' AND `tbl_ext_user`.`ext_user_id` != '{$userID}'";

            $fetchQueryExection = mysqli_query($this->conn, $fetchProjectSql);

            if (mysqli_num_rows($fetchQueryExection) != 0) :
                $count = 0;
                $tmpMembers = "";

                $id = "";
                $projectName = "";
                $projectSdlc = "";
                $projectStatus = "";
                $actualMembers = "";

                while ($got = mysqli_fetch_assoc($fetchQueryExection)) :
                    $fetchMemberName = "SELECT `user_name` FROM `tbl_user` WHERE `user_id` = '{$got["ext_user_id"]}'";
                    $resFetchMemberName = mysqli_query($this->conn, $fetchMemberName);
                    if ($resFetchMemberName) :
                        // Query Execution Success
                        $tmpMembers = mysqli_fetch_assoc($resFetchMemberName);
                    else :
                        // Query Execution Error
                        $tmpMembers = "Error";
                    endif;

                    if ($count == 0) :
                        $id = $got['project_id'];
                        $projectName = $got['project_name'];
                        $projectSdlc = $got['project_sdlc'];
                        $projectStatus = $got['project_status'];
                        $actualMembers = $tmpMembers['user_name'];
                    else :
                        $actualMembers .= ", " . $tmpMembers['user_name'];
                    endif;
                    $count++;
                endwhile;
                $response[$key] = [
                    'id' => $id,
                    'projectTitle' => $projectName,
                    'sdlc' => $projectSdlc,
                    'teamMembers' => $actualMembers,
                    'status' => $projectStatus,
                ];

            else :
                // Query Returns 0 Rows
                $response[] =  "Failed";
            endif;

        endforeach;

        return json_encode($response);
    }

    public function fetchFriendsMainMethod()
    {

        $userId = $_POST["myId"];
        $sql = "SELECT `user_id`, `user_name` FROM `tbl_user` WHERE `user_id` != '{$userId}' ";
        if (isset($_POST["firstMemberId"])) :
            $firstMemberId = $_POST["firstMemberId"];
            $sql .= "AND `user_id` != '{$firstMemberId}' ";
        endif;
        $sql .= "AND `user_program_id` = (SELECT `user_program_id` FROM `tbl_user` WHERE `user_id` = '{$userId}')";

        $sqlFilterUsers = "SELECT `tbl_ext_user`.`ext_user_id` FROM `tbl_ext_user` JOIN `tbl_user` ON `tbl_user`.`user_id` = `tbl_ext_user`.`ext_user_id` AND `tbl_user`.`user_program_id` = (SELECT `user_program_id` FROM `tbl_user` WHERE `user_id` = '{$userId}' AND `user_role` = 'Student')";

        if (mysqli_query($this->conn, $sqlFilterUsers)) :
            $res = mysqli_query($this->conn, $sqlFilterUsers);
            while ($got = mysqli_fetch_assoc($res)) :
                $assignedUsers = $got["ext_user_id"];
                $sql .= " AND `user_id` != '{$assignedUsers}'";
            endwhile;
        endif;

        $response = [];
        if (mysqli_query($this->conn, $sql)) :
            $response[0] = "Success";
            $res = mysqli_query($this->conn, $sql);
            while ($got = mysqli_fetch_assoc($res)) :
                $response[1][$got["user_id"]] = $got["user_name"];
            endwhile;
        else :
            $response[0] = "Failed";
        endif;

        return json_encode($response);
    }

    public function fetchMyTasksStatusMainMethod()
    {

        if (isset($_POST["id"])) :
            $ID = $_POST['id'];
            $sql = "SELECT `task_status` FROM `tbl_task` WHERE `task_from_id` = '{$ID}'";
        elseif (isset($_POST["projectId"])) :
            $ID = $_POST['projectId'];
            $sql = "SELECT `task_status` FROM `tbl_task` WHERE `task_to_id` = '{$ID}'";
        endif;

        $response = [];
        if (mysqli_query($this->conn, $sql)) :
            // Query Execution Success
            $response[0] = "Success";
            $pending = 0;
            $completed = 0;
            $lateSubmission = 0;
            $res = mysqli_query($this->conn, $sql);
            while ($got = mysqli_fetch_assoc($res)) :
                if ($got['task_status'] == "Pending") :
                    $pending++;
                elseif ($got['task_status'] == "Completed") :
                    $completed++;
                elseif ($got['task_status'] == "Submitted Late") :
                    $lateSubmission++;
                endif;
            endwhile;
            $response[1] = [
                "pending" => $pending,
                "completed" => $completed,
                "lateSubmitted" => $lateSubmission,
            ];
        else :
            // Query Execution Error
            $response[0] = "Failed";
        endif;
        return json_encode($response);
    }

    public function fetchTaskDetailsTecMainMethod()
    {

        $taskId = $_POST["taskId"];
        $sql = "SELECT * FROM `tbl_task` WHERE `task_id` = '{$taskId}'";
        $res = mysqli_query($this->conn, $sql);
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

                if (mysqli_query($this->conn, $nextSql)) :
                    $nextres = mysqli_query($this->conn, $nextSql);
                    if (mysqli_num_rows($nextres) != 0) :
                        $dir = [];
                        while ($got = mysqli_fetch_assoc($nextres)) :
                            $fileName = str_replace("files/", "", $got["ext_uploaded_file"]);
                            $dir[] =  $fileName;
                        endwhile;
                        $dir = array_unique($dir);
                        foreach ($dir as $val) {
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

        return json_encode($html);
    }

    public function fetchTaskPointsForTecMainMethod()
    {

        $projectId = $_POST["projectID"];

        $marks = [];
        foreach ($projectId as $projectID) :

            $fetchTaskPointsSql = "SELECT * FROM `tbl_task` WHERE `task_to_id` = '{$projectID}'";

            $fetchQueryExection = mysqli_query($this->conn, $fetchTaskPointsSql);

            if (mysqli_num_rows($fetchQueryExection) != 0) :
                $pattern = "/-/";
                $month = [];
                while ($got = mysqli_fetch_assoc($fetchQueryExection)) :

                    $task_priority = $got["task_priority"];
                    $points = 0;
                    if ($got["task_status"] == "Completed") :
                        if ($task_priority == "High") :
                            $points = 100;
                        elseif ($task_priority == "Medium") :
                            $points = 75;
                        elseif ($task_priority == "Low") :
                            $points = 50;
                        endif;

                    elseif ($got["task_status"] == "Submitted Late") :
                        if ($task_priority == "High") :
                            $points = 75;
                        elseif ($task_priority == "Medium") :
                            $points = 50;
                        elseif ($task_priority == "Low") :
                            $points = 25;
                        endif;

                    endif;
                    $date = $got["task_submitted"];
                    $components = preg_split($pattern, $date, -1, PREG_SPLIT_OFFSET_CAPTURE);
                    // $month[] = [$components[1][0] => $points];
                    // foreach ($month as $key => $value) {
                    //     if ($key != $components[1][0]) {
                    //         $month[$components[1][0]] = $points;
                    //     } 
                    // }
                    // $month += [$components[1][0] $points];
                $month[$components[1][0]] += $points;
                endwhile;

            else :
                $month = ["03" => 0];
            endif;

            ksort($month);
            
            $marks[$projectID] = $month;
            $month = (array) null;
        endforeach;
        return json_encode($marks);
    }
}
