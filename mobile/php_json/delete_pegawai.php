<?php
include 'functions.php';

$id=$_GET['id'];
 
$sql ="SELECT * FROM tbl_tagihan WHERE id_pembuat='".$id."' OR id_pengaju='".$id."' OR id_kakanwil='".$id."' OR id_minkeu='".$id."' OR id_verifikator='".$id."' OR id_bag_keu='".$id."'";

$canDel=false;
$result = $conn->query($sql);
 
if ($result->num_rows ==0) {
    $sql ="SELECT * FROM tbl_notifikasi WHERE id_pegawai='".$id."'";
    $result = $conn->query($sql);
    
    if ($result->num_rows ==0) {
        $canDel=true;
    }
}
if($canDel){
    $sqlDel="DELETE FROM tbl_pegawai WHERE id_pegawai='".$id."'";
    if ($conn->query($sqlDel) === TRUE) {
        $msg = array('succeed' => '1', 'error' => '');
    } else {
        $msg = array('succeed' => '0', 'error' => $conn->error);
    }
}else{
    $msg = array('succeed' => '0', 'error' => "EXIST");
}
$res[]=$msg;
echo json_encode($res);
$conn->close();
?>
