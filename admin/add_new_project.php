<?php
include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/projectController.php';
include_once __DIR__.'/../controller/batchController.php';

$bat_con = new BatchController();
$batch = $bat_con->getBatch();
$pcon = new ProjectController();
$project = $pcon->getProject();
if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $start_date = $_POST['date'];
    $batname = $_POST['batch'];
    $status = $pcon->addProject($title,$start_date,$batname);
    if($status)
    {
        echo "<script>location.href = 'project.php?status=".$status."'</script>";
    }
}
?>
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Add New Projects</strong></h1>
                    <div class="row">
                        <form action="" method="post">
                            <div class="my-3">
                                <label for="" class="form-label">Project Title</label>
                                <input type="text" name = "title" class= "form-control" >
                            </div>
                            <div class="my-3">
                                <label for="" class="form-label">Start_Date</label>
                                <input type="date" name="date" class="form-control" >
                            </div>
                            <div class="my-3">
                                <label for="" class="form-label">Batch Name</label>
                                <select name="batch" id="" class= "form-select">
                                    <?php
                                    foreach($batch as $bat)
                                    {
                                        if($project['batch_id']== $bat['id'])
                                            echo "<option value=".$bat['id']."selected>".$bat['batname']."</option>";
                                        else
                                            echo "<option value=".$bat['id'].">".$bat['batname']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class= "mt-3">
                                <button class="btn btn-info" name = "submit">Add</button>
                            </div>
                        </form>
                    </div>
				</div>
</main>
<?php
include_once __DIR__.'/../layouts/app_footer.php';
?>