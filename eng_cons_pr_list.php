<?php
session_start();
include_once("menu.php");
include_once("xproc.php");
include_once("xparam.php");
include_once("xfunct.php");

header("Content-type: text/xml");
echo "<?xml version='1.0' encoding='utf-8'?>";
echo "<rows>";

$cSearch = isset($_GET['p1']) ? $_GET['p1'] : '';
$dTgl1 = fConvertTgl(isset($_GET['p2']) ? $_GET['p2'] : '');
$dTgl2 = fConvertTgl(isset($_GET['p3']) ? $_GET['p3'] : '');

$sql = "SELECT PR.PRID, PR.PRNo, PR.PRDate, PR.ProjectName, PR.PRStatus, PR.PRType 
        FROM tPR PR 
        WHERE PR.PRDate BETWEEN '$dTgl1' AND '$dTgl2'";

if ($cSearch != '') {
    $sql .= " AND PR.PRNo LIKE '%$cSearch%'";
}

$sql .= " ORDER BY PR.PRDate DESC, PR.PRNo DESC";

$result = mssql_query($sql);
$no = 1;

while ($row = mssql_fetch_array($result)) {
    echo "<row id='".$row['PRID']."'>";
    echo "<cell>".$no."</cell>";
    echo "<cell><![CDATA[".$row['PRNo']."]]></cell>";
    echo "<cell><![CDATA[".fConvertTgl2($row['PRDate'])."]]></cell>";
    echo "<cell><![CDATA[".$row['ProjectName']."]]></cell>";
    echo "<cell><![CDATA[".$row['PRStatus']."]]></cell>";
    echo "<cell><![CDATA[".$row['PRType']."]]></cell>";
    echo "</row>";
    $no++;
}

echo "</rows>";
?>
	