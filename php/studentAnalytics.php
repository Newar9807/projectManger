<?php $root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST']; ?>
<!DOCTYPE html>
<html lang="en">

<head>
<<<<<<< Updated upstream
    <?php include($root . "/5thproject/php/assets/head.php"); ?>
=======
    <?php include($root . "/finalProject/php/assets/head.php"); ?>
    <link rel="stylesheet" href="../assets/css/tstyle.css" />
    <link rel="stylesheet" href="../assets/css/project.css" />
>>>>>>> Stashed changes

    <title>Teacher</title>
</head>

<body>
    <div class="container">
        <!-- Sidebar Starts -->
<<<<<<< Updated upstream
        <?php include($root . "/5thproject/php/assets/stdSidebar.php"); ?>
        <!-- Sidebar Ends -->
        <div class="main">
            <!-- Navigation Starts -->
            <?php include($root . "/5thproject/php/assets/tecNav.php"); ?>
            <!-- Navigation Ends -->
            <div>
                Studnet Analytics
=======
        <?php include($root . "/finalProject/php/assets/stdSidebar.php"); ?>
        <!-- Sidebar Ends -->
        <div class="main">
            <!-- Navigation Starts -->
            <?php include($root . "/finalProject/php/assets/tecNav.php"); ?>
            <!-- Navigation Ends -->

            <!-- mid div start -->
            <div class="content-section">
                <div class="content-details-header">
                    <div class="conHead content-header">
                        <h3>Project Details</h3>
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
>>>>>>> Stashed changes
            </div>


        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="../assets/js/websiteSkeleton.js"></script>
    


</body>

</html>