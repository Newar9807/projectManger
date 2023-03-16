<?php $root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST']; ?>
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
                <h2 class="content-header">Projects</h2>
                <div class="tableArea">
                    <div class="table-header">
                    </div>
                    <table class="display" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Project Title</th>
                                <th>Team Members</th>
                                <th>SDLC</th>
                                <th>Status</th>
                                <th colspan="2">Action</th>
                                <th></th>
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
    <!-- <script src="../assets/js/teacherDashbaord.js"></script> -->



    <script>
        $(document).ready(function() {
            $.post("tempFunction/fetchForTableProjects.php", {
                "userID": <?= $userID; ?>,
            }, function(response) {
                response = JSON.parse(response);
                console.log(response);
                var result = [];
                for (var i in (response)) {
                    result.push(response[i]);
                }
                refreshTable(result);
            });

            function refreshTable(getArray) {
                $("#myTable").DataTable({
                    "data": getArray,
                    // "columnDefs": [{
                    //         "targets": 0,
                    //         "data": "id",
                    //         "sortable": false,
                    //     },
                    //     {
                    //         "targets": 1,
                    //         "data": "projectTitle",
                    //         "sortable": false,
                    //     },
                    //     {
                    //         "targets": 2,
                    //         "data": "teamMembers",
                    //         "sortable": false,
                    //     },
                    //     {
                    //         "targets": 3,
                    //         "data": "sdlc",
                    //         "sortable": false,
                    //     },
                    //     {
                    //         "targets": 4,
                    //         "data": "status",
                    //         "sortable": false,
                    //     },
                    //     /* EDIT */
                    //     {
                    //         "targets": 5,
                    //         "sortable": false,
                    //         mRender: function(data, type, row) {
                    //             return '<a class="table-edit" data-id="' + row[0] + '">EDIT</a>'
                    //         }
                    //     },
                    //     /* DELETE */
                    //     {
                    //         "targets": 5,
                    //         "sortable": false,
                    //         mRender: function(data, type, row) {
                    //             return '<a class="table-delete" data-id="' + row[0] + '">DELETE</a>'
                    //         }
                    //     },
                    // ],
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
                        /* EDIT */
                        {
                            mRender: function(data, type, row) {
                                return '<a class="table-edit" data-id="' + row[0] + '">View</a>'
                            }
                        },
                        /* DELETE */
                        {
                            mRender: function(data, type, row) {
                                return '<a class="table-delete" data-id="' + row[0] + '">Report</a>'
                            }
                        },
                    ],
                });
            }
            // var dataColumnTableDefinition = [{
            //         "targets": 0,
            //         "data": "Email",
            //         "render": function(data, type, row, meta) {
            //             console.log("0" + data + "?" + type + "?" + row + "?" + meta);
            //             // return row;
            //         }
            //     },
            //     {
            //         "targets": 1,
            //         "data": "Email",
            //         "sortable": false,
            //         "render": function(data, type, row, meta) {
            //             console.log("01" + data + "?" + type + "?" + row + "?" + meta);
            //             // return row;
            //         }
            //     },
            //     {
            //         "targets": 2,
            //         "data": "Email",
            //         "sortable": false,
            //         "render": function(data, type, row, meta) {
            //             console.log("02" + data + "?" + type + "?" + row + "?" + meta);
            //             // return row;
            //         }
            //     },
            //     {
            //         "targets": 3,
            //         "data": "Email",
            //         "sortable": false,
            //         "render": function(data, type, row, meta) {
            //             console.log("03" + data + "?" + type + "?" + row + "?" + meta);
            //             // return row;
            //         }
            //     },
            //     {
            //         "targets": 4,
            //         "data": "Email",
            //         "sortable": false,
            //         "render": function(data, type, row, meta) {
            //             console.log("04" + data + "?" + type + "?" + row + "?" + meta);
            //             // return row;
            //         }
            //     },
            //     {
            //         "targets": 5,
            //         "data": "Email",
            //         "sortable": false,
            //         "render": function(data, type, row, meta) {
            //             console.log("05" + data + "?" + type + "?" + row + "?" + meta);
            //             // return row;
            //         }
            //     },
            // ];

            // $('#myTable').DataTable({
            //     "paging": true,
            //     "processing": true,
            //     "searching": true,
            //     "info": true,
            //     "responsive": true,
            //     "serverSide": true,
            //     "columnDefs": dataColumnTableDefinition,
            //     "ajax": {
            //         'url': 'tempFunction/fetchProjects.php',
            //         'type': 'POST',
            //         'data': function(send) {
            //             send.userID = ;
            //         },
            //     },
            //     "columns": [{
            //             data: 'first_name',

            //         },
            //         {
            //             data: 'last_name'
            //         },
            //         {
            //             data: 'position'
            //         },
            //         {
            //             data: 'office'
            //         },
            //         {
            //             data: 'start_date'
            //         },
            //         {
            //             data: 'salary'
            //         },
            //     ],
            //     // "createdRow": function(row, data, dataIndex) {

            //     // }
            // });
        });
    </script>

</body>

</html>