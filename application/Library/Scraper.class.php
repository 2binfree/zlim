<?php
//require 'Curl.php';

namespace Library;

use \Curl\Curl;

class Scraper {
	
	public $curl;
	
	public function __construct(){
		$this->curl = new Curl();		
	}
	
	public function run(){
		$this->curl->get('http://www.perdu.com/');
	}
	
	public function getResponse(){
		return $this->curl->response;
	}
	
	public function getError(){
		return array('Error: ' => $this->curl->errorCode, 'message' => $this->curl->errorMessage); 
	}
	
	public function getHeader(){
		var_dump($this->curl->requestHeaders);
		var_dump($this->curl->responseHeaders);
	}
	
}