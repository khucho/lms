<?php
include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/traineeController.php';
include_once __DIR__.'/../controller/projectController.php';

$id = $_GET['id'];
$pro_con = new ProjectController();
$project = $pro_con->getProjectById($id);

$batch_id = $project['bid'];

$tr_con = new TraineeController();
$trainee_course = $tr_con->traineeByBatch($batch_id);
?>
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Add New Information</strong></h1>
                    <div class="row">
                        <div class="col-md-6">
                           <p>Project Title:<?php echo $project['title'] ?></p>
                           <p>Start Date:<?php echo $project['start_date'] ?></p>
                        </div>
                        <div class="col-md-6">
                           <p>Batch Name:<?php echo $project['batname'] ?></p>
                        </div>
                    </div>
                    <div class="rows">
                        <form action="" method="post">
                                <div class = "row">
                                    <div class="col-md-8">
                                    <lable class="form-label">Trainee Name</lable>
                                    <select name="t_name[]" id="" class = "form-select">
                                        <option >select trainee name</option>
                                        <?php
                                        foreach($trainee_course as $tc)
                                        {
                                            echo "<option value='".$tc['tid']."'>".$tc['tname']."</option>";
                                        }
                                        ?>
                                    </select>
                                    </div>
                                    <div class="col-md-4" id = "<?php echo $batch_id; ?>">
                                        <button class="btn btn-secondary add_btn">Add More</button>
                                    </div>
                                </div>
                            
                        </form>
					</div>
                    <div class = "mt-3">
                        <button class="btn btn-info" name = "submit">Add</button>
                    </div>
				</div>
</main>
<?php
include_once __DIR__.'/../layouts/app_footer.php';
?>