<?php $root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];
include("usefulFunction/sessionCheck.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($root . "/5thproject/php/assets/head.php"); ?>

    <link rel="stylesheet" href="../assets/css/tstyle.css" />
    <link rel="stylesheet" href="../assets/css/stdTaskDetails.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />

    <title>Studnet</title>
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
            <div class="content-section">
                <h2 class="content-header">Task Details</h2>
                <div class="content-details">
                    <div class="content-details-header">
                        <h2>Information</h2>
                        <a href="studentTasks.php">
                            <button class="edit-btn">
                                <ion-icon name="arrow-back-outline" style="font-size: 18px; cursor: pointer;"></ion-icon>
                                Back
                            </button>
                        </a>
                    </div>
                    <div class="project-container">
                        <div class="project-data">
                            <div class="project-data1">
                            </div>
                            <div class="project-upload">
                                <div class="upload-section content-title">
                                    <h3 style="text-align: center;">Upload file related to task</h3>
                                    <div class="upload-container">
                                        <form action="tempFunction/uploadStdFiles.php" method="post" id="fileUpload" enctype="multipart/form-data">
                                            <div class="upload-dropbox">
                                                <input type="file" class="filepond" id="file" name="file[]" accept=".jpg, .jpeg, .docx, .pdf" data-max-file-size="3MB" multiple>
                                            </div>
                                            <!-- <button type="submit" class="submit-btn">Submit</button> -->
                                        </form>
                                    </div>
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
    <script src="../assets/js/websiteSkeleton.js"></script>
    <!-- <script src="../assets/js/stdTask.js"></script> -->

    <!---------------new added------------->
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

    <script>
        $(document).ready(function() {
            // -----------fileupload------------
            FilePond.registerPlugin(
                FilePondPluginImageTransform
            );
            FilePond.setOptions({
                allowDrop: true,
                allowReplace: false,
                instantUpload: true,
            });
            inputElement = document.querySelector('input[type="file"]');

            FilePond.create(inputElement, {
                server: 'tempFunction/uploadStdFiles.php?id=' + <?= $_GET["id"] ?>,
            });
            // var inputElement = document.querySelector('input[type="file"]');
            // var pond = FilePond.create(inputElement);
            // console.log(pond);
            // normal js ends

            $.post("tempFunction/fetchTaskDetails.php", {
                "taskId": <?= $_GET["id"] ?>
            }, function(response) {
                response = JSON.parse(response);
                $('.project-data1').append(response[0]);
                if (response[1] == "Pending") {
                    $('.upload-section').css('display', 'block');
                } else {
                    $('.upload-section').css('display', 'none');
                    // $('.project-upload').html("Submitted");
                }

            });

            $("#fileUpload").submit(function(e) {
                console.log("e");
                e.preventDefault();

            });
        });
    </script>

    <script>

    </script>
</body>

</html>