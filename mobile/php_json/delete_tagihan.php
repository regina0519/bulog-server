<?php
include 'functions.php';

$id=$_GET['id'];
 
$sql ="SELECT * FROM tbl_tagihan WHERE id_tagihan='".$id."' AND (status_pembuatan='0')";

$canDel=false;
$result = $conn->query($sql);
if ($result->num_rows >0) {
    $canDel=true;
}
if($canDel){
    $sqlNotif ="SELECT * FROM tbl_notifikasi WHERE id_tagihan='".$id."'";
    $resultNotif = $conn->query($sqlNotif);
    
    if ($resultNotif->num_rows >0) {
        $canDel=false;
        $msg = array('succeed' => '0', 'error' => "EXIST");
    }
}else{
    $msg = array('succeed' => '0', 'error' => "EXIST");
}

if($canDel){
    $sqlDelDet="DELETE FROM tbldet_item_tagihan WHERE id_tagihan='".$id."'";
    if ($conn->query($sqlDelDet) === FALSE) {
        $canDel=false;
        $msg = array('succeed' => '0', 'error' => 'KONEKSI');
    }
}
if($canDel){
    $sqlDelDet="DELETE FROM tbl_tagihan WHERE id_tagihan='".$id."'";
    if ($conn->query($sqlDelDet) === TRUE) {
        $msg = array('succeed' => '1', 'error' => '');
    }else{
        $msg = array('succeed' => '0', 'error' => 'KONEKSI');
    }
}

$res[]=$msg;
echo json_encode($res);
$conn->close();
?>
