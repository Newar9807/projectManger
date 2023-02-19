<?php

include("../assets/dbCon.php");

$sql = "SELECT `faculty_id`,`faculty_name` FROM `tbl_faculty`";
$res = mysqli_query($conn, $sql);
$fetchFaculties = [];
if ($res) :
    while ($got = mysqli_fetch_assoc($res)) :
        $fetchFaculties[$got["faculty_id"]] = $got["faculty_name"];
    endwhile;
    echo json_encode($fetchFaculties);
else :

endif;
