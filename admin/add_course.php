<?php
include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/courseController.php';
include_once __DIR__.'/../controller/categoryController.php';

$cat_con = new CategoryController();
$categories = $cat_con->getCategoriesList();

$course_controller = new CourseController();
if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $category = $_POST['category'];
    $outline = $_POST['outline'];
    $status = $course_controller->addCourse($name,$category,$outline);
    if($status)
    {
        echo '<script>location.href="course.php?status='.$status.'"</script>';
    }
}
?>
    <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Course</strong> Dashboard</h1>
					<div class="row">
                        <div class="col-md-12">
                            <form action="" method="post">
                                <div class = "my-3">
                                    <lable class="form-lable">Course Name</lable>
                                    <input type="text" name= "name" class="form-control">
                                    
                                </div>
                                <div class = "my-3">
                                    <lable class="form-lable">Course Category</lable>
                                    <select name="category" id="" class="form-select">
                                       <?php
                                       foreach($categories as $category)
                                       {
                                        echo "<option value=".$category['id'].">".$category['name']."</option>";
                                       }                                      
                                        ?>
                                        
                                    </select>
                                </div>
                                <div class = "my-3">
                                    <lable class="form-lable">Course Outline</lable>
                                    <textarea name="outline" id="" cols="30" rows="10" class="form-control"></textarea>
                                    
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