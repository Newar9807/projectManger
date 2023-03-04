<?php $root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];
require_once("eventFunctions.php");

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
            margin-top: 110px;
        }

        /* Rounded Divider */
        #divider {
            border-left: 6px solid #bbb;
            border-radius: 10px;
            height: 500px;
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
            background-color: yellowgreen;
            cursor: pointer;
        }
    </style>


</head>

<body>
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
            if (isset($_POST['add'])) :
            ?>
                <div class="alert alert-success d-flex justify-content-center" role="alert">
                    <?= $_POST['add'] ?>
                </div>
            <?php
                unset($_POST['add']);
            endif;
            ?>
            <div class="container text-center d-grid aligns-items-center justify-content-center">

                <div class="row">
                    <div class="first col-sm-7">
                        <div class="calendar">
                            <h2 class="display-3">CALENDAR</h2>
                            <table class="table">
                                <thead>
                                    <tr class="table-dark">
                                        <?php
                                        foreach ($week as $value) {
                                        ?>
                                            <th scope="col" class="border-end border-light bg-warning m-2 rounded"><?= $value; ?></th>
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
                                                        <th scope="col" class="border-end border-light table-dark m-2 rounded" style="background-color: red;"> <i class="bi bi-dash-lg"></i> </th>
                                                    <?php } else {
                                                    ?>
                                                        <th scope="col" class="border-end border-light m-2 rounded"> <i class="bi bi-dash-lg"></i> </th>
                                                    <?php
                                                    }
                                                } else if ($dayCount == 6) { ?>
                                                    <td scope="col" class="gate border-end border-light m-2 rounded" data-ddate="<?php echo $year . '-' . $month . '-' . $storeDay; ?>" style=" background-color: red;">
                                                        <?php
                                                        $storeDay = sprintf("%d", $storeDay);
                                                        echo $storeDay;
                                                        $temp = $year . '-' . $month . '-' . $storeDay;
                                                        foreach ($events as $eventDate) {
                                                            if ($eventDate['date'] == $temp) {
                                                                echo "<span style='font-size:5px'><br />" . $eventDate['event'] . "</span>";
                                                                break;
                                                            } elseif (($year . '-' . $month . '-' . $storeDay) == ($currentYear . '-' . $currentMonth . '-' . $currentDate)) {
                                                                echo "<span style='font-size:15px'><br />Today</span>";
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
                                                        $storeDay = sprintf("%d", $storeDay);
                                                        echo $storeDay;
                                                        $temp = $year . '-' . $month . '-' . $storeDay;
                                                        foreach ($events as $eventDate) {
                                                            if ($eventDate['date'] == $temp) {
                                                                echo "<span style='font-size:15px'><br />" . $eventDate['event'] . "</span>";
                                                                break;
                                                            } elseif (($year . '-' . $month . '-' . $storeDay) == ($currentYear . '-' . $currentMonth . '-' . $currentDate)) {
                                                                echo "<span style='font-size:15px'><br />Today</span>";
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
                    </div>
                    <div class="col-sm-1" id="divider"></div>
                    <div class="second col-sm-4 text-center d-grid aligns-items-center justify-content-center">
                        <div id="eventInset">
                            
                        </div>
                        <div class="mx-auto">
                            <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#inputModal">Enter Manually</button>
                            <button type="button" class="btn btn-outline-dark addEvent">Add Event</button>
                            <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#allEventModal">All Events</button>
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
                                Add Event
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="addEvent" method="POST">
                                <div class="mb-3">
                                    <label for="eventInput" class="form-label">Event</label>
                                    <input type="text" class="form-control" id="eventInput" name="eventInput" aria-describedby="eventHelp" maxlength="16" />
                                    <div id="eventHelp" class="form-text">
                                        Enter your event here
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="eventDate" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="eventDate" name="eventDate" value="<?= $currentYear . '-' . $currentMonth . '-' . $currentDate; ?>" />
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">
                                        Save Event
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Input Modal -->
            <div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="inputModalLabel">
                                Input Manually
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="home" method="POST">
                                <div class="mb-3">
                                    <label for="eventInput" class="form-label">Enter Year</label>
                                    <input type="number" class="form-control" id="inputYear" name="inputYear" aria-describedby="inputYearHelp" value="20" />
                                    <div id="inputYearHelp" class="form-text">

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="eventInput" class="form-label">Enter Month</label>
                                    <input type="number" class="form-control" id="inputMonth" name="inputMonth" aria-describedby="inputMonthHelp" min="1" max="12" />
                                    <div id="inputMonthHelp" class="form-text">

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Show</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mid div ends -->

        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script> -->
    <!-- <script src="../assets/js/event.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.gate').on('click', function(e) {
                console.log(this.getAttribute('data-ddate'));
                $('#eventDate').val(this.getAttribute('data-ddate'));
                $('#eventModal').modal('show');
            });

            $('.addEvent').click(function(e) {
                // $('#eventDate').val(this.getAttribute('data-ddate'));
                $('#eventModal').modal('show');
            })

            function allEvents(){
                <?php 
                        $con = new mysqli('localhost', 'root', '', 'pms') or die('Error Database Connection');
                        $sql = 

                ?>
                <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                <div class="d-flex w-50 justify-content-between">
                                    <h5 class="mb-1">List group item heading</h5>
                                    <small>3 days ago</small>
                                </div>
                                <p class="mb-1">Some placeholder content in a paragraph.</p>
                                <small>And some small print.</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-50 justify-content-between">
                                    <h5 class="mb-1">List group item heading</h5>
                                    <small class="text-muted">3 days ago</small>
                                </div>
                                <p class="mb-1">Some placeholder content in a paragraph.</p>
                                <small class="text-muted">And some muted small print.</small>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-50 justify-content-between">
                                    <h5 class="mb-1">List group item heading</h5>
                                    <small class="text-muted">3 days ago</small>
                                </div>
                                <p class="mb-1">Some placeholder content in a paragraph.</p>
                                <small class="text-muted">And some muted small print.</small>
                            </a>
                        </div>
            }

            $('#right').click(function() {

            });

            $('#left').click(function() {

            });

        });
    </script>


</body>

</html>