<?php
class programFunctions
{
    private $conn ;

    public function __construct()
    {
        // DB connection
        include_once("../assets/dbCon.php");
        $Database = new dbCon();
        $this->conn = $Database->getConnection();
    }
    
    // Register
    public function registerMainMethod()
    {

        $name = ucwords(strtolower($_POST["name"]));
        $faculty = $_POST["faculty"];
        $phone = $_POST["phone"];
        $email = strtolower($_POST["email"]);
        $password = ($_POST["password"]);

        if (isset($_POST["program"])) :
            $program = $_POST["program"];
            $role = "Student";
            $sql = "INSERT INTO `tbl_user`(`user_role`, `user_name`, `user_faculty`, `user_phone`, `user_email`, `user_password`, `user_program_id`, `user_pic`) VALUES ('{$role}','{$name}','{$faculty}','{$phone}','{$email}','{$password}','{$program}', 'images/user.png')";
        else :
            $role = "Teacher";
            $sql = "INSERT INTO `tbl_user`(`user_role`, `user_name`, `user_faculty`, `user_phone`, `user_email`, `user_password`, `user_pic`) VALUES ('{$role}','{$name}','{$faculty}','{$phone}','{$email}','{$password}', 'images/user.png')";
        endif;
        $res = mysqli_query($this->conn, $sql);
        if ($res) :
            // $data = "Insertion Successfull";
            $data = $role . " SignUp Successfully";
        else :
            $data = "Insertion Failed";
        endif;
        return ($data);
    }

    // SignIn
    public function signinMainMethod()
    {

        $email = $_POST["email"];
        $password = $_POST["password"];

        $sqlFirst = "SELECT count(`user_email`) as Email FROM `tbl_user` WHERE `user_email` = '{$email}' ";

        $resFirst = mysqli_query($this->conn, $sqlFirst);

        $count = -1;

        $response = [];

        if ($resFirst) :
            while ($fetchFirst = mysqli_fetch_assoc($resFirst))
                $count = $fetchFirst["Email"];
        else :
            $response[0] = "Error";
        endif;

        $sqlSecond = "SELECT `user_id`, `user_role` FROM `tbl_user` WHERE `user_email` = '{$email}' AND `user_password` = '{$password}'";

        $resSecond = mysqli_query($this->conn, $sqlSecond);

        session_start();
        if ($resSecond && (mysqli_num_rows($resSecond) == 1)) :
            while ($fetchSecond = mysqli_fetch_assoc($resSecond)) :
                $_SESSION["id"] = $fetchSecond["user_id"];
                $response[1] = $fetchSecond["user_role"];
            endwhile;
        else :
            $response[0] = "Error";
        endif;

        if ($count == "0") :
            $response[0] = "emailError";
        elseif (!isset($_SESSION["id"])) :
            $response[0] = "passwordError";
        else :
            $response[0] = "Success";
        endif;
        return ($response);
    }

    // Abstract Submission
    public function storeAbstractMainMethod()
    {
        extract($_POST);
        $sql = "INSERT INTO `tbl_project`(`project_name`, `project_frontend`, `project_backend`, `project_sdlc`, `project_created`, `project_abstract`, `project_ppt`, `project_status`, `project_priority`) VALUES ('{$projectTitle}','{$frontendTool}','{$backendTool}','{$sdlcModel}', now(),'{$abstract}','Soon..', 'Approved', 'Medium')";
        $response = [];
        if (mysqli_query($this->conn, $sql)) :
            // Query Execution Success
            $response[0] = "Success";
            $sqlMaxProjectId = "SELECT MAX(`project_id`) AS 'maxID' FROM `tbl_project`";
            if (mysqli_query($this->conn, $sqlMaxProjectId)) :
                $response[1] = "Success";
                $res = mysqli_query($this->conn, $sqlMaxProjectId);
                $tmpProjectId = 0;
                while ($got = mysqli_fetch_assoc($res)) :
                    $tmpProjectId = $got['maxID'];
                endwhile;
                $sqlLinkUser = "INSERT INTO `tbl_ext_user`(`ext_user_id`, `ext_project_id`) VALUES ('{$myId}','{$tmpProjectId}'), ('{$firstMember}','{$tmpProjectId}'), ( '3','{$tmpProjectId}')";
                if ($_POST["secondMember"] != "0") :
                    $sqlLinkUser .= ",('{$secondMember}','{$tmpProjectId}')";
                endif;
                if (mysqli_query($this->conn, $sqlLinkUser)) :
                    $response[2] = "Success";
                else :
                    $response[2] = "Failed";
                endif;
            else :
                $response[1] = "Failed";
            endif;


        else :
            // Query Execution Error
            $response[0] = "Failed";
        endif;
        return json_encode($response);
    }

    // Meeting Actions
    public function acceptMeetingMainMethod()
    {
        $id = $_POST["id"];
        $sql = "UPDATE `tbl_events` SET `events_status`='Meeting Accepted' WHERE `events_id` = {$id}";
        $res = mysqli_query($this->conn, $sql);
        if ($res) :
            return "Meeting Accepted..";
        else :
            return "Meeting Acceptance Failed..";
        endif;
    }

    public function rejectMeetingMainMethod()
    {
        $id = $_POST["id"];
        $sql = "UPDATE `tbl_events` SET `events_status`='Meeting Rejected' WHERE `events_id` = {$id}";
        $res = mysqli_query($this->conn, $sql);
        if ($res) :
            return "Meeting Rejected..";
        else :
            return "Meeting Rejection Failed..";
        endif;
    }

    public function deleteMeetingMainMethod()
    {

        $id = $_POST["id"];
        $sql = "DELETE FROM `tbl_events` WHERE `events_id` = {$id}";
        $res = mysqli_query($this->conn, $sql);
        if ($res) :
            $_POST["comment"] = "Deleted Successfully..";
            return "Deleted Successfully..";
        else :
            $_POST["comment"] = "Deleted UnSuccessful..";
            return "Deleted UnSuccessful..";
        endif;
    }

    public function studentMeetingMainMethod()
    {
        // This will be set while login process
        $_SESSION["user"] = "Student";
        $_SESSION["userId"] = 4;

        $userId = $_SESSION["userId"];

        if ($_SESSION["user"] = "Student") :
            // If meeting is requested by student
            // $stdSql = "SELECT `user_project_id` as 'PID' FROM `tbl_user` WHERE `user_id` = {$userId}";
            $stdSql = "SELECT `tbl_ext_user`.`ext_project_id` as 'PID' FROM `tbl_user` JOIN `tbl_ext_user` ON `tbl_user`.`user_id` = `tbl_ext_user`.`ext_user_id` AND `tbl_ext_user`.`ext_user_id` = '{$userId}' AND `tbl_user`.`user_role` = 'Student'";
            $stdRes = mysqli_query($this->conn, $stdSql);
            if (mysqli_num_rows($stdRes) == 1) :
                $stdRes = mysqli_fetch_assoc($stdRes);
            else :
            // Error in Query Execution or More than 1 rows are fetched
            endif;
            $fromID = $stdRes["PID"];

            // $tecSql = "SELECT `user_id` as 'tecID' FROM `tbl_user` WHERE `user_project_id` = '{$fromID}' AND `user_role` = 'Teacher'";
            $tecSql = "SELECT `tbl_ext_user`.`ext_user_id` as 'tecID' FROM `tbl_user`  JOIN `tbl_ext_user` ON `tbl_user`.`user_id` = `tbl_ext_user`.`ext_user_id` AND `tbl_ext_user`.`ext_project_id` = '{$fromID}' AND `tbl_user`.`user_role` = 'Teacher'";
            $tecRes = mysqli_query($this->conn, $tecSql);
            if (mysqli_num_rows($tecRes) == 1) :
                $tecRes = mysqli_fetch_assoc($tecRes);
            else :
            // Error in Query Execution or More than 1 rows are fetched
            endif;
            $toID = $tecRes["tecID"];
        elseif ($_SESSION["user"] = "Teacher") :
        // If meeting is requested by teacher
        endif;

        // Events Table Work
        $events_description = $_POST["description"];
        $events_date = $_POST["date"];

        $sql = "INSERT INTO `tbl_events`(`events_from_id`, `events_to_id`, `events_description`, `events_date`, `events_status`) VALUES ('{$fromID}', '{$toID}', '{$events_description}', '{$events_date}', 'Meeting Requested')";

        $res = mysqli_query($this->conn, $sql);

        if ($res) :
            $_SESSION["comment"] = "Request Sent..";
            return "Request Sent..";
        else :
            // Query Execution Error
            $_SESSION["comment"] = "Query Execution Sent..";
            return "Query Execution Error..";
        endif;
    }

    public function teacherMeetingMainMethod()
    {
        $userId = $_POST["userID"];

        $fromID = $_POST["userID"];
        $toID = $_POST["project"];

        // Events Table Work
        $events_description = $_POST["description"];
        $events_date = $_POST["date"];

        $this->conn = mysqli_connect('localhost', 'root', '', 'pms') or die("Error Database Connection");
        $sql = "INSERT INTO `tbl_events`(`events_from_id`, `events_to_id`, `events_description`, `events_date`, `events_status`) VALUES ('{$fromID}', '{$toID}', '{$events_description}', '{$events_date}', 'Meeting Assigned')";

        $res = mysqli_query($this->conn, $sql);

        if ($res) :
            return "Meeting Set..";
        else :
            // Query Execution Error
            return "Query Execution Error..";
        endif;
    }

    // Teacher Functions
    public function changeStdProfileMainMethod()
    {
        extract($_POST);

        $response = "Failed";

        if ($identifier == "changePassword") :

            $sql = "SELECT * FROM `tbl_user` WHERE `user_id` = '{$userID}' AND `user_password` = '{$oldPassword}'";


            if (mysqli_num_rows(mysqli_query($this->conn, $sql)) != 0) :
                $fullName = $first_name . " " . $last_name;

                $updateSql = "UPDATE `tbl_user` SET `user_role`='Student',`user_name`='{$fullName}',`user_faculty`='{$faculty}', `user_program_id`='{$programId}', `user_phone`='{$phoneNum}',`user_email`='{$email}',`user_password`='{$newPassword}'";
                $var = count($_FILES);
                if (count($_FILES) != 0) :
                    $dir =  $_SERVER["DOCUMENT_ROOT"] . '5thproject/php/images/' . $_FILES["image"]["name"][0];
                    move_uploaded_file($_FILES["image"]["tmp_name"][0], $dir);
                    $updateSql .= ",`user_pic`='images/{$_FILES["image"]["name"][0]}'";
                endif;

                $updateSql .= " WHERE `user_id` = '{$userID}'";

                if (mysqli_query($this->conn, $updateSql))
                    $response = "Success";
            endif;

        elseif ($identifier == "changePic") :
            $dir =  $_SERVER["DOCUMENT_ROOT"] . '5thproject/php/images/' . $_FILES["image"]["name"][0];
            move_uploaded_file($_FILES["image"]["tmp_name"][0], $dir);
            $updateSql = "UPDATE `tbl_user` SET `user_pic`='images/{$_FILES["image"]["name"][0]}' WHERE `user_id` = '{$userID}'";
            if (mysqli_query($this->conn, $updateSql))
                $response = "Success";
        endif;
        return $response;
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

    // Tasks Functions
    public function deleteTasksMainMethod()
    {

        $taskID = $_POST["taskID"];
        $sql = "DELETE FROM `tbl_task` WHERE `task_id` = {$taskID}";
        $res = mysqli_query($this->conn, $sql);
        $response = "";
        if ($res) {
            $response = "Success";
        } else {
            $response = "Failed";
        }
        return json_encode($response);
    }

    // Fetch Functions
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
                $month += [$components[1][0] => $points];
            // $month[$components[1][0]] += $points;
            endwhile;

        else :
            $month = ["03" => 0];
        // $month = json_decode($month);
        endif;
        // $month = array_unique($month);

        // $new = [];
        // $oneNew = [];
        // foreach ($month as $value) :
        //     foreach ($value as $key => $value) :
        //         $new[] = $key;
        //         $oneNew[] = $value;
        //     endforeach;
        // endforeach;

        // $add = 0;
        // $anotherTmp = '';
        // $tmp = [];
        // for ($i = 1; $i <= count($new); $i++) :
        //     if (count($tmp) == ($i-1)) :
        //         $anotherTmp = $new[$i];
        //     endif;

        // endfor;

        // $twoNew = [];
        // foreach ($new as $key => $value) :
        //     $twoNew[] = $value;
        // endforeach;

        // ksort($month);

        return json_encode($month);
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
                    $month += [$components[1][0] => $points];
                endwhile;

            else :
                $month = ["03" => 0];
            endif;
            $marks[$projectID] = $month;
            $month = (array) null;
        endforeach;
        return json_encode($marks);
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

    // Store
    public function storeTasksMainMethod()
    {

        extract($_POST);

        $sql = "INSERT INTO `tbl_task`(`task_from_id`, `task_to_id`, `task_title`, `task_phase`, `task_description`, `task_priority`, `task_status`, `task_file`, `task_created`, `task_deadline`) VALUES ('{$fromID}','{$toID}','{$taskName}','{$sdlcPhase}','{$taskDescription}','{$taskPriority}','Pending','Soon..', now(),'{$dueDate}')";
        $res = mysqli_query($this->conn, $sql);
        if ($res) :
            return "Success";
        else :
            return "Failed";
        endif;
    }

    // Update
    public function updateScoreMainMethod()
    {

        $sql = "";
        $response = [];
        if (mysqli_query($this->conn, $sql)) :
            $response[0] = "Success";
            $res = mysqli_query($this->conn, $sql);
            while ($got = mysqli_fetch_assoc($res)) :

            endwhile;
        else :
            $response[0] = "Failed";
        endif;

        return json_encode($response);
    }

    public function updateTasksMainMethod()
    {

        extract($_POST);
        $response = [];
        $sql = "UPDATE `tbl_task` SET `task_title`='{$taskName}',`task_phase`='{$sdlcPhase}',`task_description`='{$taskDescription}',`task_priority`='{$taskPriority}',`task_status`='Pending',`task_file`='Soon', `task_deadline`='{$dueDate}' WHERE `task_id`='{$taskID}'";
        $res = mysqli_query($this->conn, $sql);
        if ($res) :
            // Query Execution Success
            $response[] =  "Success";
        else :
            // Query Execution Error
            $response[] =  "Failed";
        endif;

        return json_encode($response);
    }

    // Filter
    public function filterTasksMainMethod()
    {

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

                    $fetchTakResult = mysqli_query($this->conn, $fetchTaskSql);
                    $test .= '<section class="content">
            <div class="phases">
                <h4 class="phase-header';

                    if (mysqli_num_rows($fetchTakResult) != 0) :
                        $test .= ' notification"><button class="toggle-btn" id="expandPhase' . ++$n . '">+</button>' . $actualValue . '</h4></div><div class="TableArea" id="table-area7">
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
                            if ($actualValue == $taskPhase) :
                                $taskTitle = $storeVal["task_title"];
                                $taskPriority = $storeVal["task_priority"];
                                $taskStatus = $storeVal["task_status"];
                                $taskDeadline = $storeVal["task_deadline"];
                                $taskId = $storeVal["task_id"];
                                $test .= '
                                <tr data-id="' . $taskId . '">
                                    <td>' . $taskTitle . '</td>
                                    <td class="' . strtolower($taskPriority) . '">' . $taskPriority . '</td>
                                    <td class="status-' . strtolower($taskStatus) . '">' . $taskStatus . '</td>
                                    <td>' . $taskDeadline . '</td>
                                </tr>';
                            endif;
                        endforeach;

                        $test .= '
                                </tbody>
                            </table>
                        </div></section>';
                    else :
                        $test .= '"><button class="toggle-btn" id="expandPhase' . ++$n . '">+</button>' . $actualValue . '</h4></div></section>';
                    endif;

                endforeach;

            endif;

        endforeach;

        return $test;
    }

    // Manage marks
    public function manageMarksMainMethod()
    {

        extract($_POST);

        $datass = [];
        foreach ($data as $key => $value) :

            $fetchProjectSql = "SELECT `project_name` FROM `tbl_project` WHERE `project_id` = '{$key}'";

            $fetchQueryExection = mysqli_query($this->conn, $fetchProjectSql);

            $response  = [];

            if (mysqli_num_rows($fetchQueryExection) != 0) :
                // Query Execution Success
                $response[0] = "Success";
                while ($got = mysqli_fetch_assoc($fetchQueryExection)) :
                    $response[1] = $got['project_name'];
                endwhile;
            else :
                // Query Execution Error
                $response[0] = "Failed";
            endif;

            $tempArray = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            foreach ($value as $k => $v) :
                $tempArray[intval($k) - 1] = $v;
            endforeach;

            $datass[] = [
                "label" => $response[1],
                "data" => $tempArray,
                "backgroundColor" => [$this->getRandomRgb()],
                "borderColor" => [$this->getRandomRgb()],
                "borderWidth" => 3,
            ];

        endforeach;

        return json_encode($datass);
    }

    private function getRandomRgb()
    {
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);
        return "rgb($r, $g, $b)";
    }

    // GetData

    public function getDataToEditTasksMainMethod()
    {

        $taskID = $_POST["taskID"];
        $sql = "SELECT * FROM `tbl_task` JOIN `tbl_project` ON `tbl_task`.`task_to_id` = `tbl_project`.`project_id` AND `tbl_task`.`task_id` = '{$taskID}' ORDER BY `tbl_task`.`task_id` DESC";
        $res = mysqli_query($this->conn, $sql);
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
