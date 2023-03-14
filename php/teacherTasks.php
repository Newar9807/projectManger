<?php $root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST']; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($root . "/5thproject/php/assets/head.php"); ?>
    <link rel="stylesheet" href="../assets/css/tstyle.css">
    <link rel="stylesheet" href="../assets/css/project.css">
    <link rel="stylesheet" href="../assets/css/tecTask.css">

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
                <h2 class="content-header">Tasks</h2>
                <div class="tableArea">
                    <div class="table-header">
                        <a href="#">
                            <button class="create-btn" id="modal-button">
                                <ion-icon name="add-outline" style="font-size: 22px; cursor: pointer"></ion-icon>Create New
                            </button>
                        </a>
                    </div>
                    <table class="display" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Project</th>
                                <th>Task Name</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>
                                    2023-01-22 <br />
                                    2023-03-20 <br />
                                </td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon">
                                            <a href="#" id="modal-button">
                                                <ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <a href="#">
                                                <ion-icon name="pencil" style="color: #3cab66; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <button type="submit" id="delete" class="delete" style="cursor: pointer">
                                                <ion-icon name="trash-outline" style="color: #f57878; font-size: 20px"></ion-icon>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>
                                    2023-01-22 <br />
                                    2023-03-20 <br />
                                </td>
                                <td>
                                    <span class="badge badge-completed"> Completed </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon">
                                            <a href="taskShow.html">
                                                <ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <a href="#">
                                                <ion-icon name="pencil" style="color: #3cab66; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <button type="submit" id="delete" class="delete" style="cursor: pointer">
                                                <ion-icon name="trash-outline" style="color: #f57878; font-size: 20px"></ion-icon>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>
                                    2023-01-22 <br />
                                    2023-03-20 <br />
                                </td>
                                <td>
                                    <span class="badge badge-completed"> Completed </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon">
                                            <a href="taskShow.html">
                                                <ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <a href="#">
                                                <ion-icon name="pencil" style="color: #3cab66; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <button type="submit" id="delete" class="delete" style="cursor: pointer">
                                                <ion-icon name="trash-outline" style="color: #f57878; font-size: 20px"></ion-icon>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>
                                    2023-01-22 <br />
                                    2023-03-20 <br />
                                </td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>

                                <td>
                                    <div class="actions">
                                        <span class="icon">
                                            <a href="taskShow.html">
                                                <ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <a href="#">
                                                <ion-icon name="pencil" style="color: #3cab66; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <button type="submit" id="delete" class="delete" style="cursor: pointer">
                                                <ion-icon name="trash-outline" style="color: #f57878; font-size: 20px"></ion-icon>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>
                                    2023-01-22 <br />
                                    2023-03-20 <br />
                                </td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon">
                                            <a href="taskShow.html">
                                                <ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <a href="#">
                                                <ion-icon name="pencil" style="color: #3cab66; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <button type="submit" id="delete" class="delete" style="cursor: pointer">
                                                <ion-icon name="trash-outline" style="color: #f57878; font-size: 20px"></ion-icon>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>sarowar</td>
                                <td>Thornton</td>
                                <td>
                                    2023-01-22 <br />
                                    2023-03-20 <br />
                                </td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon">
                                            <a href="taskShow.html">
                                                <ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <a href="#">
                                                <ion-icon name="pencil" style="color: #3cab66; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <button type="submit" id="delete" class="delete" style="cursor: pointer">
                                                <ion-icon name="trash-outline" style="color: #f57878; font-size: 20px"></ion-icon>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>sarowar</td>
                                <td>Thornton</td>
                                <td>
                                    2023-01-22 <br />
                                    2023-03-20 <br />
                                </td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon">
                                            <a href="#">
                                                <ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <a href="#">
                                                <ion-icon name="pencil" style="color: #3cab66; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <button type="submit" id="delete" class="delete" style="cursor: pointer">
                                                <ion-icon name="trash-outline" style="color: #f57878; font-size: 20px"></ion-icon>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>sarowar</td>
                                <td>Thornton</td>
                                <td>
                                    2023-01-22 <br />
                                    2023-03-20 <br />
                                </td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon">
                                            <a href="taskShow.html">
                                                <ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <a href="#">
                                                <ion-icon name="pencil" style="color: #3cab66; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <button type="submit" id="delete" class="delete" style="cursor: pointer">
                                                <ion-icon name="trash-outline" style="color: #f57878; font-size: 20px"></ion-icon>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>sarowar</td>
                                <td>Thornton</td>
                                <td>
                                    2023-01-22 <br />
                                    2023-03-20 <br />
                                </td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon">
                                            <a href="taskShow.html">
                                                <ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <a href="#">
                                                <ion-icon name="pencil" style="color: #3cab66; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <button type="submit" id="delete" class="delete" style="cursor: pointer">
                                                <ion-icon name="trash-outline" style="color: #f57878; font-size: 20px"></ion-icon>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>sarowar</td>
                                <td>Thornton</td>
                                <td>
                                    2023-01-22 <br />
                                    2023-03-20 <br />
                                </td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon">
                                            <a href="taskShow.html">
                                                <ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <a href="#">
                                                <ion-icon name="pencil" style="color: #3cab66; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <button type="submit" id="delete" class="delete" style="cursor: pointer">
                                                <ion-icon name="trash-outline" style="color: #f57878; font-size: 20px"></ion-icon>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>sarowar</td>
                                <td>Thornton</td>
                                <td>
                                    2023-01-22 <br />
                                    2023-03-20 <br />
                                </td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon">
                                            <a href="taskShow.html">
                                                <ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <a href="#">
                                                <ion-icon name="pencil" style="color: #3cab66; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <button type="submit" id="delete" class="delete" style="cursor: pointer">
                                                <ion-icon name="trash-outline" style="color: #f57878; font-size: 20px"></ion-icon>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>sarowar</td>
                                <td>Thornton</td>
                                <td>
                                    2023-01-22 <br />
                                    2023-03-20 <br />
                                </td>
                                <td>
                                    <span class="badge badge-pending"> Pending </span>
                                </td>
                                <td>
                                    <div class="actions">
                                        <span class="icon">
                                            <a href="taskShow.html">
                                                <ion-icon name="eye-outline" style="color: grey; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <a href="#">
                                                <ion-icon name="pencil" style="color: #3cab66; font-size: 20px"></ion-icon>
                                            </a>
                                        </span>
                                        <span class="icon">
                                            <button type="submit" id="delete" class="delete" style="cursor: pointer">
                                                <ion-icon name="trash-outline" style="color: #f57878; font-size: 20px"></ion-icon>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            </tr>
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
                    <form action="">
                        <div class="row1">
                            <div class="input-container" id="task">
                                <span>Task Name</span>
                                <input type="text" class="text-input" id="taskName" name="taskName" autocomplete="off" placeholder="Enter Task Name" />

                            </div>
                            <div class="input-container" id="project">
                                <span>Projects</span>
                                <select class="select-input" id="projectName" name="projectName" autocomplete="off" placeholder="Select Projects">
                                    <option value>Select Project</option>
                                    <option>RKS</option>
                                    <option>RMS</option>
                                    <option>DMS</option>
                                    <option>CMS</option>
                                    <option>PMS</option>
                                </select>
                            </div>
                        </div><br>
                        <div class="row2">
                            <div class="input-container" id="model">
                                <span>Sdlc Model</span>
                                <select class="select-input" id="sdlcModel" name="sdlcModel" autocomplete="off" placeholder="Select Sdlc Model">
                                    <option value="1">Prototype</option>
                                    <option value="2">Spiral</option>
                                    <option value="3">Waterfall</option>

                                </select>
                            </div>
                            <div class="input-container" id="phase">
                                <span>Sdlc Phase</span>
                                <select class="select-input" id="sdlcPhase" name="sdlcPhase" autocomplete="off" placeholder="Select Phase">
                                    <option value>Select Phase</option>
                                    <option value="1">Planning</option>
                                    <option value="2">Analysis</option>
                                    <option value="3">Design</option>
                                    <option value="4">Development</option>
                                    <option value="5">Testing</option>
                                    <option value="6">Implementation</option>
                                    <option value="7">Maintenance</option>
                                </select>
                            </div>
                        </div><br>
                        <div class="row3">
                            <div class="input-container" id="dDate">
                                <span>Due date</span>
                                <input type="date" class="text-input" id="dueDate" name="dueDate" autocomplete="off" placeholder="Enter Task Name" />

                            </div>
                            <div class="input-container" id="priority">
                                <span>Priority</span>
                                <select class="select-input" id="taskPriority" name="taskPriority" autocomplete="off" placeholder="Select Priority">
                                    <option value>Select Priority</option>
                                    <option value="1">High</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Low</option>

                                </select>
                            </div>
                        </div><br>
                        <div class="row4">
                            <div class="input-container" id="Descript">
                                <span>Description</span>
                                <textarea class="text-input"></textarea>

                            </div>
                        </div><br>
                        <div class="row5">
                            <div class="input-container" id="attach">
                                <span>Attachments</span>
                                <input type="file" class="text-input" id="fileUpload" name="fileUpload" />

                            </div>
                            <div class="btns" id="btns">
                                <button type="submit" class="btn btn-primary" id="taskBtn">Save</button>

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="../assets/js/teacherDashbaord.js"></script>

    <!-- Sarowor Work -->
    <script>
        //menutoggle
        let toggle = document.querySelector(".toggle");
        let navigation = document.querySelector(".navigation");
        let main = document.querySelector(".main");
        toggle.onclick = function() {
            navigation.classList.toggle("active");
            main.classList.toggle("active");
        };

        //add hovered class
        let list = document.querySelectorAll(".navigation li");

        function activelink() {
            list.forEach((item) => item.classList.remove("hovered"));
            this.classList.add("hovered");
        }
        list.forEach((item) => item.addEventListener("mouseover", activelink));

        //for profile dropdown
    </script>
    <script>
        let subMenu = document.getElementById("subMenu");

        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
            console.log("hello");
        }

        //delete row

        var table = $("#myTable").DataTable({
            columns: [
                null,
                null,
                null,
                null,
                null,
                {
                    sortable: false,
                },
            ],
        });

        $("#myTable").on("click", "button", function() {
            swal({
                title: "Are you sure?",
                icon: "warning",
                buttons: ["Cancel", "Yes"],
                dangerMode: true,
            }).then((isOkay) => {
                if (isOkay) {
                    table.row($(this).parents("tr")).remove().draw(false);
                }
            });
        });
    </script>

    <script>
        //for notification
        let subMenu2 = document.getElementById("notifiWrap");

        function testnoti() {
            subMenu2.classList.toggle("open-noti");
            console.log("hello1");
        }
    </script>
    <!-- This is to open model -->
    <script>
        var modal = document.getElementById("modal");

        // Get the button that opens the modal
        var modalButton = document.getElementById("modal-button");

        // Get the close button
        var closeButton = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        modalButton.onclick = function() {
            modal.style.display = "block";
        };

        // When the user clicks on the close button, close the modal
        closeButton.onclick = function() {
            modal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    </script>


</body>

</html>