<?php
//==============================================
// syst/xproc.php
// Copyright (c) 2016 MIS KBI
//==============================================

/*
$db_server 	= "localhost";
$db_user	= "root";
$db_password= "";
$db_name	= "kbi";

$db_conn = mysqli_connect($db_server,$db_user,$db_password,$db_name) or die("Error " . mysqli_error($db_conn)); 
*/

$myServer = "192.124.1.2";
$myUser = "dev01";
$myPass = "developer@mis@kbi";
//$myPass = "kbi";
$myServer = "192.124.1.4";
$myUser = "sa";
$myPass = "Mains3rv3r";
$myDB = "dbLanTest";

$conn = mssql_connect($myServer,$myUser,$myPass);
if (!$conn){ 
  die('Not connected : ' . mssql_get_last_message());
} 
$db_selected = mssql_select_db($myDB, $conn);
if (!$db_selected) {
  die ('Can\'t use db : '. mssql_get_last_message());
} 

//$RootURL = "http://57320298dcf4.sn.mynetname.net/kbi";
$RootURL = "http://192.124.1.4/kbitest";
//$RootURL = "http://36.66.98.10:89/kbi";
$RootDir = dirname($_SERVER['PHP_SELF']);

?>