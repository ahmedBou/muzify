<?php

	class Account {

		private $pdo;
		private $errorArray;

		public function __construct($pdo) {
			$this->pdo = $pdo;
			$this->errorArray = array();
		}

		// public function login($un, $pw){
		// 	// $pw = md5($pw);
		// 	echo $un;
		// 	echo $pw;

		// 	$query = $this->pdo->query("SELECT * FROM users WHERE username ='$un' and password ='$pw' ");
		// 	$result = $query->rowCount();

		// 	echo $result;

		// 	// if one result found matching the username and password
		// 	if($query->rowCount() == 1){
		// 		return true;
		// 	}
		// 	else{
		// 		array_push($this->errorArray, Constants::$loginFailed);
		// 		return false;
		// 	}
		// }

		public function login($un, $pw){
			// $pw = md5($pw);
			echo $un;
			echo $pw;

			$query = $this->pdo->query("SELECT * FROM users WHERE username ='$un' and password ='$pw' ");
			$result = $query->rowCount();

			echo $result;

			// if one result found matching the username and password
			if($query->rowCount() == 1){
			return [true, (bool)$query->fetch(PDO::FETCH_ASSOC)["isAdmin"]];
			}
			else{
				array_push($this->errorArray, Constants::$loginFailed);
				return false;
			}
		}

		public function register($un, $fn, $ln, $em, $pw, $pw2) {
			$this->validateUsername($un);
			$this->validateFirstName($fn);
			$this->validateLastName($ln);
			$this->validateEmails($em);
			$this->validatePasswords($pw, $pw2);

			if(empty($this->errorArray)) {
				return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
            }
			return false;
		}

		public function getError($error) {
			if(!in_array($error, $this->errorArray)) {
				$error = "";
			}
			return $error;
		}

		private function insertUserDetails($un, $fn, $ln, $em, $pw) {
			// $encryptedPw = md5($pw);
			$profilePic = "assets/images/profile-pics/head_default.png";
			$date = date("Y-m-d");
			return $this->pdo->query("INSERT INTO users (username, firstname,lastname, email,
                 		password, signUpDate, profilePic) 
                        VALUES ('$un', '$fn', '$ln', '$em', '$pw', '$date', '$profilePic')");
		}

		private function validateUsername($un) {
			if(strlen($un) > 25 || strlen($un) < 5) {
				array_push($this->errorArray, Constants::$usernameCharacters);
			}

			//TODO: check if username exists
			$checkUsernameQuery = $this->pdo->query("SELECT username FROM users WHERE username='$un'");
			if($checkUsernameQuery->rowCount() !=0 ){
				array_push($this->errorArray, Constants::$usernameTaken);
				return;
			}
		}

		private function validateFirstName($fn) {
			if(strlen($fn) > 25 || strlen($fn) < 2) {
				array_push($this->errorArray, Constants::$firstNameCharacters);
			}
		}

		private function validateLastName($ln) {
			if(strlen($ln) > 25 || strlen($ln) < 2) {
				array_push($this->errorArray, Constants::$lastNameCharacters);
			}
		}

		private function validateEmails($em) {
			if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, Constants::$emailInvalid);
			}
			$checkEmailQuery = $this->pdo->query("SELECT email FROM users WHERE email='$em'");
			if(mysqli_num_rows($checkEmailQuery) !=0){
				array_push($this->errorArray, Constants::$emailTaken);
				return;
			}
		}

		private function validatePasswords($pw, $pw2) {
			if($pw != $pw2) {
				array_push($this->errorArray, Constants::$passwordsDoNoMatch);
			}

			if(preg_match('/[^A-Za-z0-9]/', $pw)) {
				array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
			}

			if(strlen($pw) > 30 || strlen($pw) < 5) {
				array_push($this->errorArray, Constants::$passwordCharacters);
			}

		}
	}
?>

