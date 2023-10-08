<?php

trait support {

    // Register
    public function registerMainMethod()
    {

        $name = ucwords(strtolower($_POST["name"]));
        $faculty = $_POST["faculty"];
        $phone = $_POST["phone"];
        $email = strtolower($_POST["email"]);
        $password = ($_POST["password"]);

        if (isset($_POST["program"])) :
            $program = $_POST["program"];
            $role = "Student";
            $sql = "INSERT INTO `tbl_user`(`user_role`, `user_name`, `user_faculty`, `user_phone`, `user_email`, `user_password`, `user_program_id`, `user_pic`) VALUES ('{$role}','{$name}','{$faculty}','{$phone}','{$email}','{$password}','{$program}', 'images/user.png')";
        else :
            $role = "Teacher";
            $sql = "INSERT INTO `tbl_user`(`user_role`, `user_name`, `user_faculty`, `user_phone`, `user_email`, `user_password`, `user_pic`) VALUES ('{$role}','{$name}','{$faculty}','{$phone}','{$email}','{$password}', 'images/user.png')";
        endif;
        $res = mysqli_query($this->conn, $sql);
        if ($res) :
            // $data = "Insertion Successfull";
            $data = $role . " SignUp Successfully";
        else :
            $data = "Insertion Failed";
        endif;
        return ($data);
    }

    // SignIn
    public function signinMainMethod()
    {

        $email = $_POST["email"];
        $password = $_POST["password"];

        $sqlFirst = "SELECT count(`user_email`) as Email FROM `tbl_user` WHERE `user_email` = '{$email}' ";

        $resFirst = mysqli_query($this->conn, $sqlFirst);

        $count = -1;

        $response = [];

        if ($resFirst) :
            while ($fetchFirst = mysqli_fetch_assoc($resFirst))
                $count = $fetchFirst["Email"];
        else :
            $response[0] = "Error";
        endif;

        $sqlSecond = "SELECT `user_id`, `user_role` FROM `tbl_user` WHERE `user_email` = '{$email}' AND `user_password` = '{$password}'";

        $resSecond = mysqli_query($this->conn, $sqlSecond);

        session_start();
        if ($resSecond && (mysqli_num_rows($resSecond) == 1)) :
            while ($fetchSecond = mysqli_fetch_assoc($resSecond)) :
                $_SESSION["id"] = $fetchSecond["user_id"];
                $response[1] = $fetchSecond["user_role"];
            endwhile;
        else :
            $response[0] = "Error";
        endif;

        if ($count == "0") :
            $response[0] = "emailError";
        elseif (!isset($_SESSION["id"])) :
            $response[0] = "passwordError";
        else :
            $response[0] = "Success";
        endif;
        return ($response);
    }
    
    // Others
    public function manageMarksMainMethod()
    {

        extract($_POST);

        $datass = [];
        foreach ($data as $key => $value) :

            $fetchProjectSql = "SELECT `project_name` FROM `tbl_project` WHERE `project_id` = '{$key}'";

            $fetchQueryExection = mysqli_query($this->conn, $fetchProjectSql);

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
                $tempArray[intval($k) - 1] = $v;
            endforeach;

            $datass[] = [
                "label" => $response[1],
                "data" => $tempArray,
                "backgroundColor" => [$this->getRandomRgb()],
                "borderColor" => [$this->getRandomRgb()],
                "borderWidth" => 3,
            ];

        endforeach;

        return json_encode($datass);
    }

    private function getRandomRgb()
    {
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);
        return "rgb($r, $g, $b)";
    }

    public function getDataToEditTasksMainMethod()
    {

        $taskID = $_POST["taskID"];
        $sql = "SELECT * FROM `tbl_task` JOIN `tbl_project` ON `tbl_task`.`task_to_id` = `tbl_project`.`project_id` AND `tbl_task`.`task_id` = '{$taskID}' ORDER BY `tbl_task`.`task_id` DESC";
        $res = mysqli_query($this->conn, $sql);
        $response = [];
        if ($res) :
            // Query Execution Success
            while ($got = mysqli_fetch_assoc($res)) :
                $response = [
                    $got['task_id'] => $got['task_title'],
                    $got['project_id'] => $got['project_name'],
                    'sdlc' => $got['project_sdlc'],
                    'phase' => $got['task_phase'],
                    'dueDate' => $got['task_deadline'],
                    'priority' => $got['task_priority'],
                    'description' => $got['task_description'],
                    'status' => $got['task_status'],
                ];
            endwhile;
        else :
            // Query Execution Error
            $response[] =  "Failed";
        endif;

        return json_encode($response);
    }
}