<?php 

class User {
	private $id;
	private $username;
	private $email;
	private $password;
	private $connected;

	public function __construct(array $options) {

		if($options['action'] == 'register') {
			$this->register($options);
		} elseif($options['action'] == 'connect') {
			$this->connect($options);
		}
		
	}

	private function register($options) {

		if(	$this->validateString($options['username'])
			&& $this->validateEmail($options['email'])
			&& $this->validateString($options['password'])
		) {
			// need sanitization
			$this->setUsername($options['username']);
			$this->setEmail($options['email']);
			$this->setPassword($options['password']);
			$this->setConnected(true);

			$id = DataBase::addUser([
				'username' => $this->username,
				'email' => $this->email,
				'password' => $this->password,
				'connected' => true
			]);

			$this->setId($id);
			$_SESSION['id'] = $this->id;
			$_SESSION['username'] = $this->username;
			$_SESSION['email'] = $this->email;
			$_SESSION['password'] = $this->password;

		}
	}

	private function connect($options) {

		if( $this->validateEmail($options['email'])
			&& $this->validateString($options['password'])
		) {
			// need sanitization
			$user = DataBase::connectUser($options['email']);

			$this->setId($user['id']);
			$this->setUsername($user['username']);
			$this->setEmail($user['email']);
			$this->setPassword($user['password']);
			$this->setConnected(true);

			$_SESSION['id'] = $this->id;
			$_SESSION['username'] = $this->username;
			$_SESSION['email'] = $this->email;
			$_SESSION['password'] = $this->password;
			
		}
	}

	public function disconnect() {
		$this->setConnected(false);
		DataBase::disconnectUser($this->email);
		session_unset();
		session_destroy();
	}

	public function update($options) {

		$this->username = $options['username'];
		$this->email = $options['email'];

		$data = array_merge($options, ['id' => $this->id]);

		DataBase::updateUser($data);

		$_SESSION['username'] = $this->username;
		$_SESSION['email'] = $this->email;
	}

	public function delete() {
		DataBase::deleteUser($this->id);
		session_unset();
		session_destroy();
	}

	private function setId($id) { $this->id = $id; }
	private function setUsername($option) { $this->username = $option; }
	private function setEmail($option) { $this->email = $option; }
	private function setPassword($option) { $this->password = $option; }
	private function setConnected($option) { $this->connected = $option; }

	private function validateString($option) {
		return is_string($option);
	}

	private function validateEmail($option) {
		return filter_var($option, FILTER_VALIDATE_EMAIL);
	}
}


