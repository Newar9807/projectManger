<?php

class fetchProgram
{

    public function fetchProgramMainMethod($conn)
    {

        $facultyId = $_POST["facultyId"];
        $sql = "SELECT `program_name`, `program_id` FROM `tbl_program` WHERE `program_faculty_id` = '{$facultyId}'";
        $res = mysqli_query($conn, $sql);
        $fetchPrograms = [];
        if ($res) :
            while ($got = mysqli_fetch_assoc($res)) :
                $fetchPrograms[$got["program_id"]] = $got["program_name"];
            endwhile;
            return json_encode($fetchPrograms);
        else :

        endif;
    }
}
