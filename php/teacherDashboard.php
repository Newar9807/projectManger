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

    <title>Teacher</title>
</head>

<body>
    <div class="container">
        <!-- Sidebar Starts -->
        <?php include($root . "/5thproject/php/assets/tecSidebar.php"); ?>
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

    <script type="text/javascript">
        $(document).ready(function() {
            $.post("tempFunction/fetchMyTasksStatus.php", {
                'id': <?= $userID ?>,
            }, function(response) {
                response = $.parseJSON(response);
                if (response[0] == "Success") {
                    var pendingAndCompleted = [response[1]["pending"], response[1]["completed"]];
                    loadDoughnut(pendingAndCompleted);
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

            function loadDoughnut(dataGot) {
                new Chart(document.getElementById('myChart'), {
                    type: 'doughnut',
                    data: {
                        labels: [
                            "Pending Tasks",
                            "Completed Tasks",

                        ],
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
                            display: false
                        }
                    },

                });
            }
        });
    </script>

    <!-- charts script-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script>
        //charts
        var ctx = document.getElementById('lineChart').getContext('2d');
        var ctx = $('#lineChart')[0];
        ctx.height = 220;
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                        label: "PMS",
                        // data: [2050, 1900, 2100, 2700, 2800, 2010, 2200, 2400, 2950, 1900, 2300, 2900],
                        data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478],
                        backgroundColor: [
                            'rgb(41,155,99)'
                        ],
                        borderColor: 'rgb(41, 155, 99)',
                        borderWidth: 3
                    },
                    {
                        label: "E-Commerce",
                        // data: [2050, 1700, 2200, 2800, 1800, 2000, 2500, 2600, 2450, 1950, 2300, 2900],
                        data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478],
                        backgroundColor: [
                            'grey'
                        ],
                        borderColor: 'grey',
                        borderWidth: 3
                    },
                    {
                        label: "ParaFashion",
                        // data: [2050, 1900, 2100, 2700, 2800, 2010, 2200, 2400, 2950, 1900, 2300, 2900],
                        data: [300, 700, 2000, 5000, 6000, 4000, 2000, 1000, 200, 100],
                        backgroundColor: [
                            'pink'
                        ],
                        borderColor: 'pink',
                        borderWidth: 3
                    },
                    {
                        label: "SabKoBazar",
                        data: [2050, 1900, 2100, 2700, 2800, 2010, 2200, 2400, 2950, 200, 2300, 900],

                        backgroundColor: [
                            'blue'
                        ],
                        borderColor: 'blue',
                        borderWidth: 3
                    },
                    {
                        label: "CMS",
                        data: [2050, 1900, 2100, 2700, 2800, 2010, 2200, 2400, 2950, 1900, 2300, 2900],

                        backgroundColor: [
                            'red'
                        ],
                        borderColor: 'red',
                        borderWidth: 3
                    },
                ]
            },
            options: {
                responsive: true,
                tension: 0.4

            }
        });
        // const config = {
        //     type: 'line',
        //     data: data,
        //     options: {
        //         responsive: true,
        //         plugins: {
        //             title: {
        //                 display: true,
        //                 text: 'Suggested Min and Max Settings'
        //             }
        //         },
        //         scales: {
        //             y: {
        //                 // the data minimum used for determining the ticks is Math.min(dataMin, suggestedMin)
        //                 suggestedMin: 30,

        //                 // the data maximum used for determining the ticks is Math.max(dataMax, suggestedMax)
        //                 suggestedMax: 50,
        //             }
        //         }
        //     },
        // };
        // </block:config>

        // module.exports = {
        //     config: config,
        // };
    </script>


</body>

</html>