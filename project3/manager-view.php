<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Portal</title>
    <?php include_once("database.php"); ?>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Manager Portal</h1>

<form action="redirect.php" method="post">
    <input type="hidden" name="id" value="0">
    <input type="hidden" name="password" value="0">
    <button type="submit" name="logout">Log Out</button>
</form>

<form action="add-new-tenant-form.php" method="post">
    <button type="submit" name="addNew">Add New Tenant</button>
</form>

<p>

<?php

// get all tenant accounts
$tenants = browseAllTenants();

// display tenant's pending requests to user as a list

        ?>

        <table class="tbl-requests" cellpadding="10" cellspacing="1">
        <tbody>
        <tr>
            <th style="text-align:left;">Tenant ID</th>
            <th style="text-align:left;">Name</th>
            <th style="text-align:left;">Phone Number</th>
            <th style="text-align:left;">Email</th>
            <th style="text-align:left;">Date In</th>
            <th style="text-align:left;">Date Out</th>
            <th style="text-align:left;">Apt. Number</th>
            <th style="text-align:left;">Remove Tenant</th>
            <th style="text-align:left;">Change Apartment</th>
        </tr>	
        <?php
        if (!empty($tenants)) {
            foreach ($tenants as $tenant) {
            ?>
                <tr>
                    <td style="text-align:left;"><?php echo $tenant[0]; ?></td>
                    <td style="text-align:left;"><?php echo $tenant[1]; ?></td>
                    <td style="text-align:left;"><?php echo $tenant[2]; ?></td>
                    <td style="text-align:left;"><?php echo $tenant[3]; ?></td>
                    <td style="text-align:left;"><?php echo $tenant[4]; ?></td>
                    <td style="text-align:left;"><?php echo $tenant[5]; ?></td>
                    <td style="text-align:left;"><?php echo $tenant[6]; ?></td>
                    <td>    
                        <form action="delete-tenant.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $tenant[0] ?>">
                            <button type="submit" name="trashCan">
                                <img src="images/trash-can.jpg" width="25" height="25"></img>
                            </button>
                        </form> 
                    </td>
                    <td>    
                        <form action="change-apt-num.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $tenant[0] ?>">
                            <input type="text" name="aptNum" style="width: 50px;" value="<?php echo $tenant[6] ?>">
                            <button type="submit" name="edit">
                                <img src="images/edit.jpg" width="25" height="25"></img>
                            </button>
                        </form> 
                    </td>
                </tr>
            <?php
            }
        }
        ?>	

</p>
    
</body>
</html>