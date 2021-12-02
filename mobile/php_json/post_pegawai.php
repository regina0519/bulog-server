
<?php
include 'functions.php';


//$json='[{"id_pegawai":"087408748","id_jab":"JABATAN002","nm_pegawai":"Noldi Ramayadiv","password":"$2y$10$byoh6/X9N36I7ivelKKKtunYLaT3yk22R9G99gBgnXE.sUN3WZ8te","tipe_user":"Pengguna","ganti_pass":"0","aktif":"1","id_bidang":"BIDANG_001","id_fungsi":"FUNGSI_004","nm_jab":"Kepala Bidang Administrasi dan Keuangan","singk_jab":"Kab Minku","adalah_kepala_bidang":"1","fungsi_disposisi":"Admin Keuangan","ket_fungsi":"Admin Keuangan","nm_bidang":"Administrasi dan Keuangan"}]';
$json = file_get_contents('php://input');
$objs = json_decode($json,true);
$val="";
foreach($objs as $obj){
    if($obj["password"]=="")$obj["password"]=password_hash($obj["id_pegawai"], PASSWORD_DEFAULT);
    if($val==""){
        $val="(
            '".$obj["id_pegawai"]."',
            '".$obj["id_jab"]."',
            '".$obj["nm_pegawai"]."',
            '".$obj["password"]."',
            '".$obj["tipe_user"]."',
            '".$obj["ganti_pass"]."',
            '".$obj["aktif"]."'
        )";
    }else{
        $val.=",(
            '".$obj["id_pegawai"]."',
            '".$obj["id_jab"]."',
            '".$obj["nm_pegawai"]."',
            '".$obj["password"]."',
            '".$obj["tipe_user"]."',
            '".$obj["ganti_pass"]."',
            '".$obj["aktif"]."'
        )";
    }
}
$sql="";
if($val!=="")$sql="REPLACE INTO tbl_pegawai(id_pegawai,id_jab,nm_pegawai,password,tipe_user,ganti_pass,aktif) VALUES".$val;

if ($conn->query($sql) === TRUE) {
    $msg = array('succeed' => '1', 'error' => '');
} else {
    $msg = array('succeed' => '0', 'error' => $conn->errno);
}

$res[]=$msg;
echo json_encode($res);

$conn->close();
?>
