<?php
session_start();

if(empty($_SESSION['sMISAppuid'])){
    header("Location: xlogout.php");
}

include_once("menu.php");
include_once("xproc.php");
include_once("xparam.php"); 
include_once("xfunct.php");

$MainPage   = "Input Data";
$SubMenu    = "ENGINEERING";
$SubPage    = "Consumable PR";
$TitlePage  = "Daftar Consumable PR";

$DepartmentID = "{D323E69F-95EC-4657-B8CE-1E5E825CC938}";
$IDMenu     = "{5631F6B9-D58A-4EC3-AB15-B899CB74EA42}";
include_once("xotor.php");

$Tanggal1   = "01/".$cBln."/".$cThn;
$Tanggal2   = fMaxHariBulan($cBln,$cThn)."/".$cBln."/".$cThn;

// Add variables for permissions
$bHakTambah = false;
$bHakEdit = false;
$bHakHapus = false;
$bHakCetak = false;
$bHakPreview = false;

// Check permissions
$cSQLStr = "spSysOtor '".$_SESSION['sMISAppuid']."','{40DDDA15-7B23-4D84-A124-D60E1AB1FCBA}'"; // Add permission
$qrOtor = mssql_query($cSQLStr);
$bHakTambah = (mssql_num_rows($qrOtor) > 0);

$cSQLStr = "spSysOtor '".$_SESSION['sMISAppuid']."','{472C4691-BFAB-4B07-9B44-AAC5ADC82A2A}'"; // Hak Edit
$qrOtor = mssql_query($cSQLStr);
$bHakEdit = (mssql_num_rows($qrOtor) > 0);

$cSQLStr = "spSysOtor '".$_SESSION['sMISAppuid']."','{E8E7AE07-C806-46AE-B325-2B2A59A125AB}'"; // Hak Hapus
$qrOtor = mssql_query($cSQLStr);
$bHakHapus = (mssql_num_rows($qrOtor) > 0);

$cSQLStr = "spSysOtor '".$_SESSION['sMISAppuid']."','{7F648B8B-D254-4676-857B-16B39EE46039}'"; // Hak Cetak
$qrOtor = mssql_query($cSQLStr);
$bHakCetak = (mssql_num_rows($qrOtor) > 0);

$cSQLStr = "spSysOtor '".$_SESSION['sMISAppuid']."','{D18C7E26-E3D7-4224-97E4-FA5316EC0928}'"; // Hak Preview
$qrOtor = mssql_query($cSQLStr);
$bHakPreview = (mssql_num_rows($qrOtor) > 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="logo.jpg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $TitlePage." - ".$pSKAppNamaAplikasi;?></title>
    
    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
</head>
<body>
    <?php include_once("menu.php"); ?>

    <!-- Main Content -->
    <div class="container mt-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4><?php echo $TitlePage;?></h4>
            <div class="text-end">
                <span><?php echo date('l, d F Y'); ?></span>
            </div>
        </div>

        <!-- Main Card -->
        <div class="card">
            <div class="card-body">
                <form name="frmData" method="post">
                    <!-- Hidden inputs -->
                    <input type="hidden" name="hdFrom" value="" />
                    <input type="hidden" name="CID" value="" />
                    <input type="hidden" name="PersonalID" value="" />
                    <input type="hidden" name="TitlePage" value="<?php echo $TitlePage;?>" />
                    
                    <!-- Search and Filter Controls -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label>No. PR</label>
                            <input type="text" name="Cari" class="form-control" placeholder="Pencarian..." onkeyup="fCari(frmData)">
                        </div>
                        <div class="col-md-4">
                            <label>Periode</label>
                            <div class="input-group">
                                <input type="text" id="Tanggal1" name="Tanggal1" class="form-control datepicker" value="<?php echo $Tanggal1;?>">
                                <input type="text" id="Tanggal2" name="Tanggal2" class="form-control datepicker" value="<?php echo $Tanggal2;?>">
                            </div>
                        </div>
                        <div class="col-md-5 d-flex align-items-end justify-content-end">
                            <?php if ($bHakCetak) { ?>
                            <button type="button" class="btn btn-sm btn-secondary me-1" onclick="fCetak(frmData)">
                                <i class="fas fa-print"></i> Print
                            </button>
                            <?php } ?>
                            
                            <?php if ($bHakPreview) { ?>
                            <button type="button" class="btn btn-sm btn-info text-white me-1" onclick="fPreview(frmData)">
                                <i class="fas fa-eye"></i> Preview
                            </button>
                            <?php } ?>
                            
                            <?php if ($bHakTambah) { ?>
                            <button type="button" class="btn btn-sm btn-success me-1" onclick="fTambah(frmData)">
                                <i class="fas fa-plus"></i> Add New
                            </button>
                            <?php } ?>
                            
                            <?php if ($bHakHapus) { ?>
                            <button type="button" class="btn btn-sm btn-danger me-1" onclick="fHapus(frmData)">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                            <?php } ?>
                            
                            <button type="button" class="btn btn-sm btn-warning" onclick="fRefresh(frmData)">
                                <i class="fas fa-sync"></i> Refresh
                            </button>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" width="5%">NO.</th>
                                    <th width="15%">NOMOR</th>
                                    <th width="10%">TANGGAL</th>
                                    <th width="10%">JO</th>
                                    <th>PROJECT</th>
                                    <th width="12%">STATUS</th>
                                    <th style="display:none;">PRTYPE</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    
    <!-- Core functionality -->
    <script>
        function fCari(F) {
            F.submit();
        }
        
        function fRefresh(F) {
            F.Cari.value = "";
            F.Tanggal1.value = "<?php echo $Tanggal1;?>";
            F.Tanggal2.value = "<?php echo $Tanggal2;?>";
            F.submit();
        }
        
        function fTambah(F) {
            F.action = 'eng_cons_pr_add.php';
            F.submit();
        }
        
        function fHapus(F) {
            if(F.CID.value == '') {
                alert('Pilih data yang akan dihapus.');
                return;
            }
            if(confirm('Yakin akan menghapus data?')) {
                F.action = 'eng_cons_pr.php';
                F.submit();
            }
        }
        
        function fPreview(F) {
            if(F.CID.value == '') {
                alert('Pilih data yang akan ditampilkan.');
                return;
            }
            window.open('eng_cons_pr_preview.php?id=' + F.CID.value, '_blank');
        }
        
        function fCetak(F) {
            if(F.CID.value == '') {
                alert('Pilih data yang akan dicetak.');
                return;
            }
            window.open('eng_cons_pr_print.php?id=' + F.CID.value, '_blank');
        }
        
        $(document).ready(function() {
            $('#gridData tr').click(function() {
                $('#gridData tr').removeClass('selected');
                $(this).addClass('selected');
                document.frmData.CID.value = $(this).data('id');
            });
            
            // Double click handler untuk edit
            $('#gridData tr').dblclick(function() {
                if(document.frmData.CID.value != '') {
                    document.frmData.action = 'eng_cons_pr_edit.php';
                    document.frmData.submit();
                }
            });
            
            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
</body>
</html>
