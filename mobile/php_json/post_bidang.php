<?php
include 'functions.php';
//$json='[{"id_bidang":"","nm_bidang":"Pengadaan"}]';
$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$keyValues=array("id_bidang"=>"BIDANG_<DIGIT>3</DIGIT>");
$excluded=null;
$result=jsonToSql($obj,"ref_bidang",$keyValues,$excluded,$conn);
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
