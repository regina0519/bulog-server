<?php
include 'functions.php';

$id=$_GET['id'];
 
$sql ="SELECT * FROM tbl_tagihan WHERE id_bidang='".$id."'";

$canDel=false;
$result = $conn->query($sql);
 
if ($result->num_rows ==0) {
    $sql ="SELECT * FROM ref_jabatan WHERE id_bidang='".$id."'";
    $result = $conn->query($sql);
    
    if ($result->num_rows ==0) {
        $canDel=true;
    }
}
if($canDel){
    $sqlDel="DELETE FROM ref_bidang WHERE id_bidang='".$id."'";
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
