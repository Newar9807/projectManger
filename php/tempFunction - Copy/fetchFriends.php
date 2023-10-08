<?php
class fetchFriends
{

    public function fetchFriendsMainMethod($conn)
    {

        $userId = $_POST["myId"];
        $sql = "SELECT `user_id`, `user_name` FROM `tbl_user` WHERE `user_id` != '{$userId}' ";
        if (isset($_POST["firstMemberId"])) :
            $firstMemberId = $_POST["firstMemberId"];
            $sql .= "AND `user_id` != '{$firstMemberId}' ";
        endif;
        $sql .= "AND `user_program_id` = (SELECT `user_program_id` FROM `tbl_user` WHERE `user_id` = '{$userId}')";

        $sqlFilterUsers = "SELECT `tbl_ext_user`.`ext_user_id` FROM `tbl_ext_user` JOIN `tbl_user` ON `tbl_user`.`user_id` = `tbl_ext_user`.`ext_user_id` AND `tbl_user`.`user_program_id` = (SELECT `user_program_id` FROM `tbl_user` WHERE `user_id` = '{$userId}' AND `user_role` = 'Student')";

        if (mysqli_query($conn, $sqlFilterUsers)) :
            $res = mysqli_query($conn, $sqlFilterUsers);
            while ($got = mysqli_fetch_assoc($res)) :
                $assignedUsers = $got["ext_user_id"];
                $sql .= " AND `user_id` != '{$assignedUsers}'";
            endwhile;
        endif;

        $response = [];
        if (mysqli_query($conn, $sql)) :
            $response[0] = "Success";
            $res = mysqli_query($conn, $sql);
            while ($got = mysqli_fetch_assoc($res)) :
                $response[1][$got["user_id"]] = $got["user_name"];
            endwhile;
        else :
            $response[0] = "Failed";
        endif;

        return json_encode($response);
    }
}
