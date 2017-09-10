<?php 

Autoloader::register(); 

/*session_unset();
session_destroy();*/

$database = new DataBase([
	'host' => 'localhost',
	'dbname' => 'homework',
	'username' => 'root',
	'password' => ''
]);

if(!empty($_SESSION)) {

	$email = (!empty($_SESSION['email']))? $_SESSION['email']: null;
	$password = (!empty($_SESSION['password']))? $_SESSION['password']: null;

	$anonimus = new User([
		'email' => $email,
		'password' => $password,
		'action' => 'connect'
	]);
}

if(empty($_POST)) {
	return;
}



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

	case 'update':

		$username = (!empty($_POST['username']))? $_POST['username']: null;
		$email = (!empty($_POST['email']))? $_POST['email']: null;
		var_dump($username);
		var_dump($email);
		$anonimus->update([
			'username' => $username,
			'email' => $email
		]);

		break;
	
	default:

		break;
}



