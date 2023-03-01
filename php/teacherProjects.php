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
    <script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#myTable").DataTable();
        });
    </script>

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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Jacob</td>
                                <td>
                                    Sarowar <br />
                                    Samir <br />
                                </td>
                                <td>Lean</td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon"><a href="teacherProjectDetails.php"><ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon></a></span>
                                        <!-- <span class="icon "><a href="#"><ion-icon name="pencil"
                          style="color:#3cab66; font-size:20px;"></ion-icon></a></span>
                    <span class="icon "><button type="submit" class="delete" id="delete"
                        style="cursor:pointer"><ion-icon name="trash-outline"
                          style="color: #f57878; font-size:20px;"></ion-icon></button></span> -->
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Jacob</td>
                                <td>
                                    Sarowar <br />
                                    Samir <br />
                                </td>
                                <td>Spiral</td>
                                <td>
                                    <span class="badge badge-completed"> Completed </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon"><a href="#"><ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon></a></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Jacob</td>
                                <td>
                                    Sarowar <br />
                                    Samir <br />
                                </td>
                                <td>Agile</td>
                                <td>
                                    <span class="badge badge-completed"> Completed </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon"><a href="#"><ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon></a></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Jacob</td>
                                <td>
                                    Sarowar <br />
                                    Samir <br />
                                </td>
                                <td>Agile</td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>

                                <td>
                                    <div class="actions">
                                        <span class="icon"><a href="#"><ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon></a></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>sarowar</td>
                                <td>Thornton</td>
                                <td>Waterfall</td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon"><a href="#"><ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon></a></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>sarowar</td>
                                <td>Thornton</td>
                                <td>Spiral</td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon"><a href="#"><ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon></a></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>sarowar</td>
                                <td>Thornton</td>
                                <td>Spiral</td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon"><a href="#"><ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon></a></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>sarowar</td>
                                <td>Thornton</td>
                                <td>Agile</td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon"><a href="#"><ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon></a></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>sarowar</td>
                                <td>Thornton</td>
                                <td>Waterfall</td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon"><a href="#"><ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon></a></span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!--end-->


        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="../assets/js/teacherDashbaord.js"></script>
    

</body>

</html>