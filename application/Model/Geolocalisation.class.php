<?php
namespace Model;

class Geolocalisation extends \ActiveRecord\Model {
	static $connection = 'rvipdb';
	static $table_name = 'geolocalisation';
}