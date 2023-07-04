<?php
include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/batchController.php';

$bat_con = new BatchController();
$batchs = $bat_con->getBatch();
?>
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Batch</strong> Dashboard</h1>
                    <?php
                    if(isset($_GET['status']) && $_GET['status']== true)
                    {
                        echo "<a class='text-info'>New batch has been added successfully</a>";
                    }
                    ?>
                    <div class="row">
                        <div class="col-md-3">
                            <a href='add_batch.php' class='btn btn-dark'>Add New Batch</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped" id = "mytable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Start Date</th>
                                        <th>Duration</th>
                                        <th>Discount</th>
                                        <th>Fee</th>
                                        <th>Course Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0 ;
                                    foreach($batchs as $batch)
                                    {
                                        echo "<tr>";
                                        echo "<td>".$count++."</td>";
                                        echo "<td>".$batch['batname']."</td>";
                                        echo "<td>".$batch['start_date']."</td>";
                                        echo "<td>".$batch['duration']."</td>";
                                        echo "<td>".$batch['discount']."</td>";
                                        echo "<td>".$batch['fee']."</td>";
                                        echo "<td>".$batch['coname']."</td>";
                                        echo "<td id='".$batch['id']."'><a class ='btn btn-warning mx-1' href= 'edit_batch.php?id=".$batch['id']."'>Edit</a><button class='mx-1 btn btn-danger batch_btn_delete'>Delete</button></td>";
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