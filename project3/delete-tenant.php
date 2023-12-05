<?php

include_once("database.php");

$id = $_POST['id'];

removeTenantAccount($id);
removeUser($id);

// redirect to manager view
header('Location: '. "http://localhost/project3/manager-view.php");
die();

?>