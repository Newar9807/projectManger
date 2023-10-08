<?php

class register
{

    public function registerMainMethod($conn)
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
        $res = mysqli_query($conn, $sql);
        if ($res) :
            // $data = "Insertion Successfull";
            $data = $role . " SignUp Successfully";
        else :
            $data = "Insertion Failed";
        endif;
        return ($data);
    }
}
