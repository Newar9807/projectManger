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
if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {

    // Include class definition
    require_once('programFunctions.php');

    // Create an instance of class
    $myObject = new programFunctions();

    if ($_POST['fetchMyTasksStatus']) {

        // Call the class method
        $result = $myObject->fetchMyTasksStatusMainMethod($conn);
        
        // Send the result as a response
        echo $result;
    } elseif ($_POST['signin']) {
        
        $result = $myObject->signinMainMethod($conn);
        echo json_encode($result);
    } elseif ($_POST['fetchSpecificProjectDetails']) {
        
        $result = $myObject->fetchSpecificProjectDetailsMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchTaskPoints']) {
        
        $result = $myObject->fetchTaskPointsMainMethod($conn);
        echo $result;
    } elseif ($_POST['filterTasks']) {
        
        $result = $myObject->filterTasksMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchTaskPointsForTec']) {
        
        $result = $myObject->fetchTaskPointsForTecMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchProjects']) {
        
        $result = $myObject->fetchProjectsMainMethod($conn);
        echo $result;
    } elseif ($_POST['studentMeeting']) {
        
        $result = $myObject->studentMeetingMainMethod($conn);
        echo $result;
    } elseif ($_POST['manageMarks']) {
        
        $result = $myObject->manageMarksMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchTaskDetails']) {
        
        $result = $myObject->fetchTaskDetailsMainMethod($conn);
        echo $result;
    } elseif ($_POST['storeTasks']) {
        
        $result = $myObject->storeTasksMainMethod($conn);
        echo $result;
    } elseif ($_POST['updateTasks']) {
        
        $result = $myObject->updateTasksMainMethod($conn);
        echo $result;
    } elseif ($_POST['deleteTasks']) {
        
        $result = $myObject->deleteTasksMainMethod($conn);
        echo $result;
    } elseif ($_POST['getDataToEditTasks']) {
        
        $result = $myObject->getDataToEditTasksMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchTasks']) {
        
        $result = $myObject->fetchTasksMainMethod($conn);
        echo $result;
    } elseif ($_POST['acceptMeeting']) {
        
        $result = $myObject->acceptMeetingMainMethod($conn);
        echo $result;
    } elseif ($_POST['teacherMeeting']) {
        
        $result = $myObject->teacherMeetingMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchForTableProjects']) {
        
        $result = $myObject->fetchForTableProjectsMainMethod($conn);
        echo $result;
    } elseif ($_POST['changeStdProfile']) {
        
        $result = $myObject->changeStdProfileMainMethod($conn);
        echo $result;
    } elseif ($_POST['changeTecProfile']) {
        
        $result = $myObject->changeTecProfileMainMethod($conn);
        echo $result;
    } elseif ($_POST['deleteMeeting']) {
        
        $result = $myObject->deleteMeetingMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchFriends']) {
        
        $result = $myObject->fetchFriendsMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchTaskDetailsTec']) {
        
        $result = $myObject->fetchTaskDetailsTecMainMethod($conn);
        echo $result;
    } elseif ($_POST['register']) {
        
        $result = $myObject->registerMainMethod($conn);
        echo $result;
    } elseif ($_POST['rejectMeeting']) {
        
        $result = $myObject->rejectMeetingMainMethod($conn);
        echo $result;
    } elseif ($_POST['storeAbstract']) {
        
        $result = $myObject->storeAbstractMainMethod($conn);
        echo $result;
    } elseif ($_POST['updateScore']) {
        
        $result = $myObject->updateScoreMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchProgram']) {
        
        $result = $myObject->fetchProgramMainMethod($conn);
        echo $result;
    } elseif ($_POST['fetchFaculty']) {
        
        $result = $myObject->fetchFacultyMainMethod($conn);
        echo $result;
    }
}
