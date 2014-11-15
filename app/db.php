<?php
/**
* db.php 
*  Database class
* 
*
* @property string $host Host name. In constructor value is taken from configurations.
* @property string $user Username. Value is taken from configurations.
* @property string $pass Db Access password
* @property string $dbname  Data base name.
* @property string $dsn 
* @property array $dbh PDO object.
* @property array $error
* @property array $stmt Query statement.
* @property array $ooptions Array of PDO options.
*
*
* @vertion 1.0
* @author G.Kosh
*/
if(!defined("APP_PATH")) die;  


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
	
	
	 /**
     * Constructor
     * 
	 * Create PDO object. Read configurations
	 *
	 * @throw error if DB is not connected
	 * @return error if DB is not connected
	 */
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
	
	/**
     * Query handler
     * 
	 * Wrap PDO query function
	 */
	public function query($query){
		if (empty($this->dsn)){
		
		}else{
		$this->stmt = $this->dbh->prepare($query);
		}
	}
	
	/**
     * Bind PDO parameters with values and detect type
     * 
	 * @param string $param parameter name
	 * @param mixed $value Parameter value
	 * @param string $type Parameter type
	 */
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
	/**
     * Set of PDO wrapping functions
     * 
	 * Provide shortened access to PDO objects and functions 
	 * Example: $db->execute instead of $db->stmt->execute();
	 */
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