<?php
include 'functions.php';

$filterBidang=$_GET['bid'];
if($filterBidang=="none")$filterBidang="";
 
if($filterBidang=="all"){
    $sql ="SELECT q.*, ref_bidang.nm_bidang, ref_bidang.kode_bidang
    FROM
    (SELECT ref_jabatan.*, ref_fungsi_disposisi.fungsi_disposisi, ref_fungsi_disposisi.ket_fungsi
    FROM ref_jabatan JOIN ref_fungsi_disposisi ON (ref_jabatan.id_fungsi=ref_fungsi_disposisi.id_fungsi))q
    LEFT JOIN ref_bidang ON (q.id_bidang=ref_bidang.id_bidang)
    ORDER BY q.id_bidang ASC, q.adalah_kepala_bidang DESC, q.id_fungsi DESC";
}else{
    $sql ="SELECT q.*, ref_bidang.nm_bidang, ref_bidang.kode_bidang
    FROM
    (SELECT ref_jabatan.*, ref_fungsi_disposisi.fungsi_disposisi, ref_fungsi_disposisi.ket_fungsi
    FROM ref_jabatan JOIN ref_fungsi_disposisi ON (ref_jabatan.id_fungsi=ref_fungsi_disposisi.id_fungsi))q
    LEFT JOIN ref_bidang ON (q.id_bidang=ref_bidang.id_bidang)
    WHERE (q.id_bidang='".$filterBidang."')
    ORDER BY q.id_bidang ASC, q.adalah_kepala_bidang DESC, q.id_fungsi DESC";
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
