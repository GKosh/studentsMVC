<?php
/**
* Student controller class 
* students.php
* 
*
*  Extendds general controller class with particular actions(methods). Contain actions logic, operate with models and views.
* 
* 
* @vertion 1.0
* @author G.Kosh
*/

namespace app\controller;
use app;

class Students extends app\Controller
{
	function __construct(){
		$this->setModel();
	}
	 /**
     * Index action
     * Set title, get students list and set view
     */
	public function index(){
		
		
		$this->set([
		"title" => "База студентов",
		"students"=> $this->model->studentsList(),
		]);
		$this->setView();
		
	}
	/**
     * Add action
     * Add requested student to the database via students module
     */
	public function add(){
	
	$studentData['name'] = $this->request['name'];
	$studentData['sex'] = $this->request['sex'];
	$studentData['age'] = $this->request['age'];
	$studentData['grp'] = $this->request['grp'];
	$studentData['faculty'] = $this->request['faculty'];
		
	if ($this->model->addStudent($studentData)) $this->response['success'] = true;
	$this->set([
		"title" => "База студентов",
		"students"=> $this->model->studentsList(),
		]);
	$this->setView('table');
	}
	
	
	/**
     * Delete action
     * Delete requested student from the database via students module
     */
	public function delete(){
		
		
	$studentData['id'] = $this->request['id'];
	if ($this->model->deleteStudent($studentData)) $this->response['success'] = true;
	$this->set([
		"title" => "База студентов",
		"students"=> $this->model->studentsList(),
		]);
	$this->setView('table');
	}
	
	/**
     * Update action
     * Update requested students to the database via students module
     */
	public function update(){
	$studentData['id'] = $this->request['id'];
	$studentData['name'] = $this->request['name'];
	$studentData['sex'] = $this->request['sex'];
	$studentData['age'] = $this->request['age'];
	$studentData['grp'] = $this->request['grp'];
	$studentData['faculty'] = $this->request['faculty'];
	
	if ($this->model->updateStudent($studentData)) $this->response['success'] = true;
		$this->set([
		"title" => "База студентов",
		"students"=> $this->model->studentsList(),
		]);
	$this->setView('table');
	}
	
	

};
