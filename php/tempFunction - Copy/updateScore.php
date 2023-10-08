<?php

class updateScore
{

    public function updateScoreMainMethod($conn)
    {

        $sql = "";
        $response = [];
        if (mysqli_query($conn, $sql)) :
            $response[0] = "Success";
            $res = mysqli_query($conn, $sql);
            while ($got = mysqli_fetch_assoc($res)) :

            endwhile;
        else :
            $response[0] = "Failed";
        endif;

        return json_encode($response);
    }
}
