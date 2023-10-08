<?php
class teacherMeeting{

    public function teacherMeetingMainMethod($conn){
        $userId = $_POST["userID"];

        $fromID = $_POST["userID"];
        $toID = $_POST["project"];
        
        // Events Table Work
        $events_description = $_POST["description"];
        $events_date = $_POST["date"];
        
        $conn = mysqli_connect('localhost', 'root', '', 'pms') or die("Error Database Connection");
        $sql = "INSERT INTO `tbl_events`(`events_from_id`, `events_to_id`, `events_description`, `events_date`, `events_status`) VALUES ('{$fromID}', '{$toID}', '{$events_description}', '{$events_date}', 'Meeting Assigned')";
        
        $res = mysqli_query($conn, $sql);
        
        if ($res) :
            return "Meeting Set..";
        else :
            // Query Execution Error
            return "Query Execution Error..";
        endif;
    }
}

