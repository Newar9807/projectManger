<?php $root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];
include("usefulFunction/sessionCheck.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($root . "/5thproject/php/assets/head.php"); ?>
    <link rel="stylesheet" href="../assets/css/tstyle.css" />
    <link rel="stylesheet" href="../assets/css/project.css" />

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>Teacher</title>
    <style>
        .content-details-header {
            display: flex;
        }

        .conHead {
            /* float: left; */
            margin: 25px 0 0 77px;
        }

        .conTail {
            margin: 30px 40px 0 0;
            float: right;
        }

        .edit-btn {
            font-size: 24px;
        }

        img {

            object-fit: cover;
        }
    </style>
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
            <div class="content-section">
                <div class="content-details-header">
                    <div class="conHead content-header">
                        <h3>Project Details</h3>
                    </div>
                    <div class="conTail">
                        <a href="teacherProjects.php">
                            <button class="edit-btn"><ion-icon name="arrow-undo-outline"></ion-icon>Back</button>
                        </a>
                    </div>
                </div>

                <div class="content-details">
                    <div class="content-details-title">
                        <h2 class="projectName" style="margin-bottom: .5rem;">Project Management System</h2>
                    </div>
                    <div class="project-container">
                        <div class="project-data">
                            <div class="content-title projectData1">
                                <h3>Project Id</h3>
                                <p name="projectId" id="projectId"></p>
                            </div>
                            <div class="content-title projectData2">
                                <h3>SDLC</h3>
                                <p name="projectModel" id="projectSDLC"></p>
                            </div>

                            <div class="content-title projectData3">
                                <h3>Created</h3>
                                <p id="projectCreated"></p>
                            </div>
                            <div class="content-title projectData4">
                                <h3>Frontend</h3>
                                <p name="frontendTool" id="projectFrontend"></p>
                            </div>
                            <div class="content-title projectData5">
                                <h3>Backend</h3>
                                <p name="backendTool" id="projectBackend"></p>
                            </div>
                            <div class="content-title projectData6">
                                <h3>Status</h3>
                                <p name="projectName" id="projectStatus"></p>
                            </div>
                        </div>

                        <hr style="width:85%; margin-left:auto; margin-right:auto; margin-bottom: 2rem;">

                        <div class="project-members">
                            <h3 style="margin-bottom: 2rem;">Team Members</h3>
                            <div class="member-details">
                            </div>
                        </div>

                        <hr style="width:85%; margin-left:auto; margin-right:auto; margin-bottom: 2rem;">

                        <div class="project-description">
                            <h3>Project Abstract</h3>
                            <p class="description-box" name="projectAbstract" id="projectAbstract"></p>
                        </div>

                        <hr style="width:85%; margin-left:auto; margin-right:auto; margin-bottom: 2rem;">

                        <div class="project-progress content-title">
                            <h3>Project Progress</h3>
                            <div class="progress-graph">
                                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--end-->


    </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script> -->
    <script src="../assets/js/websiteSkeleton.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <script>
        $(document).ready(function() {
            const tmpMonth = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var xValues = [];

            $.post("tempFunction/fetchSpecificProjectDetails.php", {
                "projectID": <?= $_GET["id"] ?>,
            }, function(response) {
                response = $.parseJSON(response);
                if (response[0] == "Failed") {

                } else if (response[0] == "Success") {
                    $('.projectName').html(response[1].project_name);
                    $('#projectId').html(response[1].project_id);
                    $('#projectSDLC').html(response[1].project_sdlc);
                    $('#projectFrontend').html(response[1].project_frontend);
                    $('#projectBackend').html(response[1].project_backend);
                    $('#projectBackend').html(response[1].project_backend);
                    $('#projectAbstract').html(response[1].project_abstract);
                    $('#projectStatus').html(response[1].project_status);
                    $('#projectCreated').html("&#x1F4C6; " + response[1].project_created);
                    var htm = "";
                    Object.entries(response[2]).forEach(entry => {
                        const [key, value] = entry;
                        htm += `<div class="member">
                                    <img src="` + value.user_pic + `" alt="member image">
                                    <p>` + value.user_name + `</p>
                                    <p style="font-size: 14px;">` + value.user_email + `</p>
                                </div>`;
                    });
                    $('.member-details').empty().append(htm);

                    var dt = new Date(response[1].project_created);
                    var month = dt.getMonth();
                    var count = -1;
                    for (var i = 0; i < 8; i++) {
                        xValues[i] = tmpMonth[count + month];
                        if (month > 11) {
                            month = 0;
                            count++;
                        } else {
                            month++;
                        }
                    }
                    $.post("tempFunction/fetchTaskPoints.php", {
                        "projectID": <?= $_GET["id"]; ?>,
                    }, function(response) {
                        pattern = /\{([^}]+)\}/;
                        match = response.match(pattern);
                        var data = JSON.parse(match[0]);
                        console.log(typeof(data));
                        var sendData = [0];
                        Object.entries(data).forEach(entry => {
                            const [key, value] = entry;
                            sendData.push(value);
                        });
                        sendData.push(0);
                        console.log(sendData);
                        drawChart(xValues, sendData);
                    });
                }
            });

            function drawChart(xValues, data) {
                new Chart("myChart", {
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
                // new Chart(
                //     document.getElementById('myChart'), {
                //         type: 'line',
                //         data: {
                //             // labels: xValues.map(row => row.month),
                //             datasets: [{
                //                 data: [{
                //                     'data.key': 'one',
                //                     'data.value': 20
                //                 }, {
                //                     'data.key': 'two',
                //                     'data.value': 30
                //                 }]
                //             }]
                //         },
                //         options: {
                //             parsing: {
                //                 xAxisKey: 'data\\.key',
                //                 yAxisKey: 'data\\.value'
                //             }
                //         }
                //     }
                // );
            }



        });
    </script>

    /* Charts script */
    <script>
    </script>

</body>

</html>