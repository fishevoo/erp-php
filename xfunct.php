<?php
//==============================================
// funct.php
// Copyright (c) 2008 enex-indonesia.com	
//==============================================

//==>> FUNGSI HAK AKSES
function HakAksesMenu($pMenuID){
	$cSQLStr = "spSysOtor '".$_SESSION['sMISAppuid']."','".$pMenuID."'";
	
	$bHak = false;
	$qrOtor=mssql_query($cSQLStr); 
	if(mssql_num_rows($qrOtor)>0){
		$bHak = true;
	}
	return $bHak;
}

//==>> FUNGSI MEMBUAT MEMBER IID
function CreateMemberIID(){
	$Tgl = getdate();
	$Bln = $Tgl['mon'];
	$Thn = $Tgl['year'];	

	if ($Bln<10)
	{
		$Bln = "0";
		$Bln .= $Tgl['mon'];
	};
	$Thn = substr($Thn,2,2);
	
	$SQLStr = "SELECT NomorAnggota FROM tbmember order by right(NomorAnggota,5) Desc Limit 0,1";
	$rsCreateMIID = mysql_query($SQLStr); 
	
	if ($rwCreateMIID=mysql_fetch_array($rsCreateMIID)){
		$iCMIID = substr($rwCreateMIID['NomorAnggota'],5,5) + 1;
		
		switch(strlen(trim($iCMIID))){
			case 1:
				$iCMIID= "0000".$iCMIID;
				break;
			case 2: 
				$iCMIID= "000".$iCMIID;
				break;
			case 3: 
				$iCMIID= "00".$iCMIID;
				break;
			case 4: 
				$iCMIID= "0".$iCMIID;
				break;
			default: 
				$iCMIID= $iCMIID;
		};
	}
	else{
		$iCMIID = "00100";
	};
	return $Thn.$Bln."-".$iCMIID;
};

//==>> FUNGSI MEMBUAT IID TABLE SEMUA
function CreateTBIID($pDesc,$pTableName){
	$Tgl = getdate();
	$Bln = $Tgl['mon'];
	$Thn = $Tgl['year'];	

	if ($Bln<10){
		$Bln = "0";
		$Bln .= $Tgl['mon'];
	};
	$Thn = substr($Thn,2,2);

	$SQLStr = "SELECT IID FROM $pTableName Where left(IID, 4) ='$Thn$Bln' order by IID Desc Limit 0,1";
	$rsCreateMIID = mysql_query($SQLStr); 

	if ($rwCreateMIID=mysql_fetch_array($rsCreateMIID)){
		$iCMIID = substr($rwCreateMIID[0],5,5) + 1;

		switch(strlen(trim($iCMIID))){
			case 1:
				$iCMIID= "0000".$iCMIID;
				break;
			case 2: 
				$iCMIID= "000".$iCMIID;
				break;
			case 3: 
				$iCMIID= "00".$iCMIID;
				break;
			case 4: 
				$iCMIID= "0".$iCMIID;
				break;
			default: 
				$iCMIID= $iCMIID;
		};
	}
	else{
		$iCMIID = "00001";
	};
	return $Thn.$Bln.$pDesc.$iCMIID;
};

//==>> FUNGSI MEMBUAT IID TABLE SEMUA
function CreateIID($pDesc, $pTableName){
	if (empty($pTableName)){
		return "";
	}
	else{
		$SQLStr = "SELECT IID FROM $pTableName order by IID DESC LIMIT 0,1" ;
    	$rsCreateIID = mysql_query($SQLStr);
    	
		if ($rwCreateIID = mysql_fetch_array($rsCreateIID)){
			$iCIID = substr($rwCreateIID[0],9-strlen(trim($rwCreateIID[0])),5) + 1;

			switch(strlen(trim($iCIID))){
				case 1:
					$iCIID = "0000".$iCIID;
					break;
				case 2: 
					$iCIID = "000".$iCIID;
					break;
				case 3: 
					$iCIID = "00".$iCIID;
					break;
				case 4: 
					$iCIID = "0".$iCIID;
					break;
				default: 
					$iCIID = $iCIID;
			};
		}
	 	else{
			$iCIID = "00001";
		};
		return $pDesc."-".$iCIID;
	};
};

//==>> FUNGSI MEMBUAT IID SEMUA TABLE DENGAN TAHUN 
function fCreateTahunIID($pDesc, $pTableName){
	if (empty($pTableName)){
		return "";
	}
	else{

		$Tgl = getdate();
		$Bln = $Tgl['mon'];
		$Thn = $Tgl['year'];	
		
		if ($Bln<10){
			$Bln = "0";
			$Bln .= $Tgl['mon'];
		};
		
		$Thn = substr($Thn,2,2);
		
		$SQLStr = "SELECT IID FROM $pTableName  Where left(IID, 2) ='$Thn' order by IID Desc" ;
    	$rsCreateIID = mysql_query($SQLStr);
    	
		if ($rwCreateIID = mysql_fetch_array($rsCreateIID)){
			$iCIID = substr($rwCreateIID[0],4,4) + 1;
			
			switch(strlen(trim($iCIID))){
				case 1:
					$iCIID = "000".$iCIID;
					break;
				case 2: 
					$iCIID = "00".$iCIID;
					break;
				case 3: 
					$iCIID = "0".$iCIID;
					break;
				default: 
					$iCIID = $iCIID;
			};
		}
	 	else {
			$iCIID = "0001";
		};
		
		return $Thn.$pDesc."-".$iCIID;
	};
};

//==>> FUNGSI MEMBUAT NOMOR SEMUA TABLE DENGAN TAHUN 
function fCreateNomorTahun($pThn, $pTableName){
	if(empty($pTableName)){
		return "";
	}
	else{
		if(empty($pThn)){
			$Tgl = getdate();
			$pThn = $Tgl['year'];	
		}
			
		$SQLStr = "SELECT Nomor FROM $pTableName WHERE cStatus='AKTIF' AND YEAR(Tanggal)=$pThn ORDER BY Nomor DESC LIMIT 0,1" ;
    	$rsCreateIID = mysql_query($SQLStr);
		if ($rwCreateIID = mysql_fetch_array($rsCreateIID)){
			$iNomor = $rwCreateIID['Nomor']+1;
		}
		else {
			$iNomor	= 1;
		}	
		switch(strlen(trim($iNomor)))
		{
			case 1:
				$cNomor = "00".$iNomor;
				break;
			case 2: 
				$cNomor = "0".$iNomor;
				break;
			default: 
				$cNomor = $iNomor;
		};
		
		return $cNomor;
	};
};

//==>> FUNGSI AMBIL LAMBANG ROMAWI BULAN
function fRomawiBulan($pBln){
	$arBulan 	= array("I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");

	if(empty($pBln)){
		$Tgl = getdate();
		$pBln = $Tgl['month'];	
	}
	
	return $arBulan[$pBln-1];
	
};


//==>> FUNGSI TANGGAL DD/MM/YYYY KE DD MMMM YYYY
function TglddMMMyyyy($pTglIn){
	$arBulan 	= array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

	if (strpos($pTglIn,"-")>0){
		$cSparator	= "-";
	};
	if (strpos($pTglIn,"/")>0){
		$cSparator	= "/";
	};
	
	if(!empty($pTglIn)){
		$arTglIn	= explode($cSparator, $pTglIn);
		
		$dtTgl		= $arTglIn[0];
		$dtBln		= $arTglIn[1];
		$dtThn 		= $arTglIn[2];
		
		$dtBln = $arBulan[$dtBln-1];
		if (strlen(trim($dtTgl))<2){
			$dtTgl	= "0".$dtTgl;
		};
	}
	else {
		$dtTgl	= "";
		$dtBln	= "";
		$dtThn	= "";
	}
	return $dtTgl." ".$dtBln." ".$dtThn;
	
};

//==>> FUNGSI TANGGAL DD/MM/YYYY KE DD MMMM YYYY
function DateddMMMyyyy($pTglIn){
	$arBulan 	= array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

	if (strpos($pTglIn,"-")>0){
		$cSparator	= "-";
	};
	if (strpos($pTglIn,"/")>0){
		$cSparator	= "/";
	};
	
	if(!empty($pTglIn)){
		$arTglIn	= explode($cSparator, $pTglIn);
		
		$dtTgl		= $arTglIn[0];
		$dtBln		= $arTglIn[1];
		$dtThn 		= $arTglIn[2];
		
		$dtBln = $arBulan[$dtBln-1];
		if (strlen(trim($dtTgl))<2){
			$dtTgl	= "0".$dtTgl;
		};
	}
	else {
		$dtTgl	= "";
		$dtBln	= "";
		$dtThn	= "";
	}
	return $dtTgl." ".$dtBln." ".$dtThn;
	
};

//==>> FUNGSI TANGGAL DD/MM/YYYY KE BLN. TGL, YYYY
function DateMMddyyyy($pTglIn){
	$arBulan 	= array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

	if (strpos($pTglIn,"-")>0){
		$cSparator	= "-";
	};
	if (strpos($pTglIn,"/")>0){
		$cSparator	= "/";
	};
	
	if(!empty($pTglIn)){
		$arTglIn	= explode($cSparator, $pTglIn);
		
		$dtTgl		= $arTglIn[0];
		$dtBln		= $arTglIn[1];
		$dtThn 		= $arTglIn[2];
		
		$dtBln = $arBulan[$dtBln-1];
		if (strlen(trim($dtTgl))<2){
			$dtTgl	= "0".$dtTgl;
		};
	}
	else {
		$dtTgl	= "";
		$dtBln	= "";
		$dtThn	= "";
	}
	return $dtBln." ".$dtTgl.", ".$dtThn;
	
};

function TanggalMMddyyyy($pTglIn){
	$arBulan 	= array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

	if (strpos($pTglIn,"-")>0){
		$cSparator	= "-";
	};
	if (strpos($pTglIn,"/")>0){
		$cSparator	= "/";
	};
	
	if(!empty($pTglIn)){
		$arTglIn	= explode($cSparator, $pTglIn);
		
		$dtTgl		= $arTglIn[0];
		$dtBln		= $arTglIn[1];
		$dtThn 		= $arTglIn[2];
		
		$dtBln = $arBulan[$dtBln-1];
		if (strlen(trim($dtTgl))<2){
			$dtTgl	= "0".$dtTgl;
		};
	}
	else {
		$dtTgl	= "";
		$dtBln	= "";
		$dtThn	= "";
	}
	return $dtTgl." ".$dtBln." ".$dtThn;
	
};

//==>> FUNGSI FORMAT TANGGAL DARI MySQL Ke Format DD-MM-YYYY
function TglddMMyyyyfromMySQL($pTglIn){
	if(!empty($pTglIn)){
		if (ereg("-", $pTglIn))
		{
			$cSparator	= "-";
		};
		if (ereg("/", $pTglIn))
		{
			$cSparator	= "/";
		};
		
		$arTgl	= split(" ", $pTglIn);

		$arTglIn	= split($cSparator, $arTgl[0]);
		
		$dtThn		= $arTglIn[0];
		$dtBln		= $arTglIn[1];
		$dtTgl 		= $arTglIn[2];
		
		return $dtTgl."-".$dtBln."-".$dtThn;
	}
	else {
		return "-";
	}	
	
};

//==>> FUNGSI MERUBAH FORMAT TANGGAL DARI MySQL Ke Format DD-MM-YYYY
function TglddMMyyyyfromMySQLSlash($pTglIn)
{
	if(empty($pTglIn)||$pTglIn=="0000-00-00"){
		return "";
	}
	else {
		if (ereg(" ", $pTglIn)){
			$vTglIn	= split(" ",$pTglIn);
			$pTglIn = $vTglIn[0];
		}
		
		if (ereg("-", $pTglIn))
		{
			$cSparator	= "-";
		};
		if (ereg("/", $pTglIn))
		{
			$cSparator	= "/";
		};
		
		$arTglIn	= split($cSparator, $pTglIn);
		
		$dtThn		= $arTglIn[0];
		$dtBln		= $arTglIn[1];
		$dtTgl 		= $arTglIn[2];
		
		return $dtTgl."/".$dtBln."/".$dtThn;
	}	
};


// FUNGSI TANGGAL MM/DD/YYYY KE DD MMMM YYYY
function fDateToChar($pTglIn)
{
	$arBulan 	= array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

	$vData	= split(" ", $pTglIn);

	$pTglIn	= $vData['0'];
	
	if (ereg("-", $pTglIn))
	{
		$cSparator	= "-";
	};
	if (ereg("/", $pTglIn))
	{
		$cSparator	= "/";
	};
	
	$arTglIn	= split($cSparator, $pTglIn);
	
	$dtTgl		= $arTglIn[2];
	$dtBln		= $arTglIn[1];
	$dtThn 		= $arTglIn[0];
	
	$dtBln = $arBulan[$dtBln-1];
	if (strlen(trim($dtTgl))<2)
	{
		$dtTgl	= "0".$dtTgl;
		//$dtTgl	.= is_numeric($dtTgl);
	};
	return $dtTgl." ".$dtBln." ".$dtThn;
};

function fMaxHariBulan($pBln,$pThn){
	$arBulan1 	= array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	$arBulan2 	= array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	
	if($pThn%4==0){
		$dtBln = $arBulan1[$pBln-1];
	}
	else {
		$dtBln = $arBulan2[$pBln-1];
	}
	return $dtBln;
};

function fMaxHariTahun($pThn){
	$arTahun	= array(365,366);
	
	if($pThn%4==0){
		$dtThn = $arTahun[1];
	}
	else {
		$dtThn = $arTahun[0];
	}
	return $dtThn;
};

function fAmbilKomponenTanggal($pTgl,$pPar){
	
	if (strpos($pTgl,"-")>0){
		$cSparator	= "-";
	};
	if (strpos($pTgl,"/")>0){
		$cSparator	= "/";
	};
	
	if(!empty($pTgl)){
		$arTgl	= explode($cSparator, $pTgl);
		switch($pPar){
			case 'd':
			case 'D':
				$cResult = $arTgl['0'];
			break;
			case 'm':
			case 'M':
				$cResult = $arTgl['1'];
			break;
			case 'y':
			case 'Y':
				$cResult = $arTgl['2'];
			break;
		}
	}
	else {
		$cResult = '00';
	}
	
	return $cResult;
};

function fJumlahTanggal($pTgl,$pTp,$pJmlh,$pPar){
	$arBulan1 	= array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	$arBulan2 	= array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	
	if (strpos($pTgl,"-")>0){
		$cSparator	= "-";
	};
	if (strpos($pTgl,"/")>0){
		$cSparator	= "/";
	};
	
	if(!empty($pTgl)){
		$arTgl	= explode($cSparator, $pTgl);
		
		$dtTgl		= $arTgl[0];
		$dtBln		= $arTgl[1];
		$dtThn 		= $arTgl[2];

		switch($pTp){
			case 'd':
			case 'D':
				$iTgl = $dtTgl+$pJmlh;
				$iBln = $dtBln;
				$iThn = $dtThn;
				
				if($iThn%4==0){
					$iMBln = $arBulan1[$iBln-1];
				}
				else {
					$iMBln = $arBulan2[$iBln-1];
				}
				
				while ($iTgl>$iMBln){
					$iTgl=$iTgl-$iMBln; 
					$iBln++;
					if($iBln>12){
						$iThn++;
						$iBln=$iBln-12;
					}
					elseif($iBln<1) {
						$iThn--;
						$iBln=$iBln+12;
					}

					if($iThn%4==0){
						$iMBln = $arBulan1[$iBln-1];
					}
					else {
						$iMBln = $arBulan2[$iBln-1];
					}
					
				}
			break;
			case 'm':
			case 'M':
				$iTgl = $dtTgl;
				$iBln = $dtBln+$pJmlh;
				$iThn = $dtThn;

				if($iBln>12){
					$iThn++;
					$iBln=$iBln-12;
				}
				elseif($iBln<1) {
					$iThn--;
					$iBln=$iBln+12;
				}
				
				if($iThn%4==0){
					$iMBln = $arBulan1[$iBln-1];
				}
				else {
					$iMBln = $arBulan2[$iBln-1];
				}
				
				if($pPar==0){
					if($iTgl>$iMBln){
						$iTgl=$iMBln; 
					}
				}
				else{
					$iTgl=$iMBln; 
				}
			break;
			case 'y':
			case 'Y':
				$iTgl = $dtTgl;
				$iBln = $dtBln;
				$iThn = $dtThn+$pJmlh;

				if($iThn%4==0){
					$iMBln = $arBulan1[$iBln-1];
				}
				else {
					$iMBln = $arBulan2[$iBln-1];
				}
				
				if($iTgl>$iMBln){
					$iTgl=$iMBln; 
				}
			break;
		}

	}
	else {
		$iTgl		= '00';
		$iBln		= '00';
		$iThn 		= '0000';
	}	
	return str_pad($iTgl,2,"0",STR_PAD_LEFT).'/'.str_pad($iBln,2,"0",STR_PAD_LEFT).'/'.$iThn;
};

function fNamaHari($pTglIn){
	$arHari 	= array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");

	$arTglIn	= explode(" ",$pTglIn);
	$pTglIn		= $arTglIn[0];

	if (ereg("-", $pTglIn)){
		$cSparator	= "-";
	};

	if (ereg("/", $pTglIn)){
		$cSparator	= "/";
	};

	$arTglIn	= explode($cSparator, $pTglIn);
	$iHari 		= date("w", strtotime($arTglIn[2]."-".$arTglIn[1]."-".$arTglIn[0]));
	
	$cHari = $arHari[$iHari];
	return $cHari;
};

function fNamaBulan($pTglIn){
	$arBulan 	= array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

	$dtBln = $arBulan[$pTglIn-1];
	return $dtBln;
};

function fNamaBulanEng($pTglIn){
	$arBulan 	= array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

	$dtBln = $arBulan[$pTglIn-1];
	return $dtBln;
};

function fNamaBulanAjaran($pTglIn){
	$arBulan 	= array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des");
	if($pTglIn>12){
		$pTglIn=$pTglIn-12;
	}
	$dtBln = $arBulan[$pTglIn-1];
	return $dtBln;
};

function fNamaBulanAjaranPanjang($pTglIn)
{
	$arBulan 	= array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	if($pTglIn>12){
		$pTglIn=$pTglIn-12;
	}
	$dtBln = $arBulan[$pTglIn-1];
	return $dtBln;
};

function Tglddmmyyyy($pTglIn){
	$arBulan 	= array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	$arTglIn	= split(" ",$pTglIn);
	$pTglIn		= $arTglIn[0];

	if (ereg("-", $pTglIn))
	{
		$cSparator	= "-";
	};

	if (ereg("/", $pTglIn))
	{
		$cSparator	= "/";
	};

	$arTglIn	= split($cSparator, $pTglIn);

	$dtTgl		= $arTglIn[0];
	$dtBln		= $arTglIn[1];
	$dtThn 		= $arTglIn[2];

	$dtBln = $arBulan[$dtBln-1];
	if (strlen(trim($dtTgl))<2)
	{
		$dtTgl	= "0".$dtTgl;
	};
	return $dtTgl." ".$dtBln." ".$dtThn;
};


// FUNGSI TANGGAL SEKARANG KE FORMAT TANGGAL MY SQL
function TglFormatMySql()
{
	$GMT 	= (7 * 3600);  	
	$cTgl	= Date("d", time());
	$cBln	= Date("m", time());
	$cThn	= Date("Y", time());
	$cJam	= Date("H", time());
	$cMnt	= Date("i", time());
	$cDtk	= Date("s", time());
	
	return $cThn."-".$cBln."-".$cTgl." ".$cJam.":".$cMnt.":".$cDtk;
};

function TglDiKurang($pTglIn,$pJumlah){
	if (strpos($pTglIn,"-")>0){
		$cSparator	= "-";
	};
	if (strpos($pTglIn,"/")>0){
		$cSparator	= "/";
	};

	if(!empty($pTglIn)){
		$arTglIn	= explode($cSparator, $pTglIn);
		$dtTgl		= $arTglIn[0];
		$dtBln		= $arTglIn[1];
		$dtThn 		= $arTglIn[2];
	}
	else {
		$dtTgl		= '00';
		$dtBln		= '00';
		$dtThn 		= '0000';
	};	
	
	$FirstDate = strtotime('-'.$pJumlah.' day',strtotime($dtThn."-".$dtBln."-".$dtTgl));
	return date ('Y-m-j', $FirstDate );
}

//==>> FUNGSI TANGGAL DD/MM/YYYY KE FORMAT TANGGAL MY SQL
function TglddmmyyyytoMySql($pTglIn){
	if (strpos($pTglIn,"-")>0){
		$cSparator	= "-";
	};
	if (strpos($pTglIn,"/")>0){
		$cSparator	= "/";
	};
	
	if(!empty($pTglIn)&&!empty($cSparator)){
		$arTglIn	= explode($cSparator, $pTglIn);
		
		$dtTgl		= $arTglIn[0];
		$dtBln		= $arTglIn[1];
		$dtThn 		= $arTglIn[2];
	}
	else {
		$dtTgl		= '00';
		$dtBln		= '00';
		$dtThn 		= '0000';
	}	
	return trim($dtThn)."-".trim($dtBln)."-".trim($dtTgl);
};

function TglddmmyyyytoSqlSrv($pTglIn){
	if (strpos($pTglIn,"-")>0){
		$cSparator	= "-";
	};
	if (strpos($pTglIn,"/")>0){
		$cSparator	= "/";
	};
	
	if(!empty($pTglIn)){
		$arTglIn	= explode($cSparator, $pTglIn);
		
		$dtTgl		= $arTglIn[0];
		$dtBln		= $arTglIn[1];
		$dtThn 		= $arTglIn[2];
	}
	else {
		$dtTgl		= '00';
		$dtBln		= '00';
		$dtThn 		= '0000';
	}	
	return trim($dtBln)."/".trim($dtTgl)."/".trim($dtThn);
};

function fKodeAktivasi()
{
	$c1 = rand(63,90);
	$c2 = rand(63,90);
	$c3 = rand(63,90);
	$c4 = rand(63,90);
	$c5 = rand(63,90);
	$c6 = rand(63,90);
	$c7 = rand(63,90);
	$c8 = rand(63,90);
	$c9 = rand(63,90);
	

	return chr($c1).chr($c2).chr($c3).chr($c4).chr($c5).chr($c6).chr($c7).chr($c8).chr($c9);
	
};

function fFormatUang($pParam1){
	$cCharOfNum=strlen($pParam1);
	if($cCharOfNum>12){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-12,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-12).".".$result;
	}
	elseif($cCharOfNum>9){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-9).".".$result;
	}
	elseif($cCharOfNum>6){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-6).".".$result;
	}
	elseif($cCharOfNum>3){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,0,$cCharOfNum-3).".".$result;
	}
	elseif($cCharOfNum<=3){
		$result=$pParam1;
	}
	if(empty($result)){
		$result="0";
	}
	return $result.",-";
};

function fFormatUangInd($pParam1){
	$pParam1 = number_format((float)$pParam1, 2, '.', '');
	$vParam=explode(".",$pParam1);
	if(empty($vParam[1])){
		$iDesimal="";
	}
	else{
		$iDesimal=$vParam[1];
	}
	$pParam1 = $vParam[0];
	$cCharOfNum=strlen($pParam1);
	if($cCharOfNum>12)
	{
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-12,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-12).".".$result;
	}elseif($cCharOfNum>9)
	{
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-9).".".$result;
	}elseif($cCharOfNum>6)
	{
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-6).".".$result;
	}elseif($cCharOfNum>3)
	{
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,0,$cCharOfNum-3).".".$result;
	}elseif($cCharOfNum<=3)
	{
		$result=$pParam1;
	}
	if(empty($result)){
		$result="0";
	}
	if(empty($iDesimal)){
		return $result;
	}
	else{
		return $result.",".$iDesimal;
	}
};


function fFormatUangIndNoDesimal($pParam1){
	$pParam1 = number_format((float)$pParam1, 2, '.', '');
	$vParam=explode(".",$pParam1);
	if(empty($vParam[1])){
		$iDesimal="";
	}
	else{
		$iDesimal=$vParam[1];
	}
	$pParam1 = $vParam[0];
	$cCharOfNum=strlen($pParam1);
	if($cCharOfNum>12)
	{
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-12,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-12).".".$result;
	}elseif($cCharOfNum>9)
	{
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-9).".".$result;
	}elseif($cCharOfNum>6)
	{
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-6).".".$result;
	}elseif($cCharOfNum>3)
	{
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,0,$cCharOfNum-3).".".$result;
	}elseif($cCharOfNum<=3)
	{
		$result=$pParam1;
	}
	if(empty($result)){
		$result="0";
	}
	if(empty($iDesimal)){
		return $result;
	}
	else{
		return $result;
	}
};

function fFormatUangIndDesimal($pParam1){
/*
	$vParam=explode(",",$pParam1);
	return $pParam1;
//	return $pParam1."=".$vParam[0]."||".$vParam[1];
*/
	
	$bNegatif = false;
	if($pParam1<0){
		$pParam1=$pParam1*(-1);
		$bNegatif = true;
	}
	
	$pParam1 = number_format((float)$pParam1, 2, '.', '');
	$vParam=explode(".",$pParam1);
	if(empty($vParam[1])){
		$iDesimal="00";
	}
	else{
		$iDesimal=$vParam[1];
	}
	$pParam1 = $vParam[0];
	$cCharOfNum=strlen($pParam1);
	if($cCharOfNum>12){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-12,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-12).".".$result;
	}
	elseif($cCharOfNum>9){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-9).".".$result;
	}
	elseif($cCharOfNum>6){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-6).".".$result;
	}
	elseif($cCharOfNum>3){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,0,$cCharOfNum-3).".".$result;
	}
	elseif($cCharOfNum<=3){
		$result=$pParam1;
	}
	if(empty($result)){
		$result="0";
	}
	
	if($bNegatif){
		return "-".$result.",".$iDesimal;
	}
	else {
		return $result.",".$iDesimal;
	}
};

function fFormatUangUSDDesimal($pParam1){
/*
	$vParam=explode(",",$pParam1);
	return $pParam1;
//	return $pParam1."=".$vParam[0]."||".$vParam[1];
*/
	$pParam1 = number_format((float)$pParam1, 4, '.', '');
	$vParam=explode(".",$pParam1);
	if(empty($vParam[1])){
		$iDesimal="0000";
	}
	else{
		$iDesimal=$vParam[1];
	}
	
	$pParam1 = $vParam[0];
	$cCharOfNum=strlen($pParam1);
	if($cCharOfNum>12){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-12,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-12).".".$result;
	}
	elseif($cCharOfNum>9){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-9).".".$result;
	}
	elseif($cCharOfNum>6){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-6).".".$result;
	}
	elseif($cCharOfNum>3){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,0,$cCharOfNum-3).".".$result;
	}
	elseif($cCharOfNum<=3){
		$result=$pParam1;
	}
	if(empty($result)){
		$result="0";
	}
	return $result.",".$iDesimal;

};


function fFormatUangIndDesimalP($pParam1,$iDes){

	$pParam1 = number_format((float)$pParam1, $iDes, '.', '');
	$vParam=explode(".",$pParam1);
	if(empty($vParam[1])){
		$iDesimal="0";
	}
	else{
		$iDesimal=$vParam[1];
	}
	$pParam1 = $vParam[0];
	$cCharOfNum=strlen($pParam1);
	if($cCharOfNum>12){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-12,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-12).".".$result;
	}
	elseif($cCharOfNum>9){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-9).".".$result;
	}
	elseif($cCharOfNum>6){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-6).".".$result;
	}
	elseif($cCharOfNum>3){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,0,$cCharOfNum-3).".".$result;
	}
	elseif($cCharOfNum<=3){
		$result=$pParam1;
	}
	if(empty($result)){
		$result="0";
	}
	return $result.",".$iDesimal;

};

function fFormatUangKomaToTitik($pParam1){
	$cParam1=str_replace(".","",$pParam1);
	$cParam1=str_replace(",",".",$cParam1);
	return $cParam1;
};


function fFormatUangDariDesimal($pParam1){
	$pParam1	= round(trim($pParam1));
	$cCharOfNum=strlen($pParam1);
	if($cCharOfNum>12)
	{
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-12,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-12).".".$result;
	}elseif($cCharOfNum>9)
	{
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-9).".".$result;
	}elseif($cCharOfNum>6)
	{
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-6).".".$result;
	}elseif($cCharOfNum>3)
	{
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,0,$cCharOfNum-3).".".$result;
	}
	if(empty($result)){
		$result="0";
	}
	return $result.",-";
};

function fFormatDesimal($pParam1){
	$pParam1	= round($pParam1);
	$cCharOfNum=strlen($pParam1);
	if($cCharOfNum>12){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-12,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-12).".".$result;
	}
	elseif($cCharOfNum>9){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,$cCharOfNum-9,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-9).".".$result;
	}
	elseif($cCharOfNum>6){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,$cCharOfNum-6,3).".".$result;
		$result=substr($pParam1,0,$cCharOfNum-6).".".$result;
	}
	elseif($cCharOfNum>3){
		$result=substr($pParam1,$cCharOfNum-3,3);
		$result=substr($pParam1,0,$cCharOfNum-3).".".$result;
	}
	else{
		$result=$pParam1;
	}
	
	if(empty($result)){
		$result="0";
	}
	return $result;
};

function inputAktifitas($cAktifitasIID,$cAMemberIID,$cAKeterangan,$cADataLama,$cADataBaru) {
	$cSQLStrA	= "INSERT INTO tbaktifitas(IID,MemberIID,Keterangan,DataLama,DataBaru,DataDate)
					VALUES ('$cAktifitasIID','$cAMemberIID','$cAKeterangan','$cADataLama','$cADataBaru',Now())";
					
	$rsDataA	= mysql_query($cSQLStrA);				
}

function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 
function fFormatUangIndotoSql($nilai) {
// 	$nilai = 175000;
//	setlocale(LC_MONETARY, 'id_ID');
//	$nilaiindo = money_format('%i', $nilai); // nah ni sebenernya ngambil dari format US (yang lebih deket ke dalam format indonesia aja

	for($i=0;$i<strlen($nilai);$i++){
		if(substr($nilai,$i,1) == ','){
//			$nilaiindo[$i] = '.';
			$hasil.= ".";
		}
		elseif(substr($nilai,$i,1)=='.'){
//			$nilaiindo[$i] = '';
			$hasil.= '';
		}
		else{
//			isNumeric..
			$hasil.= substr($nilai,$i,1);
		}
	}

//	$hasil = substr_replace($nilaiindo,'Rp.',0,3);
//	echo '<br/>'.$hasil;
	return $hasil;
}
//*/

function fCetakSPP($pPrinter,$pKasir,$pJudul,$pNama,$pSekolah,$pJurusan,$pAngkatan,$pKompetensi,$pProgram,$pBulanBayar,$pNilai,$pTglBayar){
	$tanggal 	= date("d-m-Y",strtotime($pTglBayar));
	$jam 		= date("H:i:s",strtotime($pTglBayar));
	
	$tmpdir = sys_get_temp_dir(); # ambil direktori temporary untuk simpan file. 
	$file = tempnam($tmpdir, 'ctk'); # nama file temporary yang akan dicetak 
	$handle = fopen($file, 'w'); 
	
	$condensed = Chr(27) . Chr(33) . Chr(4); 
	$bold1 = Chr(27) . Chr(69); 
	$bold0 = Chr(27) . Chr(70); 
	$initialized = chr(27).chr(64); 
	$condensed1 = chr(15); 
	$condensed0 = chr(18); 
	
//	$Data = $initialized; 
//	$Data .= $condensed1; 
	$Data = $pJudul."\n"; 
	$Data .= $tanggal." ".$jam."\n"; 
	$Data .= "==========================\n"; 
	$Data .= "Nama : $pNama\n"; 
	$Data .= "Sekolah : $pSekolah / $pAngkatan\n"; 
	$Data .= "Jurusan : $pJurusan\n\n"; 
	$Data .= "Bulan : $pBulanBayar\n"; 
	$Data .= "Jumlah : Rp. $pNilai\n"; 
	$Data .= "==========================\n\n"; 
	$Data .= "Kasir : $pKasir\n\n\n"; 

	fwrite($handle, $Data); 
	fclose($handle); 
//	copy($file, "//192.168.1.1/EPSONLX"); # Lakukan cetak 
	copy($file, $pPrinter); # Lakukan cetak 
	unlink($file); 
}


function satuan($inp){
	if ($inp == 1){
		return "satu ";
	}
	else if ($inp == 2){
		return "dua ";
	}
	else if ($inp == 3){
		return "tiga ";
	}
	else if ($inp == 4){
		return "empat ";
	}
	else if ($inp == 5){
		return "lima ";
	}
	else if ($inp == 6){
		return "enam ";
	}
	else if ($inp == 7){
		return "tujuh ";
	}
	else if ($inp == 8){
		return "delapan ";
	}
	else if ($inp == 9){
		return "sembilan ";
	}
	else{
		return "";
	}
}


function belasan($inp){
	$proses = $inp; //substr($inp, -1);
	if ($proses == '11'){
		return "sebelas ";
	}
	else{
		$proses = substr($proses,1,1);
		return satuan($proses)."belas ";
	}
}



function puluhan($inp){
	$proses = $inp; //substr($inp, 0, -1);
	if ($proses == 1){
		return "sepuluh ";
	}
	else if ($proses == 0){
		return '';
	}
	else{
		return satuan($proses)."puluh ";
	}
}


function ratusan($inp){
	$proses = $inp; //substr($inp, 0, -2);
	if ($proses == 1){
		return "seratus ";
	}
	else if ($proses == 0){
		return '';
	}
	else{
		return satuan($proses)."ratus ";
	}
}


function ribuan($inp){
	$proses = $inp; //substr($inp, 0, -3);
	if ($proses == 1){
		return "seribu ";
	}
	else if ($proses == 0){
		return '';
	}
	else{
		return satuan($proses)."ribu ";
	}
}


function jutaan($inp){
	$proses = $inp; //substr($inp, 0, -6);
	if ($proses == 0){
		return '';
	}
	else{
		return satuan($proses)."juta ";
	}
}


function milyaran($inp){
	$proses = $inp; //substr($inp, 0, -9);
	if ($proses == 0){
		return '';
	}
	else{
		return satuan($proses)."milyar ";
	}
}


function terbilang1($rp){
	$kata = "";
	$rp = trim($rp);
	if (strlen($rp) >= 10){
		$angka = substr($rp, strlen($rp)-10, -9);
		$kata = $kata.milyaran($angka);
	}
	$tambahan = "";
	if (strlen($rp) >= 9){
		$angka = substr($rp, strlen($rp)-9, -8);
		$kata = $kata.ratusan($angka);
		if ($angka > 0) { $tambahan = "juta "; }
	}
	if (strlen($rp) >= 8){
		$angka = substr($rp, strlen($rp)-8, -7);
		$angka1 = substr($rp, strlen($rp)-7, -6);
		if (($angka == 1) && ($angka1 > 0)){
			$angka = substr($rp, strlen($rp)-8, -6);
			//echo " belasan".($angka)." ";
			$kata = $kata.belasan($angka)."juta ";
		}
		else{
			$angka = substr($rp, strlen($rp)-8, -7);
			//echo " puluhan".($angka)." ";
			$kata = $kata.puluhan($angka);
			if ($angka > 0) { $tambahan = "juta "; }
			
			$angka = substr($rp, strlen($rp)-7, -6);
			//echo " ribuan".($angka)." ";
			$kata = $kata.ribuan($angka);
			if ($angka == 0) { $kata = $kata.$tambahan; }
		}
	}
	
	if (strlen($rp) == 7){
		$angka = substr($rp, strlen($rp)-7, -6);
		$kata = $kata.jutaan($angka);
		if ($angka == 0) { $kata = $kata.$tambahan; }
	}
	$tambahan = "";
	if (strlen($rp) >= 6){
		$angka = substr($rp, strlen($rp)-6, -5);
		$kata = $kata.ratusan($angka);
		if ($angka > 0) { $tambahan = "ribu "; }
	}
	if (strlen($rp) >= 5){
		$angka = substr($rp, strlen($rp)-5, -4);
		$angka1 = substr($rp, strlen($rp)-4, -3);
		if (($angka == 1) && ($angka1 > 0)){
			$angka = substr($rp, strlen($rp)-5, -3);
			//echo " belasan".($angka)." ";
			$kata = $kata.belasan($angka)."ribu ";
		}
		else{
			$angka = substr($rp, strlen($rp)-5, -4);
			//echo " puluhan".($angka)." ";
			$kata = $kata.puluhan($angka);
			if ($angka > 0) { $tambahan = "ribu "; }
			
			$angka = substr($rp, strlen($rp)-4, -3);
			//echo " ribuan".($angka)." ";
			$kata = $kata.ribuan($angka);
			if ($angka == 0) { $kata = $kata.$tambahan; }
		}
	}
	if (strlen($rp) == 4){
		$angka = substr($rp, strlen($rp)-4, -3);
		//echo " ribuan".($angka)." ";
		$kata = $kata.ribuan($angka);
		if ($angka == 0) { $kata = $kata.$tambahan; }
	}
	if (strlen($rp) >= 3){
		$angka = substr($rp, strlen($rp)-3, -2);
		//echo " ratusan".($angka)." ";
		$kata = $kata.ratusan($angka);
	}
	if (strlen($rp) >= 2){
		$angka = substr($rp, strlen($rp)-2, -1);
		$angka1 = substr($rp, strlen($rp)-1);
		if (($angka == 1) && ($angka1 > 0)){
			$angka = substr($rp, strlen($rp)-2);
			//echo " belasan".($angka)." ";
			$kata = $kata.belasan($angka);
		}
		else{
			//echo " puluhan".($angka)." ";
			$kata = $kata.puluhan($angka);
			
			$angka = substr($rp, strlen($rp)-1);
			//echo " satuan".($angka)." ";
			$kata = $kata.satuan($angka);
		}
	}
	if (strlen($rp) == 1){
		$angka = substr($rp, strlen($rp)-1);
		//echo " satuan".($angka)." ";
		$kata = $kata.satuan($angka);
	}
	return $kata;
}

function terbilang($angka) {
    $angka = (float)$angka;
    $bilangan = array(
            '',
            'satu',
            'dua',
            'tiga',
            'empat',
            'lima',
            'enam',
            'tujuh',
            'delapan',
            'sembilan',
            'sepuluh',
            'sebelas'
    );
 
    if ($angka < 12) {
        return $bilangan[$angka];
    } else if ($angka < 20) {
        return $bilangan[$angka - 10] . ' belas';
    } else if ($angka < 100) {
        $hasil_bagi = (int)($angka / 10);
        $hasil_mod = $angka % 10;
        return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
    } else if ($angka < 200) {
        return sprintf('seratus %s', terbilang($angka - 100));
    } else if ($angka < 1000) {
        $hasil_bagi = (int)($angka / 100);
        $hasil_mod = $angka % 100;
        return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], terbilang($hasil_mod)));
    } else if ($angka < 2000) {
        return trim(sprintf('seribu %s', terbilang($angka - 1000)));
    } else if ($angka < 1000000) {
        $hasil_bagi = (int)($angka / 1000); // karena hasilnya bisa ratusan jadi langsung digunakan rekursif
        $hasil_mod = $angka % 1000;
        return sprintf('%s ribu %s', terbilang($hasil_bagi), terbilang($hasil_mod));
    } else if ($angka < 1000000000) {
        // hasil bagi bisa satuan, belasan, ratusan jadi langsung kita gunakan rekursif
        $hasil_bagi = (int)($angka / 1000000);
        $hasil_mod = $angka % 1000000;
        return trim(sprintf('%s juta %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else if ($angka < 1000000000000) {
        // bilangan 'milyaran'
        $hasil_bagi = (int)($angka / 1000000000);
        $hasil_mod = fmod($angka, 1000000000);
        return trim(sprintf('%s milyar %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else if ($angka < 1000000000000000) {                          // bilangan 'triliun'                           
		$hasil_bagi = $angka / 1000000000000;                           
		$hasil_mod = fmod($angka, 1000000000000);                           
		return trim(sprintf('%s triliun %s', terbilang($hasil_bagi), terbilang($hasil_mod)));                       
	} else {                            
		return 'Terlalu besar';                        
	}                   
}

function fJmlBaris($cText,$iJml){
	$k = 1;
	if(strlen(trim($cText))>$iJml){
		$cTemp1 = $cText;
		$cTemp2 = "";
		for($i=$iJml;$i<=strlen(trim($cText));$i+=$iJml){
			if(strrpos(substr($cTemp1,0,$iJml),"<br>",0)>0){
				$k++;
				$j = strrpos(substr($cTemp1,0,$iJml),"<br>",0);
				$cTemp2 .= substr($cTemp1,0,$j)."<br>";
				$cTemp1 = substr($cTemp1,$j+4);
			}
			$k++;
			$j = strrpos(substr($cTemp1,0,$iJml),' ',0);
			$cTemp2 .= substr($cTemp1,0,$j).chr(13);
			$cTemp1 = substr($cTemp1,$j+1);
		}
	}
	return $k;
}

function fUsia($Tgl1,$Tgl2){
    $vTgl1=explode("/",$Tgl1);
    $vTgl2=explode("/",$Tgl2);
	
    $cek_jmlhr1=cal_days_in_month(CAL_GREGORIAN,$vTgl1[1],$vTgl1[2]);
    $cek_jmlhr2=cal_days_in_month(CAL_GREGORIAN,$vTgl2[1],$vTgl2[2]);
	
    $sshari=$cek_jmlhr1-$vTgl1[0];
    $ssbln=12-$vTgl1[1]-1;
	
    $hari=0;
    $bulan=0;
    $tahun=0;
	
    if($sshari+$vTgl2[0]>=$cek_jmlhr2){
        $bulan=1;
        $hari=$sshari+$vTgl2[0]-$cek_jmlhr2;
    }else{
        $hari=$sshari+$vTgl2[0];
    }
    if($ssbln+$vTgl2[1]+$bulan>=12){
        $bulan=($ssbln+$vTgl2[1]+$bulan)-12;
        $tahun=$vTgl2[2]-$vTgl1[2];
    }else{
        $bulan=($ssbln+$vTgl2[1]+$bulan);
        $tahun=($vTgl2[2]-$vTgl1[2])-1;
    }

      $selisih=$tahun." Tahun ".$bulan." Bulan ".$hari." Hari";
    return $selisih;
}

function fNamaCellExcel($p0){
	$iASCA = $p0;
	if($iASCA<=90){
		$cORD = chr($iASCA);
	}
	elseif($iASCA<=116){
		$cORD = 'A'.chr(($iASCA-90)+64);
	}
	elseif($iASCA<=142){
		$cORD = 'B'.chr(($iASCA-116)+64);
	}
	elseif($iASCA<=168){
		$cORD = 'C'.chr(($iASCA-142)+64);
	}
	elseif($iASCA<=194){
		$cORD = 'D'.chr(($iASCA-168)+64);
	}
	elseif($iASCA<=220){
		$cORD = 'E'.chr(($iASCA-194)+64);
	}
	return $cORD;
}

function fNominalSay($s){
	$th = array('','thousand','million','billion','trillion');
	$dg = array('zero','one','two','three','four','five','six','seven','eight','nine'); 
	$tn = array('ten','eleven','twelve','thirteen','fourteen','fifteen','sixteen','seventeen','eighteen','nineteen'); 
	$tw = array('twenty','thirty','forty','fifty','sixty','seventy','eighty','ninety'); 

	$s = str_replace('.',' ',$s); 
	if ($s != floatval($s)) return 'not a number'; 
	$x = strrpos($s,' ',0);
	if ($x==-1||$x==0) $x = strlen($s); 
	if ($x>15) return 'too big'; 
	$n 		= explode(' ',$s); 
	$str 	= ''; 
	$sk 	= 0; 
	$kw 	= '';
	for($i=0;$i<$x;$i++) {
		if (($x-$i)%3==2) {
			if (substr($s,$i,1)=='1') {
				$str .= $tn[substr($s,($i+1),1)].' '; 
				$i++; 
				$sk=1;
			} 
			else if (substr($s,$i,1)!=0) {
				$str .= $tw[substr($s,$i,1)-2].' ';
				$sk=1;
			}
		} 
		else if (substr($s,$i,1)!=0) {
			$str .= $dg[substr($s,$i,1)].' '; 
			if (($x-$i)%3==0) $str .= 'hundred ';
			$sk=1;
		} 
		if (($x-$i)%3==1) {
			if ($sk) $str .= $th[($x-$i-1)/3].' ';
			$sk=0;
		}
	} 
//return $n[0];
/*
	if ($x!=strlen(trim($s))) {
		$y = strlen(trim($s)); 
		$str .= 'point '; 
		for ($i=$x+1; $i<$y; $i++) $str .= $dg[$n[$i]].' ';
	} 
*/

	if(strlen(trim($n[1]))>0) {
		$y = strlen(trim($n[1])); 
		$str .= 'point '; 
		$nc=$n[1];
		for ($i=0; $i<$y; $i++) $str .= $dg[$nc[$i]].' ';
	} 

	return str_replace("+","",$str);
//	return $kw;
}
	
function fPensiun($Number){
	$Number=floor($Number/3);	
	for ($x=$Number; $x>=1; $x=floor($x/3)) {
		$iReturn += $x;
	}
	return $iReturn;
}
	
define('ENCRYPTION_KEY', 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282');
	
function mc_encrypt($encrypt, $key){
    $encrypt = serialize($encrypt);
    $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
    $key = pack('H*', $key);
    $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
    $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt.$mac, MCRYPT_MODE_CBC, $iv);
    $encoded = base64_encode($passcrypt).'|'.base64_encode($iv);
    return $encoded;
}

function mc_decrypt($decrypt, $key){
    $decrypt = explode('|', $decrypt.'|');
    $decoded = base64_decode($decrypt[0]);
    $iv = base64_decode($decrypt[1]);
    if(strlen($iv)!==mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)){ return false; }
    $key = pack('H*', $key);
    $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
    $mac = substr($decrypted, -64);
    $decrypted = substr($decrypted, 0, -64);
    $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
    if($calcmac!==$mac){ return false; }
    $decrypted = unserialize($decrypted);
    return $decrypted;
}

function JadwalERPtoSunfish($JKode,$GKode){
	switch($JKode){
		case "NS":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_0800_1700_NS";
				break;
				default:
					$cReturn = "KBI_0800_1700_LS";
				break;
			}
		break;
		case "NSO":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_OFF_1";
				break;
				default:
					$cReturn = "KBI_OFF_1_LS";
				break;
			}
		break;
		case "S1":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_0800_1700_S";
				break;
				default:
					$cReturn = "KBI_0800_1700_LS";
				break;
			}
		break;
		case "S1O":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_OFF_1";
				break;
				default:
					$cReturn = "KBI_OFF_1_LS";
				break;
			}
		break;
		case "S2":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_1630_0030_S";
				break;
				default:
					$cReturn = "KBI_1630_0030_LS";
				break;
			}
		break;
		case "S2O":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_OFF_2";
				break;
				default:
					$cReturn = "KBI_OFF_2_LS";
				break;
			}
		break;
		case "S3":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_0000_0800_S";
				break;
				default:
					$cReturn = "KBI_0000_0800_LS";
				break;
			}
		break;
		case "S3O":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_OFF_3";
				break;
				default:
					$cReturn = "KBI_OFF_3_LS";
				break;
			}
		break;
		case "S1B":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_0800_1600_MB";
				break;
				default:
					$cReturn = "KBI_0800_1600_MB";
				break;
			}
		break;
		case "S1BO":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_OFF_1_SECBURN";
				break;
				default:
					$cReturn = "KBI_OFF_1_SECBURN";
				break;
			}
		break;
		case "S2B":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_1600_0000_MB";
				break;
				default:
					$cReturn = "KBI_1600_0000_MB";
				break;
			}
		break;
		case "S2BO":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_OFF_2_SECBURN";
				break;
				default:
					$cReturn = "KBI_OFF_2_SECBURN";
				break;
			}
		break;
		case "S3B":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_0000_0800_MB";
				break;
				default:
					$cReturn = "KBI_0000_0800_MB";
				break;
			}
		break;
		case "S3BO":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_OFF_3_SECBURN";
				break;
				default:
					$cReturn = "KBI_OFF_3_SECBURN";
				break;
			}
		break;
		case "S1S":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_0600-1400-SEC";
				break;
				default:
					$cReturn = "KBI_0600-1400-SEC_LS";
				break;
			}
		break;
		case "S1SO":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_OFF_1_SECBURN";
				break;
				default:
					$cReturn = "KBI_OFF_1_SECBURN";
				break;
			}
		break;
		case "S2S":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_1400-2200-SEC";
				break;
				default:
					$cReturn = "KBI_1400-2200-SEC_LS";
				break;
			}
		break;
		case "S2SO":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_OFF_2_SECBURN";
				break;
				default:
					$cReturn = "KBI_OFF_2_SECBURN";
				break;
			}
		break;
		case "S3S":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_2200-0600-SEC";
				break;
				default:
					$cReturn = "KBI_2200-0600-SEC_LS";
				break;
			}
		break;
		case "S3SO":
			switch($GKode){
				case "A":
				case "B-1":
				case "B-2":
				case "B-3":
					$cReturn = "KBI_OFF_3_SECBURN";
				break;
				default:
					$cReturn = "KBI_OFF_3_SECBURN";
				break;
			}
		break;
	}

	return $cReturn;
}

function weekday_diff($from, $to, $normalise=true) {
	$_from = is_int($from) ? $from : strtotime($from);
	$_to   = is_int($to) ? $to : strtotime($to);
	// normalising means partial days are counted as a complete day.
	if ($normalise) {
		$_from = strtotime(date('Y-m-d', $_from));
		$_to = strtotime(date('Y-m-d', $_to));
	}
	$all_days = @range($_from, $_to, 60*60*24);
	if (empty($all_days)) return 0;
	$week_days = array_filter(
	  $all_days,
	  create_function('$t', '$d = date("w", strtotime("+{$t} seconds", 0)); return !in_array($d, array(0,6));')
	);
	return count($week_days);
}

function getColFromNumber($num) {
	$numeric = ($num - 1) % 26;
	$letter = chr(65 + $numeric);
	$num2 = intval(($num - 1) / 26);
	if ($num2 > 0) {
		return getColFromNumber($num2) . $letter;
	} else {
		return $letter;
	}
}

function penguranganWaktu($waktuAwal, $waktuAkhir) {
    $awal = new DateTime($waktuAwal);
    $akhir = new DateTime($waktuAkhir);

    $selisih = $akhir->getTimestamp() - $awal->getTimestamp();
    $totalMenit = $selisih / 60;

    return $totalMenit;
}

function em($word) {

    $word = str_replace("@","%40",$word);
    $word = str_replace("`","%60",$word);
    $word = str_replace("¢","%A2",$word);
    $word = str_replace("£","%A3",$word);
    $word = str_replace("¥","%A5",$word);
    $word = str_replace("|","%A6",$word);
    $word = str_replace("«","%AB",$word);
    $word = str_replace("¬","%AC",$word);
    $word = str_replace("¯","%AD",$word);
    $word = str_replace("º","%B0",$word);
    $word = str_replace("±","%B1",$word);
    $word = str_replace("ª","%B2",$word);
    $word = str_replace("µ","%B5",$word);
    $word = str_replace("»","%BB",$word);
    $word = str_replace("¼","%BC",$word);
    $word = str_replace("½","%BD",$word);
    $word = str_replace("¿","%BF",$word);
    $word = str_replace("À","%C0",$word);
    $word = str_replace("Á","%C1",$word);
    $word = str_replace("Â","%C2",$word);
    $word = str_replace("Ã","%C3",$word);
    $word = str_replace("Ä","%C4",$word);
    $word = str_replace("Å","%C5",$word);
    $word = str_replace("Æ","%C6",$word);
    $word = str_replace("Ç","%C7",$word);
    $word = str_replace("È","%C8",$word);
    $word = str_replace("É","%C9",$word);
    $word = str_replace("Ê","%CA",$word);
    $word = str_replace("Ë","%CB",$word);
    $word = str_replace("Ì","%CC",$word);
    $word = str_replace("Í","%CD",$word);
    $word = str_replace("Î","%CE",$word);
    $word = str_replace("Ï","%CF",$word);
    $word = str_replace("Ð","%D0",$word);
    $word = str_replace("Ñ","%D1",$word);
    $word = str_replace("Ò","%D2",$word);
    $word = str_replace("Ó","%D3",$word);
    $word = str_replace("Ô","%D4",$word);
    $word = str_replace("Õ","%D5",$word);
    $word = str_replace("Ö","%D6",$word);
    $word = str_replace("Ø","%D8",$word);
    $word = str_replace("Ù","%D9",$word);
    $word = str_replace("Ú","%DA",$word);
    $word = str_replace("Û","%DB",$word);
    $word = str_replace("Ü","%DC",$word);
    $word = str_replace("Ý","%DD",$word);
    $word = str_replace("Þ","%DE",$word);
    $word = str_replace("ß","%DF",$word);
    $word = str_replace("à","%E0",$word);
    $word = str_replace("á","%E1",$word);
    $word = str_replace("â","%E2",$word);
    $word = str_replace("ã","%E3",$word);
    $word = str_replace("ä","%E4",$word);
    $word = str_replace("å","%E5",$word);
    $word = str_replace("æ","%E6",$word);
    $word = str_replace("ç","%E7",$word);
    $word = str_replace("è","%E8",$word);
    $word = str_replace("é","%E9",$word);
    $word = str_replace("ê","%EA",$word);
    $word = str_replace("ë","%EB",$word);
    $word = str_replace("ì","%EC",$word);
    $word = str_replace("í","%ED",$word);
    $word = str_replace("î","%EE",$word);
    $word = str_replace("ï","%EF",$word);
    $word = str_replace("ð","%F0",$word);
    $word = str_replace("ñ","%F1",$word);
    $word = str_replace("ò","%F2",$word);
    $word = str_replace("ó","%F3",$word);
    $word = str_replace("ô","%F4",$word);
    $word = str_replace("õ","%F5",$word);
    $word = str_replace("ö","%F6",$word);
    $word = str_replace("÷","%F7",$word);
    $word = str_replace("ø","%F8",$word);
    $word = str_replace("ù","%F9",$word);
    $word = str_replace("ú","%FA",$word);
    $word = str_replace("û","%FB",$word);
    $word = str_replace("ü","%FC",$word);
    $word = str_replace("ý","%FD",$word);
    $word = str_replace("þ","%FE",$word);
    $word = str_replace("ÿ","%FF",$word);
    return $word;
}	

function em_jaz($word) {
//	$word = str_replace('+', ' ', $word);
	$word = str_replace("%C3%A9","%E9",$word);          /* é */
	$word = str_replace("%C3%A8","%E8",$word);          /* è */
	$word = str_replace("%C3%AE","%EE",$word);          /* î */
	$word = str_replace("%26rsquo%3B","%27",$word);     /* ' */
	$word = str_replace("%C3%89","%C9",$word);          /* É */
	$word = str_replace("%C3%8A","%CA",$word);          /* Ê */ 
	$word = str_replace("%C3%8B","%CB",$word);          /* Ë */
	$word = str_replace("%C3%8C","%CC",$word);          /* Ì */
	$word = str_replace("%C3%8D","%CD",$word);          /* Í */
	$word = str_replace("%C3%8E","%CE",$word);          /* Î */
	$word = str_replace("%C3%8F","%CF",$word);          /* Ï */
	$word = str_replace("%C3%90","%D0",$word);          /* Ð */
	$word = str_replace("%C3%91","%D1",$word);          /* Ñ */
	$word = str_replace("%C3%92","%D2",$word);          /* Ò */
	$word = str_replace("%C3%93","%D3",$word);          /* Ó */
	$word = str_replace("%C3%94","%D4",$word);          /* Ô */
	$word = str_replace("%C3%95","%D5",$word);          /* Õ */
	$word = str_replace("%C3%96","%D6",$word);          /* Ö */
	$word = str_replace("%C3%98","%D8",$word);          /* Ø */                 
	$word = str_replace("%C3%99","%D9",$word);          /* Ù */
	$word = str_replace("%C3%9A","%DA",$word);          /* Ú */
	$word = str_replace("%C3%9B","%DB",$word);          /* Û */
	$word = str_replace("%C3%9C","%DC",$word);          /* Ü */
	$word = str_replace("%C3%9D","%DD",$word);          /* Ý */
	$word = str_replace("%C3%9E","%DE",$word);          /* Þ */
	$word = str_replace("%C3%9F","%DF",$word);          /* ß */
	$word = str_replace("%C3%A0","%E0",$word);          /* à */
	$word = str_replace("%C3%A1","%E1",$word);          /* á */
	$word = str_replace("%C3%A2","%E2",$word);          /* â */
	$word = str_replace("%C3%A3","%E3",$word);          /* ã */
	$word = str_replace("%C3%A4","%E4",$word);          /* ä */
	$word = str_replace("%C3%A5","%E5",$word);          /* å */
	$word = str_replace("%C3%A6","%E6",$word);          /* æ */
	$word = str_replace("%C3%A7","%E7",$word);          /* ç */
	$word = str_replace("%C3%AA","%EA",$word);          /* ê */
	$word = str_replace("%C3%AB","%EB",$word);          /* ë */
	$word = str_replace("%C3%AC","%EC",$word);          /* ì */
	$word = str_replace("%C3%AD","%ED",$word);          /* í */
	$word = str_replace("%C3%AF","%EF",$word);          /* ï */
	$word = str_replace("%C3%B0","%F0",$word);          /* ð */
	$word = str_replace("%C3%B1","%F1",$word);          /* ñ */
	$word = str_replace("%C3%B2","%F2",$word);          /* ò */
	$word = str_replace("%C3%B3","%F3",$word);          /* ó */
	$word = str_replace("%C3%B4","%F4",$word);          /* ô */
	$word = str_replace("%C3%B5","%F5",$word);          /* õ */
	$word = str_replace("%C3%B6","%F6",$word);          /* ö */
	$word = str_replace("%C3%B7","%F7",$word);          /* ÷ */
	$word = str_replace("%C3%B8","%F8",$word);          /* ø */
	$word = str_replace("%C3%B9","%F9",$word);          /* ù */
	$word = str_replace("%C3%BA","%FA",$word);          /* ú */
	$word = str_replace("%C3%BB","%FB",$word);          /* û */
	$word = str_replace("%C3%BC","%FC",$word);          /* ü */
	$word = str_replace("%C3%BD","%FD",$word);          /* ý */
	$word = str_replace("%C3%BE","%FE",$word);          /* þ */
	$word = str_replace("%C3%BF","%FF",$word);          /* ÿ */ 
	$word = str_replace("%40","%40",$word);             /* @ */
	$word = str_replace("%60","%60",$word);             /* ` */
	$word = str_replace("%C2%A2","%A2",$word);          /* ¢ */
	$word = str_replace("%C2%A3","%A3",$word);          /* £ */
	$word = str_replace("%C2%A5","%A5",$word);          /* ¥ */
	$word = str_replace("%7C","%A6",$word);             /* | */
	$word = str_replace("%C2%AB","%AB",$word);          /* « */
	$word = str_replace("%C2%AC","%AC",$word);          /* ¬ */
	$word = str_replace("%C2%AF","%AD",$word);          /* ¯ */
	$word = str_replace("%C2%BA","%B0",$word);          /* º */
	$word = str_replace("%C2%B1","%B1",$word);          /* ± */
	$word = str_replace("%C2%AA","%B2",$word);          /* ª */
	$word = str_replace("%C2%B5","%B5",$word);          /* µ */
	$word = str_replace("%C2%BB","%BB",$word);          /* » */
	$word = str_replace("%C2%BC","%BC",$word);          /* ¼ */
	$word = str_replace("%C2%BD","%BD",$word);          /* ½ */
	$word = str_replace("%C2%BF","%BF",$word);          /* ¿ */
	$word = str_replace("%C3%80","%C0",$word);          /* À */
	$word = str_replace("%C3%81","%C1",$word);          /* Á */
	$word = str_replace("%C3%82","%C2",$word);          /* Â */
	$word = str_replace("%C3%83","%C3",$word);          /* Ã */
	$word = str_replace("%C3%84","%C4",$word);          /* Ä */
	$word = str_replace("%C3%85","%C5",$word);          /* Å */
	$word = str_replace("%C3%86","%C6",$word);          /* Æ */
	$word = str_replace("%C3%87","%C7",$word);          /* Ç */
	$word = str_replace("%C3%88","%C8",$word);          
	return $word;
}
?>