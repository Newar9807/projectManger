<?php

class fetchTaskPointsForTec
{
    public function fetchTaskPointsForTecMainMethod($conn)
    {

        $projectId = $_POST["projectID"];

        $marks = [];
        foreach ($projectId as $projectID) :

            $fetchTaskPointsSql = "SELECT * FROM `tbl_task` WHERE `task_to_id` = '{$projectID}'";

            $fetchQueryExection = mysqli_query($conn, $fetchTaskPointsSql);

            if (mysqli_num_rows($fetchQueryExection) != 0) :
                $pattern = "/-/";
                $month = [];
                while ($got = mysqli_fetch_assoc($fetchQueryExection)) :

                    $task_priority = $got["task_priority"];
                    $points = 0;
                    if ($got["task_status"] == "Completed") :
                        if ($task_priority == "High") :
                            $points = 100;
                        elseif ($task_priority == "Medium") :
                            $points = 75;
                        elseif ($task_priority == "Low") :
                            $points = 50;
                        endif;

                    elseif ($got["task_status"] == "Submitted Late") :
                        if ($task_priority == "High") :
                            $points = 75;
                        elseif ($task_priority == "Medium") :
                            $points = 50;
                        elseif ($task_priority == "Low") :
                            $points = 25;
                        endif;

                    endif;
                    $date = $got["task_submitted"];
                    $components = preg_split($pattern, $date, -1, PREG_SPLIT_OFFSET_CAPTURE);
                    // $month[] = [$components[1][0] => $points];
                    $month += [$components[1][0] => $points];
                endwhile;

            else :
                $month = ["03" => 0];
            endif;
            $marks[$projectID] = $month;
            $month = (array) null;
        endforeach;
        return json_encode($marks);
    }
}
