<?php

/**
* students.php 
* 
*  
* @vertion 1.0
*/

namespace app\model;

if(!defined("APP_PATH")) die;  

class Students 
{

	public function addStudent($student){
		$db = new \Database;
		$db->query("INSERT INTO students(name , sex, age, grp, faculty) VALUES(:name,:sex,:age,:grp,:faculty);");
		$db->bind(':name', $student['name']);
		$db->bind(':sex', $student['sex']);
		$db->bind(':age', $student['age']);
		$db->bind(':grp', $student['grp']);
		$db->bind(':faculty', $student['faculty']);
		return $db->execute();
	}
	public function deleteStudent($student){
		$db = new \Database;
		$db->query("DELETE FROM students WHERE id = :id");
		$db->bind(':id', $student['id']);
		return $db->execute();
	}
		
	public function studentsList(){
		$db = new \Database;
		$db->query("SELECT id as ID, name as Name, sex as Sex, age as Age,grp as 'Group', faculty as Faculty FROM students");
		return $db->resultset();
	}
 
	public function getStudent($student){
		$db = new \Database ;
		$db->query("SELECT id as ID, name as Name, sex as Sex, age as Age,grp as 'Group', faculty as Faculty FROM students WHERE (name = :name OR sex = :sex OR age = :age OR grp = :grp OR faculty = :faculty)");
		$db->bind(':name', $student['name']);
		$db->bind(':sex', $student['sex']);
		$db->bind(':age', $student['age']);
		$db->bind(':grp', $student['grp']);
		$db->bind(':faculty', $student['faculty']);
		return $db->resultset();
	}

	public function updateStudent($student){
		$db = new \Database ;
		$db->query("UPDATE students SET name = :name, sex = :sex, age = :age, grp = :grp, faculty = :faculty WHERE id = :id");
		$db->bind(':id', $student['id']);
		$db->bind(':name', $student['name']);
		$db->bind(':sex', $student['sex']);
		$db->bind(':age', $student['age']);
		$db->bind(':grp', $student['grp']);
		$db->bind(':faculty', $student['faculty']);
		return $db->execute();
	}
	
}
