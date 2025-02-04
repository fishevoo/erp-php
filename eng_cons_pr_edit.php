<?php
session_start();
//==============================================
// eng_gnrl_pr_edit.php
// Copyright (c) 2014 Web4UKM
//==============================================
if(empty($_SESSION['sMISAppuid'])){
	header("Location: xlogout.php");
}

	include_once("xproc.php");
	include_once("xparam.php");
	include_once("xfunct.php");

	$MainPage 	= "Input Data";
	$SubMenu 	= "ENGINEERING";
	$SubPage 	= "Purchase Request";
	$TitlePage 	= "Edit Purchase Request";

	$DepartmentID = "{D323E69F-95EC-4657-B8CE-1E5E825CC938}";

	$IDMenu 	= "{472C4691-BFAB-4B07-9B44-AAC5ADC82A2A}";
	include_once("xotor.php");

/*
	$cSQLStr 	= "spSysDataGeneral ''
						,'AKTIF','".$_SESSION['sMISAppuid']."'
						,'NEWID','','','','',''";

	$qrDataG=mssql_query($cSQLStr);  
	$iIdx = 0;
	if($rsG=mssql_fetch_array($qrDataG)){
		$CID = $rsG['NEWID'];		
	}
*/
	
	$cSQLStr 	= "spSysDataGNRLPRDetail '','','','','','','',''
						,'AKTIF','".$_SESSION['sMISAppuid']."'
						,'CLEAR','','','','',''";
	$qrData=mssql_query($cSQLStr);  
						
	$cSQLStr 	= "spSysDataDepartment '".$DepartmentID."'
						,'AKTIF','".$_SESSION['sMISAppuid']."'
						,'FIND CID','','','','',''";
						
	$qrDataDept=mssql_query($cSQLStr);  
	$Dept="";
	if($rsDept=mssql_fetch_array($qrDataDept)){
		$DepartmentID 		= $rsDept['CID'];
		$Dept 				= $rsDept['DEPT'];
		$Department 		= $rsDept['DEPARTMENT'];
		$Division 			= $rsDept['DIVISIONNAMA'];
		$CostCodeCenter 	= $rsDept['COSTCENTERCODE'];
		$Requested 			= $rsDept['REQUESTED'];
		$RequestedPosition 	= $rsDept['REQUESTEDPOSITION'];
		$Approval1 			= $rsDept['APPROVAL1'];
		$Approval1Position 	= $rsDept['APPROVAL1POSITION'];
		$Approval2 			= $rsDept['APPROVAL2'];
		$Approval2Position 	= $rsDept['APPROVAL2POSITION'];
	}

	$CID = $_REQUEST['id'];		
	if(empty($CID)){
		$CID = $_POST['CID'];		
	}

	$cSQLStr 	= "spSysDataGNRLPR '".$CID."','','','','','','','','',''
						,'','','','','','','','','',''
						,'".$DepartmentID."','','','','','','','',''
						,'','','','','','','','',''
						,'AKTIF','".$_SESSION['sMISAppuid']."'
						,'FIND CID','','','','',''";
//echo $cSQLStr;
	$qrDataLN=mssql_query($cSQLStr);  
	$NOMOR=1;
	if($rsLN=mssql_fetch_array($qrDataLN)){
		$Nomor = $rsLN['NOMOR'];
		$Tanggal=$rsLN['TANGGAL'];
		$DepartmentID=$rsLN['DEPARTMENTID'];
		$cNomorDesc = $rsLN['NOMORDESC'];
		$Division = $rsLN['DIVISION'];
		$Department = $rsLN['DEPARTMENT'];
		$ProjectTitle = $rsLN['PROJECTTITLE'];
		$JO = $rsLN['JO'];
		$Batch = $rsLN['BATCH'];
		$CostCodeCenter = $rsLN['COSTCENTERCODE'];
		$MTO	= $rsLN['MTO'];
		$DateRequired = $rsLN['DATEREQUIRED'];
		$DateRequiredDesc = $rsLN['DATEREQUIREDDESC'];
		$PointOfDelivery = $rsLN['POINTOFDELIVERY'];
		$StockItem = $rsLN['PURPOSESTOCKITEM'];
		$cekStockItem = "";
		if($StockItem==1){
			$cekStockItem = 'checked="checked"';
		}
		
		$StockNonItem = $rsLN['PURPOSENONSTOCKITEM'];
		$UserFor = $rsLN['USEFOR'];
		$CapitalAssets = $rsLN['CAPITALASSETS'];
		$cekCapitalAssets = "";
		if($CapitalAssets==1){
			$cekCapitalAssets = 'checked="checked"';
		}
		$Remark = $rsLN['REMARK'];
		$Requested = $rsLN['REQUESTBY'];
		$RequestedPosition = $rsLN['REQUESTBYPOSITION'];
		$Approval1 = $rsLN['APPROVEDBY'];
		$Approval1Position = $rsLN['APPROVEDBYPOSITION'];

		$CREATEDDATE		= $rsLN['CREATEDDATE'];
		$CREATEDID		 	= $rsLN['CREATEDID'];
		$CREATEDNAMALENGKAP	= $rsLN['CREATEDNAMALENGKAP'];

		$APPROVEDDATE		= $rsLN['APPROVEDDATE'];
		$APPROVEDID		 	= $rsLN['APPROVEDID'];
		$APPROVEDNAMALENGKAP= $rsLN['APPROVEDNAMALENGKAP'];

		$APPROVED1DATE			= $rsLN['APPROVED1DATE'];
		$APPROVED1ID		 	= $rsLN['APPROVED1ID'];
		$APPROVED1NAMALENGKAP	= $rsLN['APPROVED1NAMALENGKAP'];

		$APPROVED2DATE			= $rsLN['APPROVED2DATE'];
		$APPROVED2ID		 	= $rsLN['APPROVED2ID'];
		$APPROVED2NAMALENGKAP	= $rsLN['APPROVED2NAMALENGKAP'];

		$APPROVED3DATE			= $rsLN['APPROVED3DATE'];
		$APPROVED3ID		 	= $rsLN['APPROVED3ID'];
		$APPROVED3NAMALENGKAP	= $rsLN['APPROVED3NAMALENGKAP'];

		$JMLPOITEM		 		= $rsLN['JMLPOITEM'];

		$cStatus = $rsLN['CSTATUS'];
		$cEnable1 = "";
		$cEnable2 = "";
		$cEnable3 = "";
		$cEnable4 = "ed";
		if($cStatus=='APPROVED'){
			$cEnable1 = 'readonly="readonly"';
			$cEnable2 = 'disabled="disabled"';
			$cEnable3 = 'disabled="disabled"';
			$cEnable4 = "ro";
		}
	}
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $TitlePage." - ".$pSKAppNamaAplikasi;?></title>
<?php 
	include_once('incl/meta.php');
?>
<script  src="js/terbilang.js"></script>
<!--
<script  src="codebase/baru/dhtmlxcommon.js"></script>
<script  src="codebase/baru/dhtmlxgrid.js"></script>        
<script  src="codebase/baru/dhtmlxgridcell.js"></script>    
-->
<script>
	var myCalendar;
	function doOnLoad() {
		myCalendar 		= new dhtmlXCalendarObject({input: "Tanggal", button: "TanggalIcon"});
		myCalendarReq 	= new dhtmlXCalendarObject({input: "DateRequired", button: "DateRequiredIcon"});
		myCalendarTanggalPengiriman	= new dhtmlXCalendarObject({input: "TanggalPengiriman", button: "TanggalPengirimanIcon"});
		
		myCalendar.attachEvent("onClick", function(){
			fNomorDesc(frmData);
		});

	}

	function fNomorDesc(F){
		var cTanggal = document.getElementById("Tanggal").value;
		var vBln = cTanggal.split("/");
		var cThn = vBln[2].substring(2);
		var cBln = fgBulanRomawi(vBln[1]);
		document.getElementById("divNomorDesc").innerHTML = "/<?php echo $Dept;?>/"+cBln+"/"+cThn;
	}

	function isDate(ExpiryDate) { 
		var objDate,  // date object initialized from the ExpiryDate string 
			mSeconds, // ExpiryDate in milliseconds 
			day,      // day 

			month,    // month 
			year;     // year 

		if (ExpiryDate.length<8||ExpiryDate.length>10) { 
			return false; 
		} 

//		if (ExpiryDate.substring(2,3) !== '/' || ExpiryDate.substring(5,6) !== '/') { 
//			return false; 
//		} 

//		day 	= ExpiryDate.substring(0, 2) - 0; // because months in JS start from 0 
//		month 	= ExpiryDate.substring(3, 5) - 1; 
//		year 	= ExpiryDate.substring(6, 10) - 0; 

		var parts = ExpiryDate.split("/");
		if(parts.length!=3){
			return false; 
		}
		
		if(!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(ExpiryDate)){
			return false;
		}
				
		day 	= parseInt(parts[0], 10) - 0;
		month	= parseInt(parts[1], 10) - 1;
		year 	= parseInt(parts[2], 10) - 0;

		if (year < 1000 || year > 3000) { 
			return false; 
		} 

		mSeconds = (new Date(year, month, day)).getTime(); 

		objDate = new Date(); 
		objDate.setTime(mSeconds); 

		if (objDate.getFullYear() !== year || 
			objDate.getMonth() !== month || 
			objDate.getDate() !== day) { 
			return false; 
		} 

		return true; 
	}
	
	function checkDate(cObject){ 
		var ExpiryDate = document.getElementById(cObject).value; 
		if(!isDate(ExpiryDate)) { 
			alert('Periksa Tanggal! format "dd/mm/yyyy"'); 
			document.getElementById(cObject).style.backgroundColor = "#FFD9D9";
		} 
		else {
			document.getElementById(cObject).style.backgroundColor = "";
		}
	}

	function formatUang(pNum) {
		var Num,vNum,cNum,i;
		
		pNum = pNum.toString().replace(/\./g,'');
		pNum = pNum.toString().replace(',','.');

		cNum=parseFloat(pNum).toFixed(2).toString();
		
		i=cNum.indexOf('.');
		if(i<0){
			cNum=cNum+'.00';
		}
		vNum = cNum.split('.');
		
		Num = vNum[0].toString().replace(/\$|\.|\,/g,'');
		if(isNaN(Num))
		Num = "0";
		sign = (Num == (Num = Math.abs(Num)));
		Num = Math.floor(Num*100+0.50000000001);
		cents = Num%100;
		Num = Math.floor(Num/100).toString();
		if(cents<10)
		cents = "0" + cents;
		for (var i = 0; i < Math.floor((Num.length-(1+i))/3); i++)
		Num = Num.substring(0,Num.length-(4*i+3))+'.'+
		Num.substring(Num.length-(4*i+3));
		return (((sign)?'':'-') + Num)+','+vNum[1];
		
	}

/*
	function fTerbilang($n) {
		if ($n < 0) return 'minus ' + fTerbilang(-$n);
		else if ($n < 10) {
			switch ($n) {
				case 0: return 'zero';
				case 1: return 'one';
				case 2: return 'two';
				case 3: return 'three';
				case 4: return 'four';
				case 5: return 'five';
				case 6: return 'six';
				case 7: return 'seven';
				case 8: return 'eight';
				case 9: return 'nine';
			}
		}
		else if ($n < 100) {
			$kepala = Math.floor($n/10);
			$sisa = $n % 10;
			if ($kepala == 1) {
				if ($sisa == 0) return 'ten';
				else if ($sisa == 1) return 'eleven';
				else if ($sisa == 2) return 'twelve';
				else if ($sisa == 3) return 'thirteen';
				else if ($sisa == 5) return 'fifteen';
				else if ($sisa == 8) return 'eighteen';
				else return fTerbilang($sisa) + 'teen';
			}
			else if ($kepala == 2) $hasil = 'twenty';
			else if ($kepala == 3) $hasil = 'thirty';
			else if ($kepala == 5) $hasil = 'fifty';
			else if ($kepala == 8) $hasil = 'eighty';
			else $hasil = fTerbilang($kepala) + 'ty';
		}
		else if ($n < 1000) {
			$kepala = Math.floor($n/100);
			$sisa = $n % 100;
			$hasil = fTerbilang($kepala) + ' hundred';
		}
		else if ($n < 1000000) {
			$kepala = Math.floor($n/1000);
			$sisa = $n % 1000;
			$hasil = fTerbilang($kepala) + ' thousand';
		}
		else if ($n < 1000000000) {
			$kepala = Math.floor($n/1000000);
			$sisa = $n % 1000000;
			$hasil = fTerbilang($kepala) + ' million';
		}
		else return false;

		if ($sisa > 0) $hasil += ' ' + fTerbilang($sisa);
		return $hasil;
	}
	
	if ($row_ar1['sum(ar.mdoc)']){
		echo (ucwords(Terbilang($row_ar1['sum(ar.mdoc)'])));
	}
*/

</script>
<style>
/*
	div.gridbox0 table.obj td {
		padding-top: 15px;
		padding-bottom: 15px;
		line-height: 18px;
	}

	div.gridbox1 table.obj td {
		padding-top: 15px;
		padding-bottom: 15px;
		line-height: 18px;
	}
*/
</style>
</head>
<body> 
<div class="header">
<?php 
	include_once('incl/logo.php');
	include_once('incl/menu.php');
?>
</div>
<div class="content" style="min-height: 435px;">
    <h4 style="width: 60%;"><a id="LinkAtas"></a><?php echo $TitlePage;?></h4>
    <h4 style="width: 35%; float: right; text-align: right; vertical-align: bottom; padding: 15px 15px 0px 0px; height: 29px;">
	    <div id="toolbar2">
			<a class="toolbar" href="#" style="padding: 3px 5px 2px 5px" onclick="fWPilih('WDataAttach','eng_pr_mtl_attach_w.php?p0=DAFTAR ATTACH <?php echo $TitlePage;?>&p1=<?php echo $CID;?>','Add Attachment',40,20,0,0)"><img src="images/generic.png" width="18" height="18" border="0" align="left" id="Back" title="Attachment" style="margin-right: 5px" /><?php if($cStatus=='CREATED'){ echo 'Add Attach'; } else{echo 'View Attach';};?></a>
    	</div>
    </h4>
    <div class="line"></div>
<script>
<?php
	if($vHakMenu['472C4691-BFAB-4B07-9B44-AAC5ADC82A2A']){
?>	                
		function fSave(F){
			var bJumlah = 0;
	
			if(mygrid1.getRowsNum()==0){
				alert('Belum ada data detailnya.');
				return;
			}
	
			for(var i=0;i<mygrid1.getRowsNum();i++){
				if(parseInt(mygrid1.cells2(i,3).getValue().replace(/\./g,""))==0){
					bJumlah = 1;
				}
			}
			if(bJumlah==1){
				if(!confirm('Masih ada data dengan nominal harga nol. Apakah ingin lanjut simpan?')){
					return;
				}
			}
			
			if(F.Tanggal.value==''){
				alert('Periksa kembali Tanggal.');
				return;
			}
			if(F.DateRequired.value==''){
				alert('Periksa kembali Required Date.');
				return;
			}
			if(F.Division.value==''){
				alert('Periksa kembali Division.');
				return;
			}
			if(F.Department.value==''){
				alert('Periksa kembali Department.');
				return;
			}
			if(F.ProjectTitle.value==''){
				alert('Periksa kembali Section.');
				return;
			}
			if(F.Requested.value==''){
				alert('Periksa kembali Requested by.');
				return;
			}
			if(F.Approval1.value==''){
				alert('Periksa kembali Approved by.');
				return;
			}
			
			F.action = "eng_gnrl_pr_x_proses.php"
			F.submit();
			
		}
<?php
	}
	if($vHakMenu['D18C7E26-E3D7-4224-97E4-FA5316EC0928']){
?>	                
		function fPreview(F){
			fWPilih('WCetakPR','eng_gnrl_pr_wv.php?p0?p0=PREVIEW PR <?php echo $TitlePage;?>&p1=<?php echo $CID;?>','Preview PR No. <?php echo $Nomor.$cNomorDesc;?>',40,20,0,0);
		}
<?php
	}
	if($vHakMenu['7F648B8B-D254-4676-857B-16B39EE46039']){
?>	                
		function fCetak(F){
			fWPilih('WCetakPR','eng_gnrl_pr_wc.php?p0?p0=CETAK PR <?php echo $TitlePage;?>&p1=<?php echo $CID;?>','Cetak PR No. <?php echo $Nomor.$cNomorDesc;?>',40,20,0,0);
		}
		function fCetak2(F){
			fWPilih('WCetakPR','hrd_gnrl_pr_wcq.php?p0?p0=CETAK PR <?php echo $TitlePage;?>&p1=<?php echo $CID;?>','Cetak PR No. <?php echo $Nomor.$cNomorDesc;?>',40,20,0,0);
		}
<?php
	}
	if($vHakMenu['21D31F56-5E5F-4A50-8FF3-49ED4B1386EA']){
?>	                
		function fApprove(F){
			if(confirm("Yakin memberikan status Approve pada PR?")){	
				F.hdFrom.value = "APPROVED";
				F.action = "eng_gnrl_pr_x_proses.php";
				F.submit();
			}
		}
<?php
	}
	if($vHakMenu['E4E6FCD1-FE31-449D-AC0F-3AA4F69E056F']){
?>	                
		function fApprove1(F){
			if(confirm("Yakin memberikan status Approve 2 pada PR?")){	
				F.hdFrom.value = "APPROVED 1";
				F.action = "eng_gnrl_pr_x_proses.php";
				F.submit();
			}
		}
<?php
	}
	if($vHakMenu['AB6988C1-0899-4794-82C5-491F3E81C147']){
?>	                
		function fApprove2(F){
			if(confirm("Yakin memberikan status Approve 3 pada PR?")){	
				F.hdFrom.value = "APPROVED 2";
				F.action = "eng_gnrl_pr_x_proses.php";
				F.submit();
			}
		}
<?php
	}
	if($vHakMenu['60AFF5F1-1E20-4C01-9017-1FF8AE782EC0']){
?>	                
		function fApprove3(F){
			if(confirm("Yakin memberikan status Approve 4 pada PR?")){	
				F.hdFrom.value = "APPROVED 3";
				F.action = "eng_gnrl_pr_x_proses.php";
				F.submit();
			}
		}
<?php
	}
	if($vHakMenu['15B778D0-2FCB-4862-9459-926B02C7F61F']){
?>	                
		function fUnApprove(F){
			if(confirm("Yakin memberikan status Approve pada PR?")){	
				F.hdFrom.value = "UNAPPROVED";
				F.action = "eng_gnrl_pr_x_proses.php";
				F.submit();
			}
		}
<?php
	}
	if($vHakMenu['58B5A66C-1848-432A-85DE-568E317F95FB']){
?>	                
		function fUnApprove1(F){
			if(confirm("Yakin memberikan status Approve 2 pada PR?")){	
				F.hdFrom.value = "UNAPPROVED 1";
				F.action = "eng_gnrl_pr_x_proses.php";
				F.submit();
			}
		}
<?php
	}
	if($vHakMenu['AD20D508-6BEA-49E1-864C-47C38BDA1EE9']){
?>	                
		function fUnApprove2(F){
			if(confirm("Yakin memberikan status Approve 3 pada PR?")){	
				F.hdFrom.value = "UNAPPROVED 2";
				F.action = "eng_gnrl_pr_x_proses.php";
				F.submit();
			}
		}
<?php
	}
	if($vHakMenu['3DA2589F-79EE-44B1-A1AB-BC2E3B9BC10B']){
?>	                
		function fUnApprove3(F){
			if(confirm("Yakin memberikan status Approve 4 pada PR?")){	
				F.hdFrom.value = "UNAPPROVED 3";
				F.action = "eng_gnrl_pr_x_proses.php";
				F.submit();
			}
		}
<?php
	}
?>
	
	function fRefresh(F){
		F.reset();
	}
	
	function fBatal(F){
		F.action = "eng_gnrl_pr.php"
		F.submit();
	}
	
</script>
    <form name="frmData" method="post">
    <input type="hidden" name="hdFrom" value="UPDATE" />
    <input type="hidden" name="CID" value="<?php echo $CID;?>" />
    <input type="hidden" name="DepartmentID" value="<?php echo $DepartmentID;?>" />
    <input type="hidden" name="PRDetailID" value="" />
    <input type="hidden" name="Dept" value="<?php echo $Dept;?>" />
    <div class="MainContent" style="float: left;">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" style="font-size:12px; font-weight: bold;">
          <tr>
            <td height="25" align="right" valign="top">DATE</td>
            <td align="center" valign="top">:</td>
            <td align="left" valign="top"><input name="Tanggal" type="text" class="form" style="float: left; text-align: center; width: 80px;" id="Tanggal" value="<?php echo $Tanggal;?>" size="30" maxlength="150" onchange="checkDate('Tanggal')" <?php echo $cEnable1;?> />
            <img id="TanggalIcon" src="images/calendar.gif" border="0" height="25" width="25" align="absbottom" style="float: left; margin-top: -2px; margin-left: 2px;" <?php echo $cEnable3;?> /></td>
            <td width="10" align="left" valign="top">&nbsp;</td>
            <td width="130" align="right" valign="top">MTO</td>
            <td width="10" align="center" valign="top">:</td>
            <td align="left" valign="top"><input name="MTO" type="text" class="form" style="float: left; text-align: left; width: 240px;" id="MTO" value="<?php echo $MTO;?>" maxlength="150" <?php echo $cEnable1;?> /></td>
          </tr>
          <tr>
            <td width="100" height="25" align="right" valign="top" nowrap="nowrap">PR NO.</td>
            <td width="10" align="center" valign="top">:</td>
            <td width="375" align="left" valign="top"><input name="Nomor" type="text" class="form" style="float: left; text-align: center; width: 40px;" id="Nomor" value="<?php echo $Nomor;?>" maxlength="20" onchange="fCekKode(frmData,'NOMOR','divKode',this.value)" <?php echo $cEnable1;?> /><div id="divNomorDesc" style="float: left; padding-top: 4px; margin-left: 5px;"><?php echo $cNomorDesc;?></div></td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="right" valign="top" nowrap="nowrap">DATE REQ.</td>
            <td align="center" valign="top">:</td>
            <td align="left" valign="middle"><input name="DateRequired" type="text" class="form" style="float: left; text-align: center; width: 80px;" id="DateRequired" value="<?php echo $DateRequired;?>" size="30" maxlength="150" onchange="checkDate('DateRequired')" <?php echo $cEnable1;?> />
            <img id="DateRequiredIcon" src="images/calendar.gif" border="0" height="25" width="25" align="absbottom" style="float: left; margin-top: -2px; margin-left: 2px;" <?php echo $cEnable3;?> /></td>
          </tr>
          <tr>
            <td height="25" align="right" valign="top">DIVISION</td>
            <td width="10" align="center" valign="top">:</td>
            <td align="left" valign="top"><input name="Division" type="text" class="form" style="float: left; width: 300px;" id="Division" value="<?php echo $Division;?>" maxlength="150" <?php echo $cEnable1;?> /></td>
            <td align="right" valign="top"></td>
            <td align="right" valign="top">&nbsp;</td>
            <td align="center" valign="top">&nbsp;</td>
            <td rowspan="2" align="left" valign="top"><textarea name="DateRequiredDesc" cols="30" class="form" style="width: 240px;" id="DateRequiredDesc" rows="2" <?php echo $cEnable1;?> ><?php echo $DateRequiredDesc;?></textarea></td>
          </tr>
          <tr>
            <td height="25" align="right" valign="top" nowrap="nowrap">DEPARTMENT</td>
            <td width="10" align="center" valign="top">:</td>
            <td align="left" valign="top"><input name="Department" type="text" class="form" style="float: left; width: 300px;" id="Department" value="<?php echo $Department;?>" maxlength="150" <?php echo $cEnable1;?> /></td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="right" valign="top">&nbsp;</td>
            <td align="center" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" align="right" valign="top" nowrap="nowrap">SECTION</td>
            <td align="center" valign="top">:</td>
            <td align="left" valign="top"><input name="ProjectTitle" type="text" class="form" style="float: left; width: 385px;" id="ProjectTitle" value="<?php echo $ProjectTitle;?>" maxlength="255" <?php echo $cEnable1;?> /></td>
            <td align="left" valign="top">&nbsp;</td>
            <td height="25" align="right" valign="top">POINT OF DELIVERY</td>
            <td align="center" valign="top">:</td>
            <td align="left" valign="top"><input name="PointOfDelivery" type="text" class="form" style="float: left; text-align: left; width: 240px;" id="PointOfDelivery" value="<?php echo $PointOfDelivery;?>" maxlength="150" <?php echo $cEnable1;?> /></td>
          </tr>
          <tr>
            <td height="25" align="right" valign="top" nowrap="nowrap">JO</td>
            <td align="center" valign="top">:</td>
            <td align="left" valign="top">
                <input name="JO" type="text" class="form" style="float: left; width: 60px; text-align: center; margin-right: 15px;" id="JO" value="<?php echo $JO;?>" maxlength="6" <?php echo $cEnable1;?> /> 
                <div style="float: left; margin-right: 5px;">BATCH : </div> 
                <input name="Batch" type="text" class="form" style="float: left; width: 60px; text-align: center; margin-right: 15px;" id="Batch" value="<?php echo $Batch;?>" maxlength="10" <?php echo $cEnable1;?> />
                <div style="float: left; margin-right: 5px;">COST CODE : </div> 
                <input name="CostCenterCode" type="text" class="form" style="float: left; width: 60px; text-align: center; margin-right: 15px;" id="CostCenterCode" value="<?php echo $CostCodeCenter;?>" maxlength="10" placeholder="Cost Code" onchange="fCekCostCenterCode(frmData,'','divCekCostCenterCode',this.value)" ondblclick="fPilihCostCenterCode(frmData)" <?php echo $cEnable1;?> /> <input type="hidden" name="cekCostCenterCode" value="" />           
            </td>
            <td align="left" valign="top">&nbsp;</td>
            <td height="25" align="right" valign="top">&nbsp;</td>
            <td align="center" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" rowspan="4" align="right" valign="top" nowrap="nowrap">REMARK</td>
            <td rowspan="4" align="center" valign="top">:</td>
            <td rowspan="4" align="left" valign="top"><textarea name="Remark" cols="60" class="form" id="Remark" rows="4" <?php echo $cEnable1;?> ><?php echo $Remark;?></textarea></td>
            <td rowspan="4" align="left" valign="top">&nbsp;</td>
            <td height="4" align="right" valign="top">PROPOSE</td>
            <td align="center" valign="top">:</td>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td height="5" align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">
              <input type="checkbox" name="StockItem" id="StockItem" class="form" style="float: left;" <?php echo $cekStockItem;?> <?php echo $cEnable2;?> /> <div style="float: left; margin-left: 5px;">STOCK ITEM</div>            </td>
          </tr>
          <tr>
            <td height="12" align="right" valign="top">USER</td>
            <td align="center" valign="top">:</td>
            <td align="left" valign="top"><input name="UserFor" type="text" class="form" style="float: left; text-align: left; width: 240px;" id="UserFor" value="<?php echo $UserFor;?>" maxlength="150" <?php echo $cEnable1;?> /></td>
          </tr>
          <tr>
            <td height="25" align="left" valign="top">&nbsp;</td>
            <td height="25" align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">
              <input type="checkbox" name="CapitalAssets" id="CapitalAssets" class="form" style="float: left;" <?php echo $cekCapitalAssets;?> <?php echo $cEnable2;?> /> <div style="float: left; margin-left: 5px;">CAPITAL ASSETS</div>            </td>
          </tr>
          <tr>
            <td height="10" colspan="7" align="center" valign="top" nowrap="nowrap"></td>
          </tr>
          <tr>
            <td colspan="7" align="center" valign="top" nowrap="nowrap"><div id="toolbar2" style="float: right; width: 100%; margin-left: 10px;">
        <div style="float: left; text-align: left; height: 25px; padding-top: 5px; font-size:12px; font-weight: bold;">
        	PR ITEM : 
        </div>
        <a class="toolbar" href="#" style="padding: 3px 5px 2px 5px" onclick="fRefresh1(frmData)"><img src="images/reload_f2.png" width="18" height="18" border="0" align="left" id="Refresh" title="Refresh" style="margin-right: 5px" />Refresh</a>
<?php
	if($cStatus!='APPROVED'){
?>
        <a class="toolbar" href="#" id="btnDetailDelete" style="padding: 3px 5px 2px 5px; display: none;" onclick="fHapus1(frmData)"><img src="images/db_remove.png" width="18" height="18" border="0" align="left" id="Delete" title="Delete Grade" style="margin-right: 5px" />Delete</a>    
       	<a class="toolbar" href="#" style="padding: 3px 5px 2px 5px" onclick="fWPilih('WDataAssets','data_gnrl_assets_w.php?p0=DAFTAR ASSETS <?php echo $TitlePage;?>','Daftar Assets',40,20,0,0)"><img src="images/db_add.png" width="18" height="18" border="0" align="left" id="Refresh" title="Refresh" style="margin-right: 5px" />Add</a>
<?php
	}
?>
    </div>
	<div id="divTemp" style="width: 100%; height: 1px; float: left; background-color: white; display: none;"></div>
    <div id="gridbox1" style="float: right; width: 100%; height: 200px; color: #666666;"></div>
	<div id="gridboxFooter" style="width: 100%; height: 100px; float: left;">
	  <div id="gridApproval" style="float: right; width: 100%; height: 75px; text-align: left; margin-top: 2px; padding-left: 5px; padding-top: 2px;">
      		<div style="width: 520px; float: left;">
				<div id="gridboxApproval" style="width: 520px; height: 30px; float: left; text-align: center; margin-top: 5px;">
					Approval :<br />
                    <div id="divApproval1" style="width: 255px; float: left; text-align: right; margin-top: 15px;">
                        <div style="float: right; text-align: left; width: 250px;">
                            Requested by,
                            <input name="Requested" type="text" class="form" id="Requested" value="<?php echo $Requested;?>" size="30" style="margin-bottom: 5px; float: left;" <?php echo $cEnable1;?> />
                            <input name="RequestedPosition" type="text" class="form" id="RequestedPosition" value="<?php echo $RequestedPosition;?>" size="30" style="margin-bottom: 5px; float: left;" <?php echo $cEnable1;?> />
                        </div>
                    </div>
                    <div id="divApproval2" style="width: 255px; float: left; text-align: left; margin-top: 15px;">
                        <div style="float: left; text-align: left; width: 250px;">
                            Approved by,
                            <input name="Approval1" type="text" class="form" id="Approval1" value="<?php echo $Approval1;?>" size="30" style="margin-bottom: 5px; float: left;" <?php echo $cEnable1;?> />
                            <input name="Approval1Position" type="text" class="form" id="Approval1Position" value="<?php echo $Approval1Position;?>" size="30" style="margin-bottom: 5px; float: left;" <?php echo $cEnable1;?> />
                        </div>
                    </div>
				</div>
        	</div>
      		<div style="width: 400px; float: left;">
				<div id="gridboxApproved" style="width: 450px; height: 15px; float: left; text-align: left; margin-top: 5px; font-weight: bold; padding-left: 50px;">Approved Date :</div>
				<div id="gridboxApprovedC" style="width: 450px; float: left; text-align: left; margin-top: 5px; font-weight: normal; padding-left: 50px;">Created by &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <strong><?php echo $CREATEDNAMALENGKAP;?></strong>, Date : <strong><?php echo $CREATEDDATE;?></strong> </div>
				<div id="gridboxApproved1" style="width: 450px; float: left; text-align: left; margin-top: 5px; font-weight: normal; padding-left: 50px;">Approved 1 by : 
<?php
	if(trim($APPROVEDNAMALENGKAP)!=''){
?>                
                <strong><?php echo $APPROVEDNAMALENGKAP;?></strong>, Date : <strong><?php echo $APPROVEDDATE;?></strong> 
<?php
	}
?>                
                </div>
				<div id="gridboxApproved2" style="width: 450px; float: left; text-align: left; margin-top: 5px; font-weight: normal; padding-left: 50px;">Approved 2 by : 
<?php
	if(trim($APPROVED1NAMALENGKAP)!=''){
?>                
                <strong><?php echo $APPROVED1NAMALENGKAP;?></strong>, Date : <strong><?php echo $APPROVED1DATE;?></strong> 
<?php
	}
?>                
                </div>
				<div id="gridboxApproved3" style="width: 450px; float: left; text-align: left; margin-top: 5px; font-weight: normal; padding-left: 50px;">Approved 3 by : 
<?php
	if(trim($APPROVED2NAMALENGKAP)!=''){
?>                
                <strong><?php echo $APPROVED2NAMALENGKAP;?></strong>, Date : <strong><?php echo $APPROVED2DATE;?></strong>
<?php
	}
?>              
				</div>  
				<div id="gridboxApproved3" style="width: 450px; float: left; text-align: left; margin-top: 5px; font-weight: normal; padding-left: 50px;">Approved 4 by : 
<?php
	if(trim($APPROVED3NAMALENGKAP)!=''){
?>                
                <strong><?php echo $APPROVED3NAMALENGKAP;?></strong>, Date : <strong><?php echo $APPROVED3DATE;?></strong> 
<?php
	}
?>                
                </div>
        	</div>
    	</div>
    </div>
    <script>
	
		
function fCekCostCenterCode(F,p1,p2,v1){
			doRequest('get','fin_pv_cash_x_proses.php?p0=CEK COST CENTER CODE&p1='+p1+'&v1='+v1,'text',p2);
		}
	
		function fPilihCostCenterCode(F){
			fWPilih('WDataCostCenterCode','acct_md_costcode_w.php?p0=COST CENTER CODE <?php echo $TitlePage;?>','Daftar Cost Center',40,20,0,0);
		}
		
		function fHapus1(F){
			if(F.PRDetailID.value==''){
				alert('Pilih data yang akan dihapus.');
				return;
			}
			else {
				if(confirm('Yakin akan menghapus data?')){ 
					mygrid1.deleteSelectedItem();
					fRefreshPODetail(F);
				}
			}
		}
		
		function fRefresh1(F){
			F.PRDetailID.value='';
			mygrid1.clearAll(); 
			mygrid1.loadXML("eng_gnrl_pr_detail_list.php?p0=<?php echo $TitlePage;?>&p1=<?php echo $CID;?>");
		}
				
		function doOnRowDblClicked1(rowId,cInd){
<?php
	if($cStatus!='APPROVED'){
?>
			document.frmData.PRDetailID.value = rowId;
			if(cInd==1){
				fWPilih('WDataAssets','data_gnrl_assets_w.php?p0=DAFTAR ASSETS <?php echo $TitlePage;?>&p5='+rowId+'&p6='+mygrid1.cells(rowId,10).getValue()+'&p7='+mygrid1.cells(rowId,9).getValue()+'&p8='+mygrid1.cells(rowId,6).getValue()+'&p9='+mygrid1.cells(rowId,7).getValue()+'&p10='+mygrid1.cells(rowId,8).getValue()+'&p11='+mygrid1.cells(rowId,3).getValue(),'Daftar Assets',40,20,0,0);
			}	
<?php
	}
?>	
		}
		
		function doOnRowSelected1(rowId){
			document.frmData.PRDetailID.value = rowId;
<?php
	if($cStatus!='APPROVED'){
?>
			if(mygrid1.cells(rowId,11).getValue()=='1'){
				document.getElementById('btnDetailDelete').style.display = 'none'; 
			}
			else {
				document.getElementById('btnDetailDelete').style.display = 'block'; 
			}
<?php
	}
?>
		}
		
        mygrid1 = new dhtmlXGridObject('gridbox1');
        mygrid1.setImagePath("codebase/imgs/");
        mygrid1.setHeader("<center><b>NO.</b></center>,<center><b>KETERANGAN</b></center>,<center><b>OPSI</b></center>,<center><b>QTY</b></center>,<center><b>SATUAN</b></center>,PRID,AssetID,ServiceID,SatuanID,Catatan,AssetNama,POStatus,ItemApprove,PODETAILID");
        mygrid1.setInitWidths("50,*,100,125,75,0,0,0,0,0,0,0,0,0");
        mygrid1.setColAlign("center,left,center,right,center,center,center,center,center,center,center,center,center,center");
		mygrid1.setColTypes("ro,ro,ro,<?php echo $cEnable4;?>,ro,ro,ro,ro,ro,ro,ro,ro,ro,ro");
        mygrid1.setColSorting("int,str,str,str,str,str,str,str,str,str,str,str,str,str");
        mygrid1.setSkin("modern");
		mygrid1.enableEditEvents(true,true,true);
//		mygrid1.attachEvent("onEditCell", doOnEditCell1);
		mygrid1.attachEvent("onRowDblClicked", doOnRowDblClicked1);
		mygrid1.attachEvent("onRowSelect",doOnRowSelected1);
        mygrid1.setSkin("modern");
        mygrid1.init();
        mygrid1.loadXML("eng_gnrl_pr_detail_list.php?p0=<?php echo $TitlePage;?>&p1=<?php echo $CID;?>");
		
		myDataProcessor1 = new dataProcessor("eng_gnrl_pr_detail_x_proses.php"); //lock feed url
//		myDataProcessor1.setUpdateMode("off"); // disable auto-update
		myDataProcessor1.init(mygrid1); //link dataprocessor to the grid
		
		myDataProcessor1.attachEvent("onFullSync",function(){
			mygrid1.clearAll(); 
			mygrid1.loadXML("eng_gnrl_pr_detail_list.php?p0=<?php echo $TitlePage;?>&p1=<?php echo $CID;?>");
		})	
	</script>    	</td>
          </tr>
          <tr>
            <td height="10" align="right" valign="top"></td>
            <td align="center" valign="top"></td>
            <td colspan="5" align="left" valign="top"></td>
          </tr>
          <tr align="center">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="5" align="left">
            <table cellpadding="0" cellspacing="0" border="0" id="toolbar">
              <tr valign="middle" align="center">
<?php 
		if($cStatus=='CREATED'&&$vHakMenu['472C4691-BFAB-4B07-9B44-AAC5ADC82A2A']){
?>              
                <td style="font:Arial, Helvetica, sans-serif; font-size:12px"><a class="toolbar" href="#" onclick="fSave(frmData);"><img src="images/save_f2.png" width="32" height="32" border="0" align="middle" id="Simpan" title="Simpan perubahan"/><br/>
                  Simpan</a> </td>
                <td>&nbsp;</td>
<?php
		}
		if($vHakMenu['D18C7E26-E3D7-4224-97E4-FA5316EC0928']){
?>	                
                <td style="font:Arial, Helvetica, sans-serif; font-size:12px"><a class="toolbar" href="#" onclick="fWPilih('WDataAttach','eng_pr_mtl_attach_w.php?p0=DAFTAR ATTACH <?php echo $TitlePage;?>&p1=<?php echo $CID;?>','Add Attachment',40,20,0,0)"><img src="images/generic.png" width="32" height="32" border="0" align="middle" id="Attachment" title="Attachment"/><br/>
                  Attach</a> </td>
                <td>&nbsp;</td>
                <td style="font:Arial, Helvetica, sans-serif; font-size:12px"><a class="toolbar" href="#" onclick="fPreview(frmData);"><img src="images/generic.png" width="32" height="32" border="0" align="middle" id="Preview" title="Preview PR"/><br/>
                  Preview</a> </td>
                <td>&nbsp;</td>
<?php
		}
		if($cStatus=='APPROVED'&&$vHakMenu['7F648B8B-D254-4676-857B-16B39EE46039']){
?>              
                <td style="font:Arial, Helvetica, sans-serif; font-size:12px"><a class="toolbar" href="#" onclick="fCetak(frmData);"><img src="images/printer1.png" width="32" height="32" border="0" align="middle" id="Cetak" title="Cetak PR"/><br/>
                  Cetak</a> </td>
                <td>&nbsp;</td>
                <td style="font:Arial, Helvetica, sans-serif; font-size:12px"><a class="toolbar" href="#" onclick="fCetak2(frmData);"><img src="images/printer1.png" width="32" height="32" border="0" align="middle" id="Cetak" title="Cetak PR"/><br/>
                  Cetak 2</a> </td>
                <td>&nbsp;</td>
<?php
		}
		if($cStatus=='CREATED'&&$vHakMenu['21D31F56-5E5F-4A50-8FF3-49ED4B1386EA']){
?>	                
                <td style="font:Arial, Helvetica, sans-serif; font-size:12px"><a class="toolbar" href="#" onclick="fApprove(frmData);"><img src="images/accept_icon_32.png" width="32" height="32" border="0" align="middle" id="Approve" title="Approve PR"/><br/>
                  Approve 1</a> </td>
                <td>&nbsp;</td>
<?php
		}
		if(trim($APPROVEDID)!=''&&trim($APPROVED1ID)==''&&trim($APPROVED2ID)==''&&trim($APPROVED3ID)==''
			&&$vHakMenu['E4E6FCD1-FE31-449D-AC0F-3AA4F69E056F']){
?>	                
                <td style="font:Arial, Helvetica, sans-serif; font-size:12px"><a class="toolbar" href="#" onclick="fApprove1(frmData);"><img src="images/accept_icon_32.png" width="32" height="32" border="0" align="middle" id="Approve" title="Approve PR"/><br/>
                  Approve 2</a> </td>
                <td>&nbsp;</td>
<?php
		}
		if(trim($APPROVED1ID)!=''&&trim($APPROVED2ID)==''&&trim($APPROVED3ID)==''
			&&$vHakMenu['AB6988C1-0899-4794-82C5-491F3E81C147']){
?>	                
                <td style="font:Arial, Helvetica, sans-serif; font-size:12px"><a class="toolbar" href="#" onclick="fApprove2(frmData);"><img src="images/accept_icon_32.png" width="32" height="32" border="0" align="middle" id="Approve" title="Approve PR"/><br/>
                  Approve 3</a> </td>
                <td>&nbsp;</td>
<?php
		}
		if(trim($APPROVED2ID)!=''&&trim($APPROVED3ID)==''
			&&$vHakMenu['60AFF5F1-1E20-4C01-9017-1FF8AE782EC0']){
?>	                
                <td style="font:Arial, Helvetica, sans-serif; font-size:12px"><a class="toolbar" href="#" onclick="fApprove3(frmData);"><img src="images/accept_icon_32.png" width="32" height="32" border="0" align="middle" id="Approve" title="Approve PR"/><br/>
                  Approve 4</a> </td>
                <td>&nbsp;</td>
<?php
		}
		if($cStatus=='APPROVED'&&trim($APPROVED1ID)==''&&trim($APPROVED2ID)==''&&trim($APPROVED3ID)==''
			&&$vHakMenu['15B778D0-2FCB-4862-9459-926B02C7F61F']
			&&$JMLPOITEM==0){
?>
                <td style="font:Arial, Helvetica, sans-serif; font-size:12px"><a class="toolbar" href="#" onclick="fUnApprove(frmData);"><img src="images/accept_not_icon_32.png" width="32" height="32" border="0" align="middle" id="Approve" title="UnApprove PR"/><br/>
                  UnApprove 1</a> </td>
                <td>&nbsp;</td>
<?php
		}
		if(trim($APPROVED1ID)!=''&&trim($APPROVED2ID)==''&&trim($APPROVED3ID)==''
			&&$vHakMenu['58B5A66C-1848-432A-85DE-568E317F95FB']
			&&$JMLPOITEM==0){
?>
                <td style="font:Arial, Helvetica, sans-serif; font-size:12px"><a class="toolbar" href="#" onclick="fUnApprove1(frmData);"><img src="images/accept_not_icon_32.png" width="32" height="32" border="0" align="middle" id="Approve" title="UnApprove PR"/><br/>
                  UnApprove 2</a> </td>
                <td>&nbsp;</td>
<?php
		}
		if(trim($APPROVED2ID)!=''&&trim($APPROVED3ID)==''
			&&$vHakMenu['AD20D508-6BEA-49E1-864C-47C38BDA1EE9']
			&&$JMLPOITEM==0){
?>
                <td style="font:Arial, Helvetica, sans-serif; font-size:12px"><a class="toolbar" href="#" onclick="fUnApprove2(frmData);"><img src="images/accept_not_icon_32.png" width="32" height="32" border="0" align="middle" id="Approve" title="UnApprove PR"/><br/>
                  UnApprove 3</a> </td>
                <td>&nbsp;</td>
<?php
		}
		if(trim($APPROVED3ID)!=''
			&&$vHakMenu['3DA2589F-79EE-44B1-A1AB-BC2E3B9BC10B']
			&&$JMLPOITEM==0){
?>
                <td style="font:Arial, Helvetica, sans-serif; font-size:12px"><a class="toolbar" href="#" onclick="fUnApprove3(frmData);"><img src="images/accept_not_icon_32.png" width="32" height="32" border="0" align="middle" id="Approve" title="UnApprove PR"/><br/>
                  UnApprove 4</a> </td>
                <td>&nbsp;</td>
<?php
		}
?>	                  
                <td style="font:Arial, Helvetica, sans-serif; font-size:12px"><a class="toolbar" href="#" onClick="fRefresh(frmData)"> <img src="images/reload_f2.png" width="32" height="32" border="0" align="middle" id="Batal" title="Reset"/><br/>
                  Reset</a></td>
                <td>&nbsp;</td>
                <td style="font:Arial, Helvetica, sans-serif; font-size:12px"><a class="toolbar" href="#" onClick="fBatal(frmData)"> <img src="images/cancel_f2.png" width="32" height="32" border="0" align="middle" id="Cancel" title="Batal"/><br/>
                  Cancel</a></td>
              </tr>
            </table></td>
          </tr>
          <tr align="center">
            <td height="30">&nbsp;</td>
            <td height="30">&nbsp;</td>
            <td height="30" colspan="5" align="left">&nbsp;</td>
          </tr>
        </table>
	</div>
	</form>
</div>
<?php 
	include_once('incl/footer.php');
?>
</div>
<script type="text/javascript">
	lebar = screen.width-20;
	tinggi = screen.height-250;
	wlebar = lebar-100;
	wtinggi = tinggi-200;
	var dhxWins = new dhtmlXWindows();
	dhxWins.enableAutoViewport(true);		

	dhxWins.setViewport(0, 0, lebar, tinggi);
	dhxWins.setImagePath("codebase/imgs/");
	dhxWins.setSkin("clear_silver");

	function fWPilih(Nama, URL, cTitle, iAtas, iKiri, iPanjang, iTinggi){
		if(iPanjang==0){
			iPanjang=screen.width-100;
		};
		if(iTinggi==0){
			iTinggi=screen.height-175;
		};
		
		var w1 = dhxWins.createWindow(Nama, iAtas, iKiri, iPanjang, iTinggi);
		w1.setText(cTitle);
		w1.keepInViewport(true); 
		w1.attachURL(URL);
	}
	
	function doOnUnload(v0,v1,v2,v3,v4,v5,v6,v7,v8,v9,v10,v11,v12,v13,v14,iid) {
		if(v0=='PILIH DAFTAR ASSETS <?php echo $TitlePage;?>'){

			mygrid1.addRow((new Date()).valueOf(),[mygrid1.getRowsNum()+1,v3+' '+v4,'',v5,'','<?php echo $CID;?>',v1,v2,v6,v4,v3],mygrid1.getRowIndex(mygrid1.getSelectedId()));

			dhxWins.window('WDataAssets').close();
		}	
		else if(v0=='UPDATE DAFTAR ASSETS <?php echo $TitlePage;?>'){

			mygrid1.cells(v1,1).setValue(v4+' '+v5);
			mygrid1.cells(v1,2).setValue('');
			mygrid1.cells(v1,3).setValue(v6);
			mygrid1.cells(v1,4).setValue('');
			mygrid1.cells(v1,5).setValue('<?php echo $CID;?>');
			mygrid1.cells(v1,6).setValue(v2);
			mygrid1.cells(v1,7).setValue(v3);
			mygrid1.cells(v1,8).setValue(v7);
			mygrid1.cells(v1,9).setValue(v5);
			mygrid1.cells(v1,10).setValue(v4);
			myDataProcessor1.sendData(v1);

			dhxWins.window('WDataAssets').close();
		}	
		else if(v0=='BATAL DAFTAR ASSETS <?php echo $TitlePage;?>'){
			dhxWins.window('WDataAssets').close();
		}	
		else if(v0=='PILIH COST CENTER CODE <?php echo $TitlePage;?>'){
			document.frmData.CostCenterCode.value = v2;
			fCekCostCenterCode(frmData,'','divCekCostCenterCode',v2)
			dhxWins.window('WDataCostCenterCode').close();
		}	
		else if(v0=='BATAL COST CENTER CODE <?php echo $TitlePage;?>'){
			dhxWins.window('WDataCostCenterCode').close();
		}	
		else if(v0=='BATAL DAFTAR ATTACH <?php echo $TitlePage;?>'){
			dhxWins.window('WDataAttach').close();
		}
	}	

<?php
	if($cStatus!='APPROVED'){
?>
		doOnLoad();
<?php
	}
?>
</script>	
</body>
</html>