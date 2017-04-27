<?php

class User {
	private $username;
	private $password;

	public function __construct() {
		$this->pdo = new PDO('mysql:host=localhost;dbname=cheeseshop', 'root', '');
	}

	## TJEK OM BRUGER EKSISTERER. return true, hvis ja
	private function userExists($username) {
		$this->username = $username;
		if ($stmt = $this->pdo->prepare("SELECT id FROM brugere WHERE username = :username")) {
			$stmt->bindParam(':username', $this->username);
			if ($stmt->execute()) {
				if ($stmt->rowCount() > 0) {
					return true;
				} else {
					return false;
				}
			} else {
				return true;
			}
		} else {
			return true;
		}
	}

	## OPRET NY BRUGER
	public function create($username, $password) {
		$this->username = $username;
		$this->password = $password;

		if (!$this->userExists($this->username)) {
			if ($stmt = $this->pdo->prepare("INSERT INTO brugere (username, password)
																 VALUES(:username, :password)")) {
				$stmt->bindParam(':username', $this->username);
				$stmt->bindParam(':password', password_hash($this->password,
																			PASSWORD_BCRYPT, [ 'cost' => 12 ]));
				if ($stmt->execute()) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function getLastUserId() {
		$result = $this->pdo->query("SELECT id FROM brugere ORDER BY id DESC LIMIT 1");
		$row = $result->fetch(PDO::FETCH_ASSOC);
		return $row['id'];
	}
}
