Project C.F.S Component � Database Management Services
Course: Advanced Software Engineering
Group Members: Matthew Hall, William Mcdermott, Andrew Titus, Cecil White, Peter-John Williams
Date: April 07, 2014

Description
The purpose of this component is to provide a client with database management services such as CRUD operations with database tables, and Insert, Read, Update and Delete queries for database elements.

Arguments
�	Server: This is the string representation of your database server IP address or name

�	Database: This is a string representation of database name

�	User Id/name: This is a string representation of your database user name

�	Password: This is a string representation of your database password 
 
�	Database Type: This string representation of database type this currently supports the following server types:
	o	mssql: For Microsoft SQL server  
	o	mysql: For mySQL servers
	
�	Query: This is a string representation of your SQL query     


Using java to access the web service   
Service serv = Service.create(new URL(
                     "http://url/ws_CRUD?wsdl"),       
 new QName("http://tempuri.org/", "ws_CRUD"));

        ws_CRUD p = serv.getPort(ws_CRUD.class);  
    p.GetResultFromSource(your server name, your database name, your user name, password, database type, query);

Using .net to access the web service 
•	You must first add the web reference (url to the web service) to your application 
•	You can access the web service by making the following call:
ServicesAPI.DB_CRUD.ws_CRUD sample = ServicesAPI.DB_CRUD.ws_CRUD();
sample.GetResultFromSource(your server name, your database name, your user name, password, database type(e.g mysql), query);


Output
�	Code 
	o	223: success
	o	224: sql exception
	o	225: other exceptions
	
�	Data

	o	A JSON object with values retrieved from the database if a data is select query is performed or a status, delete or update with a description what happened.

�	Debug
	o	data: status if process failed
	o	message: this gives exemption which may occurs from the database or otherwise

 Output example 
{"code": 223,   "data": [{"id":"aj3013"}],   "debug": {"data":"","message":""}}

