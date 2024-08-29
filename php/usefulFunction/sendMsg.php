<?php
include("../assets/dbCon.php");
$db = new dbCon();
$conn = $db->getConnection();
$from = $_POST['from'] ?? null;
$to = $_POST['to'] ?? null;
$msg = $_POST['msg'] ?? null;
$dateTime = new DateTime();
$queryTime = $dateTime->format('Y-m-d H:i:s');
$status = "unread";

$sql = "INSERT INTO tbl_query (query_from_id, query_to_id, query, query_time, query_status) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("iisss", $from, $to, $msg, $queryTime, $status);

// include_once("fetchMsg.php");
if ($stmt->execute()) {
    require( $_SERVER['DOCUMENT_ROOT']. '/finalProject/php/tempFunction/convertTime.php' );

    $fromID = $_POST['from'] ?? $_SESSION['id'];
    $to = $_POST['to'] ?? null;

    if ( !isset( $to ) ) {
        echo json_encode( false );
    }

    $toProjectQuery = "SELECT *
                        FROM `tbl_project` 
                        JOIN `tbl_query`
                        WHERE `tbl_project`.`project_id` IN ($to)
                        AND `tbl_query`.`query_to_id` = `tbl_project`.`project_id`
                        -- AND `tbl_query`.`query_from_id` = '{$fromID}'
                        ORDER BY `tbl_query`.`query_time` DESC    
                    ";

    $toProjectQueryExection = mysqli_query($conn, $toProjectQuery);
    $msgDatas = [];
    $toUserDatas = [];
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

    usort($msgDatas, function($a, $b) {
        return strtotime($a['time']) - strtotime($b['time']);
    });

    foreach( $msgDatas as $key => $msgData ) {
        $msgDatas[$key]['time'] = timeAgo( $msgData['time'] );
    }

    echo json_encode( [ 'msgDatas' => $msgDatas ] + [ 'userDatas' => $toUserDatas ] );
} else {
    echo json_encode("Error: " . $stmt->error);
}