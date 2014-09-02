<?php
// connect to the DB
require_once("db.php");

switch($_POST['command']) {
	case "A":
		reportA();
		break;
/*	case "E1":
		reportE1();
		break;
*/	default:
		exit("Unknown report type.");
}

// return the data to the user via csv
function writeandreturn($name,$header,$result){
	header("Content-type: text/csv");
	header("Content-Disposition: attachment; filename=$name.csv");
	header("Pragma: no-cache");
	header("Expires: 0");
	$out = fopen('php://output', 'w');
	fputcsv($out, $header);
//    while($row = sqlsrv_fetch_array($result)) {
	while($row = mssql_fetch_array($result)) {
		fputcsv($out, array_intersect_key($row,array_flip($header)));
	}
	fclose($out);
}

function reportA() {
//    global $conn;
	$header = array('SchoolYearCode', 'InstitutionCode', 'TRADITIONAL', 'Gender', 'Ethnicity', 'Count');
    $query = "select SchoolYearCode, '238' as InstitutionCode, 'TRADITIONAL' as TRADITIONAL, Gender, Ethnicity, count(personID) as Count ";
    $query .= "from working_in_WA_Jan2014 w ";
    $query .= "join people p on p.CertNum = w.certificatenumber ";
    $query .= "group by SchoolYearCode, Gender, Ethnicity";
    
//    $result = sqlsrv_query($conn, $query);
	$result = mssql_query($query);
    if ( $result === false) {
        die( print_r( sqlsrv_errors(), true));
    }

	writeandreturn("reportA",$header, $result);	
}

function reportE1() {
//    global $conn;
	$header = array('SchoolYearCode', 'UWT', 'TRADITIONAL', 'Gender', 'Ethnicity', 'Count');
    $query = "select SchoolYearCode, 'UWT' as UWT, 'TRADITIONAL' as TRADITIONAL, Gender, Ethnicity, count(personID) as Count ";
    $query .= "from working_in_WA_Jan2014 w ";
    $query .= "join people p on p.CertNum = w.certificatenumber ";
    $query .= "group by SchoolYearCode, Gender, Ethnicity";
    
//    $result = sqlsrv_query($conn, $query);
	$result = mssql_query($query);
    if ( $result === false) {
        die( print_r( sqlsrv_errors(), true));
    }

	writeandreturn("reportE1",$header, $result);	
}
?>