<?php
include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/instructorController.php';

$instructor_controller = new InstructorController();
if(isset($_POST['submit']))
{
    if(empty($_POST['name']))
    $name_error = "Please fill your name!";

    if(empty($_POST['email']))
    $email_error = "Please fill your email!";

    if(empty($_POST['phone']))
    $phone_error = "Please fill your phone number!";

    if(empty($_POST['address']))
    $address_error = "Please fill your address!";

    if(empty($_POST['position']))
    $position_error = "Please fill your position!";

    if(empty($_FILES['image']))
    $image = $_FILES['image'];

    else 
    $image_error = "Please select your image!";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $position = $_POST['position'];
   
    $status = $instructor_controller->addInstructor($name,$email,$phone,$address,$position,$image);
    if($status)
    {
        echo '<script>location.href="instructor.php?status='.$status.'"</script>';
    }
}
?>
	<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Instructor</strong> Dashboard</h1>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class= "my-3">
                                    <lable class="form-lable">Instructor Name</lable>
                                    <input type="text" name= "name" class="form-control" value = "<?php if(isset($name)) echo $name;?>">
                                    <span class= "text-danger"><?php if(isset($name_error)) echo $name_error;?></span>
                                </div>
                                <div class="my-3">
                                    <lable class="form-lable">Email</lable>
                                    <input type="text" name= "email" class="form-control" value = "<?php if(isset($email)) echo $email;?>">
                                    <span class= "text-danger"><?php if(isset($email_error)) echo $email_error;?></span>
                                </div>
                                <div class= "my-3">
                                    <lable class="form-lable">Phone</lable>
                                    <input type="text" name= "phone" class="form-control" value = "<?php if(isset($phone)) echo $phone;?>">
                                    <span class= "text-danger"><?php if(isset($phone_error)) echo $phone_error;?></span>
                                </div>
                                <div class= "my-3">
                                    <lable class="form-lable">Address</lable>
                                    <input type="text" name= "address" class="form-control" value = "<?php if(isset($address)) echo $address;?>">
                                    <span class= "text-danger"><?php if(isset($address_error)) echo $address_error;?></span>
                                </div>
                                <div class= "my-3">
                                    <lable class="form-lable">Position</lable>
                                    <input type="text" name= "position" class="form-control" value = "<?php if(isset($position)) echo $position;?>">
                                    <span class= "text-danger"><?php if(isset($position_error)) echo $position_error;?></span>
                                </div>
                                <div class = "my-3">
                                    <label for="" class="form-label">Trainee Featured Image</label>
                                    <input type="file" name = "image" class="form-control" value = "<?php if(isset($image)) echo $image;?>">
                                    <span class= "text-danger"><?php if(isset($image_error)) echo $image_error;?></span>
                        </div>
                                <div class = "mt-3">
                                    <button class="btn btn-dark" name="submit">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>

				</div>
	</main>
<?php
include_once __DIR__.'/../layouts/app_footer.php';
?>