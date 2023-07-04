<?php
include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/batchController.php';
include_once __DIR__.'/../controller/courseController.php';

$co_con = new CourseController();
$courses = $co_con->getCourseList();

$bat_con = new BatchController();
if(isset($_POST['submit'])){
    if(empty($_POST['name']))
        $name_error = "Please fill batch name!";
      

    if(empty($_POST['st_date']))
        $st_date_error = "Please fill start date!";

    if(empty($_POST['duration']))
        $duration_error = "Please fill duration of batch!";

    if(empty($_POST['discount']))
        $discount_error = "If the batch has discount, please fill if or the batch doesn't has ,please fill 0!";

    if(empty($_POST['fee']))
        $fee_error = "Please fill batch fee!";

    if(empty($_POST['course']))
        $course_error = "Please select course!";

    else
        $name = $_POST['name'];
        $start_date = $_POST['st_date'];
        $duration = $_POST['duration'];
        $discount = $_POST['discount'];
        $fee = $_POST['fee'];
        $course = $_POST['course'];
        $status = $bat_con->createBatch($name,$start_date,$duration,$discount,$fee,$course);
        if($status)
        {
            echo '<script>location.href="batch.php?status='.$status.'"</script>';
        }
}

?>
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Add New Batch</strong></h1>
                    
                    <form action="" method = "post">
                        <div class = "my-3">
                            <label for="" class="form-label">Batch Name</label>
                            <input type="text" name="name" class="form-control" value = "<?php if(isset($name)) echo $name;?>">
                            <span class="text-danger"><?php if(isset($name_error)) echo $name_error;?></span>
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Start Date</label>
                            <input type="date" name="st_date" class="form-control" value = "<?php if(isset($start_date)) echo $start_date;?>">
                            <span class="text-danger"><?php if(isset($st_date_error)) echo $st_date_error;?></span>
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Duration</label>
                            <input type="text" name="duration" class="form-control" value = "<?php if(isset($duration)) echo $duration;?>">
                            <span class="text-danger"><?php if(isset($duration_error)) echo $duration_error;?></span>
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Discount</label>
                            <input type="text" name="discount" class="form-control" value = "<?php if(isset($discount)) echo $discount;?>">
                            <span class="text-danger"><?php if(isset($discount_error)) echo $discount_error;?></span>
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Fee</label>
                            <input type="text" name="fee" class="form-control" value = "<?php if(isset($fee)) echo $fee;?>">
                            <span class="text-danger"><?php if(isset($fee_error)) echo $fee_error;?></span>
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Course Batch</label>
                            <select name="course" id="" class = "form-select" value = "<?php if(isset($course)) echo $course;?>">
                                <?php
                                foreach($courses as $co)
                                {
                                    echo "<option value=".$co['id'].">".$co['coname']."</option>";
                                }
                                ?>
                                <span class="text-danger"><?php if(isset($course_error)) echo $course_error;?></span>
                            </select>
                        </div>
                        <div class= "mt-3">
                            <button class="btn btn-success" name="submit">Add</button>
                        </div>
                    </form>
				</div>
</main>
<?php
include_once __DIR__.'/../layouts/app_footer.php';
?>