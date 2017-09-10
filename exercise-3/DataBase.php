<?php

class DataBase {

	private static $db;

	public function __construct(array $options) {
		try {
			$db = new PDO('mysql:host='.$options['host'].';dbname='.$options['dbname'].';charset=utf8', $options['username'], $options['password'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		} catch (Exception $e){
			die('Error: '.$e->getMessage());
		}

		self::$db = $db;
	}

	static function addUser(array $options) { 
		$req = self::$db->prepare('INSERT INTO users(username, email, password, connected) VALUES (:username, :email, :password, :connected)');

		try {
			$resp = $req->execute($options);
		} catch (Exception $e){
			die('Error: '.$e->getMessage());
		}
	}

	static function connectUser($email) {

		$get = self::$db->prepare('SELECT id,username,email,password FROM users WHERE email = :email');
		$post = self::$db->prepare('UPDATE users SET connected = true WHERE email = :email');

		try {
			$get->execute(['email' => $email]);
			$post->execute(['email' => $email]);
		} catch (Exception $e){
			die('Error: '.$e->getMessage());
		}

		$user = $get->fetchAll(PDO::FETCH_ASSOC)[0];
		return $user;
	}

	static function disconnectUser($email) {

		$req = self::$db->prepare('UPDATE users SET connected = false WHERE email=:email');

		try {
			$resp = $req->execute(['email' => $email]);
		} catch (Exception $e){
			die('Error: '.$e->getMessage());
		}

		var_dump($resp);
	}

	static function updateUserName() {
		
	}

	static function updateUserEmail() {
		
	}

	static function deleteUser() {
		
	}
}




