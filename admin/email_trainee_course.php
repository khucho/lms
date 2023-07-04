<?php
include_once __DIR__.'/../controller/traineeController.php';
$id = $_GET['id'];
$tcon = new TraineeController();
$status = $tcon->mailTraineeCourse($id);


if($status == true)
{
    echo "<script>location.href = 'trainee_course.php?status=$status'</script>";
}
?>