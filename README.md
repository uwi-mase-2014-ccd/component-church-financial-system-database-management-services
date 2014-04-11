Project C.F.S Component – Database Management Services
========
-----------
**Course:** Advanced Software Engineering

**Group Members:** Matthew Hall, William Mcdermott, Andrew Titus, Cecil White, Peter-John Williams

**Date:** April 07, 2014

Description
--
The purpose of this component is to provide a client with database management services such as CRUD operations with database tables, and Insert, Read, Update and Delete queries for database elements.

Arguments
--
-   **server:** This is the string representation of your database server IP address or name
-	**database:** This is a string representation of database name
-	**user ID:** This is a string representation of your database user name
-	**password:** This is a string representation of your database password  
-	**dbtype:** This string representation of database type this currently supports the following server types:
 -	mssql: For Microsoft SQL server  
 -	mysql: For mySQL servers
-	**query:** This is a string representation of your SQL query     

Access End Point:
--
http://www.holycrosschurchjm.com/dbcomponent.php

Access Method:
--
To use the web service, simply POST each argument to the access end point. That’s it. 


Constraints
--
-	This component assumes that your database is publicly available. If your database is stored locally, please clone this project, and add the php file to your local server. The access methods will remain the same. An alternative to this may be to pass your IP address as the server parameter; however this has not been tested by our group. 

-	Also, the remote endpoint provided works for MySQL users ONLY. For those using SQL Server, you MUST use the file locally. This was not our intention, but the remote server does not have the necessary extensions to support SQL Server connections.


Output
--
-	Code 
-	200: success
-	422: sql exceptions/ other exceptions
-	Data
-	A JSON object with values retrieved from the database if a data is select query is performed or a status, delete or update with a description what happened.
-	Debug
-	data: status if process failed
-	message: this gives exemption which may occurs from the database or otherwise

```sh
{"code" :  200/422,   "data" :  [JSON Object , JSON Object],   "debug" :  {"data" : "message"}} 
```

Example Queries to be executed
---
Select id from logins; 
Insert into logins values (‘nw-0001’,’Password1’) ; // this example can also work for other query types that are not returning specific data from the database (i.e. insert, update, delete, create, alter drop)

 
 Example Output
 --
Select
--
```sh
{"code" :  200,   "data" :  [{"id" : "aj3013"}, {“id” : ”mh1234”} ],   "debug" :  {"data" : "No Error Occurred"}} 
```
 
Insert
--
Success : 
--
```sh
{"code" :  200,   "data" :  “Successful”,   "debug" :  {"data" : "","message" : "No Error Occurred"}} 
```
Unsuccessful : 
--
```sh
{"code" :  422,   "data" :  “Unsuccessful”,   "debug" :  {"data" : "","message" : " Error Occurred"}}
```
