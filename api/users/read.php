<?php
//since this Api will be accessed through HTTP we need to include header
//header
header('Access-Control-Allow-Origin: *');//* to make it public without getting into authorisation/tokens
header('Content-Type: application/json');//since we will be accepting json

//db
include_once '../../config/Database.php';

include_once '../../models/Users.php';

//instantiat db object

$database=new Database();

$db=$database->db_connect();

//instantiat users object
$user=new Users($db);

$result = $user->read();

//Get row count

$num=$result->rowCount();

if($num>0)
{
	//User array
	$user_arr=array();
	$user_arr['data']=array();
	$user_arr['Success']=1;
	$user_arr['message']='Data found';
	
	while($row=$result->fetch(PDO::FETCH_ASSOC))
	{
		extract($row);
		
		$user_item=array(
		'userid'=>$userid,
		'firstname'=>$firstname,
		'lastname'=>$lastname
		);
		
		//Push data
	array_push($user_arr['data'],$user_item);
	}
	//turn to json and output
	
	echo json_encode($user_arr);
	
	
}
else
{
	$user_arr['data']=array();
	$user_arr['Success']=0;
	$user_arr['message']='Data not found';
	echo json_encode(array($user_arr));
}


?>