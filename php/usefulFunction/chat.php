<?php
require( $_SERVER['DOCUMENT_ROOT']. '/finalProject/php/tempFunction/convertTime.php' );

$fromID = $_SESSION['id'];
$isTeacherSql = "SELECT `tbl_user`.`user_role` FROM `tbl_user` WHERE `tbl_user`.`user_id` = '{$fromID}'";
$isTeacherQueryExection = mysqli_query($conn, $isTeacherSql);
$isTeacher = mysqli_fetch_assoc($isTeacherQueryExection)["user_role"] == "Teacher";

$projectIDs = implode( ",", array_values( $projectId ) );
$toProjectQuery = "SELECT *
                    FROM `tbl_project` 
                    JOIN `tbl_query`
                    WHERE `tbl_project`.`project_id` IN ($projectIDs)
                    AND `tbl_query`.`query_to_id` = `tbl_project`.`project_id`
                    ORDER BY `tbl_query`.`query_time` DESC
                ";

$toProjectQueryExection = mysqli_query($conn, $toProjectQuery);
$msgDatas = [];
if (mysqli_num_rows($toProjectQueryExection) != 0) :
    while ($got = mysqli_fetch_assoc($toProjectQueryExection)) :
        $msgDatas[] = [
            'id' => $got['query_id'],
            'from' => $got['query_from_id'],
            'to' => $got['query_to_id'],
            'msg' => $got['query'],
            'time' => $got['query_time'],
        ];
        if ( $got['query_from_id'] == $fromID || in_array($got['query_from_id'], $toUserDatas ?? [] ) ) continue;
        $toUserFetchSql = "SELECT *
                            FROM `tbl_user` 
                            WHERE `tbl_user`.`user_id` = '{$got['query_from_id']}'
                            LIMIT 1
                        ";
        $toUserFetchSqlExection = mysqli_query($conn, $toUserFetchSql);
        $toUserDatas[$got['query_from_id']] = mysqli_fetch_assoc($toUserFetchSqlExection);
    endwhile;
endif;

$allProjects = "SELECT * FROM `tbl_project` WHERE `tbl_project`.`project_id` IN ($projectIDs)";
$projectQueryExection = mysqli_query($conn, $allProjects);
$projectDatas = [];
if (mysqli_num_rows($projectQueryExection) != 0) :
    while ($got = mysqli_fetch_assoc($projectQueryExection)) :
        if ( in_array( $got['project_id'], array_column( $projectDatas, 'id' ) ) ) continue;
        $projectDatas[] = [
            'id' => $got['project_id'],
            'name' => $got['project_name'],
            'status' => $got['project_status'],
            'time' => $got['project_created'],
            'pic' => $got['project_dp'] ?? $_SERVER['DOCUMENT_ROOT'].'/finalProject/php/assets/icons/user.png',
        ];
    endwhile;
endif;

usort($msgDatas, function($a, $b) {
    return strtotime($a['time']) - strtotime($b['time']);
});

foreach( $msgDatas as $key => $msgData ) {
    $msgDatas[$key]['time'] = timeAgo( $msgData['time'] );
}
