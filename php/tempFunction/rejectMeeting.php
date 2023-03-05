<?php
    include("../assets/dbCon.php");
    $id = $_POST["id"];
    $sql = "DELETE FROM `tbl_events` WHERE `events_id` = {$id}";
    $res = mysqli_query($conn, $sql);
    if($res):
        $_POST["comment"] = "Deleted Successfully..";
        echo "Deleted Successfully..";
    else:
        $_POST["comment"] = "Deleted UnSuccessful..";
        echo "Deleted UnSuccessful..";
    endif;
?> 
<!-- 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 -->