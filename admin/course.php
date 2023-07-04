<?php
include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/courseController.php';

$course_controller = new CourseController();
$courses = $course_controller->getCourses();
?>
    <main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Course</strong> Dashboard</h1>
					<?php
                    if(isset($_GET['status']) && $_GET['status'] == true)
                    {
                        echo "<div class='alert alert-success text-info'>New Course has been successfully updated</div>";
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="add_course.php" class = "btn btn-dark">Add New Course</a>
                        </div>
                       
                    </div>
					<div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped" id="mytable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
										<th>Course Category</th>
										<th>Outline</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach($courses as $course)
                                    {
                                        echo "<tr>";
                                        echo "<td>".$count++."</td>";
                                        echo "<td>".$course['coname']."</td>";
										echo "<td>".$course['catname']."</td>";
										echo "<td>".$course['outline']."</td>";
                                        echo "<td id = '".$course['id']."'><a class = 'btn btn-warning mx-3' href='edit_course.php?id=".$course['id']."'>Edit</a><button class = 'btn btn-danger mx-3 course_btn_delete'>Delete</button></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
				</div>
	</main>
<?php
include_once __DIR__.'/../layouts/app_footer.php';
?>