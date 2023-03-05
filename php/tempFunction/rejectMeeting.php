<?php
include("../assets/dbCon.php");
$id = $_POST["id"];
$sql = "UPDATE `tbl_events` SET `events_status`='Meeting Rejected' WHERE `events_id` = {$id}";
$res = mysqli_query($conn, $sql);
if ($res) :
    echo "Meeting Rejected..";
else :
    echo "Meeting Rejection Failed..";
endif;
?>
<!-- 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 -->