<?php
// This will be set while login process
$_SESSION["user"] = "Teacher";
$_SESSION["userId"] = 3;

$userId = $_SESSION["userId"];

$fromID = $_SESSION["userId"];
$toID = $_POST["project"];

// Events Table Work
$events_description = $_POST["description"];
$events_date = $_POST["date"];

$conn = mysqli_connect('localhost', 'root', '', 'pms') or die("Error Database Connection");
$sql = "INSERT INTO `tbl_events`(`events_from_id`, `events_to_id`, `events_description`, `events_date`, `events_status`) VALUES ('{$fromID}', '{$toID}', '{$events_description}', '{$events_date}', 'Meeting Assigned')";


$res = mysqli_query($conn, $sql);

if ($res) :
    echo "Meeting Set..";
else :
    // Query Execution Error
    echo "Query Execution Error..";
endif;