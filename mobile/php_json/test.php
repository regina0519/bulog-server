<?php
include 'functions.php';

echo(password_hash("bulogkeuangan",PASSWORD_DEFAULT));

$res=$_GET['res'];
$pg=$_GET['pg'];
 
$sql = "SELECT * FROM tes limit ".$res." offset ".($pg-1)*$res;
 
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
