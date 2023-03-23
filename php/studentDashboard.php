<?php $root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];
include("usefulFunction/sessionCheck.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($root . "/5thproject/php/assets/head.php"); ?>

    <link rel="stylesheet" href="../assets/css/tstyle.css" />
    <!-- <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" /> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <title>Dashboard</title>
</head>

<body>
    <div class="container">
        <!-- Sidebar Starts -->
        <?php include($root . "/5thproject/php/assets/stdSidebar.php"); ?>
        <!-- Sidebar Ends -->
        <div class="main">
            <!-- Navigation Starts -->
            <?php include($root . "/5thproject/php/assets/tecNav.php"); ?>
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

    <script type="text/javascript">
        $(document).ready(function() {
            // Doughnut
            $.post("tempFunction/fetchMyTasksStatus.php", {
                'projectId': <?= $projectId[0] ?>,
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
                                "#FF6283",
                                "#36A2EB",
                                "#FFCC54"
                            ],
                            hoverBackgroundColor: [
                                "#FF6283",
                                "#36A2EB",
                                "#FFCC54"
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: true
                        }
                    },

                });
            }

            // line charts script
            const tmpMonth = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var xValues = [];

            $.post("tempFunction/fetchSpecificProjectDetails.php", {
                "projectID": <?= $projectId[0]; ?>,
            }, function(response) {
                response = $.parseJSON(response);
                // console.log(response);
                if (response[0] == "Failed") {

                } else if (response[0] == "Success") {

                    // console.log(response[1]);
                    var dt = new Date(response[1].project_created);
                    var month = dt.getMonth();
                    var count = -1;
                    for (var i = 0; i < 7; i++) {
                        xValues[i] = tmpMonth[count + month];
                        if (month > 11) {
                            month = 0;
                            count++;
                        } else {
                            month++;
                        }
                    }

                    $.post("tempFunction/fetchTaskPoints.php", {
                        "projectID": <?= $projectId[0]; ?>,
                    }, function(response) {
                        console.log(response);
                        pattern = /\{([^}]+)\}/;
                        match = response.match(pattern);
                        var data = JSON.parse(match[0]);
                        console.log(typeof(data));
                        var sendData = [0];
                        Object.entries(data).forEach(entry => {
                            const [key, value] = entry;
                            sendData.push(value);
                        });
                        drawChart(xValues, sendData);
                    });

                    

                }
            });

            function drawChart(xValues, data) {
                console.log(xValues);
                var ctx = document.getElementById('lineChart').getContext('2d');
                var ctx = $('#lineChart')[0];
                ctx.height = 220;
                var myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: xValues,
                        datasets: [{
                            data: data,
                            borderColor: "green",
                            fill: false
                        }, ]
                    },
                    options: {
                        legend: {
                            display: false
                        }
                    }
                });

            }
        });
    </script>

</body>

</html>