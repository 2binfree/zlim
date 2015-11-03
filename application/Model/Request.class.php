<?php
namespace Model;

class Request extends \ActiveRecord\Model {
	static $connection = 'rvipdb';
	static $table_name = 'request';
	static $belongs_to = array(array("geolocalisation"));
}