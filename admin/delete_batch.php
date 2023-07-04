<?php
include_once __DIR__.'/../controller/batchController.php';

$id = $_POST['id'];
$bat_con = new BatchController();
$status = $bat_con->deleteBatch($id);

if($status)
{
    echo "success";
}
else
{
    echo "You can't delete as it has related child data";
}
?>