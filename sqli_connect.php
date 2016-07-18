<?php
//localhost
	$SQL_SERVER = 'localhost';
	$SQL_USER = 'root';
	$SQL_PASS = '';
	$SQL_DB = 'telecom';

//Hostinger
/*	$SQL_SERVER = 'localhost';
	$SQL_USER = 'u119096256_qwert';
	$SQL_PASS = 'helloworld';
	$SQL_DB = 'u119096256_tele';

*/
	$con =  new mysqli($SQL_SERVER,$SQL_USER,$SQL_PASS,$SQL_DB);
	if ($con->connect_errno) {
	    echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
	}
	//echo "Connection ok <Br>";
?>