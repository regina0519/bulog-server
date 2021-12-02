<?php
include 'functions.php';

$filterBidang=$_GET['bid'];
if($filterBidang=="none")$filterBidang="";
 
if($filterBidang=="all"){
    $sql ="SELECT tbl_pegawai.*,qJoin.id_bidang,qJoin.id_fungsi,qJoin.nm_jab,qJoin.singk_jab,qJoin.adalah_kepala_bidang,qJoin.fungsi_disposisi,qJoin.ket_fungsi,qJoin.nm_bidang
    FROM tbl_pegawai JOIN
    (SELECT qJab.*, ref_bidang.nm_bidang
    FROM
    (SELECT ref_jabatan.*,ref_fungsi_disposisi.fungsi_disposisi,ref_fungsi_disposisi.ket_fungsi
    FROM ref_jabatan JOIN ref_fungsi_disposisi ON (ref_jabatan.id_fungsi=ref_fungsi_disposisi.id_fungsi))qJab
    LEFT JOIN ref_bidang ON (qJab.id_bidang=ref_bidang.id_bidang))qJoin
    ON (tbl_pegawai.id_jab=qJoin.id_jab)
    ORDER BY id_bidang ASC, adalah_kepala_bidang DESC, id_fungsi DESC";
}else{
    $sql ="SELECT tbl_pegawai.*,qJoin.id_bidang,qJoin.id_fungsi,qJoin.nm_jab,qJoin.singk_jab,qJoin.adalah_kepala_bidang,qJoin.fungsi_disposisi,qJoin.ket_fungsi,qJoin.nm_bidang
    FROM tbl_pegawai JOIN
    (SELECT qJab.*, ref_bidang.nm_bidang
    FROM
    (SELECT ref_jabatan.*,ref_fungsi_disposisi.fungsi_disposisi,ref_fungsi_disposisi.ket_fungsi
    FROM ref_jabatan JOIN ref_fungsi_disposisi ON (ref_jabatan.id_fungsi=ref_fungsi_disposisi.id_fungsi))qJab
    LEFT JOIN ref_bidang ON (qJab.id_bidang=ref_bidang.id_bidang))qJoin
    ON (tbl_pegawai.id_jab=qJoin.id_jab)
    WHERE (id_bidang='".$filterBidang."')
    ORDER BY id_bidang ASC, adalah_kepala_bidang DESC, id_fungsi DESC";
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
