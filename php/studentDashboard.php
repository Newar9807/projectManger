<?php $root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];
include("usefulFunction/sessionCheck.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($root . "/5thproject/php/assets/head.php"); ?>

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
            <div>
                Student Dashboard
            </div>

        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="../assets/js/websiteSkeleton.js"></script>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>

</body>

</html>