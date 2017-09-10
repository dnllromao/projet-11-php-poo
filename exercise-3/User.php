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
			$_SESSION['password'] = $this->password;
			//need to set id too, for updates !!!!
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

			$_SESSION['username'] = $this->username;
			$_SESSION['email'] = $this->email;
			$_SESSION['password'] = $this->password;
			$_SESSION['id'] = $this->id;
		}
	}

	public function disconnect() {
		DataBase::disconnectUser($this->email);
	}

	public function update($options) {
		$data = array_merge($options, ['id' => $this->id]);
		var_dump($data);
		DataBase::updateUser($data);
	}

	private function setId($id) { $this->id = $id; }

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


