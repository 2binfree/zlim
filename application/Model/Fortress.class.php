<?php
namespace Model;

// class Domain extends DbTable {
// 	protected $tableName = "domain";
// }

class Fortress extends \ActiveRecord\Model {
	static $connection = 'domadb';
	static $table_name = 'fortress';
	
	public function isExist($id, $tld, $gl, $hl){
		$records = $this->find("all", 
				array('conditions' => 
						array('source_id = ? and tld = ? and hl = ? and gl = ?', $id, $tld, $hl, $gl)
		));
		if (0 === count($records)){
			return false;
		} else {
			return true;
		}
	}
}