<?php
include 'functions.php';

$id=$_GET['id'];
 
$sql ="SELECT tbldet_item_tagihan.*, tbl_item.nm_item, tbl_item.satuan, tbl_item.harga_patokan, tbl_item.ket_item
FROM tbldet_item_tagihan JOIN tbl_item ON (tbldet_item_tagihan.id_item=tbl_item.id_item) WHERE tbldet_item_tagihan.id_tagihan='".$id."'";
 
$result = $conn->query($sql);
 
if ($result->num_rows >0) {
 
 
 while($row[] = $result->fetch_assoc()) {
 
 $tem = $row;
 
 $json = json_encode($tem);
 
 
 }
 
} else {
 echo "No Results Found.";
}
 echo $json;
$conn->close();
?>
