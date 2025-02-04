<?php
//==============================================
// xparam.php
// Copyright (c) 2016 MIS KBI
//==============================================

	$dtCurDate	= getDate();

	$cTgl	= $dtCurDate['mday'];
	$cBln	= $dtCurDate['mon'];
	$cThn	= $dtCurDate['year'];
	$cJam	= $dtCurDate['hours'];
	$cMnt	= $dtCurDate['minutes'];
	$cScn	= $dtCurDate['seconds'];
	$cMsc 	= round(microtime(true) * 1000);
	
	if(strlen($cTgl)==1){
		$cTgl = "0".$cTgl;
	}
	if(strlen($cBln)==1){
		$cBln = "0".$cBln;
	}
	if(strlen($cJam)==1){
		$cJam = "0".$cJam;
	}
	if(strlen($cMnt)==1){
		$cMnt = "0".$cMnt;
	}
	if(strlen($cScn)==1){
		$cScn = "0".$cScn;
	}

	$gTgl	= $dtCurDate['mday'];
	$gBln	= $dtCurDate['mon'];
	$gThn	= $dtCurDate['year'];

	$hr			= array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
	$hari_ini	= date("w");
	$hari		= $hr[$hari_ini];

	if($cBln>=7){
		$TahunAjaran1	= ($cThn-1).' / '.($cThn);
		$TahunAjaran2	= ($cThn).' / '.($cThn+1);
		$TahunAjaran3	= ($cThn+1.).' / '.($cThn+2);
	}
	else {
		$TahunAjaran1	= ($cThn-2).' / '.($cThn-1);
		$TahunAjaran2	= ($cThn-1).' / '.($cThn);
		$TahunAjaran3	= ($cThn).' / '.($cThn+1);
	}	

	
	$cSQLStr = mssql_query("spSysSettingFind '{41146CE0-A9DB-4B74-9ED0-74DD08D63FD2}','','','','','','','','','','','','','','' ,'AKTIF',''");

	if($rs = mssql_fetch_array($cSQLStr)) {  

		$pSKAppIID 				= $rs['IID'];
		$pSKAppNamaAplikasi		= $rs['NamaAplikasi'];
		$pSKAppNamaClient 		= $rs['NamaClient'];
		$pSKAppTelephone		= $rs['Telephone'];
		$pSKAppFax 				= $rs['Fax'];
		$pSKAppHandphone 		= $rs['Handphone'];
		$pSKAppEmail 			= $rs['Email'];
		$pSKAppURL 				= $rs['URL'];
		$pSKAppAlamat			= $rs['Alamat'];
		$pSKAppKota 			= $rs['Kota'];
		$pSKAppLogoHeader 		= $rs['LogoHeader'];
		$pSKAppLogoFooter 		= $rs['LogoFooter'];
		$pSKAppFooter 			= str_replace(chr(13),'<br>',$rs['Footer']);
		$pSKAppPrinterName		= $rs['PrinterName'];
	}
	
	$cPropertiFooter = "";
?>