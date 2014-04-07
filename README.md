Project C.F.S Component – Database Management Services
Course: Advanced Software Engineering
Group Members: Matthew Hall, William Mcdermott, Andrew Titus, Cecil White, Peter-John Williams
Date: April 07, 2014

Description
The purpose of this component is to provide a client with database management services such as CRUD operations with database tables, and Insert, Read, Update and Delete queries for database elements.

Arguments
•	Server: This is the string representation of your database server IP address or name

•	Database: This is a string representation of database name

•	User Id/name: This is a string representation of your database user name

•	Password: This is a string representation of your database password 
 
•	Database Type: This string representation of database type this currently supports the following server types:
	o	mssql: For Microsoft SQL server  
	o	mysql: For mySQL servers
	
•	Query: This is a string representation of your SQL query     

Output
•	Code 
	o	223: success
	o	224: sql exception
	o	225: other exceptions
	
•	Data

	o	A JSON object with values retrieved from the database if a data is select query is performed or a status, delete or update with a description what happened.

•	Debug
	o	data: status if process failed
	o	message: this gives exemption which may occurs from the database or otherwise

 Output example 
{"code": 223,   "data": [{"id":"aj3013"}],   "debug": {"data":"","message":""}}

