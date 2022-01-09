<?php
include 'functions.php';
//$json='[{"id_bidang":"","nm_bidang":"Pengadaan"}]';
$id=$_GET['id'];
//$json='[{"id_notifikasi":"1","id_pegawai":"1","id_tagihan":"1","notif_title":"title","notif_desc":"hallo","sent":"1","seen":"0"}]';
$now = date_create()->format('YmdHis');
$now2 = date_create()->format('Y-m-d H:i:s');
$sql="INSERT INTO tbl_log2(id_log,log_txt) VALUES('LOG_".$now."','BG Trying ".$now2."')";

if ($conn->query($sql) === TRUE) {
    $msg = array('succeed' => '1', 'error' => '');
} else {
    $msg = array('succeed' => '0', 'error' => $conn->error);
}

$res[]=$msg;
echo json_encode($res);

$conn->close();
?>
