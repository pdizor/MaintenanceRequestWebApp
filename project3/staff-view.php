<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Portal</title>
    <?php include_once("database.php"); include_once("filter-functions.php"); ?>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Staff Portal</h1>

<form action="redirect.php" method="post">
    <input type="hidden" name="id" value="0">
    <input type="hidden" name="password" value="0">
    <button type="submit" name="logout">Log Out</button>
</form>

<p>
    <form action="staff-view.php" method="post">
        <table class="tbl-requests" cellpadding="10" cellspacing="1">
        <tbody>
        <tr>
            <th>
                <label>Filters:</label>
            </th>
            <th>    
                <input type="checkbox" id="aptNumOpt" name="aptNumOpt" value="aptNumOpt" <?php if (isset($_POST['aptNumOpt'])) { ?> checked="checked" <?php } ?>>
                <label for="aptNumOpt"> Apt. Number</label>
                <input type="text" id="aptNum" name="aptNum" style="width: 50px;" <?php if (isset($_POST['aptNum'])) { ?> value="<?php echo $_POST['aptNum'] ?>" <?php } ?>>
            </th>
            <th>
                <input type="checkbox" id="areaOpt" name="areaOpt" value="areaOpt" <?php if (isset($_POST['areaOpt'])) { ?> checked="checked" <?php } ?>>
                <label for="areaOpt"> Area</label>
                <select name="location" <?php if (isset($_POST['location'])) { ?> value="<?php echo $_POST['location'] ?>" <?php } ?>>
                    <option value="kitchen">kitchen</option>
                    <option value="living room">living room</option>
                    <option value="bathroom">bathroom</option>
                    <option value="bedroom">bedroom</option>
                </select>
            </th>
            <th>
                <input type="checkbox" id="dateOpt" name="dateOpt" value="dateOpt" <?php if (isset($_POST['dateOpt'])) { ?> checked="checked" <?php } ?>>
                <label for="dateOpt"> Date Range</label>
                <label for="fromDate"> From:</label>
                <input type="date" id="fromDate" name="fromDate" <?php if (isset($_POST['fromDate'])) { ?> value="<?php echo $_POST['fromDate'] ?>" <?php } ?>>
                <label for="toDate"> To:</label>
                <input type="date" id="toDate" name="toDate" <?php if (isset($_POST['toDate'])) { ?> value="<?php echo $_POST['toDate'] ?>" <?php } ?>>
            </th>
            <th>
                <input type="checkbox" id="statusOpt" name="statusOpt" value="statusOpt" <?php if (isset($_POST['statusOpt'])) { ?> checked="checked" <?php } ?>>
                <label for="statusOpt"> Status</label>
                <select name="status" <?php if (isset($_POST['status'])) { ?> value="<?php echo $_POST['status'] ?>" <?php } ?>>
                    <option value="pending">pending</option>
                    <option value="completed">completed</option>
                </select>
            </th>
            <th>
                <button type="submit" name="filterButton">Filter</button>
            </th>
        </tr>
    </form>
</p>

<?php

// get all requests from database
$requests = browseAll();

// apply filters selected by user
if (isset($_POST['aptNumOpt']) && isset($_POST['aptNum'])) {
    $aptNum = $_POST['aptNum'];
    $requests = filterByAptNum($requests, $aptNum);
}
if (isset($_POST['areaOpt']) && isset($_POST['location'])) {
    $loc = $_POST['location'];
    $requests = filterByArea($requests, $loc);
}
if (isset($_POST['dateOpt']) && isset($_POST['fromDate']) && isset($_POST['toDate'])) {
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    $requests = filterByDate($requests, $fromDate, $toDate);
}
if (isset($_POST['statusOpt']) && isset($_POST['status'])) {
    $status = $_POST['status'];
    $requests = filterByStatus($requests, $status);
}

?>

<p>

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
        <th style="text-align:left;">Mark Complete</th>
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
                <td>
                    <?php 
                    if ($request[6] == "pending") {
                    ?>
                    <form action="complete-request.php" method="post">
                        <input type="hidden" name="reqId" value="<?php echo $request[0]; ?>">
                        <button type="submit" name="checkMark">
                            <img src="images/check-mark.jpg" width="25" height="25"></img>
                        </button>
                    </form> 
                    <?php
                    }
                    ?>
                </td>
            </tr>	
        <?php
        }
    }
    ?>

</p>
    
</body>
</html>