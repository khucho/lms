<?php
include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/traineeController.php';

$tc_con = new TraineeController();
$train_co = $tc_con->getTraineeCourse();

?>
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Trainee Course</strong> Dashboard</h1>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="add_trainee_course.php" class="btn btn-dark">Add New Trainee and Course</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped" id="mytable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Trainee Name</th>
                                        <th>Batch Name</th>
                                        <th>Joined Date</th>
                                        <th>Status</th>
                                        <th>Email</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach($train_co as $tc)
                                    {
                                        echo "<tr>";
                                        echo "<td>".$count++."</td>";
                                        echo "<td>".$tc['tname']."</td>";
                                        echo "<td>".$tc['batname']."</td>";
                                        echo "<td>".$tc['joined_date']."</td>";
                                        echo "<td>".$tc['status']."</td>";
                                        if($tc['email'] == 1)
                                            echo "<td>Already Send!</td>";
                                        else
                                            echo "<td id='".$tc['id']."'><a class = 'btn btn-info mx-1 add_email' href='email_trainee_course.php?id=".$tc['id']."'>Send</td>";
                                        echo "<td id=".$tc['id']."><a class='btn btn-warning mx-3' href='edit_trainee_course.php?id=".$tc['id']."'>Edit</a><a class='btn btn-danger mx-3 tc_delete'>Delete</a></td>";
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