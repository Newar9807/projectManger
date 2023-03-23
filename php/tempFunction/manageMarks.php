<?php
include("../assets/dbCon.php");
extract($_POST);

$datass = [];
foreach ($data as $key => $value) :

    $fetchProjectSql = "SELECT `project_name` FROM `tbl_project` WHERE `project_id` = '{$key}'";

    $fetchQueryExection = mysqli_query($conn, $fetchProjectSql);

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
        $tempArray[intval($k)-1] = $v;
    endforeach;

    $datass[] = [
        "label" => $response[1],
        "data" => $tempArray,
        "backgroundColor" => [getRandomRgb()],
        "borderColor" => [getRandomRgb()],
        "borderWidth" => 3,
    ];

endforeach;


function getRandomRgb()
{
    $r = rand(0, 255);
    $g = rand(0, 255);
    $b = rand(0, 255);
    return "rgb($r, $g, $b)";
}

echo json_encode($datass);
