<?php

$type = $_POST['type'];
$id = $_POST['id'];

if ($type = "tenant") {
    // redirect to tenant view
    header('Location: '. "http://localhost/project3/tenant-view.php?id=".$id);
    die();
}
else {
    // redirect to manager view
    header('Location: '. "http://localhost/project3/manager-view.php");
    die();
}

?>