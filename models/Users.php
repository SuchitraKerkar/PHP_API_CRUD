<?php
class Users
{
	//db stuff
	private $conn;
	private $table='users';

   //users properties
    public $userid;
	public $firstname;
	public $lastname;
	public $num;
	
	//constructor with db
	public function __construct($db)
	{
		$this->conn=$db;
	}
	
	//get users
	public function read()
	{
		 $query="select u.userid,u.firstname,u.lastname from ".$this->table." as u where deleted=0 order by userid";
		 
		 //prepare statement
		 $stmt=$this->conn->prepare($query);
		 
		 //execute query
		 
		 $stmt->execute();
		 return $stmt;
	}
	
	//get users
	public function read_single()
	{
		  $query="select u.userid,u.firstname,u.lastname from ".$this->table." as u where deleted=0 and userid=? Limit 0,1 ";
		 
		 //prepare statement
		 $stmt=$this->conn->prepare($query);
		 
		 //bind parmeter
		 $stmt->bindParam(1,$this->userid);
		 
		 //execute query
		 
		 $stmt->execute();
		  return $stmt;
		 
	}
	
	///Create a new Record
	public function create()
	{
		 $query="Insert into ".$this->table." (firstname, lastname) VALUES 
			(:firstname, :lastname)
			";
		//prepare statement
		 $stmt=$this->conn->prepare($query);	
		 
		 $this->firstname=htmlentities(strip_tags($this->firstname));
		 $this->lastname=htmlentities(strip_tags($this->lastname));
		 
		 //bind parmeter
		 $stmt->bindParam(':firstname',$this->firstname);
		 $stmt->bindParam(':lastname',$this->lastname);
		 
		 //execute
		 
		 if($stmt->execute())
		 {
			 return true;
		 }
		 else
			 {
				 printf("Error: %s.\n",$stmt->error());
				 return false;
			 }
		
		
	}
	
	
	///Update a existing Record
	public function update()
	{
		 $query="
			UPDATE ".$this->table." 
			SET firstname = :firstname, lastname = :lastname 
			WHERE userid = :userid
			";
		//prepare statement
		 $stmt=$this->conn->prepare($query);	
		 
		 $this->firstname=htmlentities(strip_tags($this->firstname));
		 $this->lastname=htmlentities(strip_tags($this->lastname));
		 $this->userid=htmlentities(strip_tags($this->userid));
		 
		 //bind parmeter
		 $stmt->bindParam(':firstname',$this->firstname);
		 $stmt->bindParam(':lastname',$this->lastname);
		 $stmt->bindParam(':userid',$this->userid);
		 
		 //execute
		 
		 if($stmt->execute())
		 {
			 return true;
		 }
		 else
			 {
				 printf("Error: %s.\n",$stmt->error());
				 return false;
			 }
		
		
	}
	
	///Update a existing Record
	public function deleteuser()
	{
		
		
		$query="
			Delete from ".$this->table." 
			WHERE userid = :userid
			";
		//prepare statement
		 $stmt=$this->conn->prepare($query);	
		 
		 $this->userid=htmlentities(strip_tags($this->userid));
		 
		 //bind parmeter
		 $stmt->bindParam(':userid',$this->userid);
		 
		  //execute
		 
		 if($stmt->execute())
		 {
			
			 return true;
		 }
		 else
		 {
			 printf("Error: %s.\n",$stmt->error());
			 return false;
		 }
		
	}
	
	public function check_if_exist()
	{
		$query="select u.userid,u.firstname,u.lastname from ".$this->table." as u where deleted=0 and userid=? Limit 0,1 ";
		 
		 //prepare statement
		 $stmt=$this->conn->prepare($query);
		 
		 //bind parmeter
		 $stmt->bindParam(1,$this->userid);
		 
		 $k=0;
		 //execute query
		 
		 $stmt->execute();
		 
		 if($stmt->execute())
			{
				foreach($stmt->fetchAll() as $row)
				{
					$k++;
					
				}
				return $k;
			}
			else
		 {
			 printf("Error: %s.\n",$stmt->error());
			 return false;
		 }
		 
	}
}

?>