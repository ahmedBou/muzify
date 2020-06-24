<?php 
    class Account{
        private $errorArray;
        public function __construct()
        {
            $this->errorArray = array();
        }
        public function register($un, $fn, $ln, $em, $em2, $pw, $pw2){
            $this->validateUsername($un);
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateEmails($em, $em2);
            $this->validatePasswords($pw, $pw2);

            if(empty($this->errorArray)== true){
                // insert into db
                return true;
            }else{
                return false;
            }
        }

        public function getError($error){
            if(!in_array($error, $this->errorArray)){
                return $error = "";
            }else{
                return "<span class='errorMessage'>$error</span>";
            }
        }

        private function validateUsername($un){
            if(strlen($un)> 25 || strlen($un)<5){
                array_push($this->errorArray, Constants::$userNameCharacters);
                return;

            }
            // TODO: check if the username exists
        }
        private function validateFirstName($fn){
            if(strlen($fn)> 25 || strlen($fn)<2){
                array_push($this->errorArray, Constants::$firstNameCharacters);
                return;

            }        
        }

        
        private function validateLastName($ln){
            if(strlen($ln)> 25 || strlen($ln)<2){
                array_push($this->errorArray, Constants::$lastNameCharacters);
                return;
            }  
        }

        private function validateEmails($em,$em2){
            if($em != $em2){
                array_push($this->errorArray, Constants::$emailDoNotMatch);
                return;
            }
            if(!filter_var($em, FILTER_VALIDATE_EMAIL)){
                array_push($this->errorArray, Constants::$emailInvalid);
            }
            // TODO: Check that username hans't already been used
        }
        private function validatePasswords($pw,$pw2){
            if($pw != $pw2){
                array_push($this->errorArray, Constants::$passwordsDoNoMatch);
                return;
            }

            if(preg_match("/[^A-Za-z0-9]/", $pw)){
                array_push($this->errorArray, Constants::$passwordNotAlphanumeric); 
                return;             
            }

            if(strlen($pw)>30 || strlen($pw)< 5){
                array_push($this->errorArray, Constants::$passwordCharacters);
                return;
            }

        }

    }

?>