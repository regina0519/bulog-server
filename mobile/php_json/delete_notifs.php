<?php
include 'functions.php';

$id=$_GET['id'];
 
$sqlDel="DELETE FROM tbl_notifikasi WHERE id_tagihan='".$id."'";
    if ($conn->query($sqlDel) === TRUE) {
        $msg = array('succeed' => '1', 'error' => '');
    } else {
        $msg = array('succeed' => '0', 'error' => $conn->error);
    }
$res[]=$msg;
echo json_encode($res);
$conn->close();
?>
