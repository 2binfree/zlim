<?php
namespace Library;

class Mysql {
	
	private $config;
	private $db;
	
	public function __construct($config){
		$this->config = $config;
	}
	
	public function connect(){
		$conn = NULL;
		try {
			$conn = new \PDO($this->getPDOString(), $this->config['db']['user'], $this->config['db']['pwd']);
		} catch ( \PDOException $e){
			$error = new Error($e->getCode(), $e->getMessage());
			return (object)array('status' => false, 'error' => $error);
		}
		$this->db = $conn;
		return (object)array('status' => true, 'error' => NULL);
	}
	
	public function execute($sql){
		$sth = $this->db->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}
	
	public function getMetadata($table){
		$sql = "DESCRIBE " . $table;
		return $this->execute($sql);
	}
	
	private function getPDOString(){
		$PDOString  = "mysql:host=";
		$PDOString .= $this->config['db']['host'];
		$PDOString .= ";dbname=";
		$PDOString .= $this->config['db']['dbname'];
		$PDOString .= ";charset=utf8;collation=utf8_unicode_ci";
		
		return $PDOString;
	}
}