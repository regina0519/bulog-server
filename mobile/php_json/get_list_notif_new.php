<?php
include 'functions.php';

$id=$_GET['id']; 
$sql ="SELECT * FROM tbl_notifikasi WHERE id_pegawai='".$id."' AND sent='0'";
 
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
