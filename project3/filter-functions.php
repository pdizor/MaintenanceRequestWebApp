<?php

// Filter through requests, only keeping requests
// with given aptNum
function filterByAptNum($requests, $aptNum) {

    $filtered_reqs = array();

    $ndx = 0;
    foreach ($requests as $request) {
        if ($request[1] == $aptNum) {
            $filtered_reqs[$ndx] = array($request[0], $request[1], $request[2], 
                                        $request[3], $request[4], $request[5], $request[6]);
        }
        $ndx++;
    }

    return $filtered_reqs;
}

// Filter through requests, only keeping requests
// with given area/location
function filterByArea($requests, $area) {

    $filtered_reqs = array();

    $ndx = 0;
    foreach ($requests as $request) {
        if ($request[2] == $area) {
            $filtered_reqs[$ndx] = array($request[0], $request[1], $request[2], 
                                        $request[3], $request[4], $request[5], $request[6]);
        }
        $ndx++;
    }

    return $filtered_reqs;
}

// Filter through requests, only keeping requests
// with dates within the specified date
function filterByDate($requests, $fromDate, $toDate) {

    $filtered_reqs = array();

    // extract year, month, day from dates
    $fd = extractDate($fromDate);
    $td = extractDate($toDate);

    $ndx = 0;
    foreach ($requests as $request) {
        $reqDate = extractDate($request[4]);

        // check if date is equal to or before the to date
        $lessThan = true;
        if ((int)$reqDate[0] <= (int)$td[0]) {
            if ((int)$reqDate[0] == (int)$td[0]) {
                if ((int)$reqDate[1] <= (int)$td[1]) {
                    if ((int)$reqDate[1] == (int)$td[1]) {
                        if ((int)$reqDate[2] > (int)$td[2])
                            $lessThan = false;
                    }
                }
                else $lessThan = false;
            }
        }
        else $lessThan = false;
        // check if date is equal to or after the from date
        $greaterThan = true;
        if ((int)$reqDate[0] >= (int)$fd[0]) {
            if ((int)$reqDate[0] == (int)$fd[0]) {
                if ((int)$reqDate[1] >= (int)$fd[1]) {
                    if ((int)$reqDate[1] == (int)$fd[1]) {
                        if ((int)$reqDate[2] < (int)$fd[2])
                            $greaterThan = false;
                    }
                }
                else $greaterThan = false;
            }
        }
        else $greaterThan = false;

        if ($lessThan && $greaterThan) {
            $filtered_reqs[$ndx] = array($request[0], $request[1], $request[2], 
                                        $request[3], $request[4], $request[5], $request[6]);
        }
        $ndx++;
    }

    return $filtered_reqs;
}

// filter through requests, only keeping requests
// with specified status
function filterByStatus($requests, $status) {

    $filtered_reqs = array();

    $ndx = 0;
    foreach ($requests as $request) {
        if ($request[6] == $status) {
            $filtered_reqs[$ndx] = array($request[0], $request[1], $request[2], 
                                        $request[3], $request[4], $request[5], $request[6]);
        }
        $ndx++;
    }

    return $filtered_reqs;
}

// extract year, month, a day from date of the form
// yyyy-mm-dd
function extractDate($date) {
    $year = "";
    $month = "";
    $day = "";

    for ($i = 0; $i < strlen($date); $i++) {
        if ($date[$i] != '-' && $i <= 4) {
            $year .= $date[$i]; 
        }
        if ($date[$i] != '-' && $i > 4 && $i <= 7) {
            $month .= $date[$i];
        }
        if ($i > 7) {
            $day .= $date[$i];
        }
    }
    $ymd = array($year, $month, $day);
    
    return $ymd;
}



?>