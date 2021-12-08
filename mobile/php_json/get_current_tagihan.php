<?php
include 'functions.php';

$id=$_GET['id'];
 
$sql ="SELECT tbl_tagihan.*, ref_bidang.nm_bidang, ref_bidang.kode_bidang FROM tbl_tagihan JOIN ref_bidang ON (tbl_tagihan.id_bidang=ref_bidang.id_bidang) WHERE id_tagihan='".$id."'";

 
$result = $conn->query($sql);
 
if ($result->num_rows >0) {
    $ind=0;
    while($row[] = $result->fetch_assoc()) {
        $sqlDet="SELECT tbldet_item_tagihan.*, tbl_item.nm_item, tbl_item.satuan, tbl_item.harga_patokan, tbl_item.ket_item
FROM tbldet_item_tagihan JOIN tbl_item ON(tbldet_item_tagihan.id_item=tbl_item.id_item) WHERE id_tagihan='".$row[$ind]["id_tagihan"]."'";
        $resultDet = $conn->query($sqlDet); 
        if ($resultDet->num_rows >0) {
            $ind2=0;
            $arrDet=array();
            while($rowDet[] = $resultDet->fetch_assoc()) {
                if($rowDet[$ind2]!=null)array_push($arrDet,$rowDet[$ind2]);
                $ind2++;
            }
            $row[$ind]+=["det_array"=>$arrDet];
        }else{
            echo "No Results Found.";
        }
        $json = json_encode($row);
        $ind++;
    }
} else {
    echo "No Results Found.";
}
echo $json;
$conn->close();
?>
