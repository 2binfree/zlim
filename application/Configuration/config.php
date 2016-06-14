<?php

/*
 * To define a route, create a top level array entry with 'route' keyword.
 * For each route :
 * 		'route_name' => array('path' => 'the real path for your application',
 * 							  'controller' => 'the controller class name without file extension',
 * 							  'action'	=> 'the method name of your controller class' 
 * 
 */
return array(
	'db'	=> array('host'	 	=> '127.0.0.1',
					 'dbname'	=> 'analysis',
					 'user'		=> 'root', 
					 'pwd'		=> ''),
	'db_rvip' => array('host'	 	=> '',
					 'dbname'	=> '',
					 'user'		=> 'r', 
					 'pwd'		=> ''),
	'route'	=> array(
					'home' => array(
							'path'			=> '/',
							'controller'	=> 'Home',
							'action'		=> 'index'),
					'fd_refresh' => array(
							'path'			=> '/refresh',
							'controller'	=> 'Home',
							'action'		=> '_refresh')),
	'logTable' => array(
					'name' => 'log_import'),
	'opendata' => array(
					'key' => '')
		
); 