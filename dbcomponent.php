<?php
if(isset($_REQUEST['server']) and isset($_REQUEST['database'])and isset($_REQUEST['userID'])and isset($_REQUEST['password'])and isset($_REQUEST['dbtype']) and isset($_REQUEST['query']))
	dbaccess($_REQUEST['server'],$_REQUEST['database'],$_REQUEST['userID'],$_REQUEST['password'],$_REQUEST['dbtype'],$_REQUEST['query']);

function check($result, $message) {
				if (!$result) {
				print "SQL error during $message: ".mysql_error();
				return "SQL error during $message ";
				}
				else
				//print "No Error Occurred";
				return "No Error Occurred";
				}
								
	
function dbaccess($server,$database,$userID,$password,$dbtype,$query)
{
	$server = trim($server);
	$database = trim($database);
	$userID = trim($userID);
	$password = trim($password);
	$dbtype = trim($dbtype);
	$query =  trim($query);
	//$query2 = '"'.$query.'"';
	if (strcmp($dbtype,"mysql")==0)
	{
		$query_array = explode(" ",$query);
		$key = strtolower($query_array[0]);
		
		if(strcmp($key,"select")==0)
		{

		$return_data = array();
		$conn = mysql_connect($server,$userID,$password);
			check($conn, "connect");
			check(mysql_select_db($database), "selecting db");
			
		$results = mysql_query($query,$conn);
			check($results, "query of $query");
		
		if (mysql_num_rows($results)>0)
		{	
			$return_data = array();
			$number_of_fields = mysql_num_fields($results);
			while ($row = mysql_fetch_array($results))
			{
				$data = array();
				for($i=0; $i<count($row);$i++)
				{
				
					$rowname = trim(mysql_field_name($results, $i));
					if (strcmp($rowname," ")==0||$rowname==null)
					{ break;}
						$data[$rowname]=$row[$i];
					/*for($j=0;$j<count($number_of_fields);$j++)
					{
						$rowname = trim(mysql_field_name($results, $j));
						$data[$rowname]=$row[$j];
						//array_push($data,$row[$i]);		//mysql_field_name($resul, $i)
					} */
				}
				
				//$row_json = json_encode($data);
				array_push($return_data,$data);
			}
			$debug = array();
			$debug["data"] = "No Error Occured"; 
			$return_json = array();
			$return_json["code"] = 200;
			$return_json["data"] = $return_data;
			$return_json["debug"] = $debug;
			
			print json_encode($return_json);		
			mysql_close($conn);
			return json_encode($return_json);		
		}
		else
			{
			$debug = array();
			$debug["data"] = "No Error Occured";
			$return_json = array();
			$return_json["code"] = 200;
			$return_json["data"] = " ";
			$return_json["debug"] = $debug;
			
			print json_encode($return_json);		
			mysql_close($conn);
			return json_encode($return_json);
			
			}	
		}
		
		if(strcmp($key,"insert")==0||strcmp($key,"update")==0||strcmp($key,"delete")==0||strcmp($key,"create")==0||strcmp($key,"alter")==0||strcmp($key,"drop")==0)
		{
		
			$conn = mysql_connect($server,$userID,$password);
			check($conn, "connect");
			check(mysql_select_db($database), "selecting db");
			
			$results = mysql_query($query);
			check($results, "query of $query");
			
			if ($results)
			{	
			$debug = array();
			$debug["data"] = "No Error Occured";
			$return_json = array();
			$return_json["code"] = 200;
			$return_json["data"] = "Successful";
			$return_json["debug"] = $debug;
			
			print json_encode($return_json);		
			mysql_close($conn);
			return json_encode($return_json);
			}
			else
			{
			$debug = array();
			$debug["data"] = "Error Occured";
			$return_json = array();
			$return_json["code"] = 422;
			$return_json["data"] = "Unsuccesful";
			$return_json["debug"] = $debug;
			
			print json_encode($return_json);		
			mysql_close($conn);
			return json_encode($return_json);
			}
		}
		
	}
	elseif (strcmp($dbtype,"mssql")==0)
	{
		$query_array = explode(" ",$query);
		$key = strtolower($query_array[0]);
		$connectionInfo = array( "Database"=>$database, "UID"=>$userID, "PWD"=>$password);
		$params = array();
		$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
		
		if(strcmp($key,"select")==0)
		{

		$return_data = array();
		
		$conn = sqlsrv_connect( $server, $connectionInfo);		
			check($conn, "connect");			
			
		$results = sqlsrv_query($conn, $query,$params,$options);
				check($results, "query of $query");
		
		if (sqlsrv_num_rows($results)>0)
		{	
			$return_data = array();
			//$number_of_fields = mysql_num_fields($results);
			while ($row = sqlsrv_fetch_array($results))
			{
				$data = array();
				for($i=0; $i<count($row);$i++)
				{
					$metadata = sqlsrv_field_metadata($results);
					$rowname = $metadata[$i]["Name"];
					if (strcmp($rowname," ")==0||$rowname==null)
					{ break;}
						$data[$rowname]=$row[$i];
					/*for($j=0;$j<count($number_of_fields);$j++)
					{
						$rowname = trim(mysql_field_name($results, $j));
						$data[$rowname]=$row[$j];
						//array_push($data,$row[$i]);		//mysql_field_name($resul, $i)
					} */
				}
				
				//$row_json = json_encode($data);
				array_push($return_data,$data);
			}
			$debug = array();
			$debug["data"] = "No Error Occured"; 
			$return_json = array();
			$return_json["code"] = 200;
			$return_json["data"] = $return_data;
			$return_json["debug"] = $debug;
			
			print json_encode($return_json);		
			sqlsrv_free_stmt($results);
			sqlsrv_close($conn);
			return json_encode($return_json);		
		}
		else
			{
			$debug = array();
			$debug["data"] = "No Error Occured";
			$return_json = array();
			$return_json["code"] = 200;
			$return_json["data"] = " ";
			$return_json["debug"] = $debug;
			
			print json_encode($return_json);		
			sqlsrv_free_stmt($results);
			sqlsrv_close($conn);
			return json_encode($return_json);
			
			}	
		}
		
		if(strcmp($key,"insert")==0||strcmp($key,"update")==0||strcmp($key,"delete")==0||strcmp($key,"create")==0||strcmp($key,"alter")==0||strcmp($key,"drop")==0)
		{
		
			$conn = sqlsrv_connect( $server, $connectionInfo);		
			check($conn, "connect");			
			
			$results = sqlsrv_query($conn, $query,$params);
			check($results, "query of $query");
			
			if ($results)
			{	
			$debug = array();
			$debug["data"] = "No Error Occured";
			$return_json = array();
			$return_json["code"] = 200;
			$return_json["data"] = "Successful";
			$return_json["debug"] = $debug;
			
			print json_encode($return_json);		
			sqlsrv_free_stmt($results);
			sqlsrv_close($conn);
			return json_encode($return_json);
			}
			else
			{
			$debug = array();
			$debug["data"] = "Error Occured";
			$return_json = array();
			$return_json["code"] = 422;
			$return_json["data"] = "Unsuccesful";
			$return_json["debug"] = $debug;
			
			print json_encode($return_json);		
			sqlsrv_free_stmt($results);
			sqlsrv_close($conn);
			return json_encode($return_json);
			}
		}
		
	}
	else
	{
			$debug = array();
			$debug["data"] = "No Support for your Database Management System.";
			$return_json = array();
			$return_json["code"] = 422;
			$return_json["data"] = "Unsuccesful";
			$return_json["debug"] = $debug;
			
			print json_encode($return_json);					
			return json_encode($return_json);
	}
}

?>