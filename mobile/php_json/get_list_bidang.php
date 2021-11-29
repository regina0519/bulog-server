<?php
include 'functions.php';

$res=$_GET['res'];
$pg=$_GET['pg'];
 
$sql ="SELECT * FROM ref_bidang limit ".$res." offset ".($pg-1)*$res;
 
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
