<?php
include 'functions.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$user=$obj['user'];
$pass=$obj['pass'];

//$tmp=password_hash($pass, PASSWORD_DEFAULT);
//echo $tmp."\n";
 
$sql = "select tbl_pegawai.*, ref_jabatan.id_bidang, ref_jabatan.id_fungsi, ref_jabatan.nm_jab, ref_jabatan.singk_jab, ref_jabatan.adalah_kepala_bidang, ref_fungsi_disposisi.fungsi_disposisi, ref_fungsi_disposisi.ket_fungsi, ref_bidang.nm_bidang FROM tbl_pegawai,ref_jabatan,ref_fungsi_disposisi,ref_bidang
WHERE (ref_jabatan.id_jab=tbl_pegawai.id_jab AND ref_jabatan.id_bidang=ref_bidang.id_bidang AND ref_jabatan.id_fungsi=ref_fungsi_disposisi.id_fungsi) AND
(tbl_pegawai.aktif='1' AND tbl_pegawai.id_pegawai='".$user."')";
 
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
