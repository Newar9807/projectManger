<?php $root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];
include("usefulFunction/sessionCheck.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
<<<<<<< Updated upstream
    <?php include($root . "/5thproject/php/assets/head.php"); ?>
=======
    <?php
    include($root . "/finalProject/php/assets/head.php");
    ?>
>>>>>>> Stashed changes

    <link rel="stylesheet" href="../assets/css/tstyle.css" />
    <!-- <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" /> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <title>Teacher</title>
</head>

<body>
    <div class="container">
        <!-- Sidebar Starts -->
<<<<<<< Updated upstream
        <?php include($root . "/5thproject/php/assets/tecSidebar.php"); ?>
        <!-- Sidebar Ends -->
        <div class="main">
            <!-- Navigation Starts -->
            <?php include($root . "/5thproject/php/assets/tecNav.php"); ?>
=======
        <?php include($root . "/finalProject/php/assets/tecSidebar.php"); ?>
        <!-- Sidebar Ends -->
        <div class="main">
            <!-- Navigation Starts -->
            <?php include($root . "/finalProject/php/assets/tecNav.php"); ?>
>>>>>>> Stashed changes
            <!-- Navigation Ends -->

            <!-- mid div start -->

            <div class="dashInner">
                <div class="graphss">
                    <h2>Project Progress</h2>
                    <div id="chartLine">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
                <div class="rightDiv">
                    <h2>Task Status</h2>
                    <div id="container22">
                        <canvas id="myChart"></canvas>

                    </div>
                </div>
            </div>
            <!--ends-->
        </div>
    </div>

    <!-- <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script> -->
    <script src="../assets/js/websiteSkeleton.js"></script>

    <!-- Resources -->
    <!-- <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script> -->

    <!-- Resources -->
    <!-- <script src="https://cdn.amcharts.com/lib/5/xy.js"></script> -->

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        //for project
        // var ctx2 = document.getElementById("doughnut").getContext("2d");
        // var myChart2 = new Chart(ctx2, {
        //     type: "doughnut",
        //     data: {
        //         labels: ["Pending Projects", "Completed Projects"],
        //         datasets: [{
        //             label: "Employees",
        //             data: [10, 2],
        //             backgroundColor: ["purple", "#F76C6C"],
        //             borderColor: ["white"],
        //             borderWidth: 5,
        //         }, ],
        //     },
        //     options: {
        //         responsive: true,
        //         maintainAspectRatio: false,
        //     },
        // });
    </script>


    <!-- charts script-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // LineGraph
            var projectId = [];
            var dataForLineGraph = [];
            var ctx = document.getElementById('lineChart').getContext('2d');
            var ctx = $('#lineChart')[0];
            ctx.height = 220;

            <?php foreach ($projectId as $val) : ?>
                projectId.push(<?= $val; ?>);
            <?php endforeach; ?>

            $.post("tempFunction/fetchTaskPointsForTec.php", {
                "projectID": projectId,
            }, function(response) {
                pattern = /\{(?:[^{}]*\{[^{}]*\}[^{}]*)*\}/;
                match = response.match(pattern);
                var data = JSON.parse(match[0]);
                var count = 0;
                // Object.entries(data).forEach(entry => {
                //     const [key, value] = entry;
                $.post("tempFunction/manageMarks.php", {
                    "data": data,
                }, function(response) {
                    response = JSON.parse(response);
                    console.log(response);
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            datasets: response,
                        },
                        options: {
                            responsive: true,
                            tension: 0.4
                        }
                    });
                });
            });

            // PieChart
            $.post("tempFunction/fetchMyTasksStatus.php", {
                'id': <?= $userID ?>,
            }, function(response) {
                response = $.parseJSON(response);
                if (response[0] == "Success") {
                    var pendingAndCompleted = [];
                    var label = [];
                    if (response[1]["pending"] == 0 && response[1]["completed"] == 0 && response[1]["lateSubmitted"] == 0) {
                        pendingAndCompleted = [1];
                        label = [
                            "No Assigned Yet !!",
                        ];
                    } else {
                        console.log(response[1]);
                        pendingAndCompleted = [response[1]["pending"], response[1]["completed"], response[1]["lateSubmitted"]];
                        label = [
                            "Pending Tasks",
                            "Completed Tasks",
                            "Late Submitted"
                        ];
                    }
                    loadDoughnut(pendingAndCompleted, label);
                } else if (response[0] == "Failed") {
                    swal({
                        title: "Failed to fetch task status",
                        icon: "warning",
                        closeOnClickOutside: false,
                        closeOnEsc: true,
                        timer: 3000,
                        dangerMode: false,
                    });
                }
            });

            function loadDoughnut(dataGot, label) {
                new Chart(document.getElementById('myChart'), {
                    type: 'doughnut',
                    data: {
                        labels: label,
                        datasets: [{
                            data: dataGot,
                            backgroundColor: [
                                getRandomRgb(), getRandomRgb(), getRandomRgb()
                            ],
                            hoverBackgroundColor: [
                                getRandomRgb(), getRandomRgb(), getRandomRgb()
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: false
                        }
                    },

                });
            }


        });

        function getRandomRgb() {
            const r = Math.floor(Math.random() * 256);
            const g = Math.floor(Math.random() * 256);
            const b = Math.floor(Math.random() * 256);
            const avg = (r + g + b) / 3;
            const threshold = 128;
            if (avg < threshold) {
                return `rgb(${r + threshold}, ${g + threshold}, ${b + threshold})`;
            } else {
                return `rgb(${r - threshold}, ${g - threshold}, ${b - threshold})`;
            }
        }
    </script>
</body>

</html>