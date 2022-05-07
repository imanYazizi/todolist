<?php
$conn = require_once 'conn.php';
if ( isset( $_POST['add'] ) )
{
	if ( $_POST['name'] != "" )
	{
		$name = $_POST['name'];

		$stmt = $conn->prepare( "INSERT INTO `task` VALUES('', ?, 'Open')" );
		$stmt->execute( [ $name ] );
		header( 'location:index.php' );
	}
}
