<?php
include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/instructorController.php';

$id = $_GET['id'];
$in_con = new InstructorController();
$instructor = $in_con->getEditInstructor($id);

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $position = $_POST['position'];
    $status = $in_con->editInstructor($id,$name,$email,$phone,$address,$position);
    if($status)
    {
        echo '<script> location.href="instructor.php"</script>';
    }
}
?>
    <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Edit Instructor</strong></h1>

                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post">
                                <div class = "my-3">
                                    <lable class="form-label">Instructor Name</lable>
                                    <input type="text" name= "name" class="form-control" value = "<?php echo $instructor['name']; ?>">
                                </div>
                                <div class = "my-3">
                                    <lable class="form-label">Email</lable>
                                    <input type="text" name= "email" class="form-control" value = "<?php echo $instructor['email']; ?>">
                                </div>
                                <div class = "my-3">
                                    <lable class="form-label">Phone</lable>
                                    <input type="text" name= "phone" class="form-control" value = "<?php echo $instructor['phone']; ?>">
                                </div>
                                <div class = "my-3">
                                    <lable class="form-label">Address</lable>
                                    <input type="text" name= "address" class="form-control" value = "<?php echo $instructor['address']; ?>">
                                </div>
                                <div class = "my-3">
                                    <lable class="form-label">Position</lable>
                                    <input type="text" name= "position" class="form-control" value = "<?php echo $instructor['position']; ?>">
                                </div>
                                <div class = 'mt-3'>
                                    <button class="btn btn-dark" name = "submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
				</div>
	</main>
<?php
include_once __DIR__.'/../layouts/app_footer.php';
?>