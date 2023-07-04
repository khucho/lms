<?php
include_once __DIR__.'/../controller/projectController.php';
$id = $_POST['id'];
$pcon = new ProjectController();
$status = $pcon->deleteProject($id);
if($status)
{
    echo "success";
}
else
{
    echo "You can't delete as it has related child data";
}
?>