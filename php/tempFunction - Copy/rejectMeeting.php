<?php

class rejectMeeting
{

    public function rejectMeetingMainMethod($conn)
    {
        $id = $_POST["id"];
        $sql = "UPDATE `tbl_events` SET `events_status`='Meeting Rejected' WHERE `events_id` = {$id}";
        $res = mysqli_query($conn, $sql);
        if ($res) :
            return "Meeting Rejected..";
        else :
            return "Meeting Rejection Failed..";
        endif;
    }
}
?>
<!-- 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 -->