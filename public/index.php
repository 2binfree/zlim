<?php
	require '../application/Library/LogActivityWriter.class.php';
	require '../application/vendor/autoload.php';
	include_once '../application/Bootstrap.php';
					
	$app = new \Slim\Slim(array(
		'debug' 		=> true,
		'mode' 			=> 'development',
		'log.enabled' 	=> true,
		'log.writer'	=> new \Library\LogActivityWriter()
	));
	
	$bootstrap = new Bootstrap();
	$bootstrap->init();
	
	$app->run();