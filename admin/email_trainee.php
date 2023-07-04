<?php
include_once __DIR__.'/../controller/traineeController.php';

$id = $_GET['id'];
$tcon = new TraineeController();
$status = $tcon->mailTrainee($id);

if($status == true)
{
    echo "<script>location.href = 'trainee.php?status=$status'</script>";
}
?>