<?php
include 'functions.php';

$res=$_GET['res'];
$pg=$_GET['pg'];
$bid=$_GET['bid'];
$person=$_GET['person'];
$fungsi=$_GET['fungsi'];
 
$sql ="select qTag.*, ref_bidang.nm_bidang
FROM
(SELECT 
	tbl_tagihan.*,
    qGroup.ketdet,
    qGroup.total
FROM tbl_tagihan
JOIN 
	(select 
        qDet.id_tagihan,
        GROUP_CONCAT(qDet.ketdet SEPARATOR '\n')ketdet,
        SUM(qDet.subtotal)total
    FROM
    (SELECT 
        tbl_tagihan.id_tagihan,
        tbldet_item_tagihan.id_det_item,
        concat(tbl_item.nm_item,' (',tbldet_item_tagihan.qty,' ',tbl_item.satuan,')')ketdet,
        (tbldet_item_tagihan.qty*tbldet_item_tagihan.harga)subtotal
    FROM tbl_tagihan,tbldet_item_tagihan,tbl_item
    WHERE (tbl_tagihan.id_tagihan=tbldet_item_tagihan.id_tagihan AND tbldet_item_tagihan.id_item=tbl_item.id_item))qDet
    GROUP BY id_tagihan)qGroup
ON(tbl_tagihan.id_tagihan=qGroup.id_tagihan))qTag
JOIN ref_bidang ON(qTag.id_bidang=ref_bidang.id_bidang)
WHERE (qTag.status_tagihan='COMPLETED' OR qTag.status_tagihan='FAILED')
AND ((";

if($fungsi=="FUNGSI_001"){
    $sql.="qTag.id_pembuat='".$person."'";
}else if($fungsi=="FUNGSI_002"){
    $sql.="qTag.id_bidang='".$bid."'";
}else{
    $sql.="1";
}
$sql.=") OR (";

if($fungsi=="FUNGSI_001"){
    $sql.="qTag.id_pembuat='".$person."'";
}else if($fungsi=="FUNGSI_002"){
    $sql.="qTag.id_pengaju='".$person."'";
}else if($fungsi=="FUNGSI_003"){
    $sql.="qTag.id_kakanwil='".$person."'";
}else if($fungsi=="FUNGSI_004"){
    $sql.="qTag.id_minkeu='".$person."'";
}else if($fungsi=="FUNGSI_005"){
    $sql.="qTag.id_verifikator='".$person."'";
}else{
    $sql.="qTag.id_bag_keu='".$person."'";
}
$sql.="))";

$sql.=" ORDER BY tgl_pembuatan DESC limit ".$res." offset ".($pg-1)*$res;
 
//echo($sql);

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
