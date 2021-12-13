<?php
include 'functions.php';
$json = file_get_contents('php://input');
//$json='[{"id_notifikasi":"1","id_pegawai":"1","id_tagihan":"1","notif_title":"title","notif_desc":"hallo","sent":"1","seen":"0"}]';
$obj = json_decode($json,true);

$sql="UPDATE tbl_notifikasi SET seen='1' WHERE id_notifikasi='".$obj[0]["id_notifikasi"]."'";
//echo($result[0]);


if ($conn->query($sql) === TRUE) {
    $msg = array('succeed' => '1', 'error' => '');
} else {
    $msg = array('succeed' => '0', 'error' => $conn->error);
}

$res[]=$msg;
echo json_encode($res);

$conn->close();
?>
