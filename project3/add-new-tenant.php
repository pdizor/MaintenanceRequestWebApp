<?php
include_once("database.php");

$id = $_POST['id'];
$name = $_POST['name'];
$phoneNum = $_POST['phoneNum'];
$email = $_POST['email'];
$dateIn = $_POST['dateIn'];
$dateOut = $_POST['dateOut'];
$aptNum = $_POST['aptNum'];
$password = $_POST['password'];

addTenant($id, $name, $phoneNum, $email, $dateIn, $dateOut, $aptNum);
addUser($id, $password);

// redirect to manager view
header('Location: '. "http://localhost/project3/manager-view.php");
die();

?>