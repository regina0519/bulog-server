<?php
include 'functions.php';

$res=$_GET['res'];
$pg=$_GET['pg'];
 
$sql = "SELECT * FROM app_settings where id_setting='1'";
 
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
