<?php
include 'functions.php';
//$json='[["DET_TAG_BIDANG_001_20210101000000_0001_ITEM_20210101000000_00002_00001","DET_TAG_BIDANG_001_20210101000000_0001_ITEM_20210101000000_00001_00001"],[{"id_tagihan":"TAG_BIDANG_001_20210101000000_0001","ket_tagihan":"Tagihan ATK","id_bidang":"BIDANG_001","id_pembuat":"087408759","nm_pembuat":"Novita Lampasian","jab_pembuat":"Kepala Seksi Sekretariat, Umum dan Humas","cat_pembuat":"Tes","tgl_pembuatan":"2021-01-01 00:00:00","status_pembuatan":"0","no_nota_intern":"NI001","id_pengaju":null,"nm_pengaju":null,"jab_pengaju":null,"cat_pengaju":null,"tgl_pengajuan":null,"status_pengajuan":"0","id_kakanwil":null,"nm_kakanwil":null,"jab_kakanwil":null,"cat_kakanwil":null,"tgl_disposisi_kakanwil":null,"status_approval_kakanwil":"0","id_minkeu":null,"nm_minkeu":null,"jab_minkeu":null,"cat_minkeu":null,"tgl_disposisi_minkeu":null,"status_approval_minkeu":"0","id_verifikator":null,"nm_verifikator":null,"jab_verifikator":null,"cat_verifikator":null,"tgl_verifikasi":null,"kesesuaian_data":"0","kesesuaian_perhitungan":"0","status_verifikasi":"0","no_verifikasi":null,"id_bag_keu":null,"nm_bag_keu":null,"jab_bag_keu":null,"cat_bag_keu":null,"tgl_bayar":null,"status_approval_bagkeu":"0","no_bukti_pembayaran":null,"status_tagihan":"0","det_array":[{"id_det_item":"","id_tagihan":"","id_item":"ITEM_20211122185458_00001","qty":"10","harga":"3000","ket_det_item":"","nm_item":"Gina","satuan":"Nut","harga_patokan":"3000","ket_item":""},{"id_det_item":"","id_tagihan":"","id_item":"ITEM_20211122031617_00001","qty":"10","harga":"5000","ket_det_item":"","nm_item":"Hahah","satuan":"Hihi","harga_patokan":"5000","ket_item":"Nnn"}]}]]';
//$json='[[],[{"id_tagihan":"","ket_tagihan":"Xxxx","id_bidang":"","id_pembuat":"","nm_pembuat":"","jab_pembuat":"","cat_pembuat":"Yyyyy","tgl_pembuatan":"2021-12-05 21:50:32","status_pembuatan":"0","no_nota_intern":"111","id_pengaju":"","nm_pengaju":"","jab_pengaju":"","cat_pengaju":"","tgl_pengajuan":"","status_pengajuan":"0","id_kakanwil":"","nm_kakanwil":"","jab_kakanwil":"","cat_kakanwil":"","tgl_disposisi_kakanwil":"","status_approval_kakanwil":"0","id_minkeu":"","nm_minkeu":"","jab_minkeu":"","cat_minkeu":"","tgl_disposisi_minkeu":"","status_approval_minkeu":"0","id_verifikator":"","nm_verifikator":"","jab_verifikator":"","cat_verifikator":"","tgl_verifikasi":"","kesesuaian_data":"0","kesesuaian_perhitungan":"0","status_verifikasi":"0","no_verifikasi":"","id_bag_keu":"","nm_bag_keu":"","jab_bag_keu":"","cat_bag_keu":"","tgl_bayar":"","status_approval_bagkeu":"0","no_bukti_pembayaran":"","status_tagihan":"","det_array":[{"id_det_item":"","id_tagihan":"","id_item":"ITEM_20210101000000_00001","qty":"10","harga":"25000","ket_det_item":"","nm_item":"Ballpoint Baliner Hitam","satuan":"Buah","harga_patokan":"25000","ket_item":""},{"id_det_item":"","id_tagihan":"","id_item":"ITEM_20210101000000_00002","qty":"10","harga":"30000","ket_det_item":"","nm_item":"Ballpoint Baliner Merah","satuan":"Buah","harga_patokan":"30000","ket_item":""},{"id_det_item":"","id_tagihan":"","id_item":"ITEM_20211122031617_00001","qty":"10","harga":"5000","ket_det_item":"","nm_item":"Hahah","satuan":"Hihi","harga_patokan":"5000","ket_item":"Nnn"},{"id_det_item":"","id_tagihan":"","id_item":"ITEM_20211122153933_00001","qty":"10","harga":"2500","ket_det_item":"","nm_item":"Tes","satuan":"Ggg","harga_patokan":"2500","ket_item":""}]}]]';
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
$dels=$obj[0];
$tags=$obj[1];
$continue=true;
$tmp="";
foreach($tags as $tag){
    if($tag["id_tagihan"]==""){
        if($tmp==""){
            $tmp="no_nota_intern='".$tag["no_nota_intern"]."'";
        }else{
            $tmp.=" OR no_nota_intern='".$tag["no_nota_intern"]."'";
        }
    }
}
if($tmp!=""){
    $tmp="SELECT * FROM tbl_tagihan WHERE (".$tmp.")";
    //echo($tmp."<br/><br/>");
    $result = $conn->query($tmp);
    if ($result->num_rows >0) {
        while($r = $result->fetch_assoc()) {
            $continue=false;
            $msg = array('succeed' => '0', 'error' => "No Nota: ".$r["no_nota_intern"]. " sudah terpakai.");
            break;
        }
    }
}

if($continue){
    $keyValuesTag=array("id_tagihan"=>"TAG_[id_bidang]_TIMESTAMP_<DIGIT>4</DIGIT>");
    $excludedTag=array("det_array","nm_bidang","kode_bidang");
    $resultTag=jsonToSql($tags,"tbl_tagihan",$keyValuesTag,$excludedTag,$conn);

    $tagsId=$resultTag[1];
    $dets=[];
    $i=0;
    foreach($tags as $tag){
        for($j=0;$j<count($tag["det_array"]);$j++){
            $tag["det_array"][$j]["id_tagihan"]=$tagsId[$i][0];
            array_push($dets,$tag["det_array"][$j]);
        }
        $i++;
    }



    $keyValuesDet=array("id_det_item"=>"DET_[id_tagihan]_[id_item]_<DIGIT>5</DIGIT>");
    $excludedDet=array("nm_item","satuan","harga_patokan","ket_item");
    $resultDet=jsonToSql($dets,"tbldet_item_tagihan",$keyValuesDet,$excludedDet,$conn);

    $resultDel="";
    foreach($dels as $del){
        if($resultDel==""){
            $resultDel="id_det_item='".$del."'";
        }else{
            $resultDel.=" OR id_det_item='".$del."'";
        }
    }
    if($resultDel!="")$resultDel="DELETE FROM tbldet_item_tagihan WHERE ".$resultDel;

    //echo($resultDel."<br/><br/>");
    //echo($resultTag[0]."<br/><br/>");
    //echo($resultDet[0]."<br/><br/>");
    
    if($resultDel!=""){
        if ($conn->query($resultDel) === FALSE) {
            $continue=false;
            $msg = array('succeed' => '0', 'error' => $conn->error);
        } 
    }
    if($continue){
        if ($conn->query($resultTag[0]) === TRUE) {
            if ($conn->query($resultDet[0]) === TRUE) {
                $msg = array('succeed' => '1', 'error' => '');
            } else {
                $msg = array('succeed' => '0', 'error' => $conn->error);
            }
        } else {
            $msg = array('succeed' => '0', 'error' => $conn->error);
        }
    }
}


$res[]=$msg;
echo json_encode($res);

$conn->close();
?>
