<?php 
	require 'pdo.php';
	require 'autoloader.php'; 
	Autoloader::register(); 

	$database = new DataBase($db);
	$anonimus = new User([
		'username' => 'noname',
		'email' => 'noname@no.be',
		'password' => 'name'
	]);
	var_dump($anonimus);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
</body>
</html>