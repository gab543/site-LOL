<?php
$dsn = 'mysql:dbname=siteLOL;host=localhost';
$user = 'root';
$password = 'root';

try
{
	$pdo = new PDO($dsn,$user,$password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo "PDO error".$e->getMessage();
	die();
}
?>