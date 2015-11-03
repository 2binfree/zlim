<?php
namespace Controller\Home;

use \Curl\Curl;
//use Model\Fortress;

class Home extends \Controller\Controller {
	
	public function index(){
// 		$curl = new Curl();
// 		$apikey = \Slim\Slim::getInstance()->config['opendata']['key'];
// 		$curl->setHeader("X-API-KEY", $apikey);
// 		$curl->setURL("https://www.data.gouv.fr/api/1/organizations/?page_size=1");
// 		$data = $curl->exec();
// 		echo "<pre>";
// 		print_r($data);
// 		echo "</pre>";
// 		die;

		
		$records = \Model\Fortress::find('all', array('select' => 'name'));
		$fortress = array();
		foreach($records as $record){
			$fortress[] = $record->name;
		}
		$data["total"] = count($fortress);
		$data["fortress"] = $fortress;
		return array("data"	=> $data);
	}
	
	public function _refresh(){
		$fortress = new \Model\Fortress();
		
		//return array();
	}
}