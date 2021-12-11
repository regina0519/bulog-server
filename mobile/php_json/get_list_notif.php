<?php
include 'functions.php';

$id=$_GET['id']; 
$seen=$_GET['seen'];
//$sql ="SELECT * FROM tbl_notifikasi WHERE id_pegawai='".$id."' ORDER BY tgl_notif DESC";
if($seen!=null){
    $sql ="SELECT * FROM tbl_notifikasi WHERE id_pegawai='".$id."' AND seen='".$seen."' ORDER BY tgl_kirim DESC";
}else{
    $sql ="SELECT * FROM tbl_notifikasi WHERE id_pegawai='".$id."' ORDER BY tgl_kirim DESC";
}

 
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
