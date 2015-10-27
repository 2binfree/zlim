<?php
	require '../application/vendor/autoload.php';
	include_once '../application/Bootstrap.php';
					
	$app = new \Slim\Slim(array(
		'debug' => true,
		'mode' 	=> 'development'
	));
	
	$bootstrap = new Bootstrap();
	$bootstrap->init();
	
	$app->run();