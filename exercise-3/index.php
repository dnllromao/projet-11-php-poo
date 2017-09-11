<?php 

	session_start();

	require 'autoloader.php';
	require 'script.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Poo</title>
</head>
<body>
	<div class="register">
		<h4>Register</h4>
		<form action="#" method="post">
			<label>Username: <input type="text" name="username"></label>
			<label>Email: <input type="email" name="email"></label>
			<label>Password: <input type="password" name="password"></label>
			<input type="submit" value="register" name="action">
		</form>
	</div>
	<div class="connect">
		<h4>Connect</h4>
		<form action="#" method="post">
			<label>Email: <input type="email" name="email"></label>
			<label>Password: <input type="password" name="password"></label>
			<input type="submit" value="connect" name="action">
		</form>
	</div>

	<?php if(isset($_SESSION['username'])): ?>
		<div class="connected">
			<h3>You're connected, <?= $_SESSION['username'] ?></h3>
			<div class="disconnect">
				<h4>Disconnect</h4>
				<form action="#" method="post">
					<input type="submit" value="disconnect" name="action">
				</form>
			</div>
			<div class="update">
				<h4>Update</h4>
				<form action="#" method="post">
					<label>Username: <input type="text" name="username" value="<?= $_SESSION['username']?>"></label>
					<label>Email: <input type="email" name="email" value="<?= $_SESSION['email']?>"></label>
					<input type="submit" value="update" name="action">
				</form>
			</div>
			<div class="delete">
				<h4>Delete</h4>
				<form action="#" method="post">
					<input type="submit" value="delete" name="action">
				</form>
			</div>
		</div>
	<?php endif; ?>
	
</body>
</html>