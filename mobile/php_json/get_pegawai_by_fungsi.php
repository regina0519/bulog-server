<?php
include 'functions.php';


$f=$_GET['f'];
 
$sql ="SELECT tbl_pegawai.id_pegawai
FROM tbl_pegawai JOIN ref_jabatan ON tbl_pegawai.id_jab=ref_jabatan.id_jab
WHERE ref_jabatan.id_fungsi='".$f."'";
 
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
