<?php $root = $_SERVER['DOCUMENT_ROOT'];?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($root."/5thproject/php/assets/head.php"); ?>

    <title>Teacher</title>
</head>

<body>
    <div class="container">
        <!-- Sidebar Starts -->
        <?php include($root."/5thproject/php/assets/tecSidebar.php"); ?>
        <!-- Sidebar Ends -->
        <div class="main">
            <!-- Navigation Starts -->
            <?php include($root."/5thproject/php/assets/tecNav.php"); ?>
            <!-- Navigation Ends -->

            <!-- mid div start -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers" id="ProjectNumber" name="ProjectNumber">
                            12
                        </div>
                        <div class="cardName">
                            Projects
                        </div>
                    </div>
                    <div class="doughChart">
                        <canvas id="doughnut"></canvas>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers" id="TaskNumber" name="TaskNumber">
                            20
                        </div>
                        <div class="cardName" id="Task">
                            Tasks
                        </div>
                    </div>
                    <div class="doughChart">
                        <canvas id="doughnut2"></canvas>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers" id="completedTaskNumber" name="completedTaskNumber">
                            10
                        </div>
                        <div class="cardName">
                            Meetings
                        </div>
                    </div>
                    <div class="doughChart">
                        <canvas id="doughnut3"></canvas>
                    </div>
                </div>
            </div>
            <!-- mid div end -->

            <!-- data charts -->
            <div class="charts">
                <div class="chart">
                    <h2>Project Progress</h2>
                    <div>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>

            </div>
            <!-- data charts ends -->

        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="../assets/js/teacherDashbaord.js"></script>

</body>

</html>