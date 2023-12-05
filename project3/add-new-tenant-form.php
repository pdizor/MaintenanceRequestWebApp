<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Tenant</title>
    <link rel="stylesheet" href="form-style.css">
</head>
<body>

    <p>
        <form action="back.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="type" value="tenant">
            <button type="submit" name="back">Back</button>
        </form>
    </p>

    <h1>Add New Tenant</h1>
        <form action="add-new-tenant.php" method="post" enctype="multipart/form-data">
            <label for="id">ID: </label>
            <input type="text" name="id" placeholder="Enter id">
            <label for="name">Name: </label>
            <input type="text" name="name" placeholder="Enter tenant name">
            <label for="phoneNum">Phone Number: </label>
            <input type="text" name="phoneNum" placeholder="Enter phone number">
            <label for="email">Email: </label>
            <input type="text" name="email" placeholder="Enter email">
            <label for="dateIn">Date In: </label>
            <input type="date" name="dateIn">
            <label for="dateOut">Date Out: </label>
            <input type="date" name="dateOut">
            <label for="aptNum">Apartment Number: </label>
            <input type="text" name="aptNum" placeholder="Enter Apartment Number">
            <label for="password">Account Password: </label>
            <input type="text" name="password" placeholder="Enter Account Password">
            <button type="submit" name="submit">Submit</button>
        </form>

<?php

?>
    
</body>
</html>