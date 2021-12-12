<?php
include 'functions.php';
setlocale(LC_ALL, 'id_ID');
$bid=$_GET['bid'];
$t0=$_GET['t0'];
$t1=$_GET['t1'];
if($bid=="all")$bid="";
 
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
WHERE status_tagihan='COMPLETED' AND (";

$tmp="";
if($bid!=""){
    $tmp="qTag.id_bidang='".$bid."'"; 
}
if($t0!=""){
    if($tmp==""){
        $tmp="tgl_bayar>='".$t0."'"; 
    }else{
        $tmp.=" AND tgl_bayar>='".$t0."'"; 
    }
}
if($t1!=""){
    if($tmp==""){
        $tmp="tgl_bayar<='".$t1."'"; 
    }else{
        $tmp.=" AND tgl_bayar<='".$t1."'"; 
    }
}
if($tmp==""){
    $sql.="1)";
}else{
    $sql.=$tmp.")";
}
$sql.=" ORDER BY tgl_bayar ASC";

$periode="";
if($t0==""){
    if($t1==""){
        $periode="";
    }else{
        $periode="Periode: s/d ".strftime("%d %B %Y", strtotime($t1));
    }
}else{
    if($t1==""){
        $periode="Periode: ".strftime("%d %B %Y", strtotime($t0))." s/d sekarang";
    }else{
        $periode="Periode: ".strftime("%d %B %Y", strtotime($t0))." s/d ".strftime("%d %B %Y", strtotime($t1));
    }
}
 
//echo($sql);
$result = $conn->query($sql);
 
if ($result->num_rows >0) {

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Intern</title>
    <style>
        table, th, td {
            vertical-align: text-top;
        }
        #detail table, #detail th, #detail td{
            border: 1px solid black;
            border-collapse: collapse;
            padding:5px;
        }
        p{
          text-align:justify;
        }
        
    }

    </style>
</head>
<body>
    <div id="content">
        <div style="display:flex; flex-direction: row; justify-content: flex-start; align-items:center">
            <img src="https://reginamondow.skom.id/bulog/mobile/images/favicon.png"/>
            <h1 style="color:#428BCA; padding:10px">BULOG</h1>
        </div>
        <div style="font-weight:bold; font-size:100%">WILAYAH: SULAWESI UTARA DAN GORONTALO</div>
        <br>
        
      <div style="text-align:center;font-weight:bold; font-size:150%">REKAPITULASI PEMBAYARAN KAS MANAJEMEN</div>
      <?php
        if($bid!=""){
            $sqlBid="SELECT nm_bidang FROM ref_bidang WHERE id_bidang='".$bid."'";
            $resultBid = $conn->query($sqlBid); 
            if ($resultBid->num_rows >0) {
                $rBid = $resultBid->fetch_assoc();
                ?>
      <div style="text-align:center;font-weight:bold"><?php echo(strtoupper("Bidang ".$rBid["nm_bidang"])) ?></div>          
                <?php
            }
        }
      ?>
      <div style="text-align:center;font-weight:bold"><?php echo($periode) ?></div>
      <br>
      
      <div id="detail" align="center">
            <table>
                <thead id="tblItemHead">
                    <tr>
                    <th scope=col>No</th>
                    <th scope=col>Tanggal</th>
                    <th scope=col>Perihal</th>
                    <th scope=col>Uraian</th>
                    <th scope=col>Jumlah (Rp)</th>
                    <th scope=col>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $urt=1;
                    $tot=0;
                    while($r = $result->fetch_assoc()) {
                        $tot+=$r["total"];
                        ?>
                        <tr>
                            <td style="text-align:right"><?php echo($urt++) ?></td>
                            <td><?php echo(strftime("%d %B %Y", strtotime($r["tgl_bayar"]))) ?></td>
                            <td><?php echo($r["ket_tagihan"]) ?></td>
                            <td><?php echo(nl2br(stringTruncateIndo($r["ketdet"],2,"\n","item"))) ?></td>
                            <td style="text-align:right"><?php echo(number_format($r["total"], 2, '.', ',')) ?></td>
                            <td>Bidang <?php echo($r["nm_bidang"]) ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr style="font-weight:bold">
                        <td colspan=4 style="text-align:right">TOTAL</td>
                        <td style="text-align:right"><?php echo(number_format($tot, 2, '.', ',')) ?></td>
                        <td>&nbsp</td>
                    </tr>
                </tbody>
            </table>
      </div>
      
      <br><br>
      <?php
        $sqlMinku="SELECT tbl_pegawai.*, ref_jabatan.id_fungsi, ref_jabatan.nm_jab
        FROM tbl_pegawai JOIN ref_jabatan ON tbl_pegawai.id_jab=ref_jabatan.id_jab
        WHERE id_fungsi='FUNGSI_004'";
        $resultMinku = $conn->query($sqlMinku); 
        if ($resultMinku->num_rows >0) {
            $rMinku = $resultMinku->fetch_assoc();
            $jabMinku=$rMinku["nm_jab"];
            $nmMinku=$rMinku["nm_pegawai"];
        }
      ?>
      <div align="center" style="page-break-inside: avoid; page-break-after: avoid">
          <table style="width:100%">
                    <tr>
                        <td style="width:50%">&nbsp</td>
                        <td style="text-align:center;width:50%">Manado, <?php echo(strftime("%d %B %Y", strtotime(date("Y-m-d H:i:s")))) ?></td>
                    </tr>
                <tr>
                <td>&nbsp</td>
                  <td>
                    <p  style="text-align:center"><?php echo($jabMinku); ?></p>
                    <p>&nbsp</p>
                    <p>&nbsp</p>
                    <p  style="text-align:center"><span style="font-weight:bold"><?php echo($nmMinku); ?></p>
                  </td>
              </tr>
          </table>
      </div>

    </div>
</body>
</html>






<?php 
 
} else {
 echo "Tidak ada data";
}

$conn->close();
?>

