<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
	<title>TodoList</title>
</head>
<body>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<a class="navbar-brand" href="https://imanazizi.ir">Todolist</a>
	</div>
</nav>
<div class="col-md-3"></div>
<div class="col-md-6 well">
	<h3 class="text-primary">To Do List</h3>
	<hr style="border-top:1px dotted #ccc;"/>
	<div class="row">
		<div class="col-md-6" style="text-align: center;">
			<form method="GET" class="form-inline">
				<label>
					Search
					<input type="text" class="form-control" name="s" value="<?= ! empty( $_GET['s'] ) ? $_GET['s'] : "" ?>"/>
				</label>
				<button class="btn btn-primary form-control">Search</button>
			</form>
		</div>
		<div class="col-md-6" style="text-align: center;">
			<form method="POST" class="form-inline" action="add_query.php">
				<label>
					Task:
					<input type="text" class="form-control" name="name" required/>
				</label>
				<button class="btn btn-primary form-control" name="add">Add Task</button>
			</form>
		</div>
	</div>
	<br/><br/><br/>
	<table class="table">
		<thead>
		<tr>
			<th>#</th>
			<th>Task</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
		$conn = require 'conn.php';
		if ( ! empty( $_GET['s'] ) )
		{
			$query = $conn->prepare( "SELECT * FROM `task` WHERE `name` LIKE ? ORDER BY `id` ASC" );
			$query->execute( [ "%" . $_GET['s'] . "%" ] );
		}
		else
		{
			$query = $conn->query( "SELECT * FROM `task` ORDER BY `id` ASC" );
		}

		$count = 1;
		while ( $fetch = $query->fetch() )
		{
			?>
			<tr>
				<td><?= $count ++ ?></td>
				<td><?= $fetch['name'] ?></td>
				<td><?= $fetch['status'] ?></td>
				<td colspan="2">
					<div style="text-align: left;">
						<?php
						if ( $fetch['status'] != "Done" )
						{
							echo '<a href="update_task.php?id=' . $fetch['id'] . '" class="btn btn-success"><span class="glyphicon glyphicon-check"></span></a> |';
						}
						?>
						<a href="edit.php?id=<?php echo $fetch['id'] ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
						<a href="delete_query.php?id=<?php echo $fetch['id'] ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
					</div>
				</td>
			</tr>
			<?php
		}
		?>
		</tbody>
	</table>
</div>
</body>
</html><?php
