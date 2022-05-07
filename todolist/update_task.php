<?php
$conn = require_once 'conn.php';

if ( $_GET['id'] != "" )
{
	$id = $_GET['id'];

	$stmt = $conn->prepare( "UPDATE `task` SET `status` = 'Done' WHERE `id` = ?" );
	$stmt->execute( [ $id ] );
	header( 'location: index.php' );
}
