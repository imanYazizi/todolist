<?php
$conn = require_once 'conn.php';

$stmt = $conn->prepare( "CREATE DATABASE IF NOT EXISTS `todolist`" );
$stmt->execute( [] );

$stmt = $conn->prepare( "
CREATE TABLE IF NOT EXISTS `task` (
`Id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
    `status` varchar(100) NOT NULL
)");
$stmt->execute( [] );