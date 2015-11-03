<?php
namespace Library;

class ImportLogWriter {
	
	private $logTable;
	
	public function __construct(){
			
	}
	
	public function write(mixed $message, $level, $from, $to){
		$log = new \Model\LogImport();
		$log->message = $message;
		$log->level = $level;
		$log->from = $from;
		$log->to = $to;
		$log->creation_date = array("select" => "now()");
		$log->save();
	}
	
}