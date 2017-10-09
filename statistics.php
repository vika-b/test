<?php
require ('handlers/statistics.php');

$statistics = new StatisticsHandler();

$data = $statistics->getTableData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
    <link rel="stylesheet" href="vendor/twitter/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body id="statistics-page">
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <canvas id="all-discipline-pie"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="all-discipline-bar"></canvas>
        </div>
    </div>

    <div class="row">
        <table id="data-table" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Email</th>
                <th>B-day</th>
                <th>Gender</th>
                <th>Discipline</th>
                <th>Discipline style for Music</th>
                <th>Discipline profession for Music</th>
                <th>Discipline style for Dance</th>
                <th>Discipline profession for Dance</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Email</th>
                <th>B-day</th>
                <th>Gender</th>
                <th>Discipline</th>
                <th>Discipline style for Music</th>
                <th>Discipline profession for Music</th>
                <th>Discipline style for Dance</th>
                <th>Discipline profession for Dance</th>
            </tr>
            </tfoot>
            <tbody>
            <?php foreach ($data as $item) { ?>
                <tr>
                    <td><?=$item['email']?></td>
                    <td><?=$item['bday']?></td>
                    <td><?=$item['gender']?></td>
                    <td><?=$item['discipline']?></td>
                    <td><?=$item['discipline-music-style']?></td>
                    <td><?=$item['discipline-music-profession']?></td>
                    <td><?=$item['discipline-dance-style']?></td>
                    <td><?=$item['discipline-dance-profession']?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<script src="vendor/components/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>