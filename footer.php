<?php
//==============================================
// footer.php
// Copyright (c) 2014 Web4UKM
//==============================================

?>
<style>
.zFooterShortCut {
  transition: transform .2s; /* Animation */
  width: 32px;
  height: 32px;
  font-weight: bold;
  font-size: 7px;
}

.zFooterShortCut:hover {
  transform: scale(1.3); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>
<div id="footerW" class="footer" <?php echo $cPropertiFooter;?>>
    <div class="footer-logo" style="background:url('<?php echo $pSKAppLogoFooter;?>');"></div>
    <div class="copyright">2025 © PT. KARURNIA BERCA INDONESIA.</div>
    <div style="float: right; margin-right: 10px;">Created by Duta Alamin</div>
    <div style="float: right; margin-right: 30px; margin-top: 5px;">
    
<?php
	if($vHakMenu['E6A4FFF2-DBC2-4044-B0C1-65C62227AFA3']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="Maintenance: Peminjaman Tools">
        	<a href="lap_mtn_pinjam_sp.php" style="font-size: 11px;"><img src="images/generic.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />Pinjam Tools</a>
        </div>
<?php
	}
	if($vHakMenu['4517529A-5983-4FD5-B8E6-86F5E246798F']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="Maintenance: Permintaan/Peminjaman Barang">
        	<a href="mtn_permintaan_barang_add.php" style="font-size: 11px;"><img src="images/add-to-cart.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />Minta Barang</a>
        </div>
<?php
	}
	if($vHakMenu['F30B5F7B-CB6B-42A9-ADB3-AFF3CEB194AA']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="Maintenance: Pengembalian Barang">
        	<a href="mtn_pengembalian_barang_add.php" style="font-size: 11px;"><img src="images/retur-to-cart.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />Kembali Barang</a>
        </div>
<?php
	}
	if($vHakMenu['57837D3C-DC9A-4176-A16E-1808BB7371EE']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="Maintenance: Stock Card">
        	<a href="lap_mtn_store_stockcard.php" style="font-size: 11px;"><img src="images/kfm_home.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />Stock Card</a>
        </div>
<?php
	}
	if($vHakMenu['B896AEB5-8B13-450E-A227-4CEE8C3BE825']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="Maintenance: MRIS">
        	<a href="mtn_gnrl_mris.php" style="font-size: 11px;"><img src="images/Open.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />MRIS</a>
        </div>
<?php
	}
	if($vHakMenu['410F182B-560B-4C1F-B2BE-EE1F162C5CD3']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="Maintenance: Consumable RAIR">
        	<a href="mtn_gnrl_rair.php" style="font-size: 11px;"><img src="images/rair-128.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />RAIR Cons.</a>
        </div>
<?php
	}
	if($vHakMenu['D40B8345-3ED0-4F18-BEC9-ABFD19769F81']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="Maintenance: Ex. Prod. Cons. RAIR">
        	<a href="mtn_gnrl_retur_rair.php" style="font-size: 11px;"><img src="images/rair-ex-128.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />RAIR Ex.</a>
        </div>
<?php
	}
	if($vHakMenu['85503D45-B65E-45EC-AEC0-517116ABD1A1']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="Maintenance: Consumable PR">
        	<a href="mtn_gnrl_pr.php" style="font-size: 11px;"><img src="images/pr-128.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />PR Cons.</a>
        </div>
<?php
	}
	if($vHakMenu['D1FFE33A-3CE3-4492-AF3B-032AB9426C5D']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="HRD: Cuti Karyawan">
        	<a href="hrd_data_cuti_karyawan.php" style="font-size: 11px;"><img src="images/Cuti-265.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />Cuti Karyawan</a>
        </div>
<?php
	}
	if($vHakMenu['CA2ED5C5-DDB7-4049-9387-B158AFB3F00D']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="HRD: Input Surat Dokter / Kwitansi">
        	<a href="hrd_sakit_karyawan.php" style="font-size: 11px;"><img src="images/dokter-256.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />Surat Dokter</a>
        </div>
<?php
	}
	if($vHakMenu['C417971E-3F6C-4743-8EA3-AA58A51E0E23']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="FIN: Payment Voucher AP">
        	<a href="fin_pv_ap.php" style="font-size: 11px;"><img src="images/pv-ap-256.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />Payment AP</a>
        </div>
<?php
	}
	if($vHakMenu['1E3B7DEB-AF3E-4166-9D36-9EFD8C9BAB61']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="FIN: Payment Voucher Non AP">
        	<a href="fin_pv_nap.php" style="font-size: 11px;"><img src="images/pv-nap-256.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />Payment Non AP</a>
        </div>
<?php
	}
	if($vHakMenu['8D1050C2-73F8-4C1A-B938-03E6C7FC1137']||$vHakMenu['508ED4B7-F8E5-48D0-B599-DB7CCB3B1C62']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="FIN: Cash Payment">
        	<a href="fin_pv_cash.php" style="font-size: 11px;"><img src="images/pv-cash-256.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />Cash Payment</a>
        </div>
<?php
	}
	if($vHakMenu['2166A398-0625-4AC3-BD9E-9E276E5F0CC2']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="FIN: Prepare Payment">
        	<a href="fin_pv_pp.php" style="font-size: 11px;"><img src="images/pv-prepare-pay-256.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />Prepare Payment</a>
        </div>
<?php
	}
	if($vHakMenu['3662AEE0-4CAE-4504-B57B-990771BF3B13']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="FIN: Journal">
        	<a href="acct_fast_payment_journal.php" style="font-size: 11px;"><img src="images/journal-256.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />Journal</a>
        </div>
<?php
	}
	if($vHakMenu['6A2D0FD0-ED71-40AD-BA4C-1FC857C8AEEB']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="FIN: Proforma Journal">
        	<a href="acct_fast_proforma_journal.php" style="font-size: 11px;"><img src="images/journal-proforma-256.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />Proforma Journal</a>
        </div>
<?php
	}
	if($vHakMenu['FACCBC5A-255D-4BF3-B3B7-54DFBADE5454']){
?>
    	<div class="zFooterShortCut" style="text-align: center; width: 50px; margin-left: 10px; float: right;" title="Logistic: Stock Card">
        	<a href="lap_log_mtl_stockcard.php" style="font-size: 11px;"><img src="images/kfm_home.png" style="width: 32px; height: 32px; margin-left: auto; margin-right: auto;" /><br />Stock Card</a>
        </div>
<?php
	}
?>
    </div>
</div>
<script>
	//alert($_SESSION['sMISAppDepartmentIID']);
	function fCekData(){
<?php
		if($_SESSION['sMISAppDepartmentIID']=="D323E69F-95EC-4657-B8CE-1E5E825CC938"
			||$_SESSION['sMISAppuid']=="697B2929-94FE-4BD6-B715-BECA57EF059F"
			){
?>
			doRequest('get','yCekData.php?p0=ENG','text',"divNotifikasi");
<?php
		}
		elseif($_SESSION['sMISAppDepartmentIID']=="08F604D9-1AF4-457B-B80C-C66B7DBE0D9C"
			||$_SESSION['sMISAppuid']=="697B2929-94FE-4BD6-B715-BECA57EF059F"
			){
?>
			doRequest('get','yCekData.php?p0=PROC','text',"divNotifikasi");
<?php
		}
		elseif($_SESSION['sMISAppDepartmentIID']=="705B97E5-1064-4395-B59F-7FA45B25D7DA"
			||$_SESSION['sMISAppuid']=="697B2929-94FE-4BD6-B715-BECA57EF059F"
			){
?>
			doRequest('get','yCekData.php?p0=LOG','text',"divNotifikasi");
<?php
		}
		elseif($_SESSION['sMISAppDepartmentIID']=="233E600F-F87C-4A0A-93EF-6238D94CF905"
			||$_SESSION['sMISAppuid']=="697B2929-94FE-4BD6-B715-BECA57EF059F"
			){
?>
			doRequest('get','yCekData.php?p0=HRD','text',"divNotifikasi");
<?php
		}
		elseif($_SESSION['sMISAppDepartmentIID']=="52AD13D0-32E1-4F51-9C82-903D1BFAB337"
			||$_SESSION['sMISAppuid']=="697B2929-94FE-4BD6-B715-BECA57EF059F"
			){
?>
			doRequest('get','yCekData.php?p0=HRGA','text',"divNotifikasi");
<?php
		}
		elseif($_SESSION['sMISAppDepartmentIID']=="86AE9A6F-2153-419E-ADA7-32806FE1724D"
			||$_SESSION['sMISAppuid']=="697B2929-94FE-4BD6-B715-BECA57EF059F"
			){
?>
			doRequest('get','yCekData.php?p0=FIN','text',"divNotifikasi");
<?php
		}
		elseif(($_SESSION['sMISAppDepartmentIID']=="9E3D61B0-DC5F-4687-ADA1-292790FF25F7" && $vHakMenu['052285AE-F4A5-4126-98B5-AE2B516B1129'])
			||$_SESSION['sMISAppuid']=="697B2929-94FE-4BD6-B715-BECA57EF059F"
			){			
?>
			doRequest('get','yCekData.php?p0=GA','text',"divNotifikasi");
<?php
		}
		elseif(($_SESSION['sMISAppDepartmentIID']=="C4AE9C34-E28E-484A-BC97-9A33AD7FDE20")
			||$_SESSION['sMISAppuid']=="697B2929-94FE-4BD6-B715-BECA57EF059F"
			){			
?>
			doRequest('get','yCekData.php?p0=MTN','text',"divNotifikasi");
<?php
		}
		elseif(($_SESSION['sMISAppDepartmentIID']=="03187C64-CC47-476E-BCBE-291786018A5C")
			||$_SESSION['sMISAppuid']=="697B2929-94FE-4BD6-B715-BECA57EF059F"
			){			
?>
			doRequest('get','yCekData.php?p0=PLANT','text',"divNotifikasi");
<?php
		}
		elseif($_SESSION['sMISAppDepartmentIID']=="E6A3021C-4FBA-4E66-BFDB-3D614A472597"
			||$_SESSION['sMISAppuid']=="697B2929-94FE-4BD6-B715-BECA57EF059F"
			){
?>		
			doRequest('get','yCekData.php?p0=SFT','text',"divNotifikasi");
<?php
		}
		elseif($_SESSION['sMISAppDepartmentIID']=="E55146A8-CCD1-4DF3-B9B0-14771E5A9B47"
			||$_SESSION['sMISAppuid']=="697B2929-94FE-4BD6-B715-BECA57EF059F"
			){
?>		
			doRequest('get','yCekData.php?p0=ACCT','text',"divNotifikasi");
<?php
		}
		else{
?>		
			doRequest('get','yCekData.php?p0=ALL','text',"divNotifikasi");
<?php
		}
?>
		window.setTimeout(fCekData, 7200000);
	}
	
	fCekData();
</script>
<?php
	$_SESSION['Mulai_Session']=time();

	mssql_close()
?>
