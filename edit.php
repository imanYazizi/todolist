<?php

$conn = require_once 'conn.php';

if ( $_GET['id'] != "" )
{
	$id = $_GET['id'];

	$stmt = $conn->prepare( "SELECT * FROM `task` WHERE id=? LIMIT 1" );
	$stmt->execute( [ $id ] );
	$row = $stmt->fetch();

	if ( empty( $row ) )
	{
		header( 'location:index.php' );
	}
}
else
{
	header( 'location:index.php' );
}

if ( ! empty( $_POST ) && isset( $_POST['action'] ) )
{
	$id = $row['id'];

	$name   = $_POST['name'];
	$status = $_POST['status'];


	$stmt = $conn->prepare( "UPDATE `task` SET `name` = ?, `status` = ? WHERE `id` = ?" );
	$stmt->execute( [ $name, $status, $id ] );
	header( 'location: index.php' );
}
?>
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
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div style="text-align: center;">
			<form method="POST" class="form-inline" action="edit.php?id=<?= $row['id'] ?>">
				<label>
					Task Name:
					<input type="text" class="form-control" value="<?= $row['name'] ?>" name="name" required/>
				</label>
				<br>
				<label>
					Status:
					<input type="text" class="form-control" name="status" value="<?= $row['status'] ?>" required/>
				</label>
				<br>
				<button class="btn btn-warning form-control" name="action">Edit</button>
			</form>
		</div>
	</div>
</div>
