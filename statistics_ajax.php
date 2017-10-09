<?php
require ('handlers/statistics.php');

if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
    $statistics = new StatisticsHandler();

    switch($action) {
        case 'getStatisticsData' : $statistics->getStatisticsData();break;
    }
}

?>