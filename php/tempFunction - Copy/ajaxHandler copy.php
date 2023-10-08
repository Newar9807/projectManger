<?php

// Error Handler
$check = true;
$ajaxArr = ['fetchProgram', 'updateScore', 'storeAbstract', 'rejectMeeting', 'register', 'fetchTaskDetailsTec', 'fetchFriends', 'deleteMeeting', 'changeTecProfile', 'changeStdProfile', 'fetchForTableProjects', 'teacherMeeting', 'acceptMeeting', 'fetchTasks', 'getDataToEditTasks', 'deleteTasks', 'updateTasks', 'storeTasks', 'fetchTaskDetails', 'manageMarks', 'fetchProjects', 'studentMeeting', 'fetchTaskPointsForTec', 'fetchMyTasksStatus', 'signin', 'fetchSpecificProjectDetails', 'fetchTaskPoints', 'filterTasks'];

foreach ($_POST as $elementToCheck => $value) {
    if (in_array($elementToCheck, $ajaxArr)) {
        foreach ($ajaxArr as $replaceData) {
            if ($replaceData != $elementToCheck)
                $_POST += [$replaceData => 0];
        }
        $check = false;
    }
}
if ($check) {
    return false;
}

// DB connection
include_once("../assets/dbCon.php");
$Database = new dbCon();
$conn = $Database->getConnection();

// Check if the AJAX request is made
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['fetchMyTasksStatus']) {

        // Include class definition
        require_once('fetchMyTasksStatus.php');

        // Create an instance of class
        $myObject = new fetchMyTasksStatus();

        // Call the class method
        $result = $myObject->fetchMyTasksStatusMainMethod($conn);

        // Send the result as a response
        echo $result;
    } elseif ($_POST['signin']) {

        require_once('signin.php');
        $myObject = new signin();
        $result = $myObject->signinMainMethod($conn);
        echo json_encode($result);
    } elseif ($_POST['fetchSpecificProjectDetails']) {

        require_once('fetchSpecificProjectDetails.php');
        $myObject = new fetchSpecificProjectDetails();
        $result = $myObject->fetchSpecificProjectDetailsMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchTaskPoints']) {

        require_once('fetchTaskPoints.php');
        $myObject = new fetchTaskPoints();
        $result = $myObject->fetchTaskPointsMainMethod($conn);
        echo $result;
    } elseif ($_POST['filterTasks']) {

        require_once('filterTasks.php');
        $myObject = new filterTasks();
        $result = $myObject->filterTasksMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchTaskPointsForTec']) {

        require_once('fetchTaskPointsForTec.php');
        $myObject = new fetchTaskPointsForTec();
        $result = $myObject->fetchTaskPointsForTecMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchProjects']) {

        require_once('fetchProjects.php');
        $myObject = new fetchProjects();
        $result = $myObject->fetchProjectsMainMethod($conn);
        echo $result;
    } elseif ($_POST['studentMeeting']) {

        require_once('studentMeeting.php');
        $myObject = new studentMeeting();
        $result = $myObject->studentMeetingMainMethod($conn);
        echo $result;
    } elseif ($_POST['manageMarks']) {

        require_once('manageMarks.php');
        $myObject = new manageMarks();
        $result = $myObject->manageMarksMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchTaskDetails']) {

        require_once('fetchTaskDetails.php');
        $myObject = new fetchTaskDetails();
        $result = $myObject->fetchTaskDetailsMainMethod($conn);
        echo $result;
    } elseif ($_POST['storeTasks']) {

        require_once('storeTasks.php');
        $myObject = new storeTasks();
        $result = $myObject->storeTasksMainMethod($conn);
        echo $result;
    } elseif ($_POST['updateTasks']) {

        require_once('updateTasks.php');
        $myObject = new updateTasks();
        $result = $myObject->updateTasksMainMethod($conn);
        echo $result;
    } elseif ($_POST['deleteTasks']) {

        require_once('deleteTasks.php');
        $myObject = new deleteTasks();
        $result = $myObject->deleteTasksMainMethod($conn);
        echo $result;
    } elseif ($_POST['getDataToEditTasks']) {

        require_once('getDataToEditTasks.php');
        $myObject = new getDataToEditTasks();
        $result = $myObject->getDataToEditTasksMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchTasks']) {

        require_once('fetchTasks.php');
        $myObject = new fetchTasks();
        $result = $myObject->fetchTasksMainMethod($conn);
        echo $result;
    } elseif ($_POST['acceptMeeting']) {

        require_once('acceptMeeting.php');
        $myObject = new acceptMeeting();
        $result = $myObject->acceptMeetingMainMethod($conn);
        echo $result;
    } elseif ($_POST['teacherMeeting']) {

        require_once('teacherMeeting.php');
        $myObject = new teacherMeeting();
        $result = $myObject->teacherMeetingMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchForTableProjects']) {

        require_once('fetchForTableProjects.php');
        $myObject = new fetchForTableProjects();
        $result = $myObject->fetchForTableProjectsMainMethod($conn);
        echo $result;
    } elseif ($_POST['changeStdProfile']) {

        require_once('changeStdProfile.php');
        $myObject = new changeStdProfile();
        $result = $myObject->changeStdProfileMainMethod($conn);
        echo $result;
    } elseif ($_POST['changeTecProfile']) {

        require_once('changeTecProfile.php');
        $myObject = new changeTecProfile();
        $result = $myObject->changeTecProfileMainMethod($conn);
        echo $result;
    } elseif ($_POST['deleteMeeting']) {

        require_once('deleteMeeting.php');
        $myObject = new deleteMeeting();
        $result = $myObject->deleteMeetingMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchFriends']) {

        require_once('fetchFriends.php');
        $myObject = new fetchFriends();
        $result = $myObject->fetchFriendsMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchTaskDetailsTec']) {

        require_once('fetchTaskDetailsTec.php');
        $myObject = new fetchTaskDetailsTec();
        $result = $myObject->fetchTaskDetailsTecMainMethod($conn);
        echo $result;
    } elseif ($_POST['register']) {

        require_once('register.php');
        $myObject = new register();
        $result = $myObject->registerMainMethod($conn);
        echo $result;
    } elseif ($_POST['rejectMeeting']) {

        require_once('rejectMeeting.php');
        $myObject = new rejectMeeting();
        $result = $myObject->rejectMeetingMainMethod($conn);
        echo $result;
    } elseif ($_POST['storeAbstract']) {

        require_once('storeAbstract.php');
        $myObject = new storeAbstract();
        $result = $myObject->rejectMeetingMainMethod($conn);
        echo $result;
    } elseif ($_POST['updateScore']) {

        require_once('updateScore.php');
        $myObject = new updateScore();
        $result = $myObject->updateScoreMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchProgram']) {

        require_once('fetchProgram.php');
        $myObject = new fetchProgram();
        $result = $myObject->fetchProgramMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchFaculty']) {

        require_once('fetchFaculty.php');
        $myObject = new fetchFaculty();
        $result = $myObject->fetchFacultyMainMethod($conn);
        echo $result;
    }
}
