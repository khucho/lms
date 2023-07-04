<?php
include_once __DIR__.'/../controller/instructorController.php';

$id = $_POST['id'];
$in_con = new InstructorController($id);
$result = $in_con->deleteInstructor($id);

if($result)
{
    echo "success";
}
else
{
    echo "You can't delete as it has related child data.";
}
?>