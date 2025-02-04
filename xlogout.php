<?PHP
session_start();
//==============================================
// index.php
// Copyright (c) 2016 MIS KBI
//==============================================

	include_once("xproc.php");
	include_once("xparam.php");
	include_once("xfunct.php");

	unset($_SESSION['sMISAppUName']);
	unset($_SESSION['sMISAppNIK']);
	unset($_SESSION['sMISAppPassword']);
	unset($_SESSION['sMISAppuid']);
	unset($_SESSION['sMISAppPersonalIID']);
	unset($_SESSION['sMISAppDepartmentIID']);
	unset($_SESSION['sMISAppDepartmentNama']);
	unset($_SESSION['sMISAppGradeIID']);
	unset($_SESSION['sMISAppGradeNama']);
	unset($_SESSION['sMISAppJabatanIID']);
	unset($_SESSION['sMISAppJabatanNama']);
	unset($_SESSION['sMISAppNamaLengkap']);
	unset($_SESSION['sMISAppTempatLahir']);
	unset($_SESSION['sMISAppTanggalLahir']);
	unset($_SESSION['sMISAppTelephone']);
	unset($_SESSION['sMISAppHandphone']);
	unset($_SESSION['sMISAppAlamat']);
	unset($_SESSION['sMISAppKota']);
	unset($_SESSION['sMISAppPrinterName']);
	unset($_SESSION['sMISAppPosisi']);
	unset($_SESSION['sMISAppLevel']);
	unset($_SESSION['sMISAppcStatus']);
	unset($_SESSION['sMISAppCabangIID']);
	unset($_SESSION['sMISAppLembagaIID']);

	header("location: index.php");
?>