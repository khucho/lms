<?php
include_once __DIR__.'/../controller/traineeController.php';
$id = $_POST['id'];
$tcon = new TraineeController();
$status = $tcon->deleteTraineeCourse($id);
if($status)
{
    echo "success";
}
else
{
    echo "You can't delete as its has related child data";
}
?>