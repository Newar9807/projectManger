<?php
include("usefulFunction/docHead.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($root . "/5thproject/php/assets/head.php"); ?>
    <link rel="stylesheet" href="../assets/css/tstyle.css" />
    <link rel="stylesheet" href="../assets/css/project.css" />

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- <script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

    <style>
        .table thead,
        .table th {
            text-align: center;
            align-items: center;
        }
    </style>
    <title>Projects</title>
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
                <h2 class="content-header">Projects</h2>
                <div class="tableArea">
                    <div class="table-header">
                    </div>
                    <table class="display table" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Project Title</th>
                                <th>Team Members</th>
                                <th>SDLC</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
            $('#myTable').on("click", ".icon", function() {
                if (this.id == "view") {
                    var id = $(this).closest('tr').attr("value");
                    window.location.href = "teacherProjectDetails.php?id=" + id;
                } else if (this.id == "report") {
                    swal({
                        title: "Report this project ?",
                        icon: "warning",
                        closeOnClickOutside: false,
                        closeOnEsc: true,
                        timer: 3000,
                        buttons: ["Cancel", "Yes"],
                        dangerMode: false,
                    }).then((isOkay) => {
                        if (isOkay) {
                            console.log("yes");
                        }
                    });
                }
            });

            $.post("tempFunction/ajaxHandler.php", {
                "userID": <?= $userID; ?>,
                'fetchForTableProjects': 1,
            }, function(response) {
                response = JSON.parse(response);
                var result = [];
                for (var i in (response)) {
                    result.push(response[i]);
                }
                refreshTable(result);
            });

            function refreshTable(getArray) {
                $("#myTable").DataTable({
                    "destroy": true,
                    "data": getArray,
                    "paging": true,
                    "searching": true,
                    "scrollY": 510,
                    "order": [
                        [0, 'asc']
                    ],
                    "createdRow": function(row, data, dataIndex, cells) {
                        $(row).attr("value", data.id);
                    },
                    "columnDefs": [{
                            "targets": 0,
                            "className": "dt-body-center",
                            "createdCell": function(td, cellData, rowData, row, col) {
                                $(td).html(row + 1);
                            },
                        },
                        {
                            "targets": [1, 2, 3, 4, 5],
                            "className": "dt-center",
                        },
                        {
                            "targets": [2, 5],
                            "sortable": false,
                        },
                    ],
                    "columns": [{
                            "data": "id",
                        },
                        {
                            "data": "projectTitle"
                        },
                        {
                            "data": "teamMembers"
                        },
                        {
                            "data": "sdlc"
                        },
                        {
                            "data": "status"
                        },
                        /* Action */
                        {
                            mRender: function(data, type, row) {
                                return `<div class="actions">
                                        <span class="icon" id="view">
                                                <ion-icon name="eye-outline" style="color: grey; font-size: 22px; cursor: pointer;"></ion-icon>
                                        </span>
                                        <span class="icon" id="report">
                                                <ion-icon name="warning-outline" style="color: #f57878; font-size: 22px; cursor: pointer;"></ion-icon>
                                        </span>
                                    </div>`;
                            }
                        },
                    ],
                });
            }
        });
    </script>

</body>

</html>