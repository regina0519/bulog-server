<?php
include 'functions.php';
function extractNo($str){
    //$str = "NI-0202/gsdg/sdgs.sdg.sdg/20";
    $pattern = "/^[^0-9][^0-9]*/";
    $res=preg_replace($pattern,"",$str); 
    return intval($res);
}

$no="";
$sql="SELECT no_bukti_pembayaran FROM tbl_tagihan WHERE YEAR(tgl_bayar)='".date("Y")."' ORDER BY tgl_bayar DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows >0) {
    while($r = $result->fetch_assoc()) {
        $no=$r["no_bukti_pembayaran"];
        break;
    }
}
if($no!=""){
    $msg = array('no' => (extractNo($no)+1)."");
}else{
    $msg = array('no' => '1');
}
$res[]=$msg;
echo json_encode($res);
$conn->close();
?>