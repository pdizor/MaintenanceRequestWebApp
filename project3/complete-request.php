<?php

include_once("database.php");

// change request status to complete
$reqId = $_POST['reqId'];
completeRequest($reqId);

// redirect to staff-view
header('Location: '. "http://localhost/project3/staff-view.php");
die();


?>