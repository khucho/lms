<?php
include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/projectController.php';
include_once __DIR__.'/../controller/batchController.php';
$id = $_GET['id'];
$bat_con = new BatchController();
$batch = $bat_con->getBatch();
$pcon = new ProjectController();
$project = $pcon->getEditProjectById($id);
if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $start_date = $_POST['date'];
    $batname = $_POST['batch'];
    $status = $pcon->editProject($id,$title,$start_date,$batname);
    if($status)
    {
        echo "<script>location.href = 'project.php?status=".$status."'</script>";
    }
}
?>
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Edit Projects</strong></h1>
                    <div class="row">
                        <form action="" method="post">
                            <div class="my-3">
                                <label for="" class="form-label">Project Title</label>
                                <input type="text" name = "title" class= "form-control" value= "<?php echo $project['title']; ?>">
                            </div>
                            <div class="my-3">
                                <label for="" class="form-label">Start_Date</label>
                                <input type="date" name="date" class="form-control" value= "<?php echo $project['start_date']; ?>">
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
                                <button class="btn btn-info" name = "submit">Update</button>
                            </div>
                        </form>
                    </div>
				</div>
</main>
<?php
include_once __DIR__.'/../layouts/app_footer.php';
?>