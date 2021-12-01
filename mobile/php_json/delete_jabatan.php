<?php
include 'functions.php';

$id=$_GET['id'];
$isKepala=$_GET['kepala'];
$bid=$_GET['bid'];

 
$sql ="SELECT * FROM tbl_pegawai WHERE id_jab='".$id."'";

$canDel=false;
$result = $conn->query($sql);
 
if ($result->num_rows ==0)$canDel=true;
if($canDel){
    if($bid!="" && $isKepala=="1"){
        $sqHead="SELECT * FROM ref_jabatan WHERE id_bidang='".$bid."' AND id_jab<>'".$id."'";
        $result = $conn->query($sqHead); 
        if ($result->num_rows >0) {
            $newHead="";
            $newHeadNm="";
            while($r = $result->fetch_assoc()) {
                $newHead=$r["id_jab"];
                $newHeadNm=$r["nm_jab"];
                break;
            }
            $sqTmp="UPDATE ref_jabatan SET adalah_kepala_bidang='1' WHERE id_jab='".$newHead."'";
            if ($conn->query($sqTmp) === FALSE) {
                $canDel=false;
            }else{
                $successMsg="Anda telah menghapus jabatan Kepala Bidang. Secara otomatis sitem telah menunjuk jabatan lainnya (".$newHeadNm.") sebagai Kepala Bidang. Anda dapat mengatur kembali penunjukan Kepala Bidang ini.";
            }
        }
    }
    if($canDel){
        $sqlDel="DELETE FROM ref_jabatan WHERE id_jab='".$id."'";
        if ($conn->query($sqlDel) === TRUE) {
            $msg = array('succeed' => '1', 'error' => $successMsg==""?"":$successMsg);
        } else {
            $msg = array('succeed' => '0', 'error' => $conn->error);
        }
    }else{
        $msg = array('succeed' => '0', 'error' => $conn->error);
    }
}else{
    $msg = array('succeed' => '0', 'error' => "EXIST");
}
$res[]=$msg;
echo json_encode($res);
$conn->close();
?>
