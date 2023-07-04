<?php
include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/traineeController.php';
include_once __DIR__.'/../controller/batchController.php';

$trainee_con = new TraineeController();
$trainees = $trainee_con->getTraineeList();
$tcs = $trainee_con->traineeCourseStatus();

$batch_con = new BatchController();
$batchs = $batch_con->getBatch();

$tc_con = new TraineeController();
if(isset($_POST['submit']))
{
    $tname = $_POST['tname'];
    $batname = $_POST['batch_name'];
    $joined_date = $_POST['jdate'];
    $status = $_POST['status'];

    $result = $tc_con->addTraineeCourse($tname,$batname,$joined_date,$status);
    if($result)
    {
        echo "<script>location.href = 'trainee_course.php'</script>";
    }
}
?>
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Add New Trainee Course</strong> </h1>
                    <form action="" method="post">
                        <div class="my-3">
                            <select name="batch_name" id="batch" class="form-select">
                                <option>Select Batch</option>
                            <?php
                                foreach($batchs as $batch)
                                {
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
                                    echo "<option value='".$trainee['id']."'>".$trainee['name']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class= "my-3">
                            <lable class="form-label">Joined Date</lable>
                            <input type="date" name = 'jdate'  class="form-control">
                        </div>
                        <div class= "my-3">
                            <select name="status" id="" class = "form-select">
                            <option value="">Select status</option>
                            <?php
                            foreach($tcs as $tc)
                            {
                                echo "<option>".$tc['status']."</option>";
                            }
                            ?>
                            </select>
                        </div>
                        <div class = "mt-3">
                            <button class="btn btn-success" name = "submit">Add</button>
                        </div>
                    </form>
				</div>
</main>
<?php
include_once __DIR__.'/../layouts/app_footer.php';
?>