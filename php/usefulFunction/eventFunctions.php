<?php
function init($data = null)
{
    $conn = mysqli_connect('localhost', 'root', '', 'pms') or die('Error Database Connection');
    $sql = "SELECT * FROM `tbl_events`";
    $res = mysqli_query($conn, $sql);
    $events = [];
    if ($res) :
        $_POST['comment'] = "All Event Has Been Fetched Successfully";
        while ($tmpRes = mysqli_fetch_assoc($res)) {
            $events[] = $tmpRes;
        };
    else :
        $_POST['comment'] = "Query Error While Fetching Event";
    endif;
    $conn->close();

    extract($_POST);

    if ($data == "right") :
        if ($inputMonth == 12) :
            $inputYear++;
            $inputMonth = 1;
        else :
            $inputMonth++;
        endif;
    elseif ($data == "left") :
        if ($inputMonth == 1) :
            $inputYear--;
            $inputMonth = 12;
        else :
            $inputMonth--;
        endif;
    endif;

    if (!((isset($_POST['inputYear'])) && (isset($_POST['inputMonth'])))) :
        $time = mktime(0, 0, 0, date('n', time()), 1, date('Y', time()));
    else :
        $time = mktime(0, 0, 0, $inputMonth, 1, $inputYear);
        unset($_POST);
    endif;

    $_SESSION = [
        "year" => date('Y', $time),
        "date" => date('d', $time),
        "month" => date('m', $time),
        "currentYear" => date('Y', time()),
        "currentMonth" => date('m', time()),
        "currentDate" => date('d', time()),
        "totalDay" => date('t', $time),
        "monthInWords" => date('F', $time),
        "day" => date('w', $time),
        "time" => $time,
        "week" => ["SUNDAY", "MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY"],
        "events" => $events,
    ];
    $data = null;
}
    
    

// }
