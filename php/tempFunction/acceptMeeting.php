<?php
include("../assets/dbCon.php");
$id = $_POST["id"];
$sql = "UPDATE `tbl_events` SET `events_status`='Meeting Accepted' WHERE `events_id` = {$id}";
$res = mysqli_query($conn, $sql);
if ($res) :
    echo "Meeting Accepted..";
else :
    echo "Meeting Acceptance Failed..";
endif;
?>