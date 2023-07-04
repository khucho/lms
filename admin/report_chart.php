<?php
include_once __DIR__.'/../controller/batchController.php';

$bat_con = new BatchController();
$batch_per_year = $bat_con->batchPerYear();

echo json_encode($batch_per_year);
?>