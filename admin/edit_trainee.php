<?php

include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/traineeController.php';

$id = $_GET['id'];
$trainee_controller = new TraineeController();
$trainee = $trainee_controller->getEditTrainee($id);
$tcs =  $trainee_controller->traineeStatus();
if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $education = $_POST['education'];
    $remark = $_POST['remark'];
    $image = $_FILES['image'];
    $status = $_POST['status'];

    $result = $trainee_controller->editTrainee($id,$name,$email,$phone,$city,$education,$remark,$status,$image);
    if($result)
    {
        echo '<script>location.href="trainee.php?result='.$result.'"</script>';
    }
}

?>
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong> Edit Trainee</strong></h1>
                    <form action="" method = "post" enctype = "multipart/form-data">
                        <div class = "my-3">
                            <label for="" class="form-label">Trainee Name</label>
                            <input type="text" name = "name" class="form-control" value = "<?php  echo $trainee['name']; ?>">
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text" name = "email" class="form-control" value = "<?php echo $trainee['email']; ?>">
                            
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Phone</label>
                            <input type="text" name = "phone" class="form-control" value = "<?php  echo $trainee['phone']; ?>">
                            
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">City</label>
                            <input type="text" name = "city" class="form-control" value = "<?php  echo $trainee['city']; ?>">
                            
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Education</label>
                            <input type="text" name = "education" class="form-control" value = "<?php  echo $trainee['education']; ?>">
                            
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Remark</label>
                            <input type="text" name = "remark" class="form-control" value = "<?php  echo $trainee['remark']; ?>">
                            
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Status</label>
                            <select name="status" id="" class="form-select">
                                <?php
                                foreach($tcs as $tc)
                                {
                                    if($tc['status'] == 'online')
                                    {
                                        echo "<option value=".$trainee['id']."selected>".$tc['status']."</option>";
                                        
                                    }
                                    else
                                    {
                                        echo "<option>".$tc['status']."</option>";
                                        
                                    }
                                       
                                }
                                ?>
                            </select>
                            
                        </div>
                        <div class = "my-3">
                            <div>
                            <img src = "" value = "<?php echo $trainee['image']; ?>"/>
                            </div>
                            <label for="" class="form-label">Trainee Featured Image</label>
                            <input type="file" name = "image" class="form-control">
                            
                        </div>
                        <div class = "mt-3">
                            <button class = "btn btn-success" name = "submit">Update</button>
                        </div>
                    </form>
				</div>
</main>

<?php
include_once __DIR__.'/../layouts/app_footer.php';
?>
