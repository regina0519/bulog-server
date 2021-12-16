<?php
include 'functions.php';
$id=$_GET['id'];
//$json='[{"id_notifikasi":"1","id_pegawai":"1","id_tagihan":"1","notif_title":"title","notif_desc":"hallo","sent":"1","seen":"0"}]';
$sql="UPDATE tbl_notifikasi SET sent='1' WHERE id_notifikasi='".$id."'";
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
