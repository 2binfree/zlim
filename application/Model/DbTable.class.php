<?php
namespace Model;

abstract class DbTable {
	
	protected $tableName = NULL;
	protected $metadata = NULL;
	protected $db = NULL;
	protected $primary = NULL;
	
	public function __construct(){
		$this->db = \Slim\Slim::getInstance()->db;
		$this->metadata = $this->db->getMetadata($this->getTableName());
	}
	
	/**
	 * Return the table row identified by the ID 
	 * @param string $id
	 * @throws Exception
	 * @return Array
	 */
	public function getRowById($id){
		$primary = $this->getPrimaryKey();
		if(is_null($primary)){
			throw new Exception("No primary key defined.");
		}
		$tableName = $this->getTableName();
		$sql  = 'SELECT * FROM ' . $tableName;
		$sql .= ' WHERE ' . $primary . " = '" . $id . "'";
		$result = $this->db->execute($sql);
		if (1 === count($result)){
			return $result[0];
		} else {
			return $result;
		}
	}
	
	/**
	 * return the current table name
	 * If the table name is not setted in the protected property, the class name is returned
	 * @return string
	 */
	public function getTableName(){
		if (is_null($this->tableName)){
			$this->tableName = get_class($this);
		}
		return $this->tableName;
	}
	
	/**
	 * return current table primary key
	 * @return string | NULL
	 */
	protected function getPrimaryKey(){
		if (is_null($this->primary)){
			foreach($this->metadata as $col){
				if ($col['Key'] === "PRI"){
					$this->primary = $col['Field'];
					break;
				}
			}
		}
		return $this->primary;
	}
	
	/**
	 * return all rows
	 * @return array
	 */
	public function getAll(){
		$tableName = $this->getTableName();
		$sql  = 'SELECT * FROM ' . $tableName;
		return $this->db->execute($sql);
	}
}