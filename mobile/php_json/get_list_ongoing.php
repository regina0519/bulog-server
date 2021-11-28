<?php
include 'functions.php';

$res=$_GET['res'];
$pg=$_GET['pg'];
 
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
JOIN ref_bidang ON(qTag.id_bidang=ref_bidang.id_bidang) limit ".$res." offset ".($pg-1)*$res;
 
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
