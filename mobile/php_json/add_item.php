<?php
include 'functions.php';
//$json='{"id_item":"","nm_item":"Hhhhh","satuan":"Gghfh","harga_patokan":"965","ket_item":""}';
$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$idItem=$obj['id_item'];
$nmItem=$obj['nm_item'];
$satuan=$obj['satuan'];
$hargaPatokan=$obj['harga_patokan'];
$ketItem=$obj['ket_item'];


$now = date_create()->format('YmdHis');
$sqlTmp="select * from tbl_item where id_item LIKE 'ITEM_".$now."_%'";
$resTmp = $conn->query($sqlTmp);
$newId=$resTmp->num_rows+1;
$length=5;
$strId = substr(str_repeat(0, $length).$newId, - $length);
 
$sql = "INSERT INTO tbl_item(id_item,nm_item,satuan,harga_patokan,ket_item) VALUES('ITEM_".$now."_".$strId."','".$nmItem."','".$satuan."','".$hargaPatokan."','".$ketItem."')";
//echo("<br><br>".$sql."<br><br>");

 
if ($conn->query($sql) === TRUE) {
    $msg = array('succeed' => '1', 'error' => '');
} else {
    $msg = array('succeed' => '0', 'error' => $conn->error);
}

$res[]=$msg;
echo json_encode($res);

$conn->close();
?>
