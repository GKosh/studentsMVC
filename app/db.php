<?php
/**
* db.php 
* 
* Класс БД 
* Использует PDO 
* @vertion 1.0
*/
if(!defined("APP_PATH")) die;  

// PDO Database model classes
class Database
{
	private $host;
	private $user;
	private	$pass;
	private $dbname;
	private $dsn;
	public $dbh;
	public $error;
	public $stmt;
	public $options = array(
		PDO::ATTR_PERSISTENT => true,
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
	);
	
	
	public function __construct(){

	$this->host = \app::$Conf["DB_HOST"];
	$this->user = \app::$Conf["DB_USER"];
	$this->pass = \app::$Conf["DB_PASS"];
	$this->dbname = \app::$Conf["DB_NAME"];		
			
	$this->dsn = "mysql:host=" . $this->host . ";dbname=" . $this-> dbname;
		try {
		$this->dbh = new PDO($this->dsn, $this ->user, $this->pass, $this->options);
		} catch (PDOException $e) {
			
		$this->error = $e->getMessage();
		return $this->error;
		}
	}
	
	public function query($query){
		if (empty($this->dsn)){
		
		}else{
		$this->stmt = $this->dbh->prepare($query);
		}
	}
	
	public function bind($param, $value, $type = null){
    if (is_null($type)) {
        switch (true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
    }
    $this->stmt->bindValue($param, $value, $type);
	}

	public function execute(){
    return $this->stmt->execute();
	}
	
	public function resultset(){
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function rowCount() {
	return $this->stmt->rowCount();
	}
	
	public function lastInsertId(){
	return $this->dbh->lastInsertId();
	}
	
	public function single(){
	$this->execute();
	return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	public function beginTransaction(){
		return $this->dbh->beginTransaction();
	}
	
	public function endTransaction(){
		return $this->dbh->commit();
	}
	
	public function cancelTransaction(){
		return $this->dbh->rollBack();
	}
	
	public function debugDumpParams(){
		return $this->stmt->debugDumpParams();
	}
}