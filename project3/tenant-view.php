<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant Portal</title>
    <?php include_once("database.php"); ?>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Tenant Portal</h1>

<form action="redirect.php" method="post">
    <input type="hidden" name="id" value="0">
    <input type="hidden" name="password" value="0">
    <button type="submit" name="logout">Log Out</button>
</form>

<?php
    // find tenant's apt. number
    $id = $_GET['id'];
    $apt_num = getAptNum($id);
?>

<p>
    <form action="add-new-request-form.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="apt_num" value="<?php echo $apt_num; ?>">
        <button type="submit" name="addNew">Add New +</button>
    </form>
</p>

<p>

<?php

// get tenant's pending requests
$requests = searchPendingByAptNum($apt_num);

// display tenant's pending requests to user as a list

        ?>

        <table class="tbl-requests" cellpadding="10" cellspacing="1">
        <tbody>
        <tr>
            <th style="text-align:left;">Photo</th>
            <th style="text-align:left;">Request ID</th>
            <th style="text-align:left;">apt_num</th>
            <th style="text-align:left;">Location</th>
            <th style="text-align:left;">Description</th>
            <th style="text-align:left;">Date</th>
            <th style="text-align:left;">Status</th>
        </tr>	
        <?php
        if (!empty($requests)) {
            foreach ($requests as $request) {
                
                // get image src
                $img = $request[5];
                // if no image was provided
                if ($img == "n/a") {
                    $img = "images/no-photo.jpg";
                }
            ?>
                <tr>
                    <td><img src="<?php echo $img ?>" width="100" height="100" class="request-photo" /></td>
                    <td><?php echo $request[0]; ?></td>
                    <td><?php echo $request[1]; ?></td>
                    <td style="text-align:left;"><?php echo $request[2]; ?></td>
                    <td style="text-align:left;"><?php echo $request[3]; ?></td>
                    <td style="text-align:left;"><?php echo $request[4]; ?></td>
                    <td style="text-align:left;"><?php echo $request[6]; ?></td>
                </tr>	
            <?php
            }
        }
        ?>

    </p>
    
</body>
</html>