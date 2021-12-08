<?php
include 'functions.php';
//$json='[{"id_jab":"JABATAN006","id_bidang":"BIDANG_001","id_fungsi":"FUNGSI_001","nm_jab":"Kepala Seksi Akuntansi","singk_jab":"Kasi Akunxxx","adalah_kepala_bidang":"0","fungsi_disposisi":"Pembuat Tagihan","ket_fungsi":"Yang membuat tagihan","nm_bidang":"Administrasi dan Keuangan","kode_bidang":"18040"}]';
$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$continue=true;
foreach ($obj as $ind=>$value) {
    if($value["id_bidang"]==""){
        $value["adalah_kepala_bidang"]="0";
        $obj[$ind]=$value;
    }else{
        if($value["adalah_kepala_bidang"]=="1"){
            $sq="UPDATE ref_jabatan SET adalah_kepala_bidang='0' WHERE id_bidang='".$value["id_bidang"]."' AND id_jab<>'".$value["id_jab"]."'";
            if ($conn->query($sq) === FALSE) {
                $continue=false;
                break;
            }
        }
    }
}

if($continue){
    $keyValues=array("id_jab"=>"JABATAN<DIGIT>3</DIGIT>");
    $excluded=array("fungsi_disposisi","ket_fungsi","nm_bidang","kode_bidang");
    $result=jsonToSql($obj,"ref_jabatan",$keyValues,$excluded,$conn);
    if ($conn->query($result[0]) === TRUE) {
        $msg = array('succeed' => '1', 'error' => '');
    } else {
        $msg = array('succeed' => '0', 'error' => $conn->error);
    }
}else{
    $msg = array('succeed' => '0', 'error' => $conn->error);
}

$res[]=$msg;
echo json_encode($res);

$conn->close();
?>
