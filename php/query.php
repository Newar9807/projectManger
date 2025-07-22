<?php
// require('usefulFunction/docHead.php');
// require('usefulFunction/chat.php');

$root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include($root . "/php/assets/head.php"); ?>
    <link rel="stylesheet" href="../assets/css/tstyle.css" />
    <link rel="stylesheet" href="../assets/css/project.css" />
    <link rel="stylesheet" href="../assets/css/chat.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <title>Query</title>
    <style>
        .content-details-header {
            display: flex;
        }

        .conHead {
            /* float: left; */
            margin: 25px 0 0 77px;
        }

        .conTail {
            margin: 30px 40px 0 0;
            float: right;
        }

        .edit-btn {
            font-size: 24px;
        }

        img {

            object-fit: cover;
        }
        .form-control {
            position: fixed;
            bottom: 2%;
            left: <?= $isTeacher ? '70%' : '57%'?>;
            transform: translateX(-50%);
            width: 50%;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: block;
            height: calc(4.5em + 1.75rem + 3px);
            padding: .375rem .75rem;
            font: 400 1rem/1.5 sans-serif;
            color: #495057;
            background: #fff;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .form-control:focus {
            border-right: 0;
        }

        .topbar {
            position: fixed;
            top: 0;
            width: 82%;
            height: 60px;
            display: flex;
            justify-content: space-between;
            padding: 0 10px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 10000;
        }

        .topbar .user img {
            max-height: 100%;
            height: auto;
            width: auto; /* Ensures the image maintains its aspect ratio */
            object-fit: contain; /* Ensures the image fits within its container without distortion */
        }

        .users-container {
            margin-top: 3%;
            position: fixed;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            height: 100vh;
            z-index: 9999;
        }

        .isTeacher{
            margin-left: 25%;
        }

        .person {
            display: flex;
            align-items: center; 
            padding: 10px;
        }

        .user {
            display: flex;
            align-items: center; 
            justify-content: center; 
            margin-right: 10px; 
        }

        .name-time {
            display: flex;
            flex-direction: column; 
            justify-content: center; 
        }

        .name-time .name,
        .name-time .time {
            text-align: left;
        }

        .chatContainerScroll {
            overflow-y: scroll;
            padding: 0 10px;
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar Starts -->
        <?php 
            if ( $isTeacher ?? false ) {
                include($root . "/php/assets/tecSidebar.php");
            } else {
                include($root . "/php/assets/stdSidebar.php");
            }
         ?>
        <!-- Sidebar Ends -->
        <div class="main">
            <!-- Navigation Starts -->
            <?php include($root . "/php/assets/tecNav.php"); ?>
            <!-- Navigation Ends -->

            <!-- mid div start -->
            <div class="content-wrapper">
                <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card m-0">
                            <div class="row no-gutters">
                                <?php if ( $isTeacher ) : ?>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3">
                                        <div class="users-container">
                                            <ul class="users">
                                                <?php foreach ( $projectDatas as $key => $value ) : ?>
                                                    <li class="person<?= ($key == 0) ? ' active-user' : ''?>" data-id="<?= $value['id']?>">
                                                            <div class="user">
                                                                <img src="<?= $value['pic']?>" alt="user" />
                                                                <span class="status busy"></span>
                                                            </div>
                                                            <p class="name-time">
                                                                <span class="name"><?= $value['name']?></span>
                                                                <span class="time"><?= $value['time']?></span>
                                                            </p>
                                                        </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-9 col-9">
                                    <div class="chat-container<?= $isTeacher ? ' isTeacher' : ''?>">
                                        <p><?= !empty($msgDatas) ? '' : 'No Chats Yet'?></p>
                                        <?php if ( !empty( $msgDatas ) ) : ?>
                                            <ul class="chat-box chatContainerScroll">
                                                <?php foreach ( $msgDatas as $key => $value ): ?>
                                                    <?php if ( $value['from'] == $user['user_id'] ) : ?>
                                                        <li class="chat-right">
                                                            <div class="chat-hour"> <?= $value['time'] ?> </div>
                                                            <div class="chat-text"> <?= $value['msg'] ?> </div>
                                                            <div class="chat-avatar">
                                                                <img src="<?= $user['user_pic']?>" alt="dp" />
                                                                <div class="chat-name"><?= explode( ' ', $user['user_name'] )[0]; ?></div>
                                                            </div>
                                                        </li>
                                                    <?php else: ?>
                                                        <li class="chat-left">
                                                            <div class="chat-avatar">
                                                                <img src="<?= $toUserDatas[$value['from']]['user_pic']?>" alt="dp" />
                                                                <div class="chat-name"><?= explode( ' ', $toUserDatas[$value['from']]['user_name'] )[0]; ?></div>
                                                            </div>
                                                            <div class="chat-text"> <?= $value['msg'] ?> </div>
                                                            <div class="chat-hour"> <?= $value['time'] ?> </div>
                                                        </li>
                                                    <?php endif; ?>

                                                    
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif;?>
                                        
                                    </div>
                                    <div class="form-group mt-3 mb-0">
                                        <textarea
                                            id="sendMsg"
                                            data-from="<?= $userID?>"
                                            data-to="<?= $projectDatas[0]['id'] ?? $projectIdd?>"
                                            class="form-control"
                                            rows="3"
                                            placeholder="Type your message here..."
                                        ></textarea>
                                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script> -->
    <script src="../assets/js/websiteSkeleton.js"></script>

    
    <!-- <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.users .person').on('click', function() {
                $('.users .active-user').removeClass('active-user');
                $(this).addClass('active-user');
                $('#sendMsg').attr('data-to', $(this).data('id'));
                $.ajax({
                    url: 'usefulFunction/fetchMsg.php', 
                    type: 'POST',
                    data: {
                        msg: '',
                        from: $('#sendMsg').data('from'),
                        to: $(this).data('id'),
                    },
                    success: function(response) {
                        var response = JSON.parse(response);
                        if ( response.msgDatas.length > 0 ) {
                            appendHTML(response);
                        } else {    
                            $('.isTeacher').html('<ul class="chat-box chatContainerScroll"><p>No Chats Yet</p></u>');
                        }
                        $('#sendMsg').val('');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching message:', error);
                    }
                });
                $('.chatContainerScroll').scrollTop($('.chatContainerScroll')[0].scrollHeight);
            });

            $('#sendMsg').on('keydown', function(event) {
                console.log(event.key);
                if (event.key === 'Enter') {
                    event.preventDefault();
                    $.ajax({
                        url: 'usefulFunction/sendMsg.php', 
                        type: 'POST',
                        data: {
                            msg: $('#sendMsg').val(),
                            from: $('#sendMsg').data('from'),
                            to: $('#sendMsg').data('to'),
                        },
                        success: function(response) {
                            var response = JSON.parse(response);
                            if ( response.msgDatas.length > 0 ) {
                                appendHTML(response);
                            } else {
                                $('.isTeacher').html('<ul class="chat-box chatContainerScroll"><p>No Chats Yet</p></u>');
                            }
                            $('#sendMsg').val('');
                        },
                        error: function(xhr, status, error) {
                            console.error('Error sending message:', error);
                        }
                    });
                }
            });

            function appendHTML(response) {
                console.log(response);
                var ele = '<ul class="chat-box chatContainerScroll"><p></p>';
                response.msgDatas.map( (msg) => {
                    if ( msg.from == $('#sendMsg').data('from') ) {
                        ele += `<li class="chat-right">
                                    <div class="chat-hour"> ${msg.time} </div>
                                    <div class="chat-text"> ${msg.msg} </div>
                                    <div class="chat-avatar">
                                        <img src="<?= $user['user_pic']?>" alt="dp" />
                                        <div class="chat-name"> <?= explode( ' ', $user['user_name'] )[0]; ?> </div>
                                    </div>
                                </li>`;
                    } else {
                        ele += `<li class="chat-left">
                                    <div class="chat-avatar">
                                        <img src="${response.userDatas[msg.from].user_pic}" alt="dp" />
                                        <div class="chat-name"> ${response.userDatas[msg.from].user_name.split(' ')[0]} </div>
                                    </div>
                                    <div class="chat-text"> ${msg.msg} </div>
                                    <div class="chat-hour"> ${msg.time} </div>
                                </li>`;
                    }
                })
                ele += '</ul>';
                $('.isTeacher').html(ele);
            }
        });
    </script>


</body>

</html>