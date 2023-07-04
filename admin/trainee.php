<?php
include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/traineeController.php';

$trainee_controller = new TraineeController();
$trainees = $trainee_controller->getTrainee();

?>
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Trainee</strong> Dashboard</h1>
                    <?php
                    if(isset($_GET['result']) && $_GET['result'] == true)
                    {
                        echo "<div class = 'text-info'>New Trainee has been successfully added</div>";
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="add_trainee.php" class = "btn btn-dark">Add New Trainee</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class = "table table-striped" id="mytable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone No</th>
                                        <th>City</th>
                                        <th>Education</th>
                                        <th>Remark</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach($trainees as $trainee)
                                    {
                                        echo "<tr>";
                                        echo "<td>".$count++."</td>";
                                        echo "<td>".$trainee['name']."</td>";
                                        echo "<td>".$trainee['email']."</td>";
                                        echo "<td>".$trainee['phone']."</td>";
                                        echo "<td>".$trainee['city']."</td>";
                                        echo "<td>".$trainee['education']."</td>";
                                        echo "<td>".$trainee['remark']."</td>";
                                        echo "<td>".$trainee['status']."</td>";
                                        echo "<td><img src = '../uploads/".$trainee['image']."'width = '100px' height = '100px'></td>";
                                        echo "<td id='".$trainee['id']."'><a class = 'btn btn-info mx-1' href='email_trainee.php?id=".$trainee['id']."'>Email</td>";
                                        echo "<td id='".$trainee['id']."'><a class = 'btn btn-warning mx-1' href='edit_trainee.php?id=".$trainee['id']."'>Edit</a><button class = 'btn btn-danger mx-1 trainee_btn_delete'>Delete</button></td>";
                                        
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