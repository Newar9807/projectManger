<?php

// DB connection
include("assets/dbCon.php");
$Database = new dbCon();
$conn = $Database->getConnection();

// Directories
$root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];

// Check Session
include("usefulFunction/sessionCheck.php");
$sessionObject = new sessionCheck();

// Place returned value
$sessionReturned = $sessionObject->sessionMainMethod($conn);
$userID = $sessionReturned['userID'];
$projectId = $sessionReturned['projectId'];