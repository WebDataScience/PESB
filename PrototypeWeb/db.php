<?php
$server = "masked";
$db = "masked";
$user = "masked";
$pass = "masked";
/*
$info = array("Database" => "masked",
              "UID" => "masked",
              "PWD" => "masked");

$conn = sqlsrv_connect($server,$info)
*/
$dblink = mssql_connect($server,$user,$pass)
	or die("Couldn't connect to server on $server");
	
$conn = mssql_select_db($db, $dblink)
	or die("Couldn't open database $db");
?>	