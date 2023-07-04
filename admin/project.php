<?php
include_once __DIR__.'/../layouts/sidebar.php';
include_once __DIR__.'/../controller/projectController.php';

$pro_con = new ProjectController();
$projects = $pro_con->getProject();
?>
<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Projects</strong> Dashboard</h1>
					<div class="row">
						<div class="col-md-3">
						<a class= "btn btn-dark" href="add_new_project.php">Add Project</a>
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped">
								<thead>
									<th>No</th>
									<th>Project Title</th>
									<th>Start Date</th>
									<th>Batch</th>
									<th></th>
									<th class= "text-center">Action</th>
								</thead>
								<tbody>
									<?php
									$count = 0;
									foreach($projects as $project)
									{
										echo "<tr>";
										echo "<td>".$count++."</td>";
										echo "<td>".$project['title']."</td>";
										echo "<td>".$project['start_date']."</td>";
										echo "<td>".$project['batname']."</td>";
										echo "<td><a class = 'btn btn-info mx-1' href='add_project.php?id=".$project['id']."'>Add Information</a><button class = 'btn btn-success mx-1 '>Details</button></td>";
										echo "<td id='".$project['id']."'><a class = 'btn btn-warning mx-1' href='edit_project.php?id=".$project['id']."'>Edit</a><button class = 'btn btn-danger mx-1 project_delete'>Delete</button></td>";
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