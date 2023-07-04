<?php

include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/traineeController.php';

$trainee_controller = new TraineeController();
$tcs = $trainee_controller->traineeStatus();
if(isset($_POST['submit']))
{
    if(empty($_POST['name']))
        $name_error = "Please fill your name";

    if(empty($_POST['email']))
        $email_error = "Please fill your email";
    
    if(empty($_POST['phone']))
        $phone_error = "Please fill your phone number";
    
    if(empty($_POST['city']))
        $city_error = "Please fill your city";

    if(empty($_POST['education']))
        $education_error = "Please fill your education";

    if(empty($_POST['remark']))
        $remark_error = "Please fill your remark";

    if(empty($_POST['status']))
        $status = $_POST['status'];
        
    if(empty($_FILES['image']))
        $image = $_FILES['image'];
       

    else
    $status_error = "Please select status";

    $image_error = "Please fill image";
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $education = $_POST['education'];
        $remark = $_POST['remark'];
        $image = $_FILES['image'];
        $status = $_POST['status'];
    //var_dump($image);
    $result = $trainee_controller->addTrainee($name,$email,$phone,$city,$education,$remark,$status,$image);
    if($result)
    {
        echo '<script>location.href="trainee.php?result='.$result.'"</script>';
    }
}

?>
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong> Add New Trainee</strong></h1>
                    <form action="" method = "post" enctype = "multipart/form-data" >
                        <div class = "my-3">
                            <label for="" class="form-label">Trainee Name</label>
                            <input type="text" name = "name" class="form-control"value = "<?php if(isset($name)) echo $name;?>">
                            <span class="text-danger"><?php if(isset($name_error)) echo $name_error;?></span>
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text" name = "email" class="form-control" value = "<?php if(isset($email)) echo $email;?>">
                            <span class="text-danger"><?php if(isset($email_error)) echo $email_error;?></span>
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Phone</label>
                            <input type="text" name = "phone" class="form-control" value = "<?php if(isset($phone)) echo $phone;?>">
                            <span class="text-danger"><?php if(isset($phone_error)) echo $phone_error;?></span>
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">City</label>
                            <input type="text" name = "city" class="form-control" value = "<?php if(isset($city)) echo $city;?>">
                            <span class="text-danger"><?php if(isset($city_error)) echo $city_error;?></span>
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Education</label>
                            <input type="text" name = "education" class="form-control" value = "<?php if(isset($education)) echo $education;?>">
                            <span class="text-danger"><?php if(isset($education_error)) echo $education_error;?></span>
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Remark</label>
                            <input type="text" name = "remark" class="form-control" value = "<?php if(isset($remark)) echo $remark;?>">
                            <span class="text-danger"><?php if(isset($remark_error)) echo $remark_error;?></span>
                        </div>
                        <div class = "my-3">
                        <label for="" class="form-label">Status</label>
                            <select name="status" id="" class="form-select" value = "<?php if(isset($status)) echo $status;?>" >
                                <option >select status</option>
                                <?php
                                foreach($tcs as $tc)
                                {
                                    echo "<option>".$tc['status']."</option>";
                                }
                                ?>
                                
                            </select>
                            <span class="text-danger"><?php if(isset($status_error)) echo $status_error;?></span>
                        </div>
                        <div class = "my-3">
                            <label for="" class="form-label">Trainee Featured Image</label>
                            <input type="file" name = "image" class="form-control" value = "<?php if(isset($image)) echo $image;?>">
                            <span class="text-danger"><?php if(isset($image_error)) echo $image_error;?></span>
                        </div>
                        <div class = "mt-3">
                            <button class = "btn btn-success" name = "submit">Add</button>
                        </div>
                    </form>
				</div>
</main>

<?php
include_once __DIR__.'/../layouts/app_footer.php';
?>
