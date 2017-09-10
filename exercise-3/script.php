<?php 

Autoloader::register(); 

//unset($_SESSION['username']);

if(empty($_POST)) {
	return;
}

$database = new DataBase([
	'host' => 'localhost',
	'dbname' => 'homework',
	'username' => 'root',
	'password' => ''
]);

switch ($_POST['action']) {
	case 'register':
		$username = (!empty($_POST['username']))? $_POST['username']: null;
		$email = (!empty($_POST['email']))? $_POST['email']: null;
		$password = (!empty($_POST['password']))? $_POST['password']: null;

		$anonimus = new User([
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'action' => 'register'
		]);

		break;

	case 'connect':
		$email = (!empty($_POST['email']))? $_POST['email']: null;
		$password = (!empty($_POST['password']))? $_POST['password']: null;

		$anonimus = new User([
			'email' => $email,
			'password' => $password,
			'action' => 'connect'
		]);

		break;

	case 'disconnect':

		$anonimus->disconnect();

		break;
	
	default:

		break;
}


