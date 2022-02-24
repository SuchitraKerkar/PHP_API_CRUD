<?php
class Database{
	
	
	private $host='localhost';
	private $db_name='phpapi';
	private $username='root';
	private $password='';
	
	private $conn;
	
	function __construct()
	{
		$this->db_connect();
	}
	
	public function db_connect()
	{
		$this->conn=NULL;
		
		try{
			$this->conn=new PDO('mysql:host=' .$this->host. ';dbname='. $this->db_name,$this->username,$this->password);
			//To get if any error
			$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			
			echo "Connection error".$e->getMessage();
			
		}
		
		return $this->conn;
	}
	
	
}

?>