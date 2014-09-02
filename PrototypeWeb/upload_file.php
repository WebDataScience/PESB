<?php
// connect to the DB
require_once("db.php");

if ($_FILES["file"]["error"] > 0) {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
} else {
/*  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br />";*/
  $filecontent = file($_FILES["file"]["tmp_name"]);  
	// look at header
  switch(array_shift($filecontent)){
  case "studentid,label,somethingelse":
		importtodb($filecontent,"TableName","column1, column2, column3");
		break;
	default:
		exit("Unknown report type.");
  }

}

function importtodb($filecontent,$tablename,$columnnames){
  $query = "insert into $tablename($columnnames) values"
  while(($data = fgetcsv($filecontent, 0, ",")) !== FALSE){
	if($data[0]){
		$query .= "(".implode(",",$data)."),";
	}
  }
  rtrim($query, ",");
  mssql_query($query);
  }
/*
while(! feof($file))
  {
  print_r(fgetcsv($file));
  }
  */
  ?>

