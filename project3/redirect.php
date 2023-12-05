<?php
// redirects user to proper view based on login input
// if incorrect login, etc. the user is simply redirected
// back to the login page
include_once("database.php");

$id = $_POST["id"];
$password = $_POST["password"];

$user_type = getUserType($id, $password);

if ($user_type == "manager") {
    // redirect to manager view
    header('Location: '. "http://localhost/project3/manager-view.php");
    die();
}
else if ($user_type == "staff") {
    // redirect to staff view
    header('Location: '. "http://localhost/project3/staff-view.php");
    die();
}
else if ($user_type == "tenant") {
    // redirect to tenant view
    header('Location: '. "http://localhost/project3/tenant-view.php?id=".$id);
    die();
}
else {
    // redirect to login page
    header('Location: '. "http://localhost/project3/login.php");
    die();
}

?>