<?php
include_once __DIR__.'/../controller/courseController.php';
$id = $_POST['id'];

$co_con = new CourseController();
$result = $co_con->deleteCourse($id);

if($result)
{
    echo "success";
}
else
{
    echo "You can't delete as it has related child data.";
}

?>