<?php
class DB{
	private static $_instance = null;
	private $_pdo,
	$_query,$_error = false,
	$_results,$count = 0;
	
	private function __construct(){
		try{
			$this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host'). ';dbname=' . Config::get('mysql/db'),Config::get('mysql/username'),Config::get('mysql/password'));
			
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	
	/**an instance to communicate to the database**/
	public static function getInstance(){
		if(!isset(self::$_instance)){
			self::$_instance = new DB();
		}
		return self::$_instance;
	}
	
	public function action($action, $table, $where = array()){
		if(count($where) === 3){
			$operators = array('=','>','<','>=','<=');
			
			$field 		= $where[0];
			$operator 	= $where[1];
			$value 		= $where[2];
			
			if(in_array($operator , $operators)){
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
				
				if(!$this->query($sql, array($value))->error()){
					return $this;
				}
			}
		}
		
		return false;
	}
	
	/**a function to fetch a fields from table**/
	public function query($sql,$params = array()){
		$this->_error = false;
			if($this->_query = $this->_pdo->prepare($sql)){
				$x = 1;
				if(count($params)){
					foreach($params as $param){
						$this->_query->bindValue($x,$param);
						$x++;
					}
				}
				
				if($this->_query->execute()){
					$this->_results = $this->_query-> fetchAll(PDO::FETCH_OBJ);
					$this->_count = $this-> _query-> rowCount();
				} else {
					$this->_error = true;
				}
			}
				return $this;
	}
	
	/**a function to insert a fields to table**/
	public function insert($table, $fields = array()){
			$keys = array_keys($fields);
			$values = null;
			$x=1;
			foreach($fields as $field){
				$values .= '?';
				if($x < count($fields)){
					$values .= ', ';
				}
				$x++;
			}		
			
			$sql = "INSERT INTO {$table}(`" . implode('`, `', $keys) . "`) VALUES ({$values})";
			
			if(!$this->query($sql, $fields)->error()){
				return true;
			}
		return false;
	}
	
	
	public function get($table, $where){
		return $this->action('SELECT *', $table, $where);
	}
	
	public function allget($table){
		return $this->action('SELECT *', $table);
	}

	public function delete($table, $where){
		return $this->action('DELETE', $table, $where);
	}
	
	public function first(){
		return $this->results()[0];
	}
	/**reults or a recordset from database**/
	public function results(){
		return $this->_results;
	}
	/**counting section**/
	public function count(){
		return $this->_count;
	}
	/**if encounter an error for debugging**/
	public function error(){
		return $this->_error;
	}

}