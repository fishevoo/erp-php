<?php
//==============================================
// xotor.php
// Copyright (c) 2015 SuksesKomputer
//==============================================

	$cSQLStr = "spSysOtor '".$_SESSION['sMISAppuid']."','".$IDMenu."'";

	$qrOtor=mssql_query($cSQLStr); 
	if(mssql_num_rows($qrOtor)==0){
		header("Location: xlogout.php");
	}
?>