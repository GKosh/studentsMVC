<?php
/**
* Controller class 
* controller.php
* General controller class. Contain general controllers methods and properties.
*
*
* @property string $default_layout Provide default_layout name if not specified in configurations.
* @property string $default_view Provide default_view if not specified in configurations.
* @property array $model contain required model name.
* @property array $data Contain variables to be passed to view.
* @property array $request Contain request properties and string of request itself
* 
* 
* @vertion 1.0
* @author G.Kosh
*/

namespace app;

if(!defined("APP_PATH")) die;  

class Controller
{
	private $default_layout = 'layout';
	private $default_view = 'view';
	public $model;
	public $data;
	public $request;

	
	function __construct(){
			
	}
	
	 /**
     * Include layout and set view parameters
     * When ajax request controller view without layout is included
     */
	public function setView($view_name = ""){
	
	if(empty($view_name)){
		$view_name = $this->default_view;  
	} else { $view_name = strtolower($view_name);
		}
	

	$javascript = \app::$Conf['JavaScript'];
	array_push($javascript, $view_name .'.js');
	$this->set(['JavaScript'=> $javascript ]);
	
	$this->set(['CSS'=>\app::getURL() . 'data/css/'. $view_name .'.css']);
		
	if (!$this->request['ajax']){
		$this->set([
		'header_path'=> \app::$Conf['viewPath'] . "header.php",
		'content_path'=> \app::$Conf['viewPath'] . $view_name . ".php",
		'footer_path'=>\app::$Conf['viewPath'] . "footer.php",
		]);
		
		extract($this->data,EXTR_OVERWRITE);
		
		if ((!empty($this->default_layout)) && (file_exists(\app::$Conf['viewPath'] . $this->default_layout . ".php"))) {
			include(\app::$Conf['viewPath'] . $this->default_layout . ".php");
		} else { 
			echo "Something bad happened(layout not found) =(" ;
		}
	} else{
		extract($this->data,EXTR_OVERWRITE);
		if (file_exists(\app::$Conf['viewPath'] . $view_name . ".php")) {
			include(\app::$Conf['viewPath'] . $view_name . ".php");
		}
	}
	}
	
	/**
     * Include model by name 
	 *
	 * Include required model or custom model if model_name not null 
	 * @param string @model_name Optional.
     */
	
	
	public function setModel($model_name=null){
		if(empty($model_name)){
		
		$model_name = (new \ReflectionClass($this))->getShortName();
			  
		}  
		require_once \app::$Conf['modelPath'] . $model_name . ".php";
		$model = "app\model\\" . $model_name;
		$this->model = new $model;
		$this->$model_name = $this->model;
	}
	
	public function set($data){
		if (is_array($data)){
			foreach ($data as $item=>$value) {
				$this->data[$item] = $value;
			}
		}
	}

}