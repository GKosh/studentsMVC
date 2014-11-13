<?php

namespace app\controller;
use app;

class Students extends app\Controller
{
	function __construct(){
		$this->setModel();
	}
	
	public function index(){
		
		
		$this->set([
		"title" => "База студентов",
		"students"=> $this->model->studentsList(),
		]);
		$this->setView();
		
	}
	
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
	
	public function delete(){
		
		
	$studentData['id'] = $this->request['id'];
	if ($this->model->deleteStudent($studentData)) $this->response['success'] = true;
	$this->set([
		"title" => "База студентов",
		"students"=> $this->model->studentsList(),
		]);
	$this->setView('table');
	}
	
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
