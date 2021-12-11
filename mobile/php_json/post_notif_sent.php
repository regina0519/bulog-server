<?php
include 'functions.php';
$json = file_get_contents('php://input');
//$json='[{"id_notifikasi":"1","id_pegawai":"1","id_tagihan":"1","notif_title":"title","notif_desc":"hallo","sent":"1","seen":"0"}]';
$obj = json_decode($json,true);

$keyValues=array("id_notifikasi"=>"NOTIF_[id_pegawai]_[id_tagihan]_TIMESTAMP_<DIGIT>5</DIGIT>");
$excluded=null;
$result=jsonToSql($obj,"tbl_notifikasi",$keyValues,$excluded,$conn);
//echo($result[0]);


if ($conn->query($result[0]) === TRUE) {
    $msg = array('succeed' => '1', 'error' => '');
} else {
    $msg = array('succeed' => '0', 'error' => $conn->error);
}

$res[]=$msg;
echo json_encode($res);

$conn->close();
?>
