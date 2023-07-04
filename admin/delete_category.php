<?php
include_once __DIR__.'/../controller/categoryController.php';
$id = $_POST['id'];

$cat_con = new CategoryController();
$result = $cat_con->deleteCategory($id);

if($result)
{
    echo "success";
}
else
{
    echo "You can't delete as it has related child data.";
}

?>