<?php

include_once("database.php");

// retrieve values from form
$apt_num = $_POST['apt_num'];
$loc = trim($_POST['location']);
$desc = trim($_POST['description']);
$id = $_POST['id'];

// get data of image uploaded by user
if(isset($_FILES["img"]["name"]) && !empty($_FILES['img']['name'])) {
    $imageName = $_FILES['img']['name']; 
    $imageTemp = $_FILES['img']['tmp_name'];

    // store the image in images file
    move_uploaded_file($imageTemp, "images/" . $imageName);

    // store request src in database
    addRequest($apt_num, $loc, $desc, "images/".$imageName);
}
// if no image is uploaded
else {
    // store request src in database
    addRequest($apt_num, $loc, $desc, "images/no-image-found.jpg");
}

// redirect to tenant view
header('Location: '. "http://localhost/project3/tenant-view.php?id=".$id);
die();

?>