<?php
namespace Library;

class LogActivityWriter {

	private static $delay;
	
	public function __construct(){
		self::$delay = microtime(true);
	}
	
	public function write($message, $level){
		self::$delay = microtime(true) - self::$delay;
		$log = new \Model\LogActivity();
		$log->message = $message;
		$log->level = $level;
		$log->creation_date = date('Y-m-d H:i:s');
		$log->delay = self::$delay;
		$log->memory = memory_get_usage();
		$log->save();
	}
	
}