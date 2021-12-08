<?php
include 'functions.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$user=$obj['user'];
$pass=$obj['pass'];

//$tmp=password_hash($pass, PASSWORD_DEFAULT);
//echo $tmp."\n";
 
$sql = "SELECT tbl_pegawai.*,qJoin.id_bidang,qJoin.id_fungsi,qJoin.nm_jab,qJoin.singk_jab,qJoin.adalah_kepala_bidang,qJoin.fungsi_disposisi,qJoin.ket_fungsi,qJoin.nm_bidang,qJoin.kode_bidang
FROM tbl_pegawai JOIN
(SELECT qJab.*, ref_bidang.nm_bidang, ref_bidang.kode_bidang
FROM
(SELECT ref_jabatan.*,ref_fungsi_disposisi.fungsi_disposisi,ref_fungsi_disposisi.ket_fungsi
FROM ref_jabatan JOIN ref_fungsi_disposisi ON (ref_jabatan.id_fungsi=ref_fungsi_disposisi.id_fungsi))qJab
LEFT JOIN ref_bidang ON (qJab.id_bidang=ref_bidang.id_bidang))qJoin
ON (tbl_pegawai.id_jab=qJoin.id_jab)
WHERE (aktif='1' AND id_pegawai='".$user."')";
 
$result = $conn->query($sql);
 
if ($result->num_rows >0) {
 
 
 while($r = $result->fetch_assoc()) {
    //echo $row[0]['nm_pegawai'];
    if(password_verify($pass, $r["password"])){
        $row[]=$r;
        $tem = $row;
        $json = json_encode($tem);
        break;
    }
 }
 
} else {
 echo "No Results Found.";
}
 echo $json;
$conn->close();
?>
