<?php
include 'functions.php';

//$json = '[{"id_tagihan":"TAG","ket_tagihan":"","id_bidang":"BID_001","id_pembuat":"ORG_001","nm_pembuat":"","jab_pembuat":"","cat_pembuat":"","tgl_pembuatan":"","status_pembuatan":"0","no_nota_intern":"","id_pengaju":"","nm_pengaju":"","jab_pengaju":"","cat_pengaju":"","tgl_pengajuan":"","status_pengajuan":"0","id_kakanwil":"","nm_kakanwil":"","jab_kakanwil":"","cat_kakanwil":"","tgl_disposisi_kakanwil":"","status_approval_kakanwil":"0","id_minkeu":"","nm_minkeu":"","jab_minkeu":"","cat_minkeu":"","tgl_disposisi_minkeu":"","status_approval_minkeu":"0","id_verifikator":"","nm_verifikator":"","jab_verifikator":"","cat_verifikator":"","tgl_verifikasi":"","kesesuaian_data":"0","kesesuaian_perhitungan":"0","status_verifikasi":"0","no_verifikasi":"","id_bag_keu":"","nm_bag_keu":"","jab_bag_keu":"","cat_bag_keu":"","tgl_bayar":"","status_approval_bagkeu":"0","no_bukti_pembayaran":"","status_tagihan":"","det_array":[]}]';

$json = '[{"id_tagihan":"","ket_tagihan":"","id_bidang":"BID_001","id_pembuat":"ORG_001","nm_pembuat":"","jab_pembuat":"","cat_pembuat":"","tgl_pembuatan":"","status_pembuatan":"0","no_nota_intern":"","id_pengaju":"","nm_pengaju":"","jab_pengaju":"","cat_pengaju":"","tgl_pengajuan":"","status_pengajuan":"0","id_kakanwil":"","nm_kakanwil":"","jab_kakanwil":"","cat_kakanwil":"","tgl_disposisi_kakanwil":"","status_approval_kakanwil":"0","id_minkeu":"","nm_minkeu":"","jab_minkeu":"","cat_minkeu":"","tgl_disposisi_minkeu":"","status_approval_minkeu":"0","id_verifikator":"","nm_verifikator":"","jab_verifikator":"","cat_verifikator":"","tgl_verifikasi":"","kesesuaian_data":"0","kesesuaian_perhitungan":"0","status_verifikasi":"0","no_verifikasi":"","id_bag_keu":"","nm_bag_keu":"","jab_bag_keu":"","cat_bag_keu":"","tgl_bayar":"","status_approval_bagkeu":"0","no_bukti_pembayaran":"","status_tagihan":"","det_array":[]},{"id_tagihan":"TAG2","ket_tagihan":"","id_bidang":"BID_002","id_pembuat":"ORG_002","nm_pembuat":"","jab_pembuat":"","cat_pembuat":"","tgl_pembuatan":"","status_pembuatan":"0","no_nota_intern":"","id_pengaju":"","nm_pengaju":"","jab_pengaju":"","cat_pengaju":"","tgl_pengajuan":"","status_pengajuan":"0","id_kakanwil":"","nm_kakanwil":"","jab_kakanwil":"","cat_kakanwil":"","tgl_disposisi_kakanwil":"","status_approval_kakanwil":"0","id_minkeu":"","nm_minkeu":"","jab_minkeu":"","cat_minkeu":"","tgl_disposisi_minkeu":"","status_approval_minkeu":"0","id_verifikator":"","nm_verifikator":"","jab_verifikator":"","cat_verifikator":"","tgl_verifikasi":"","kesesuaian_data":"0","kesesuaian_perhitungan":"0","status_verifikasi":"0","no_verifikasi":"","id_bag_keu":"","nm_bag_keu":"","jab_bag_keu":"","cat_bag_keu":"","tgl_bayar":"","status_approval_bagkeu":"0","no_bukti_pembayaran":"","status_tagihan":"","det_array":[]}]';


$obj = json_decode($json,true);

//jsonToSql($rec,$tblName,$keyValues,$excluded)

//$tes=$obj['id_tagihan'];
$keyValues=array("id_tagihan"=>"TAG_[id_bidang]_[id_pembuat]_TIMESTAMP_<DIGIT>5</DIGIT>");
$excluded=array("jab_pembuat","det_array");
$result=jsonToSql($obj,"jimi",$keyValues,$excluded,$conn);
echo($result[0]);
//echo($result[1][1][0]);

echo("<br/><br/>");
//echo(password_hash("bulogkeuangan", PASSWORD_DEFAULT));

$conn->close();
?>
