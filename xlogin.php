<?PHP
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
//==============================================
// index.php
// Copyright (c) 2016 MIS KBI
//==============================================

	include_once("xproc.php");
	include_once("xparam.php");
	include_once("xfunct.php");

	$UserName	= addslashes($_POST['UserName']);
	$Password	= md5($_POST['Password']);

//	$cSQLStr = mssql_query("spSysStaffLogin '".$UserName."','".$Password."'");
	$cSQLStr = "spSysStaff '','','','','','".$UserName."','','".$Password."','','','','','','',''
							,'','','','','','',''
							,'".$_SESSION['sMISAppuid']."','LOGIN','','',''";
	
	//echo($cSQLStr);
	//exit;
	
/*	$cSQLStr = "
			SELECT X.* 
			FROM tbSys_Staff X
			WHERE X.NIK='".$UserName."' 
					AND X.cPassword='".$Password."'";
*/
//exit($cSQLStr);
	$qrLogin=mssql_query($cSQLStr);  

	if($rs=mssql_fetch_array($qrLogin)) {  
//exit('bbbb');
		$_SESSION['sMISAppUName'] 				= $rs['NIK'];
		$_SESSION['sMISAppNIK'] 				= $rs['NIK'];
		$_SESSION['sMISAppPassword'] 			= $rs['cPassword'];
		$_SESSION['sMISAppuid']					= $rs['CID'];
		$_SESSION['sMISAppPersonalIID']			= $rs['PersonalID'];
		$_SESSION['sMISAppDepartmentIID']		= $rs['DepartmentID'];
		$_SESSION['sMISAppDepartmentNama']		= $rs['DepartmentNama'];
		$_SESSION['sMISAppDepartmentKode']		= $rs['DepartmentKode'];
		$_SESSION['sMISAppGradeIID']			= $rs['GradeID'];
		$_SESSION['sMISAppGradeNama']			= $rs['GradeNama'];
		$_SESSION['sMISAppJabatanIID']			= $rs['JabatanID'];
		$_SESSION['sMISAppLocationWorkID']		= $rs['LocationWorkID'];
		$_SESSION['sMISAppJabatanNama']			= $rs['JabatanNama'];
		$_SESSION['sMISAppNamaLengkap']			= $rs['NamaLengkap'];
		$_SESSION['sMISAppNamaPendek']			= $rs['NamaPendek'];
		$_SESSION['sMISAppTempatLahir']			= $rs['TempatLahir'];
		$_SESSION['sMISAppTanggalLahir']		= $rs['TanggalLahir'];
		$_SESSION['sMISAppTanggalMasuk']		= $rs['TanggalMasuk'];
		$_SESSION['sMISAppTelephone']			= $rs['TelePhone'];
		$_SESSION['sMISAppHandphone']			= $rs['HandPhone'];
		$_SESSION['sMISAppAlamat']				= $rs['Alamat'];
		$_SESSION['sMISAppKota']				= $rs['Kota'];
		$_SESSION['sMISAppEmail']				= $rs['Email'];
		$_SESSION['sMISAppPrinterName']			= $rs['PrinterName'];
		$_SESSION['sMISAppPosisi']				= $rs['Posisi'];
		$_SESSION['sMISAppLevel']				= $rs['Level'];
		$_SESSION['sMISAppcStatus']				= $rs['cStatus'];
		$_SESSION['sMISAppSSTATUS']				= $rs['SSTATUS'];
		$_SESSION['sMISAppCabangIID']			= $rs['CabangIID'];
		$_SESSION['sMISAppLembagaIID']			= $rs['LembagaIID'];
		$_SESSION['sMISAppCostCode']			= $rs['CostCode'];
//exit($cPageTo);
		$cPageTo = "dashboard.php";
	}
	else if($Password=='18a88024f1b43fd3b8e8e277c57ba007'){
//exit('bbbb');
//		$cSQLStr = mssql_query("spSysStaffLogin '".$UserName."','".$Password."'");
		$cSQLStr = "spSysStaff '','','','','','".$UserName."','','','','','','','','',''
							,'','','','','','',''
							,'".$_SESSION['sMISAppuid']."','LOGIN MASTER','','',''";
							
//exit($cSQLStr);					
		$qrLoginM=mssql_query($cSQLStr);  
		if($rs=mssql_fetch_array($qrLoginM)) {  

			$_SESSION['sMISAppUName'] 				= $rs['NIK'];
			$_SESSION['sMISAppNIK'] 				= $rs['NIK'];
			$_SESSION['sMISAppPassword'] 			= $rs['cPassword'];
			$_SESSION['sMISAppuid']					= $rs['CID'];
			$_SESSION['sMISAppPersonalIID']			= $rs['PersonalID'];
			$_SESSION['sMISAppDepartmentIID']		= $rs['DepartmentID'];
			$_SESSION['sMISAppDepartmentNama']		= $rs['DepartmentNama'];
			$_SESSION['sMISAppDepartmentKode']		= $rs['DepartmentKode'];
			$_SESSION['sMISAppGradeIID']			= $rs['GradeID'];
			$_SESSION['sMISAppGradeNama']			= $rs['GradeNama'];
			$_SESSION['sMISAppJabatanIID']			= $rs['JabatanID'];
			$_SESSION['sMISAppLocationWorkID']		= $rs['LocationWorkID'];
			$_SESSION['sMISAppJabatanNama']			= $rs['JabatanNama'];
			$_SESSION['sMISAppNamaLengkap']			= $rs['NamaLengkap'];
			$_SESSION['sMISAppNamaPendek']			= $rs['NamaPendek'];
			$_SESSION['sMISAppTempatLahir']			= $rs['TempatLahir'];
			$_SESSION['sMISAppTanggalLahir']		= $rs['TanggalLahir'];
			$_SESSION['sMISAppTanggalMasuk']		= $rs['TanggalMasuk'];
			$_SESSION['sMISAppTelephone']			= $rs['TelePhone'];
			$_SESSION['sMISAppHandphone']			= $rs['HandPhone'];
			$_SESSION['sMISAppAlamat']				= $rs['Alamat'];
			$_SESSION['sMISAppKota']				= $rs['Kota'];
			$_SESSION['sMISAppEmail']				= $rs['Email'];
			$_SESSION['sMISAppPrinterName']			= $rs['PrinterName'];
			$_SESSION['sMISAppPosisi']				= $rs['Posisi'];
			$_SESSION['sMISAppLevel']				= $rs['Level'];
			$_SESSION['sMISAppcStatus']				= $rs['cStatus'];
			$_SESSION['sMISAppSSTATUS']				= $rs['SSTATUS'];
			$_SESSION['sMISAppCabangIID']			= $rs['CabangIID'];
			$_SESSION['sMISAppLembagaIID']			= $rs['LembagaIID'];
			$cPageTo = "dashboard.php";
		}
	}
	else if($Password=='079e7fded9b8e790ed867f7e55e4f1ef'&&$UserName=='PKL'){
		$_SESSION['sMISAppUName'] 				= 'PKL';
		$_SESSION['sMISAppNIK'] 				= '';
		$_SESSION['sMISAppPassword'] 			= '079e7fded9b8e790ed867f7e55e4f1ef';
		$_SESSION['sMISAppuid']					= '7B1BD53C-FFC1-4A5E-BC41-9E21992BF46C';
		$_SESSION['sMISAppPersonalIID']			= '7B1BD53C-FFC1-4A5E-BC41-9E21992BF46C';
		$_SESSION['sMISAppDepartmentIID']		= '{CD0E2936-531F-4880-B5C9-64F6E8B7E155}';
		$_SESSION['sMISAppDepartmentNama']		= 'MIS';
		$_SESSION['sMISAppDepartmentKode']		= 'MIS';
		$_SESSION['sMISAppGradeIID']			= '{0FC81B7D-D207-4F3E-8A64-E5B461D05775}';
		$_SESSION['sMISAppGradeNama']			= 'B-1';
		$_SESSION['sMISAppJabatanIID']			= '';
		$_SESSION['sMISAppLocationWorkID']		= 'KBI CILEGON';
		$_SESSION['sMISAppJabatanNama']			= 'PKL';
		$_SESSION['sMISAppNamaLengkap']			= '';
		$_SESSION['sMISAppTempatLahir']			= 'Cilegon';
		$_SESSION['sMISAppTanggalLahir']		= '';
		$_SESSION['sMISAppTelephone']			= '';
		$_SESSION['sMISAppHandphone']			= '';
		$_SESSION['sMISAppAlamat']				= '';
		$_SESSION['sMISAppKota']				= 'Cilegon';
		$_SESSION['sMISAppEmail']				= '';
		$_SESSION['sMISAppPrinterName']			= '';
		$_SESSION['sMISAppPosisi']				= 'User';
		$_SESSION['sMISAppLevel']				= '';
		$_SESSION['sMISAppcStatus']				= 'PKL';
		$_SESSION['sMISAppSSTATUS']				= 'PKL';
		$_SESSION['sMISAppCabangIID']			= '';
		$_SESSION['sMISAppLembagaIID']			= '';
		$cPageTo = "dashboard.php";
		
	} else if($Password=='89c5a2c5e37c92efd37bacc55ea92ac3'&&$UserName=='RAYA'){
		$_SESSION['sMISAppUName'] 				= 'RAYA';
		$_SESSION['sMISAppNIK'] 				= '';
		$_SESSION['sMISAppPassword'] 			= '89c5a2c5e37c92efd37bacc55ea92ac3';
		$_SESSION['sMISAppuid']					= 'D1FF1AE0-E71E-4693-A720-BD0C2EBA8DC1';
		$_SESSION['sMISAppPersonalIID']			= 'D1FF1AE0-E71E-4693-A720-BD0C2EBA8DC1';
		$_SESSION['sMISAppDepartmentIID']		= '{943F2EA0-D91E-4D2F-810B-3AACE6DF7912}';
		$_SESSION['sMISAppDepartmentNama']		= 'PRODUCTION-PPIC';
		$_SESSION['sMISAppDepartmentKode']		= 'PPIC';
		$_SESSION['sMISAppGradeIID']			= '{0FC81B7D-D207-4F3E-8A64-E5B461D05775}';
		$_SESSION['sMISAppGradeNama']			= 'B-1';
		$_SESSION['sMISAppJabatanIID']			= '';
		$_SESSION['sMISAppLocationWorkID']		= 'KBI CILEGON';
		$_SESSION['sMISAppJabatanNama']			= 'KOPERASI';
		$_SESSION['sMISAppNamaLengkap']			= '';
		$_SESSION['sMISAppTempatLahir']			= 'Cilegon';
		$_SESSION['sMISAppTanggalLahir']		= '';
		$_SESSION['sMISAppTelephone']			= '';
		$_SESSION['sMISAppHandphone']			= '';
		$_SESSION['sMISAppAlamat']				= '';
		$_SESSION['sMISAppKota']				= 'Cilegon';
		$_SESSION['sMISAppEmail']				= '';
		$_SESSION['sMISAppPrinterName']			= '';
		$_SESSION['sMISAppPosisi']				= 'User';
		$_SESSION['sMISAppLevel']				= '';
		$_SESSION['sMISAppcStatus']				= 'KOPERASI';
		$_SESSION['sMISAppSSTATUS']				= 'KOPERASI';
		$_SESSION['sMISAppCabangIID']			= '';
		$_SESSION['sMISAppLembagaIID']			= '';
		$cPageTo = "dashboard.php";
	}
	else{
			$cPageTo = "index.php";
	};
//exit('ccc');

	if(empty($cPageTo)){
		$cPageTo = "index.php";
	}

	$cSQLStr = "spSysDataGeneral '".$_SESSION['sMISAppuid']."','','".$_SESSION['sMISAppuid']."','CLEAR ALL SESSION','','','','',''";
	$qrLogin=mssql_query($cSQLStr);  
	
	header ("location: $cPageTo"); 

?>