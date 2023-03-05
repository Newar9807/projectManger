<?php
require_once("usefulFunction/eventFunctions.php");
require_once("usefulFunction/wordLimiter.php");
require_once("assets/dbCon.php");

$root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];

// This Session will be set while login process
$_SESSION["user"] = "Student";
$_SESSION["userId"] = 6;
$_SESSION["projectId"] = 2;

$userID = $_SESSION['userId'];
$projectID = $_SESSION["projectId"];

// Database Work
$sqlToFetch = "SELECT * FROM `tbl_events` WHERE `events_to_id` = '{$projectID}' ORDER BY `events_id` DESC";
$resToFetch = mysqli_query($conn, $sqlToFetch);
$sqlFromFetch = "SELECT * FROM `tbl_events` WHERE `events_from_id` = '{$projectID}' ORDER BY `events_id` DESC";
$resFromFetch = mysqli_query($conn, $sqlFromFetch);

if (isset($_POST["right"])) :
    init('right');
elseif (isset($_POST["left"])) :
    init('left');
else :
    init();
endif;

extract($_SESSION);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($root . "/5thproject/php/assets/head.php"); ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-- <link rel="stylesheet" href="../assets/css/events.css"> -->

    <style>
        .container {
            /* margin-top: 110px; */
            margin: 50px auto;
        }

        .row {
            border-top: 5px solid var(--blue);
            border-left: 5px solid var(--blue);
            box-shadow: 5px 10px 28px;
            margin: 10px 20px 0px 10px;
            padding: 10px;
            border-radius: 15px;
        }

        /* Rounded Divider */
        #divider {
            border-left: 5px solid #bbb;
            /* border-right: 6px solid #bbb; */
            /* margin-left: 55px; */
            border-radius: 5px;
            /* border-width: 8px; */
            height: 600px;
        }

        #eventInset {
            /* position: absolute; */
            /* border-top: 3px solid var(--blue); */
            overflow-y: scroll;
            /* overflow: hidden; */
            height: 90%;
        }

        #eventInsetWhole {
            padding: 10px;
            margin-left: 65px;
            background-color: #45aaf2;
            border-radius: 5px;
            width: 318px;
            height: 600px;
            /*     
            padding: 10px;
            background-color: #fbc531;
            border-radius: 5px;
            height: 600px; */
        }

        .navigation ul>li {
            /* margin-left: -20px; */
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        #eventInset::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        #eventInset {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        td:hover {
            background-color: #f7b731;
            cursor: pointer;
        }
    </style>


</head>

<body style="overflow-y: hidden; background-color: #55efc4;">
    <div class="containers">
        <!-- Sidebar Starts -->
        <?php include($root . "/5thproject/php/assets/stdSidebar.php"); ?>
        <!-- Sidebar Ends -->

        <div class="main">
            <!-- Navigation Starts -->
            <?php include($root . "/5thproject/php/assets/tecNav.php"); ?>
            <!-- Navigation Ends -->

            <!-- mid div starts -->
            <?php
            if (isset($_POST['comment'])) :
            ?>
                <!-- <div class="alert alert-success d-flex justify-content-center" role="alert">
                    $_POST['comment'];
                </div> -->
            <?php
                unset($_POST['comment']);
            endif;
            ?>
            <div class="container text-center d-grid aligns-items-center">

                <div class="row">
                    <div class="first col-sm-8 align-text-bottom ms-5" style="margin-top: 100px;">
                        <div class="mb-3">
                            <h1 class="display-6">CALENDER</h1>
                        </div>
                        <div class="calendar mt-4">
                            <table class="table">
                                <thead>
                                    <tr class="table-dark">
                                        <?php
                                        foreach ($week as $value) {
                                        ?>
                                            <th scope="col" class="border-end border-light m-2 rounded" style="background-color: #45aaf2;"><?= $value; ?></th>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_POST))
                                        unset($_POST);
                                    $storeDay = 0;
                                    nextRow:
                                    while ($storeDay < $totalDay) {
                                    ?>
                                        <tr class="table-dark">
                                            <?php
                                            $dayCount = 0;
                                            while ($dayCount < 7) {
                                                if (!($dayCount < $day || $storeDay >= $totalDay)) :
                                                    $storeDay++;
                                                    $storeDay = sprintf("%02d", $storeDay);
                                                endif;

                                                if ($dayCount < $day || $storeDay >= $totalDay) {
                                                    if ($dayCount == 6) {
                                            ?>
                                                        <th scope="col" class="border-end border-light table-dark m-2 rounded" style="background-color: #f53b57;"> <i class="bi bi-dash-lg"></i> </th>
                                                    <?php } else {
                                                    ?>
                                                        <th scope="col" class="border-end border-light m-2 rounded"> <i class="bi bi-dash-lg"></i> </th>
                                                    <?php
                                                    }
                                                } else if ($dayCount == 6) { ?>
                                                    <td scope="col" class="gate border-end border-light m-2 rounded" data-ddate="<?php echo $year . '-' . $month . '-' . $storeDay; ?>" style=" background-color: #f53b57;">
                                                        <?php
                                                        // $storeDay = sprintf("%d", $storeDay);
                                                        echo $storeDay;
                                                        $temp = $year . '-' . $month . '-' . $storeDay;
                                                        $see = $currentYear . '-' . $currentMonth . '-' . $currentDate;
                                                        if (($temp) == ($see)) {
                                                            echo "<span style=''><br />Today</span>";
                                                        }
                                                        foreach ($events as $eventDate) {
                                                            if ($eventDate['events_date'] == $temp) {
                                                                // echo "<span style='font-size:15px'><br />" . $eventDate['events_description'] . "</span>";
                                                                break;
                                                            }
                                                        }
                                                        ?></i></th>
                                                    <?php
                                                    $day = -1;
                                                    goto nextRow;
                                                } else { ?>
                                                        <!--data-bs-toggle="modal" data-bs-target="#eventModal" -->
                                                    <td scope="col" class="gate border-end border-light m-2 rounded" data-ddate="<?php echo $year . '-' . $month . '-' . $storeDay; ?>">
                                                        <?php
                                                        // $storeDay = sprintf("%d", $storeDay);
                                                        echo $storeDay;
                                                        $temp = $year . '-' . $month . '-' . $storeDay;
                                                        $see = $currentYear . '-' . $currentMonth . '-' . $currentDate;
                                                        if (($temp) == ($see)) {
                                                            echo "<span style=''><br />Today</span>";
                                                        }
                                                        foreach ($events as $eventDate) {
                                                            if ($eventDate['events_date'] == $temp) {
                                                                // echo "<span style='font-size:15px'><br />" . $eventDate['events_description'] . "</span>";
                                                                break;
                                                            }
                                                        }
                                                        ?></td>
                                                <?php
                                                } ?>
                                            <?php
                                                $dayCount++;
                                            } ?>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="info d-flex justify-content-center">
                            <form action="" method="post">
                                <input type="hidden" name="inputMonth" value="<?= $month ?>">
                                <input type="hidden" name="inputYear" value="<?= $year ?>">
                                <button type="submit" class="btn" name="left">
                                    <i class="bi bi-arrow-left-circle-fill bi-sm" id="manage" style="font-size: 20px;"></i>
                                </button>
                            </form>
                            <h2 class="display-7"><?= " " . $year . ", " . $monthInWords . " "; ?></h2>
                            <form action="" method="post">
                                <input type="hidden" name="inputMonth" value="<?= $month ?>">
                                <input type="hidden" name="inputYear" value="<?= $year ?>">
                                <button type="submit" class="btn" name="right">
                                    <i class="bi bi-arrow-right-circle-fill bi-sm" id="manage" style="font-size: 20px;"></i>
                                </button>
                            </form>
                        </div>

                        <div class="alert d-flex justify-content-center" role="alert" id="indicator">
                        </div>

                    </div>
                    <div class="second col-sm-3 text-center d-grid justify-content-center">
                        <!-- <span class="" id="divider"></span> -->
                        <div id="eventInsetWhole">
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-dark active" data-bs-toggle="modal" data-bs-target="#allEventModal">All Events</button>
                            </div>
                            <div class="list-group" id="eventInset">
                                <ol class="list-group">
                                    <?php
                                    $a = mysqli_num_rows($resToFetch);
                                    $b = mysqli_num_rows($resFromFetch);
                                    if (mysqli_num_rows($resToFetch) == 0 && mysqli_num_rows($resFromFetch) == 0) :
                                    ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="m-auto">
                                                <div class="fw-bold">No Meetings Interaction </div>
                                                Done Till Now !!
                                            </div>
                                        </li>
                                    <?php
                                    elseif (!$resToFetch || !$resFromFetch) : ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="m-auto">
                                                <div class="fw-bold">Query Execution Error </div>
                                                Sorry !!
                                            </div>
                                        </li>
                                        <?php
                                    else :
                                        if ($resToFetch) :
                                            while ($got = mysqli_fetch_assoc($resToFetch)) :
                                        ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center" <?php if ($got["events_status"] == "Meeting Rejected") : ?>style="background-color:#f53b57; color: snow;" <?php elseif ($got["events_status"] == "Meeting Accepted") : ?> style="background-color:#78e08f; color: snow;" <?php elseif ($got["events_status"] == "Meeting Assigned") : ?> style="background-color: #81ecec;" <?php endif; ?>>
                                                    <div class="m-auto d-grid ">
                                                        <div class="fw-bold"><?= $got["events_status"]; ?></div>
                                                        <?= (word_limiter($got["events_description"])); ?><br>
                                                        <span class="badge bg-info rounded-pill" style="font-size: 14px;"><?= $got["events_date"]; ?></span>
                                                        <?php if ($got["events_status"] == "Meeting Requested") : ?>
                                                            <small class="d-grid my-1">
                                                                <!-- <hr style="margin: 0.15rem 0;"> -->
                                                                <span class="badge bg-danger rounded-pill trash" role="button" data-id="<?= $got["events_id"]; ?>"><i class="bi bi-trash" style="font-size: 16px;"></i></span>
                                                            </small>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if ($got["events_status"] == "Meeting Requested") : ?>
                                                        <!-- <span class="badge bg-danger rounded-pill trash" role="button" data-id="<?= $got["events_id"]; ?>"><i class="bi bi-trash3"></i></span> -->
                                                    <?php endif; ?>
                                                </li>
                                            <?php
                                            endwhile;
                                        else :
                                            // Query Execution Error
                                            echo "";
                                        endif;

                                        if ($resFromFetch) :
                                            while ($got = mysqli_fetch_assoc($resFromFetch)) :
                                            ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center" <?php if ($got["events_status"] == "Meeting Rejected") : ?>style="background-color:#f53b57; color: snow;" <?php elseif ($got["events_status"] == "Meeting Accepted") : ?> style="background-color:#78e08f; color: snow;" <?php elseif ($got["events_status"] == "Meeting Assigned") : ?> style="background-color: #81ecec;" <?php endif; ?>>
                                                    <div class="m-auto d-grid ">
                                                        <div class="fw-bold"><?= $got["events_status"]; ?></div>
                                                        <?= (word_limiter($got["events_description"])); ?><br>
                                                        <span class="badge bg-info rounded-pill" style="font-size: 14px;"><?= $got["events_date"]; ?></span>
                                                        <?php if ($got["events_status"] == "Meeting Requested") : ?>
                                                            <small class="d-grid my-1">
                                                                <!-- <hr style="margin: 0.15rem 0;"> -->
                                                                <span class="badge bg-danger rounded-pill trash" role="button" data-id="<?= $got["events_id"]; ?>"><i class="bi bi-trash" style="font-size: 16px;"></i></span>
                                                            </small>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if ($got["events_status"] == "Meeting Requested") : ?>
                                                        <!-- <span class="badge bg-danger rounded-pill trash" role="button" data-id="<?= $got["events_id"]; ?>"><i class="bi bi-trash3"></i></span> -->
                                                    <?php endif; ?>
                                                </li>
                                    <?php
                                            endwhile;
                                        else :
                                            // Query Execution Error
                                            echo "Query Execution Error";
                                        endif;
                                    endif;
                                    ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Modal -->
            <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="eventModalLabel$time">
                                Meeting
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="meetingForm" autocomplete="off">
                                <div class="mb-3 form-floating">
                                    <textarea class="form-control" placeholder="Why do you want to meet Supervisor ?" id="meetingDescription" style="height: 100px" name="meetingDescription" maxlength="100"></textarea>
                                    <label for="meetingDescription">Description</label>
                                    <div id="eventHelp" class="form-text">
                                        Why do you want to meet Supervisor ?
                                    </div>
                                </div>
                                <!-- <div class="mb-3">
                                    <label for="eventInput" class="form-label">Description</label>
                                    <input type="text" class="form-control" id="meetingDescription" name="meetingDescription" aria-describedby="eventHelp" maxlength="150" />
                                    <div id="eventHelp" class="form-text">
                                        Why do you want to meet Supervisor ?
                                    </div>
                                </div> -->
                                <div class="mb-3">
                                    <label for="eventDate" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="meetingDate" name="meetingDate" value="<?= $currentYear . '-' . $currentMonth . '-' . $currentDate; ?>" />
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">
                                        Request
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Event Model Ends -->

        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="../assets/js/teacherDashbaord.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="../assets/js/event.js"></script>

    <script>
        $(document).ready(function() {
            $("#meetingForm").submit(function(e) {
                e.preventDefault();
                let description = $("#meetingDescription").val(),
                    date = $("#meetingDate").val();
                let choosenDate = date.replaceAll("-", "");

                const d = new Date();
                let year = d.getFullYear(),
                    month = d.getMonth() + 1,
                    day = d.getDate();
                month = month < 10 ? "0" + month.toString() : month.toString();
                day = day < 10 ? "0" + day.toString() : day.toString();
                let currentDate = year + "-" + month + "-" + day;
                currentDate = currentDate.replaceAll("-", "");
                currentDate = parseInt(currentDate);
                choosenDate = parseInt(choosenDate);

                if (currentDate > choosenDate) {
                    $("#meetingDate").addClass(" btn btn-outline-danger");
                } else {
                    $("#meetingDate").removeClass("btn btn-outline-danger");
                    $.post(
                        "tempFunction/studentMeeting.php", {
                            description: description,
                            date: date,
                        },
                        function(response) {
                            localStorage.setItem("comment", response);
                            localStorage.setItem("cmtClass", true);
                            location.reload();
                        }
                    );
                }
            });
        });
    </script>


</body>

</html>