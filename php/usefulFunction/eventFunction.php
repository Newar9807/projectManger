<?php
$data = null;
if (($_POST["data"]) != 0)
    $data = $_POST["data"];

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

if (((($_POST['inputYear']) == "") && (($_POST['inputMonth']) == ""))) :
    $time = mktime(0, 0, 0, date('n', time()), 1, date('Y', time()));
else :
    $time = mktime(0, 0, 0, $inputMonth, 1, $inputYear);
    unset($_POST);
endif;

$response = [
    "year" => date('Y', $time),
    "date" => date('d', $time),
    "month" => date('m', $time),
    "currentYear" => date('Y', time()),
    "currentMonth" => date('m', time()),
    "currentDate" => date('d', time()) + 1,
    "totalDay" => date('t', $time),
    "monthInWords" => date('F', $time),
    "day" => date('w', $time),
    "time" => $time,
    "week" => ["SUNDAY", "MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY"],
];
echo json_encode($response);
