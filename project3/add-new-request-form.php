<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit New Request</title>
    <link rel="stylesheet" href="form-style.css">
</head>
<body>
    <p>
        <form action="back.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
            <input type="hidden" name="type" value="tenant">
            <button type="submit" name="back">Back</button>
        </form>
    </p>

    <h1>Submit New Maintenance Request</h1>
        <form action="add-new-request.php" method="post" enctype="multipart/form-data">
            <label>Photo:</label>
            <input type="file" id="photo" name="img">
            <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
            <input type="hidden" name="apt_num" value="<?php echo $_POST['apt_num']; ?>">
            <label for="location">Location: </label>
            <select name="location">
                <option value="kitchen">kitchen</option>
                <option value="living room">living room</option>
                <option value="bathroom">bathroom</option>
                <option value="bedroom">bedroom</option>
            </select>
            <textarea name="description" placeholder="Enter Problem Description"></textarea>
            <button type="submit" name="submit">Submit</button>
        </form>

<?php

?>
    
</body>
</html>