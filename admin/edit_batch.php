<?php

include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/batchController.php';
include_once __DIR__.'/../controller/courseController.php';

$id = $_GET['id'];
$co_con = new CourseController();
$courses = $co_con->getCourseList();

$bat_con = new BatchController();
$batch = $bat_con->getEdit($id);

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $start_date = $_POST['st_date'];
    $duration = $_POST['duration'];
    $discount = $_POST['discount'];
    $fee = $_POST['fee'];
    $course = $_POST['course'];
    $status = $bat_con->editBatch($id,$name,$start_date,$duration,$discount,$fee,$course);
    if($status)
    {
        echo '<script>location.href="batch.php?status='.$status.'"</script>';
    }
}
?>
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong> Edit Batch</strong> </h1>
                    <form action="" method = "post">
                        <div class = "my-3">
                            <label for="" class="form-label">Batch Name</label>
                            <input type="text" name="name" class="form-control" value = "<?php echo $batch['name']?>">
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Start Date</label>
                            <input type="date" name="st_date" class="form-control"  value = "<?php echo $batch['start_date']?>">
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Duration</label>
                            <input type="text" name="duration" class="form-control"  value = "<?php echo $batch['duration']?>">
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Discount</label>
                            <input type="text" name="discount" class="form-control"  value = "<?php echo $batch['discount']?>">
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Fee</label>
                            <input type="text" name="fee" class="form-control"  value = "<?php echo $batch['fee']?>">
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Course Batch</label>
                            <select name="course" id="" class = "form-select">
                                <?php
                                foreach($courses as $co)
                                {
                                    if($batch['course_id'] == $co['id'])
                                        echo "<option value=".$co['id']." selected >".$co['coname']."</option>";
                                    else
                                        echo "<option value=".$co['id']." >".$co['coname']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class= "mt-3">
                            <button class="btn btn-success" name="submit">Update</button>
                        </div>
                    </form>
				</div>
</main>
<?php
include_once __DIR__.'/../layouts/app_footer.php';
?>
