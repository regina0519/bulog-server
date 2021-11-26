<?php
include 'functions.php';

$filter=$_GET['fltr'];
$res=$_GET['res'];
$pg=$_GET['pg'];

 
$sql = "SELECT * FROM tbl_item limit ".$res." offset ".($pg-1)*$res;
if($filter!="")$sql = "SELECT * FROM tbl_item WHERE nm_item LIKE '%".$filter."%' limit ".$res." offset ".($pg-1)*$res;
 
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
