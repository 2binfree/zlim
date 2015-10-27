<?php
namespace Controller\Home;

use \Curl\Curl;
use Model\Domain;

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

		
		$records = Domain::find('all', array('select' => 'name'));
		foreach($records as $record){
			$data[] = $record->name;
		}
		//print_r($data);die;
		return array("data"	=> $data);
	}
}