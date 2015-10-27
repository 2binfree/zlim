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
					 'dbname'	=> 'Domain',
					 'user'		=> 'root', 
					 'pwd'		=> 't3rr3aux'),
		
	'route'	=> array(
					'home' => array(
							'path'			=> '/',
							'controller'	=> 'Home',
							'action'		=> 'index'),
					'other' => array(
							'path'			=> '/pouf',
							'controller'	=> 'Other',
							'action'		=> 'index')),
	'opendata' => array(
					'key' => 'eyJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoiNTYxY2U0Y2JjNzUxZGYwNWNkY2RiYjQ4IiwidGltZSI6MTQ0NDczNDE5Ni4wMTg0MTJ9.7AwJ1BdlaLbxyX1kw6bE6tuShD4LS3XW3QmBTQlE7fI')
		
); 