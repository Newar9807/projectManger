<?php
class acceptMeeting
{
    public function acceptMeetingMainMethod($conn)
    {
        $id = $_POST["id"];
        $sql = "UPDATE `tbl_events` SET `events_status`='Meeting Accepted' WHERE `events_id` = {$id}";
        $res = mysqli_query($conn, $sql);
        if ($res) :
            return "Meeting Accepted..";
        else :
            return "Meeting Acceptance Failed..";
        endif;
    }
}
