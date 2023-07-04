<?php
include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/courseController.php';
include_once __DIR__.'/../controller/categoryController.php';

$cat_con = new CategoryController();
$categories = $cat_con->getCategoriesList();

$id = $_GET['id'];
$co_con = new CourseController();
$course = $co_con->getEditCourse($id);


if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $cat = $_POST['category'];
    $outline = $_POST['outline'];
    $status = $co_con->editCourse($id,$name,$cat,$outline);
    if($status)
    {
        echo '<script>location.href="course.php?status='.$status.'"</script>';
    }
}
?>
    <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Edit Course</strong></h1>

                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="post">
                                <div class = "my-3">
                                    <lable class="form-label">Course Name</lable>
                                    <input type="text" name= "name" class="form-control" value = "<?php echo $course['name']; ?>">
                                </div>
                                <div class = "my-3">
                                    <lable class="form-lable">Course Category</lable>
                                    <select name="category" id="" class="form-select">
                                       <?php
                                       foreach($categories as $category)
                                       {
                                        if($category['id'] == $course['cat_id'])
                                            echo "<option value=".$category['id']." selected>".$category['name']."</option>";
                                        else
                                            echo "<option value=".$category['id'].">".$category['name']."</option>";
                                       }                                      
                                        ?>
                                    </select>
                                </div>
                                <div class = "my-3">
                                    <lable class="form-label">Course Outline</lable>
                                    <textarea name="outline" id="" cols="30" rows="10" class="form-control" value = "<?php echo $course['outline']; ?>"></textarea>
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