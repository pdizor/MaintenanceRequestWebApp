<?php

include_once("database.php");

$id = $_POST['id'];
$aptNum = $_POST['aptNum'];

changeAptNum($id, $aptNum);

// redirect to manager view
header('Location: '. "http://localhost/project3/manager-view.php");
die();

?>