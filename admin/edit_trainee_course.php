<?php
include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/traineeController.php';
include_once __DIR__.'/../controller/batchController.php';

$id = $_GET['id'];
$trainee_con = new TraineeController();
$trainees = $trainee_con->getTraineeList();
$tcs = $trainee_con->traineeCourseStatus();
$trainee_course = $trainee_con->getEditTC($id);


$batch_con = new BatchController();
$batchs = $batch_con->getBatch();

if(isset($_POST['submit']))
{
    $batname = $_POST['batch_name'];
    $tname = $_POST['tname'];
    $joined_date = $_POST['jdate'];
    $status = $_POST['status'];

    $message = $trainee_con->editTraineeCourse($id,$tname,$batname,$joined_date,$status);
    if($message)
    {
        echo '<script>location.href ="trainee_course.php?message='.$message.'"</script>';
    }
}

?>
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Trainee Course</strong> Dashboard</h1>
                    <form action="" method = "post">
                    <div class="my-3">
                            <select name="batch_name" id="batch" class="form-select">
                                <option>Select Batch</option>
                            <?php
                                foreach($batchs as $batch)
                                {
                                    if($trainee_course['batch_id'] == $batch['id'])
                                        echo "<option value='".$batch['id']."'selected>".$batch['batname']."</option>";
                                    else
                                     echo "<option value='".$batch['id']."'>".$batch['batname']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class= "my-3">
                            <select name="tname" id="trainee" class="form-select">
                            <?php
                                foreach($trainees as $trainee)
                                {
                                    if($trainee_course['trainee_id'] == $trainee['id'])
                                        echo "<option value='".$trainee['id']."'selected>".$trainee['name']."</option>";
                                    else
                                        echo "<option value='".$trainee['id']."'>".$trainee['name']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class= "my-3">
                            <lable class="form-label">Joined Date</lable>
                            <input type="date" name = 'jdate'  class="form-control" value="<?php echo $trainee_course['joined_date']; ?>">
                        </div>
                        <div class= "my-3">
                            <select name="status" id="" class = "form-select">
                            <?php
                             foreach($tcs as $tc)
                             {
                                 if($tc['status'] == 'online')
                                 {
                                     echo "<option value=".$trainee_course['id']."selected>".$tc['status']."</option>";
                                     
                                 }
                                 else
                                 {
                                     echo "<option>".$tc['status']."</option>";
                                     
                                 }
                                    
                             }
                             ?>
                            </select>
                        </div>
                        <div class = "mt-3">
                            <button class="btn btn-success" name = "submit">Update</button>
                        </div>
                    </form>
				</div>
</main>
<?php
include_once __DIR__.'/../layouts/app_footer.php';
?>