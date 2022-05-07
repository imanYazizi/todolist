<?php
$host    = 'db';
$db      = 'todolist';
$user    = 'root';
$pass    = getenv('MYSQL_PASSWORD');
$charset = 'utf8mb4';

$dsn     = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES   => false,
];
try
{
	return new PDO( $dsn, $user, $pass, $options );
}
catch ( PDOException $e )
{
	throw new PDOException( $e->getMessage(), (int) $e->getCode() );
}