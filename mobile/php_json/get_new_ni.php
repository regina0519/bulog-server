<?php
include 'functions.php';
function extractNI($str){
    //$str = "NI-0202/gsdg/sdgs.sdg.sdg/20";
    $pattern = "/^[^0-9][^0-9]*/";
    $res=preg_replace($pattern,"",$str); 
    return intval($res);
}

$no="";
$sql="SELECT no_nota_intern FROM tbl_tagihan WHERE YEAR(tgl_pembuatan)='".date("Y")."' ORDER BY tgl_pembuatan DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows >0) {
    while($r = $result->fetch_assoc()) {
        $no=$r["no_nota_intern"];
        break;
    }
}
if($no!=""){
    $msg = array('ni' => (extractNI($no)+1)."");
}else{
    $msg = array('ni' => '1');
}
$res[]=$msg;
echo json_encode($res);
$conn->close();
?>