PHP API Learning

Simple Users API (CRUD)
•	This API allows one to view all user details 
•	You can view detail of single user at a time
•	You can modify the data
•	You can delete the data as well

File Structure
1.	Config
Has Database class which will do core connection with to MySQL using PDO

2.	Models
It has Users Model to execute the desired query based on the input
3.	API
Front end facing API folder with all Api’s performing different action

API Details

The API is available at  http://localhost/PHP_API_CRUD/api/users/

Backend Structure
Table = Users(userid,firstname,lastname,deleted)

1.	Get List of users 

Filename = [read.php]
Method = GET
Query Params: none


 


2.	Read_single.php

 Filename = [read_single.php]
 Method = GET
 Query Params: 
{"id":"1"}



3.	Create
Filename = [create.php]
 Method = POST
 Query Params: 
{
"firstname":"Ben",
"lastname":"Ten"
}
Authorisation: none 




4.	Update
 Filename = [update.php]
 Method = PUT
 Query Params: 
{
"firstname":"oggy",
"lastname":"roaches",
"userid":"5"
}
Authorisation: none



5.	Delete

Filename = [Delete.php]
Method = DELETE
Query Params: 
{
"userid":"5"
}

Authorisation: none

	