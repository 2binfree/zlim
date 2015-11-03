<?php
include __DIR__ . '/Library/Autoloader.class.php';

class Bootstrap {
	private $app;
	
	/**
	 * initialize root app class in locale private variable
	 * load application configuration into app root class (app->config->...) 
	 * declare autoloader
	 */
	public function __construct(){
		$this->app = \Slim\Slim::getInstance();
		$this->app->config = include('../application/Configuration/config.php');
		\Library\Autoloader::register();
	}
	
	/**
	 * call all init methods
	 */
	public function init(){
		$this->initView();
		$this->initDb();
		$this->initRoute();
	}
	
	/**
	 * initialize twig environment and view path
	 */
	public function initView(){
		$loader = new Twig_Loader_Filesystem('../application/view');
		$twig = new Twig_Environment($loader /* ,array(twig config) */);
		$this->app->twig = $twig;
	}
	
	/**
	 * initialise ActiveRecord DB connection
	 */
	public function initDb(){
		$config = $this->app->config;
		$locale = $config['db'];
		$rvip = $config['db_rvip'];
		$dbPathLocale = "mysql://" . $locale['user'] . ":" . $locale['pwd'] . "@" . $locale['host'] . "/" . $locale['dbname'];
		$dbPathRvip = "mysql://" . $rvip['user'] . ":" . $rvip['pwd'] . "@" . $rvip['host'] . "/" . $rvip['dbname'];
		$connections = array(
			'domadb'	=> $dbPathLocale,
			'rvipdb'	=> $dbPathRvip
		);
		ActiveRecord\Config::initialize(function($cfg) use ($connections){
			$cfg->set_model_directory(__DIR__ . '/Model');
			$cfg->set_connections($connections);
		});				
	}
	/**
	 * declare all route from the config file
	 */
	public function initRoute(){
		$routes = array();
		if (isset($this->app->config['route'])){
			$routes = $this->app->config['route'];
		}
		
		$app = $this->app;
	
		foreach($routes as $name => $route){
			$class = '\\Controller\\' . $route['controller'] . '\\' . $route['controller'];
			if (!isset($route['path']) or $route['path'] == ''){
				$route['path'] = $route['controller'];
			}
			// define route
			$this->app->get($route['path'], function() use ($app, $route, $class) {
				// instanciate controller class
				$controller = new $class();
				// call method (the method must always return an array)
				$data = $controller->$route['action']();
				// compute view path
				$viewPath = $route['controller'] . '/' . $route['action'] . '.html.twig';
				// call template renderer with data
				// all actions with an underscore on the first character are not rendered 
				if (0 !== strpos($route['action'], '_')){
					echo $app->twig->render($viewPath, $data);
				}
			})->name($name);
		}
	}
}