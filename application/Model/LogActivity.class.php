<?php
namespace Model;

class LogActivity extends \ActiveRecord\Model {
	static $connection = 'domadb';
	static $table_name = 'log_activity';
}