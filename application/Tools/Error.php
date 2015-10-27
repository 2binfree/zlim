<?php

class Error {
	public $errorCode;
	public $errorMessage;
	
	public function __construct($code = 0, $message = ""){
		$this->errorCode = $code;
		$this->errorMessage = "";
	}
	
	public function setErrorCode($code){
		$this->errorCode = $code;
	}
	
	public function setErrorMessage($message){
		$this->errorMessage = $message;
	}
	
	public function getErrorCode(){
		return $this->errorCode;
	}

	public function getErrorMessage(){
		return $this->errorMessage;
	}	
	
	public static function displayError($error){
		echo "<pre>";
		print_r($error);
		echo "</pre>";
	}
	
}