<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

function pr($variable){
	echo "<pre style='background: #eee; padding: 10px; border: 1px solid #777;'>".
			print_r($variable, true).
		"</pre>";
}

class DataBase {
	private $user;
	private $password;
	private $dbname;
	private $host;
	private $port;
	private $pdo;

	public function __construct($user, $password, $dbname, $host, $port){
		$this->user = $user;
		$this->password = $password;
		$this->dbname = $dbname;
		$this->host = $host;
		$this->port = $port;
		try {
			$this->pdo = new PDO(
				'mysql:host='.$this->host.';port='.$this->port.';dbname='.$this->dbname, 
				$this->user, 
				$this->password
			);
		} catch (Exception $e){
		  echo "Unable to connect: " . $e->getMessage() ."<p>";
		}
	}
	public function get($query, $arguments = []){
		if(!empty($query)){
			$stmt = $this->pdo->prepare($query);
			$stmt->execute($arguments);
			if($stmt->rowCount() > 1){
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			} else {
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
			}
			
			$stmt->closeCursor();
			return $result;
		}
		return false;
	}
	public function change($query, $arguments = []){
		if(!empty($query)){
			$stmt = $this->pdo->prepare($query);
			$stmt->execute($arguments);
			$stmt->closeCursor();
			return $this->pdo;
		}
		return false;
	}
}

class User {
	public $db;
	public $id;
	public $username;
	public $email;
	public $password;
	public $connected;

	public function __construct($db, $id, $username, $email, $password, $connected){
		$this->db = $db;
		$this->id = $id;
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
		$this->connected = $connected;
	}

	public static function getUserById($db, $id){
		$result = $db->get("SELECT * FROM users WHERE id= ? ", [$id]);
		if(empty($result)){
			return false;
		}
		$user = new User(
			$db, 
			$result["id"], 
			$result["username"], 
			$result["email"], 
			$result["password"], 
			$result["connected"]
		);
		return $user;
	}

	public static function register($db, $username, $email, $password){
		$pdo = $db->change(
			"INSERT INTO users (username, email, password, connected) VALUES (?, ?, ?, ?)", 
			[$username, $email, $password, 1]
		);
		$user = new User($db, $pdo->lastInsertId(), $username, $email, $password, 1);
		$user->connect();
		return $user;
	}

	public function connect(){
		if(empty($_SESSION["user"])){
			$_SESSION["user"] = [
				"id" => $this->id, 
				"username" => $this->username, 
				"email" => $this->email, 
				"connected" => $this->connected
			];
			$pdo = $this->db->change(
				"UPDATE users SET connected = ? WHERE id = ?", 
				[1, $this->id]
			);
		}
		// header('Location: ./profile');
		echo "ConnectÃ©<br>";
	}

	public function disconnect(){
		$pdo = $this->db->change(
			"UPDATE users SET connected = ? WHERE id = ?", 
			[0, $this->id]
		);
		$this->reset();
	}
	public function reset(){
		session_unset(); 
		// header('Location: ./');
		echo "DÃ©connectÃ©<br>";
	}

	public function update_name($val){
		$pdo = $this->db->change(
			"UPDATE users SET username = ? WHERE id = ?", 
			[$val, $this->id]
		);
		$this->username = $val;
	}

	public function update_email($val){
		$pdo = $this->db->change(
			"UPDATE users SET email = ? WHERE id = ?", 
			[$val, $this->id]
		);
		$this->email = $val;
	}

	public function delete(){
		$pdo = $this->db->change(
			"DELETE FROM users WHERE id = ?", 
			[$this->id]
		);
		$this->reset();
	}
}


$db = new DataBase('root', 'root', 'demo', 'localhost','3306');

// $newUser = User::register($db, "teddy", "teddy@becode.org", "azerty");
/*
if($newUser){
	 $user->delete();
}
*/

$user = User::getUserById($db, 20);

$user->connect();

// $user->update_name("Robert yoloaaa");
// $user->update_email("bbb@truc.com");

// $user->disconnect();
// $user->delete();

pr( $user );

?>