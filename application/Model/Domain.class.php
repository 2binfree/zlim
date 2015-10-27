<?php
namespace Model;

// class Domain extends DbTable {
// 	protected $tableName = "domain";
// }

class Domain extends \ActiveRecord\Model {
	static $table_name = 'domain';
}