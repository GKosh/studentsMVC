<?php 
/**
* Configuration file 
* config.php 
* 
* @var array $configs Array with main application configurations: database, URL, directories  
* 
* @vertion 1.0
* @author G.Kosh
*/

define("APP_PATH", dirname(realpath(__FILE__)). DIRECTORY_SEPARATOR);


$configs = [
	"default_controller"=>"students",
	// resourses' directories 
	"controllerPath" => APP_PATH . "controller" . DIRECTORY_SEPARATOR,
	"modelPath" => APP_PATH . "model" . DIRECTORY_SEPARATOR,
	"viewPath" => APP_PATH . "view" . DIRECTORY_SEPARATOR,
	"logPath" => APP_PATH . "log" . DIRECTORY_SEPARATOR,
	// included classes
	"defaultController" => "students",
	"defaultMethod" => "index",
	"ControllerClass" => APP_PATH . "controller.php",
	"dbClass" => APP_PATH . "db.php",
	//url settings
	"subURL"=> "",
	// DB settings
	"DB_HOST" => "localhost",
	"DB_USER" => "root",
	"DB_PASS" => "",
	"DB_NAME" => "students",
	"JavaScript" => [
		"JQuery" => "jquery-1.11.1.min.js",
		"Bootstrap" => "bootstrap.min.js",
	],

];


