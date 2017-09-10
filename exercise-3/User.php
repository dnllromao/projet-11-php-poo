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

			DataBase::addUser([
				'username' => $this->username,
				'email' => $this->email,
				'password' => $this->password,
				'connected' => true
			]);

			$_SESSION['username'] = $this->username;
			$_SESSION['email'] = $this->email;
		}
	}

	private function connect($options) {

		if( $this->validateEmail($options['email'])
			&& $this->validateString($options['password'])
		) {
			// need sanitization
			$user = DataBase::connectUser($options['email']);

			$this->setUsername($user['id']);
			$this->setUsername($user['username']);
			$this->setEmail($user['email']);
			$this->setPassword($user['password']);

			$_SESSION['username'] = $this->username;
			$_SESSION['email'] = $this->email;
		}
	}

	public function disconnect() {
		DataBase::
	}

	private function setUsername($option) { $this->username = $option; }
	private function setEmail($option) { $this->email = $option; }
	private function setPassword($option) { $this->password = $option; }

	private function validateString($option) {
		return is_string($option);
	}

	private function validateEmail($option) {
		return filter_var($option, FILTER_VALIDATE_EMAIL);
	}
}


