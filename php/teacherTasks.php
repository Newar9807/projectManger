<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];
include("usefulFunction/sessionCheck.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../assets/css/tstyle.css">
    <link rel="stylesheet" href="../assets/css/project.css">
    <link rel="stylesheet" href="../assets/css/tecTask.css">
    <?php include($root . "/5thproject/php/assets/head.php"); ?>

    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

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
                <h2 class="content-header">Tasks</h2>
                <div class="tableArea">
                    <div class="table-header">
                        <button class="create-btn" id="modal-button">
                            <ion-icon name="add-outline" style="font-size: 22px; cursor: pointer"></ion-icon>Create New
                        </button>
                    </div>
                    <table class="display" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Project Name</th>
                                <th>Task Title</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Here Comes Task Details -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!--task create-->
            <div id="modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>New Task</h2>
                    <br />
                    <hr />
                    <br />
                    <form action="" id="taskModel" enctype="multipart/form-data">
                        <div class="row1">
                            <div class="input-container" id="task">
                                <span>Task Name</span>
                                <input type="text" class="text-input forEditOrView" id="taskName" name="taskName" autocomplete="off" placeholder="Enter Task Name" />

                            </div>
                            <div class="input-container" id="project">
                                <span>Projects</span>
                                <select class="select-input forEditOrView" id="projectName" name="projectName" autocomplete="off" placeholder="Select Projects">
                                </select>
                            </div>
                        </div><br>
                        <div class="row2">
                            <div class="input-container" id="model">
                                <span>Sdlc Model</span>
                                <input type="text" class="select-input forEditOrView" style="opacity:1;" id="sdlcModel" name="sdlcModel" autocomplete="off" value="SDLC" disabled />
                            </div>
                            <div class="input-container" id="phase">
                                <span>Sdlc Phase</span>
                                <select class="select-input forEditOrView" id="sdlcPhase" name="sdlcPhase" autocomplete="off" placeholder="Select Phase">
                                </select>
                            </div>
                        </div><br>
                        <div class="row3">
                            <div class="input-container" id="dDate">
                                <span>Due date</span>
                                <input type="date" class="text-input forEditOrView" id="dueDate" name="dueDate" autocomplete="off" placeholder="Enter Task Name" />
                            </div>
                            <div class="input-container" id="priority">
                                <span>Priority</span>
                                <select class="select-input forEditOrView" id="taskPriority" name="taskPriority" autocomplete="off" placeholder="Select Priority">
                                </select>
                            </div>
                        </div><br>
                        <div class="row4">
                            <div class="input-container" id="Descript">
                                <span>Description</span>
                                <textarea class="text-input forEditOrView" id="taskDescription" placeholder="Describe about task (length 10-100 words).." maxlength="100"></textarea>
                            </div>
                        </div><br>
                        <div class="row5">
                            <div class="input-container" id="attach">
                                <input type="file" class="text-input" id="fileUpload" name="fileUpload" hidden />
                                Attachments
                                <div class="img-area" data-img="">
                                    <!-- <i class="bx bxs-cloud-upload icon"></i> -->
                                    <!-- <h3>Empty</h3> -->
                                    <p>File size must be less than <span>2MB</span></p>
                                </div>
                                <!-- <button class="select-image">Attach File</button> -->
                            </div>
                            <div class="btns" id="btns">
                                <button type="submit" class="btn btn-primary" id="taskBtn" value="">Save</button>
                            </div>
                        </div>
                    </form>
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
        // const selectImage = document.querySelector(".select-image");
        // const inputFile = document.querySelector("#file");
        // const imgArea = document.querySelector(".img-area");

        // selectImage.addEventListener("click", function() {
        //     inputFile.click();
        // });

        // inputFile.addEventListener("change", function() {
        //     const image = this.files[0];
        //     if (image.size < 2000000) {
        //         const reader = new FileReader();
        //         reader.onload = () => {
        //             const allImg = imgArea.querySelectorAll("img");
        //             allImg.forEach((item) => item.remove());
        //             const imgUrl = reader.result;
        //             const img = document.createElement("img");
        //             img.src = imgUrl;
        //             imgArea.appendChild(img);
        //             imgArea.classList.add("active");
        //             imgArea.dataset.img = image.name;
        //         };
        //         reader.readAsDataURL(image);
        //     } else {
        //         alert("Image size more than 2MB");
        //     }
        // });
    </script>

    <!-- <script src="http://datatables.net/reference/api/ajax.reload()"></script> -->
    <script>
        $(document).ready(function() {
            $("#attClose").click(function() {
                console.log("hello");
            })

            const priority = `<option value>Select Priority</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>`;

            var prototype = ['Requirement Analysis', 'Quick Design', 'Building ProtoType', 'Customer Evaluation', 'Review & Update', 'Development', 'Testing', 'Maintain'],
                waterfall = ['Requirement Analysis', 'System Design', 'Implementation', 'Testing', 'Deployment', 'Maintenance'];

            const allModel = {
                'ProtoType': prototype,
                'WaterFall': waterfall,
            };

            var now = new Date();
            var day = parseInt(("0" + now.getDate()).slice(-2)) + 1;
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear() + "-" + (month) + "-" + (day);

            var projectID = new Array();
            <?php foreach ($projectId as $key => $val) : ?>
                projectID[<?= $key ?>] = <?= $val; ?>;
            <?php endforeach; ?>

            $('#modal-button').click(function() {
                $.post(
                    "tempFunction/fetchProjects.php", {
                        'userID': <?= $userID; ?>,
                        'projectID': projectID,
                    },
                    function(response) {
                        response = JSON.parse(response);
                        resetTaskForm();
                        $('#modal').css('display', 'block');
                        var htm = `<option value="0">Select Project</option>`;
                        Object.entries(response).forEach(entry => {
                            const [key, value] = entry;
                            htm += `<option value="${key}" `;
                            Object.entries(value).forEach(entry => {
                                const [key, value] = entry;
                                if (key == 0) {
                                    htm += `data-model="${value}">`;
                                } else {
                                    htm += `${value}</option>`;
                                }
                            });
                        });
                        $('#projectName').empty().append(htm);
                        $('#taskBtn').html('Save').attr('value', '0');

                        $('#dueDate').val(today).addClass('successTrack');

                        $('#taskName').focus();
                    }
                );
            });

            $('#dueDate').change(function() {
                if ($(this).val() < today) {
                    $(this).addClass("errorTrack");
                    $(this).removeClass("successTrack");
                } else {
                    $(this).removeClass("errorTrack");
                    $(this).addClass("successTrack");
                }
            });


            $('.close:eq(0)').click(function() {
                resetTaskForm();
            });

            $('#projectName').change(function() {
                if ($(this).find(':selected').val() == 0) {
                    $(this).removeClass('successTrack');
                    $(this).addClass('errorTrack');
                    $('#sdlcModel').removeClass('successTrack');
                    $('#sdlcModel').addClass('errorTrack');
                } else {
                    $(this).addClass('successTrack');
                    $(this).removeClass('errorTrack');
                    $('#sdlcModel').removeClass('errorTrack');
                    $('#sdlcModel').addClass('successTrack');
                    var model = $(this).find(':selected').data('model');
                    $('#sdlcModel').val(model);
                    htm = `<option value="0">Select Phase</option>`;
                    Object.entries(allModel).forEach(entry => {
                        const [key, value] = entry;
                        if (key == model) {
                            Object.entries(value).forEach(entry => {
                                const [key, value] = entry;
                                htm += `<option value="${value}">${value}</option>`;
                            });
                        }
                    });
                    $('#sdlcPhase').empty();
                    $('#sdlcPhase').append(htm);
                    $('#sdlcPhase').removeClass('successTrack');
                }
            });

            $('#sdlcPhase').change(function() {
                if ($(this).find(':selected').val() == 0) {
                    $(this).removeClass('successTrack');
                    $(this).addClass('errorTrack');
                } else {
                    $(this).addClass('successTrack');
                    $(this).removeClass('errorTrack');
                }
            });

            $('#taskPriority').change(function() {
                if ($(this).find(':selected').val() == 0) {
                    $(this).removeClass('successTrack');
                    $(this).addClass('errorTrack');
                } else {
                    $(this).removeClass('errorTrack');
                    $(this).addClass('successTrack');
                }
            });

            $('#taskDescription').keyup(function() {
                if ($(this).val().length < 10) {
                    $(this).removeClass('successTrack');
                    $(this).addClass('errorTrack');
                } else {
                    $(this).removeClass('errorTrack');
                    $(this).addClass('successTrack');
                }
            });

            $('#taskName').keyup(function() {
                if ($(this).val().length < 4) {
                    $(this).removeClass('successTrack');
                    $(this).addClass('errorTrack');
                } else {
                    $(this).removeClass('errorTrack');
                    $(this).addClass('successTrack');
                }
            });

            $("#taskModel").submit(function(e) {
                e.preventDefault();
                if ($('#taskModel .successTrack').length != 7) {
                    swal({
                        title: "Please check all fields",
                        icon: "warning",
                        closeOnClickOutside: false,
                        closeOnEsc: true,
                        timer: 3000,
                        dangerMode: false,
                    }).then((isOkay) => {
                        if (isOkay) {}
                    });
                } else {
                    var taskName = $('#taskName').val();
                    var projectID = $('#projectName').val();
                    var sdlcPhase = $('#sdlcPhase').val();
                    var dueDate = $('#dueDate').val();
                    var taskPriority = $('#taskPriority').val();
                    var taskDescription = $('#taskDescription').val();

                    if ($('#taskBtn').val() == 0) {
                        $.post(
                            "tempFunction/storeTasks.php", {
                                'taskName': taskName,
                                'fromID': <?= $userID; ?>,
                                'toID': projectID,
                                'sdlcPhase': sdlcPhase,
                                'taskDescription': taskDescription,
                                'taskPriority': taskPriority,
                                'dueDate': dueDate,
                            },
                            function(response) {
                                if (response == "Failed") {
                                    swal({
                                        title: "Failed !!",
                                        icon: "error",
                                        closeOnClickOutside: false,
                                        closeOnEsc: true,
                                        timer: 3000,
                                        dangerMode: true,
                                    }).then((isOkay) => {
                                        if (isOkay) {}
                                    });
                                } else if (response == "Success") {
                                    swal({
                                        title: "Saved Successfully",
                                        icon: "success",
                                        closeOnClickOutside: false,
                                        closeOnEsc: true,
                                        timer: 3000,
                                    }).then((isOkay) => {
                                        if (isOkay) {}
                                    });
                                }
                                resetTaskForm();
                                fetchTasks();
                            }
                        );
                    } else if ($('#taskBtn').val() == 1) {
                        $.post(
                            "tempFunction/updateTasks.php", {
                                'taskID': localStorage.getItem("taskID"),
                                'taskName': taskName,
                                'fromID': <?= $userID; ?>,
                                'toID': projectID,
                                'sdlcPhase': sdlcPhase,
                                'taskDescription': taskDescription,
                                'taskPriority': taskPriority,
                                'dueDate': dueDate,
                            },
                            function(response) {
                                response = $.parseJSON(response);
                                if (response == "Failed") {
                                    swal({
                                        title: "Updation Failed",
                                        icon: "error",
                                        closeOnClickOutside: false,
                                        closeOnEsc: true,
                                        timer: 3000,
                                        dangerMode: true,
                                    }).then((isOkay) => {
                                        if (isOkay) {}
                                    });
                                } else if (response == "Success") {
                                    swal({
                                        title: "Updation Successful",
                                        icon: "success",
                                        closeOnClickOutside: false,
                                        closeOnEsc: true,
                                        timer: 3000,
                                    }).then((isOkay) => {
                                        if (isOkay) {}
                                    });
                                }
                                localStorage.removeItem("taskID");
                                fetchTasks();
                                resetTaskForm();
                            }
                        );
                    }
                }
            });

            $("#myTable").on("click", "span", function() {
                localStorage.setItem("taskID", $(this).closest('tr').attr('value'));
                var action = ($(this).attr('id'));
                if (action == "delete") {
                    swal({
                        title: "Are you sure?",
                        icon: "warning",
                        closeOnClickOutside: false,
                        closeOnEsc: true,
                        timer: 3000,
                        buttons: ["Cancel", "Yes"],
                        dangerMode: true,
                    }).then((isOkay) => {
                        if (isOkay) {
                            $.post("tempFunction/deleteTasks.php", {
                                'taskID': localStorage.getItem("taskID"),
                            }, function(response) {
                                response = JSON.parse(response);
                                fetchTasks();
                            });
                        }
                    });
                } else if (action == "edit") {
                    $.post("tempFunction/getDataToEditTasks.php", {
                        'taskID': localStorage.getItem("taskID"),
                    }, function(response) {
                        response = JSON.parse(response);
                        var count = 0;
                        resetTaskForm();
                        $('#modal').css('display', 'block');
                        $('.forEditOrView').empty();

                        Object.entries(response).forEach(entry => {
                            const [key, value] = entry;
                            htm = `<option value="` + key + `">` + value + `</option>`;
                            if (count == 1) {
                                $('#taskModel .forEditOrView').eq(0).val(value);
                            } else if (count == 0) {
                                $('#taskModel .forEditOrView').eq(1).append(htm);
                            } else if (count == 2) {
                                htm1 = `<option value="0">Select Phase</option>`;
                                var tmpValue = value;
                                Object.entries(allModel).forEach(entry => {
                                    const [key, value] = entry;
                                    if (key == tmpValue) {
                                        Object.entries(value).forEach(entry => {
                                            const [key, value] = entry;
                                            htm1 += `<option value="${value}">${value}</option>`;
                                        });
                                    }
                                });
                                $('#taskModel .forEditOrView').eq(3).append(htm1);
                                $('#taskModel .forEditOrView').eq(count).val(tmpValue);
                            } else if (count % 2 == 0) {
                                $('#taskModel .forEditOrView').eq(count).val(value);
                            } else if (count == 3) {
                                $('#taskModel .forEditOrView').eq(count).val(value).change();
                            } else if (count == 5) {
                                $('#taskModel .forEditOrView').eq(count).append(priority);
                                $('#taskModel .forEditOrView').eq(count).val(value).change();
                            } else if (count < 6) {
                                $('#taskModel .forEditOrView').eq(3).append(htm);
                                // console.log($('#taskModel .forEditOrView').eq(count).html());
                            } else if (count == 6) {
                                $("#taskModel .forEditOrView").html(val);
                            }
                            count++;
                        });
                        $('#taskModel .forEditOrView').removeClass("blueSuccess");
                        $('#taskModel .forEditOrView').addClass("successTrack");
                        $('#taskBtn').html("Update");
                        $('#taskBtn').css('display', 'block');
                        $('#taskBtn').attr('value', '1');
                    });
                } else if (action == "view") {
                    window.location = "teacherTaskDetails.php?id=" + $(this).closest('tr').attr('value');

                }
            });

            window.onclick = function(event) {
                if (event.target == modal) {
                    resetTaskForm();
                }
            };

            function resetTaskForm() {
                $('#modal').css('display', 'none');
                $('#taskModel')[0].reset();
                $('#taskBtn').attr('value', '');
                $('#sdlcPhase').empty().append('<option value="0">Phase..</option>');
                $('#projectName').empty().append('<option value="0">Projects..</option>');
                $('#taskPriority').empty().append(priority);
                $("#taskModel .successTrack, .errorTrack").removeClass("successTrack errorTrack");
                $("#taskModel .blueSuccess").removeClass("blueSuccess");
                $('#taskModel .forEditOrView').prop('disabled', false);
                $('#sdlcModel').prop('disabled', true);
            }

            function fetchTasks() {
                $.post("tempFunction/fetchTasks.php", {
                    userID: <?= $userID; ?>,
                }, function(response) {
                    response = $.parseJSON(response);
                    $("#myTable").DataTable({
                        "destroy": true,
                        "data": response,
                        "paging": true,
                        "searching": true,
                        "scrollY": 425,
                        "order": [
                            [0, 'desc']
                        ],
                        "createdRow": function(row, data, dataIndex, cells) {
                            $(row).attr("value", data.taskID);
                        },
                        "columnDefs": [{
                                "targets": 0,
                                "className": "dt-center",
                                "createdCell": function(td, cellData, rowData, row, col) {
                                    $(td).html(row + 1);
                                },
                            },
                            {
                                "targets": [2, 5],
                                "sortable": false,
                            }, {
                                "targets": [0, 1, 2, 3, 4, 5],
                                "className": "dt-center",
                            }
                        ],
                        "columns": [{
                                "data": "taskID",
                            },
                            {
                                "data": "projectName"
                            },
                            {
                                "data": "taskName"
                            },
                            {
                                "data": "duration"
                            },
                            {
                                "data": "status",
                                mRender: function(data, type, row) {
                                    return `<span class="badge badge-${data.toLowerCase()}">${data}</span>`;
                                }
                            },
                            /* Action */
                            {
                                mRender: function(data, type, row) {
                                    return `<div class="actions">
                                        <span class="icon" id="view">
                                                <ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon>
                                        </span>
                                        <span class="icon" id="edit">
                                                <ion-icon name="pencil" style="color: #3cab66; font-size: 20px"></ion-icon>
                                        </span>
                                        <span class="icon" id="delete">
                                                <ion-icon name="trash-outline" style="color: #f57878; font-size: 20px"></ion-icon>
                                        </span>
                                    </div>`;
                                }
                            },
                        ],
                    });
                });
            }
            fetchTasks();
        });
    </script>

</body>

</html>