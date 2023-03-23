<?php $root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];
include("usefulFunction/sessionCheck.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($root . "/5thproject/php/assets/head.php"); ?>

    <link rel="stylesheet" href="../assets/css/stdTask.css" />
    <link rel="stylesheet" href="../assets/css/tstyle.css" />

    <title>Teacher</title>
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

            <section class="header">
                <h1 class="Task">Task </h1>
            </section>
            <div class="sectionContent">
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="../assets/js/websiteSkeleton.js"></script>
    <!-- <script src="../assets/js/stdTask.js"></script> -->

    <script>
        $(document).ready(function() {
            var prototype = ['Requirement Analysis', 'Quick Design', 'Building ProtoType', 'Customer Evaluation', 'Update', 'Development', 'Testing', 'Maintain'],
                waterfall = ['Requirement Analysis', 'System Design', 'Implementation', 'Testing', 'Deployment', 'Maintenance'];

            const allModel = {
                'ProtoType': prototype,
                'WaterFall': waterfall,
            };

            $.post("tempFunction/fetchSpecificProjectDetails.php", {
                "projectID": <?= $projectId[0]; ?>,
            }, function(response) {
                response = $.parseJSON(response);
                if (response[0] == "Failed") {

                } else if (response[0] == "Success") {
                    $.post("tempFunction/filterTasks.php", {
                        "response": response,
                    }, function(response) {
                        $('.sectionContent').append(response);
                    });
                }
            });

            $('.sectionContent').on("click", ".toggle-btn", function() {
                console.log($(this).closest('.content').children('.TableArea'));
                if ($(this).html() == '+') {
                    $(this).closest('.content').children('.TableArea').css('display', 'block');
                    $(this).html('-');
                } else {
                    $(this).closest('.content').children('.TableArea').css('display', 'none');
                    $(this).html('+');
                }
                // $(this).closest('.phase-header').removeClass('notification');
            });
            $('.sectionContent').on("click", "tr", function() {
                window.location = "studentTaskDetails.php?id="+$(this).data('id');

            });



        });
    </script>


</body>

</html>