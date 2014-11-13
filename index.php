
<?php
/**
* index.php - точка входа
* 
* Загружает config.php и app.php
* 
* @vertion 1.0
* @return HTML
*/


$timer = microtime(true);
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);



require_once(__DIR__ .DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "config.php");
require_once(__DIR__ .DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "app.php");

(new app($configs));
?>