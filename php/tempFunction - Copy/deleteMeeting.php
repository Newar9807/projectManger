<?php
class deleteMeeting
{

    public function deleteMeetingMainMethod($conn)
    {

        $id = $_POST["id"];
        $sql = "DELETE FROM `tbl_events` WHERE `events_id` = {$id}";
        $res = mysqli_query($conn, $sql);
        if ($res) :
            $_POST["comment"] = "Deleted Successfully..";
            return "Deleted Successfully..";
        else :
            $_POST["comment"] = "Deleted UnSuccessful..";
            return "Deleted UnSuccessful..";
        endif;
    }
}
