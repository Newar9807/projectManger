<?php

trait meeting
{
    
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
}
