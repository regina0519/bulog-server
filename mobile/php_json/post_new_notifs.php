<?php
include 'functions.php';
$json = file_get_contents('php://input');
//$json='[{"id_notifikasi":"","id_pegawai":"087408754","id_tagihan":"TAG_BIDANG_003_20211209194227_0001","notif_title":"Tagihan selesai","notif_desc":"NI-008/18020/KU.04.02/12/2021 telah selesai diproses.","sent":"0","tgl_kirim":"2021-12-11 23:31:46","seen":"0"},{"id_notifikasi":"","id_pegawai":"087408748","id_tagihan":"TAG_BIDANG_003_20211209194227_0001","notif_title":"Tagihan selesai","notif_desc":"NI-008/18020/KU.04.02/12/2021 telah selesai diproses.","sent":"0","tgl_kirim":"2021-12-11 23:31:46","seen":"0"},{"id_notifikasi":"","id_pegawai":"087408749","id_tagihan":"TAG_BIDANG_003_20211209194227_0001","notif_title":"Tagihan selesai","notif_desc":"NI-008/18020/KU.04.02/12/2021 telah selesai diproses.","sent":"0","tgl_kirim":"2021-12-11 23:31:46","seen":"0"},{"id_notifikasi":"","id_pegawai":"087408752","id_tagihan":"TAG_BIDANG_003_20211209194227_0001","notif_title":"Tagihan selesai","notif_desc":"NI-008/18020/KU.04.02/12/2021 telah selesai diproses.","sent":"0","tgl_kirim":"2021-12-11 23:31:46","seen":"0"},{"id_notifikasi":"","id_pegawai":"087408756","id_tagihan":"TAG_BIDANG_003_20211209194227_0001","notif_title":"Tagihan selesai","notif_desc":"NI-008/18020/KU.04.02/12/2021 telah selesai diproses.","sent":"0","tgl_kirim":"2021-12-11 23:31:46","seen":"0"}]';
$obj = json_decode($json,true);

$keyValues=array("id_notifikasi"=>"NOTIF_[id_pegawai]_[id_tagihan]_TIMESTAMP_<DIGIT>5</DIGIT>");
$excluded=null;
$result=jsonToSql($obj,"tbl_notifikasi",$keyValues,$excluded,$conn);
//echo($result[0]);


if ($conn->query($result[0]) === TRUE) {
    $msg = array('succeed' => '1', 'error' => '');
} else {
    $msg = array('succeed' => '0', 'error' => $conn->error);
}

$res[]=$msg;
echo json_encode($res);

$conn->close();
?>
