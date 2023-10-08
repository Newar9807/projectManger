<?php

// Error Handler
$check = true;
$ajaxArr = ['fetchFaculty', 'fetchProgram', 'updateScore', 'storeAbstract', 'rejectMeeting', 'register', 'fetchTaskDetailsTec', 'fetchFriends', 'deleteMeeting', 'changeTecProfile', 'changeStdProfile', 'fetchForTableProjects', 'teacherMeeting', 'acceptMeeting', 'fetchTasks', 'getDataToEditTasks', 'deleteTasks', 'updateTasks', 'storeTasks', 'fetchTaskDetails', 'manageMarks', 'fetchProjects', 'studentMeeting', 'fetchTaskPointsForTec', 'fetchMyTasksStatus', 'signin', 'fetchSpecificProjectDetails', 'fetchTaskPoints', 'filterTasks'];

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

// Check if the AJAX request is made
if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {


    if ($_POST['fetchMyTasksStatus']) {

        // Include class definition
        require_once('teacher.php');

        // Create an instance of class
        $myObject = new teacher();

        // Call the class method
        $result = $myObject->fetchMyTasksStatusMainMethod();

        // Send the result as a response
        echo $result;
    } elseif ($_POST['signin']) {

        require_once('teacher.php');
        $myObject = new teacher();
        $result = $myObject->signinMainMethod();
        echo json_encode($result);
    } elseif ($_POST['fetchSpecificProjectDetails']) {

        require_once('teacher.php');
        $myObject = new teacher();
        $result = $myObject->fetchSpecificProjectDetailsMainMethod();
        echo $result;
    } elseif ($_POST['fetchTaskPoints']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->fetchTaskPointsMainMethod();
        echo $result;
    } elseif ($_POST['filterTasks']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->filterTasksMainMethod();
        echo $result;
    } elseif ($_POST['fetchTaskPointsForTec']) {

        require_once('teacher.php');
        $myObject = new teacher();
        $result = $myObject->fetchTaskPointsForTecMainMethod();
        echo $result;
    } elseif ($_POST['fetchProjects']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->fetchProjectsMainMethod();
        echo $result;
    } elseif ($_POST['studentMeeting']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->studentMeetingMainMethod();
        echo $result;
    } elseif ($_POST['manageMarks']) {

        require_once('teacher.php');
        $myObject = new teacher();
        $result = $myObject->manageMarksMainMethod();
        echo $result;
    } elseif ($_POST['fetchTaskDetails']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->fetchTaskDetailsMainMethod();
        echo $result;
    } elseif ($_POST['storeTasks']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->storeTasksMainMethod();
        echo $result;
    } elseif ($_POST['updateTasks']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->updateTasksMainMethod();
        echo $result;
    } elseif ($_POST['deleteTasks']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->deleteTasksMainMethod();
        echo $result;
    } elseif ($_POST['getDataToEditTasks']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->getDataToEditTasksMainMethod();
        echo $result;
    } elseif ($_POST['fetchTasks']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->fetchTasksMainMethod();
        echo $result;
    } elseif ($_POST['acceptMeeting']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->acceptMeetingMainMethod();
        echo $result;
    } elseif ($_POST['teacherMeeting']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->teacherMeetingMainMethod();
        echo $result;
    } elseif ($_POST['fetchForTableProjects']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->fetchForTableProjectsMainMethod();
        echo $result;
    } elseif ($_POST['changeStdProfile']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->changeStdProfileMainMethod();
        echo $result;
    } elseif ($_POST['changeTecProfile']) {

        require_once('teacher.php');
        $myObject = new teacher();
        $result = $myObject->changeTecProfileMainMethod();
        echo $result;
    } elseif ($_POST['deleteMeeting']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->deleteMeetingMainMethod();
        echo $result;
    } elseif ($_POST['fetchFriends']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->fetchFriendsMainMethod();
        echo $result;
    } elseif ($_POST['fetchTaskDetailsTec']) {

        require_once('teacher.php');
        $myObject = new teacher();
        $result = $myObject->fetchTaskDetailsTecMainMethod();
        echo $result;
    } elseif ($_POST['register']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->registerMainMethod();
        echo $result;
    } elseif ($_POST['rejectMeeting']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->rejectMeetingMainMethod();
        echo $result;
    } elseif ($_POST['storeAbstract']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->storeAbstractMainMethod();
        echo $result;
    } elseif ($_POST['updateScore']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->updateScoreMainMethod();
        echo $result;
    } elseif ($_POST['fetchProgram']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->fetchProgramMainMethod();
        echo $result;
    } elseif ($_POST['fetchFaculty']) {

        require_once('student.php');
        $myObject = new student();
        $result = $myObject->fetchFacultyMainMethod();
        echo $result;
    }
}
