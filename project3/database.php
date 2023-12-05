<?php
// database functions

// add new request to database
function addRequest($aptNum, $loc, $desc, $imageSrc) {
    // database connection
    require 'database-connection.php';

    $sql = "INSERT INTO requests (apt_num, location, description, photo, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    $status = "pending";
    mysqli_stmt_bind_param($stmt, "sssss", $aptNum, $loc, $desc, $imageSrc, $status);
    mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);

}

// add new tenant to database
function addTenant($id, $name, $phoneNum, $email, $dateIn, $dateOut, $aptNum) {
    // database connection
    require 'database-connection.php';

    $sql = "INSERT INTO tenant_accounts VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "isssssi", $id, $name, $phoneNum, $email, $dateIn, $dateOut, $aptNum);
    mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);
    
}

// add a new user to database
function addUser($id, $password) {
    // database connection
    require 'database-connection.php';

    $sql = "INSERT INTO user_accounts VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    $type = "tenant";
    mysqli_stmt_bind_param($stmt, "iss", $id, $password, $type);
    mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);

}

// fetches all requests in database
function browseAll() {
    // database connection
    require 'database-connection.php';

    // get all rows from requests table
    $sql = "SELECT * FROM requests";
    $result = mysqli_query($conn, $sql);

    // array to hold results
    $requests = array();

    if (mysqli_num_rows($result) > 0) {

        $ndx = 0;

        // store data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $requests[$ndx] = array($row["id"], $row["apt_num"], $row["location"], $row["description"], $row["date"], $row["photo"], $row["status"]);
            $ndx++;
        }
    }

    mysqli_close($conn);

    return $requests;

}

// fetches requests with specified apt. number
function searchByAptNum($aptNum) {
    // database connection
    require 'database-connection.php';

    // get all rows from requests table with given apt. number
    $sql = "SELECT * FROM requests WHERE apt_num = ".$aptNum;
    $result = mysqli_query($conn, $sql);

    // array to hold results
    $requests = array();

    if (mysqli_num_rows($result) > 0) {

        $ndx = 0;

        // store data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $requests[$ndx] = array($row["id"], $row["apt_num"], $row["location"], $row["description"], $row["date"], $row["photo"], $row["status"]);
            $ndx++;
        }
    }
    
    mysqli_close($conn);

    return $requests;

}

// fetches requests with given location
function searchByLocation($loc) {
    // database connection
    require 'database-connection.php';

    // get all rows from requests table with given location
    $sql = "SELECT * FROM requests WHERE location like '%".$loc."%'";

    $result = mysqli_query($conn, $sql);

    // array to hold results
    $requests = array();

    if (mysqli_num_rows($result) > 0) {

        $ndx = 0;

        // store data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $requests[$ndx] = array($row["id"], $row["apt_num"], $row["location"], $row["description"], $row["date"], $row["photo"], $row["status"]);
            $ndx++;
        }
    }
    
    mysqli_close($conn);

    return $requests;

}

// fetches requests with specified status
function searchByStatus($status) {
    // database connection
    require 'database-connection.php';

    // get all rows from requests table with given status
    $sql = "SELECT * FROM requests WHERE status like '%".$status."%'";

    $result = mysqli_query($conn, $sql);

    // array to hold results
    $requests = array();

    if (mysqli_num_rows($result) > 0) {

        $ndx = 0;

        // store data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $requests[$ndx] = array($row["id"], $row["apt_num"], $row["location"], $row["description"], $row["date"], $row["photo"], $row["status"]);
            $ndx++;
        }
    }
    
    mysqli_close($conn);

    return $requests;

}

// fetches requests with specified apt_num and pending status
function searchPendingByAptNum($aptNum) {
    // database connection
    require 'database-connection.php';

    // get all rows from requests table with given apt. number and with pending status
    $sql = "SELECT * FROM requests WHERE apt_num = ".$aptNum." and status like 'pending'";
    $result = mysqli_query($conn, $sql);

    // array to hold results
    $requests = array();

    if (mysqli_num_rows($result) > 0) {

        $ndx = 0;

        // store data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $requests[$ndx] = array($row["id"], $row["apt_num"], $row["location"], $row["description"], $row["date"], $row["photo"], $row["status"]);
            $ndx++;
        }
    }
    
    mysqli_close($conn);

    return $requests;

}

// get apt_num of tenant with specified id
function getAptNum($id) {

    // database connection
    require 'database-connection.php';

    // get row from request with given id and password
    $sql = "SELECT * FROM tenant_accounts WHERE id = ".$id;

    $result = mysqli_query($conn, $sql);

    $apt_num = "";
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $apt_num = $row["apt_num"];
    }
    else {
        $apt_num = -1;
    }

    return $apt_num;

}

// get type of the user with specified id and password
function getUserType($id, $password) {

    // database connection
    require 'database-connection.php';

    // get row from request with given id and password
    $sql = "SELECT * FROM user_accounts WHERE id = ".$id." and password like '".$password."'";

    $result = mysqli_query($conn, $sql);

    $user_type = "";
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_type = $row["user_type"];
    }
    else {
        $user_type = "failure";
    }

    return $user_type;

}

// set status to complete
function completeRequest($reqId) {

    // database connection
    require 'database-connection.php';

    $sql = "UPDATE requests SET status = 'completed' WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "i", $reqId);
    mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);    

}

// fetches all tenant accounts in database
function browseAllTenants() {
    // database connection
    require 'database-connection.php';

    // get all rows from requests table
    $sql = "SELECT * FROM tenant_accounts";
    $result = mysqli_query($conn, $sql);

    // array to hold results
    $tenants = array();

    if (mysqli_num_rows($result) > 0) {

        $ndx = 0;

        // store data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $tenants[$ndx] = array($row["id"], $row["name"], $row["phone_num"], $row["email"], $row["date_in"], $row["date_out"], $row["apt_num"]);
            $ndx++;
        }
    }

    mysqli_close($conn);

    return $tenants;

}

// delete tenant account from database
function removeTenantAccount($id) {

    // database connection
    require 'database-connection.php';

    $sql = "DELETE FROM tenant_accounts WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    mysqli_close($conn);

}

// delete tenant account from database
function removeUser($id) {

    // database connection
    require 'database-connection.php';

    $sql = "DELETE FROM user_accounts WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    mysqli_close($conn);

}

// change apt num for tenant account with specified id
function changeAptNum($id, $aptNum) {

    // database connection
    require 'database-connection.php';

    $sql = "UPDATE tenant_accounts SET apt_num = ? WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);

    mysqli_stmt_bind_param($stmt, "ii", $aptNum, $id);
    mysqli_stmt_execute($stmt);

    mysqli_close($conn);

}

?>