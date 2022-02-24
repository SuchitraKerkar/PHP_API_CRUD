<?php
//since this Api will be accessed through HTTP we need to include header
//More header will be included in this as it is POST request
//header
header('Access-Control-Allow-Origin: *');//* to make it public without getting into authorisation/tokens
header('Content-Type: application/json');//since we will be accepting json

//Define method DELETE
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,x-requested-with,Authorization');

//helps in cross site scripting ->x-requested-with


//db
include_once '../../config/Database.php';

include_once '../../models/Users.php';

//instantiat db object

$database=new Database();

$db=$database->db_connect();

//instantiat users object
$user=new Users($db);

//Get the raw Posted data

$data= json_decode(file_get_contents("php://input"));//considering data will be jason format this statment will give us the raw data

$user->userid=$data->userid;

if(trim($user->userid)!='')
{
	 if($user->check_if_exist()>0)
	{	
	
		if($user->deleteuser())
		{
			echo json_encode(array("message"=>"User data deleted","Success"=>1));
		}
		else
		{
			echo json_encode(array("message"=>"User data not deleted","Success"=>0));
		}
    }
	else
	{
		echo json_encode(array("message"=>"User data not Present","Success"=>0));
	}
}
 else{
	echo json_encode(array("message"=>"Data Param Missing","Success"=>0));
}


?>