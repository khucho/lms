<?php
include_once __DIR__.'/../controller/traineeController.php';

$bat_id = $_POST['id'];
$t_con = new TraineeController();
$trainee = $t_con->traineeByBatch($bat_id);

 $html = "";
 $html.= "<div class = 'row my-3'>";
 $html .= "<div class = 'col-md-8'>";
            
$html .= "<select name = 't_name[]' class = 'form-select'>";
$html .= "<option>select trainee name</option>";
foreach($trainee as $train)
{
    $html.= "<option value='".$train['tid']."'>".$train['tname']."</option>";
}
$html .= "</select>";
$html .= "</div>";
$html .= "<div class = 'col-md-3'><button class= 'btn btn-danger delete_btn'>Delete</button></div>";
$html .= "</div>";

echo $html;
?>