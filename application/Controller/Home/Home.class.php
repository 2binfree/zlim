<?php
namespace Controller\Home;

use \Curl\Curl;
use ActiveRecord;
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
		$requests = \Model\Request::find('all', 
										array('select' => 'name, id, tld, hl, gl'),
										array('joins' => 'geolocalisation'),
										array('conditions' => array('fortress_pending_date is not null'))
		);
		$updated = 0;
		foreach ($requests as $request){
			$id = $request->id;
			$tld = $request->geolocalisation->tld;
			$hl = $request->geolocalisation->hl;
			$gl = $request->geolocalisation->gl;
			
			if (false === $fortress->isExist($id, $tld, $gl, $hl)){
				$newFortress = new \Model\Fortress();
				$newFortress->name 			= $request->name;
				$newFortress->source_id 	= $id;
				$newFortress->tld 			= $tld;
				$newFortress->gl 			= $gl;
				$newFortress->hl 			= $hl;
				$newFortress->save();
				unset($newFortress);
				$updated++;
			}
		}
		echo json_encode($updated);
	}
}