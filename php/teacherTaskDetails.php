<?php
include("usefulFunction/docHead.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($root . "/5thproject/php/assets/head.php"); ?>
    <link rel="stylesheet" href="../assets/css/tstyle.css">
    <link rel="stylesheet" href="../assets/css/tecTaskDetails.css">

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <title>Task Details</title>

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
                <!-- <h2 class="content-header">Task Detail</h2> -->
                <div class="content-details">
                    <div class="content-details-header">
                        <h2> Task Information</h2>
                        <a href="teacherTasks.php">
                            <button class="edit-btn">
                                <ion-icon name="arrow-back-outline" style="font-size: 18px; cursor: pointer;"></ion-icon>
                                Back
                            </button>
                        </a>
                    </div>
                    <div class="project-container">
                        <div class="project-data">

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



    <script>
        $(document).ready(function() {
            $.post("tempFunction/ajaxHandler.php", {
                "taskId": <?= $_GET["id"] ?>,
                "fetchTaskDetailsTec": 1,
            }, function(response) {
                response = JSON.parse(response);
                if (response[0] == "Failed") {
                    swal({
                        title: "Failed !!",
                        icon: "error",
                        closeOnClickOutside: false,
                        closeOnEsc: true,
                        timer: 3000,
                        dangerMode: true,
                    });
                } else {
                    $('.project-data').append(response[0]);
                }
                console.log(response);
            });

            $("#fileUpload").submit(function(e) {
                console.log("e");
                e.preventDefault();

            });
        });
        // -----------fileupload------------
        // FilePond.registerPlugin(
        //     FilePondPluginImagePreview,
        //     FilePondPluginImageResize,
        //     FilePondPluginImageTransform
        // );
        // const inputElement = document.querySelector('input[type="file"]');

        // const pond = FilePond.create(inputElement, {
        //     imageResizeTargetWidth: 256,
        //     imageResizeMode: 'contain',
        // });
        // console.log(pond);
    </script>

</body>

</html>