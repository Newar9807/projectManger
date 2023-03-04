<?php $root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST']; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($root . "/5thproject/php/assets/head.php"); ?>
    <link rel="stylesheet" href="../assets/css/tstyle.css" />
    <link rel="stylesheet" href="../assets/css/project.css" />

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
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
            <div class="content-section">
                <div class="content-details-header">
                    <h2 class="content-header">Project Details</h2>
                    <a href="teacherProjects.php">
                        <button class="edit-btn"><ion-icon name="arrow-undo-outline"></ion-icon>Back</button>
                    </a>
                </div>

                <div class="content-details">
                    <div class="content-details-title">
                        <h2>Project Management System</h2>
                    </div>
                    <div class="project-container">
                        <div class="project-data">
                            <div class="content-title projectData1">
                                <h3>Project Id</h3>
                                <p name="projectId">101</p>
                            </div>
                            <div class="content-title projectData2">
                                <h3>Project Name</h3>
                                <p name="projectName">Project Manager</p>
                            </div>
                            <div class="content-title projectData3">
                                <h3>SDLC</h3>
                                <p name="projectModel">WaterFall Model</p>
                            </div>

                            <div class="content-title projectData4">
                                <h3>Duration</h3>
                                <p><ion-icon name="calendar-outline"></ion-icon>Start Date: 2023-01-22<br></p>
                            </div>
                            <div class="content-title projectData5">
                                <h3>Frontend</h3>
                                <p name="frontendTool">HTML/CSS <br> Javascript</p>
                            </div>
                            <div class="content-title projectData6">
                                <h3>Backend</h3>
                                <p name="backendTool">PHP <br> MySQL</p>
                            </div>
                        </div>

                        <hr style="width:85%; margin-left:auto; margin-right:auto; margin-bottom: 2rem;">

                        <div class="project-members">
                            <h3 style="margin-bottom: 2rem;">Team Members</h3>
                            <div class="member-details">
                                <div class="member">
                                    <img src="avatar1.png" alt="member image">
                                    <p>Sarowar</p>
                                    <p style="font-size: 14px;">Frontend Developer</p>
                                </div>

                                <div class="member">
                                    <img src="avatar3.png" alt="member image">
                                    <p>Samir</p>
                                    <p style="font-size: 14px;">Backend Developer</p>
                                </div>

                            </div>
                        </div>

                        <hr style="width:85%; margin-left:auto; margin-right:auto; margin-bottom: 2rem;">

                        <div class="project-description">
                            <h3>Project Abstract</h3>
                            <p class="description-box" name="projectAbstract">Project Manager is the application to manage projects.</p>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="../assets/js/teacherDashbaord.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    /* Charts script */
    <script>
        var xValues = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct","Nov","Dec"];

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478],
                    borderColor: "red",
                    fill: false
                },]
            },
            options: {
                legend: { display: false }
            }
        });
    </script>

</body>

</html>