<?php
include_once __DIR__.'/../controller/traineeController.php';
$id = $_POST['id'];

$trainee_con = new TraineeController();
$result = $trainee_con->deleteTrainee($id);
if($result)
{
    echo "success";
}
else
{
    echo "You can't delete as it has related child data";
}
?>