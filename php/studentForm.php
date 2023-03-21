<?php
include("assets/dbCon.php");
$root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];
if (isset($_GET["id"])) :
    $_SESSION["userId"] = $_GET["id"];
else :
    $_SESSION["userId"] = 0;
    return;
endif;
$userID = $_SESSION['userId'];
$sql = "SELECT count(`ext_project_id`) AS 'check' FROM `tbl_ext_user` WHERE `ext_user_id` = '{$userID}'";

if (mysqli_query($conn, $sql)) :
    $res = mysqli_query($conn, $sql);
    while ($got = mysqli_fetch_assoc($res)) :
        if ($got["check"] == 1) :
            echo "<script> window.location = 'studentDashboard.php?id=$userID';</script>";
            return;
        endif;
    endwhile;
else :
// Query Execution Error
// $_SESSION["projectId"] = 0;
endif;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .input-container {
            width: 280px;
            position: relative;
        }

        .text-input {
            padding: 0.8rem;
            width: 100%;
            height: 70%;
            border: 2px solid #382f26;
            border-radius: 5px;
            font-size: 18px;
            outline: none;
            transition: all 0.3s;
        }

        .select-input {
            padding: 0.8rem;
            width: 100%;
            height: 70%;
            border: 2px solid #382f26;
            border-radius: 5px;
            font-size: 18px;
            outline: none;
            transition: all 0.3s;
        }

        /* .text-input:focus {
            border: 2px solid #287bff;
        }

        .select-input:focus {
            border: 2px solid #287bff;
        } */

        /* .text-input:focus+.label,.filled{
        top: -15px;
        color: #333333;
        font-size: 14px;
      } */
        .text-input::placeholder {
            font-size: 16px;
            opacity: 0;
            transition: all 0.3s;
        }

        .text-input:focus::placeholder {
            opacity: 1;
            animation-delay: 0.2s;
        }

        .select-input::placeholder {
            font-size: 16px;
            opacity: 0;
            transition: all 0.3s;
        }

        .slect-input:focus::placeholder {
            opacity: 1;
            animation-delay: 0.2s;
        }

        .loader {
            text-align: center;
            height: 40px;
            width: 100%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            position: absolute;
        }

        .loader span {
            font-size: 1.5rem;
            font-weight: 700;
            transform: translateZ(-100%);
            display: inline-block;
            color: #44bd32;
            animation: animate 8s infinite;
            transition: all 0.8s;
        }

        .loader span:nth-child(1) {
            animation-delay: 0.3s;
        }

        .loader span:nth-child(2) {
            animation-delay: 0.4s;
        }

        .loader span:nth-child(3) {
            animation-delay: 0.5s;
        }

        .loader span:nth-child(4) {
            animation-delay: 0.6s;
        }

        .loader span:nth-child(5) {
            animation-delay: 0.7s;
        }

        .loader span:nth-child(6) {
            animation-delay: 0.6s;
        }

        .loader span:nth-child(7) {
            animation-delay: 0.7s;
        }

        @keyframes animate {
            0% {
                color: rgb(245, 20, 20);
                transform: translateY(0);
                margin-left: 0;
            }

            25% {
                transform: translateY(-15%);
                margin-left: 10px;
                text-shadow: 0 15px 5px rgba(0, 0, 0, 1);
            }

            100% {
                color: rgb(0, 0, 0);
                transform: translateY(0);
                margin-left: 0;
            }
        }

        #taskBtn {
            margin-top: 30px;
            width: 200px;
            margin-left: 40px;
            /* border-radius: 10px; */
            height: 40px;
            background-color: #287bff;
            color: #fefefe;
            border: #287bff;
            cursor: pointer;
        }
    </style>

    <?php include($root . "/5thproject/php/assets/head.php"); ?>

    <link rel="stylesheet" href="../assets/css/tstyle.css" />


    <title>Abstract</title>
</head>

<body>
    <div class="container">
        <div class="navigation" id="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="logo-snapchat"></ion-icon></span>
                        <span class="title">Project Manager</span>
                    </a>
                </li>
            </ul>
            <div class="loader">
                <span>Please</span>
                <span>Fill</span>
                <span>Up</span>
                <span>the</span>
                <span>form</span>
            </div>
        </div>
        <div class="main">
            <!-- mid div start -->
            <div class="formDiv">
                <div>
                    <h1>ABSTRACT FORM</h1>
                </div>

                <div class="rowFirst">
                    <div class="input-container" id="projectTitle">
                        <span>Project Title</span>
                        <input type="text" class="text-input projectTitle" placeholder="Enter Project Title" name="projectTitle">

                    </div>
                    <div class="input-container" id="sdlcDiv">

                        <span>Sdlc Model</span>
                        <select class="select-input" id="sdlcModel" name="sdlcModel" autocomplete="off" placeholder="Select Sdlc Model">
                            <option value="0">Select</option>
                            <option value="1">ProtoType</option>
                            <option value="2">Spiral</option>
                            <option value="3">Waterfall</option>
                        </select>

                    </div>
                </div>
                <div class="secondRow">
                    <div class="input-container" id="frontendTool">
                        <span>Frontend Tool</span>
                        <input type="text" class="text-input frontendTool" placeholder="Enter Frontend Tool" name="frontendTool">

                    </div>
                    <div class="input-container" id="backendTool">
                        <span>Backend Tool</span>
                        <input type="text" class="text-input backendTool" placeholder="Enter Backend Tool" name="backendTool">

                    </div>
                </div>
                <div class="thirdRow">
                    <div class="input-container" id="Descript">
                        <span>Abstract</span>
                        <textarea class="text-input abstract"></textarea>

                    </div>
                </div>
                <div class="fourthrow">
                    <div class="input-container members" id="stdOne">
                        <span>Project Member</span>
                        <select class="select-input firstMember" name="stdOne" autocomplete="off" placeholder="">
                            <option value="0">First Member</option>
                        </select>
                        <!-- <input type="text" class="text-input firstMember" placeholder="Enter student name" name="stdOne"> -->

                    </div>
                    <div class="input-container members" id="stdTwo">
                        <span>*Project Member</span>
                        <select class="select-input secondMember" name="stdTwo" autocomplete="off" placeholder="">
                            <option value="1">Second Member</option>
                        </select>
                        <!-- <input type="text" class="text-input secondMember" placeholder="Enter student name" name="stdTwo"> -->
                    </div>
                </div>
                <div class="seventhRow">
                    <button type="submit" class="btn btn-primary" id="taskBtn">Save</button>
                </div>

            </div>

            <!--ends-->
        </div>
    </div>
    <script>
        function myFunction() {
            var x = document.getElementById("sixthRow");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        $(document).ready(function() {
            $.post("tempFunction/fetchFriends.php", {
                "myId": <?= $userID ?>,
            }, function(response) {
                response = JSON.parse(response);
                if (response[0] == "Success") {
                    var htm = `<option value="0">First Member</option>`;
                    Object.entries(response[1]).forEach(entry => {
                        const [key, value] = entry;
                        htm += `<option value="${key}" data-model="${value}">${value}</option>`;
                    });
                    $('.firstMember').empty().append(htm);

                } else if (response[0] == "Failed") {

                }
            });

            $(".projectTitle, .frontendTool, .backendTool").keyup(function() {
                if ($(this).val().length < 4) {
                    $(this).removeClass('successTrack');
                    $(this).addClass('errorTrack');
                } else {
                    $(this).removeClass('errorTrack');
                    $(this).addClass('successTrack');
                }
            });

            $('.abstract').keyup(function() {
                if ($(this).val().length < 10) {
                    $(this).removeClass('successTrack');
                    $(this).addClass('errorTrack');
                } else {
                    $(this).removeClass('errorTrack');
                    $(this).addClass('successTrack');
                }
            });

            $('#sdlcModel, .firstMember, .secondMember').change(function() {
                if ($(this).find(':selected').val() == 0) {
                    $(this).removeClass('successTrack');
                    $(this).addClass('errorTrack');
                } else {
                    $(this).removeClass('errorTrack');
                    $(this).addClass('successTrack');
                    var trigger = $(this).closest('div').attr('id');
                    if ($(this).closest('div').attr('class') == 'input-container members') {
                        if (trigger == "stdOne") {
                            if (($(this).find(':selected').html() == $(".secondMember").find(':selected').html()) || ($(".secondMember").find(':selected').html() == "Second Member")) {
                                console.log(trigger);
                                $.post(
                                    "tempFunction/fetchFriends.php", {
                                        "myId": <?= $userID ?>,
                                        "firstMemberId": $(this).find(':selected').val(),
                                    },
                                    function(response) {
                                        response = JSON.parse(response);
                                        if (response[0] == "Success") {
                                            var htm = `<option value="0">Second Member</option>`;
                                            Object.entries(response[1]).forEach(entry => {
                                                const [key, value] = entry;
                                                htm += `<option value="${key}" data-model="${value}">${value}</option>`;
                                            });
                                            $('.secondMember').addClass("errorTrack").removeClass("successTrack").empty().append(htm);
                                        } else if (response[0] == "Failed") {

                                        }
                                    }
                                );
                            }
                        }
                        // else if (trigger == "stdTwo") {
                        //     if ($(this).find(':selected').html() == $(".firstMember").find(':selected').html()) {
                        //         $.post(
                        //             "tempFunction/fetchFriends.php", {
                        //                 "myId": <?= $userID ?>,
                        //                 "firstMemberId": $(this).find(':selected').val(),
                        //             },
                        //             function(response) {
                        //                 response = JSON.parse(response);
                        //                 if (response[0] == "Success") {
                        //                     var htm = `<option value="0">First Member</option>`;
                        //                     Object.entries(response[1]).forEach(entry => {
                        //                         const [key, value] = entry;
                        //                         htm += `<option value="${key}" data-model="${value}">${value}</option>`;
                        //                     });
                        //                     $('.firstMember').addClass("errorTrack").removeClass("successTrack").empty().append(htm);
                        //                 } else if (response[0] == "Failed") {

                        //                 }
                        //             }
                        //         );
                        //     }
                        // }
                    }
                }
            });

            $('#taskBtn').click(function() {
                console.log($('.formDiv .successTrack').length);
                if ($('.formDiv .successTrack').length < 6) {
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
                    var projectTitle = $(".projectTitle").val();
                    var sdlcModel = $('#sdlcModel').children("option:selected").html();
                    var frontendTool = $(".frontendTool").val();
                    var backendTool = $(".backendTool").val();
                    var abstract = $(".abstract").val();
                    var firstMember = $(".firstMember").val();
                    var secondMember = $(".secondMember").val();
                    $.post("tempFunction/storeAbstract.php", {
                        "projectTitle": projectTitle,
                        "sdlcModel": sdlcModel,
                        "frontendTool": frontendTool,
                        "backendTool": backendTool,
                        "abstract": abstract,
                        "myId": <?= $userID ?>,
                        "firstMember": firstMember,
                        "secondMember": secondMember,
                    }, function(response) {
                        if ((response[0] = "Success") && (response[1] = "Success") && (response[2] = "Success")) {
                            window.location = 'studentDashboard.php?id=<?= $userID ?>';
                        } else {
                            swal({
                                title: response,
                                icon: "warning",
                                closeOnClickOutside: false,
                                closeOnEsc: true,
                                timer: 3000,
                                dangerMode: false,
                            });
                        };
                    });
                }

            });
        });
    </script>

</body>

</html>