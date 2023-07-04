<?php
include_once __DIR__.'/../controller/courseController.php';

$co_con = new CourseController();
$course = $co_con->coursePerTrainee();

echo json_encode($course);
?>