<?php 
/**
* Application boot class
* app.php 
* 
* @property array $configs app onject propery contain configurations form config.php file.
* @property array $Conf static clone of $configs.
* @property array $request Contain request properties and string of request itself
* @property string/object  Before loadController function is called contain name of requested controller. After loadController function is invoked $controller contains instance of Controller object.
* @property string $method Required method(action).
* @property array $params Array of required URL parameters.
* 
* @vertion 1.0
* @author G.Kosh
*/

class app 
{
	public $configs;
	public static $Conf;
	public $request;
	public $controller = "default";
	public $method = "index";
	public $params;
	
	public function __construct($configs = []){
		session_start();
		//	$this->configs = json_decode (CONFIGS, true);
		$this->configs = $configs;
		\app::$Conf = $configs;
		
		$this->controller = $this->configs['defaultController'];
		$this->method = $this->configs['defaultMethod'];
		// загрузка класса БД
		if (file_exists($this->configs['dbClass'])) {
			require_once($this->configs['dbClass']) ;
			$db = new Database($configs);
		}
		// загрузка класса Контроллера
		if (file_exists($this->configs['ControllerClass'])) {
			require_once($this->configs['ControllerClass']) ;
		}
		// обработка УРЛ и загрузка контролера
		$this->parseRequest();
		$this->loadController();
	}
	
	 /**
     * Provide base URL of application.
     * 
     * @return Base URL string
     */
	public static function getURL(){
			$pageURL = 'http';
		if ((isset($_SERVER["HTTPS"])) && (strtolower($_SERVER["HTTPS"]) == "on")) $pageURL .= "s"; 
			$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80")
			$pageURL.=$_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . '/';
		else 
			$pageURL .= $_SERVER["SERVER_NAME"] . '/';
	
		return $pageURL;
	}

	/**
     * Handles request and call required controller with set of parameters from request.
     * @return Response the resulting response
     * 
     */
	public function parseRequest(){
		
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
			$this->request['ajax'] = true;
			else $this->request['ajax'] = false;
		if(isset($_POST)) foreach ($_POST as $key=>$value){
			 $this->request[$key] = $value;
		};
		if(isset($_GET)) foreach ($_GET as $key=>$value){
			 $this->request[$key] = $value;
		};
		
		if ($_SERVER['REQUEST_URI'] != '/') {
			$URI_path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH),"/");
			$URI_path = substr($URI_path,strlen($this->configs["subURL"]));
			@list($controller,$method,$params) = $URI_parts = explode('/', $URI_path);
			
			if ((isset($controller))&&($controller!="")){
				
				$this->controller = strtolower($controller);
				if (isset($method)){
					$this->method = strtolower($method);
				}
				if (!empty($params)){
				    $params = explode("/",$params);
					$this->params = $params;
				} 
			} 
		}
	
	}
	
	/**
     *  @return controller
     */
	public function getController(){
		return $this->controller;
	}
	
	/**
     *  @return string method 
     */
	public function getMethod(){
		return $this->method;
	}
	
	/**
     *  @return array reuested parameters or false
     */
	public function getParams(){
		if (!empty($this->params)){
			return $this->params;
		} else {
			return false;
		}
	}
	/**
    * Controller loader
	* Create controller instance adn load required method. Pass required parameters if defined
    */
	public function loadController($controller = null,$method = null,$params = null){
	    if ((empty($controller))||(empty($method))){
			$method = $this->getMethod();
			$controller = $this->getController();
			$params = $this->getParams();
			
	
		}
		$controllerPath = $this->configs["controllerPath"] . $controller . ".php"; 
	
		if (file_exists($controllerPath)){
			require_once($controllerPath);
		/**
		* Запуск метода и передача параметров
		*/
			if (!empty($params)) $this->request['params'] = $params;
			$controller = "\app\controller\\" . ucfirst($controller); 
				$this->controller = new $controller();
				$this->controller->request = $this->request;
				
			if (method_exists($controller,$method)){
				$this->controller->$method();
			} else  {
			echo "Sorry! This page cannot be found(method ". $method ." doesn't exist)!";
			}
		} else { 
			echo "Sorry! This page cannot be found(controller ". $controllerPath ." doesn't exist)!"; 
		}
	}

	public function loginCheck(){
	
		return false;
	}

	/**
     *  Log file
	 *  @param string message Log message to be placed in log file.
     */
	public function logMessage($message){
		file_put_contents( $this->configs["logPath"] . "log.txt", $message. "\n",FILE_APPEND);
	}

}




