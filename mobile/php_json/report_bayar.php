<?php
include 'functions.php';
setlocale(LC_ALL, 'id_ID');
$id=$_GET['id'];

 
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
WHERE qTag.id_tagihan='".$id."'";

 
$result = $conn->query($sql);
 
if ($result->num_rows >0) {
 
 while($r = $result->fetch_assoc()) {
    break;
 }

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
        
      <div style="text-align:center;font-weight:bold; font-size:150%">BUKTI PEMBAYARAN KAS MANAJEMEN</div>
      <div style="text-align:center;font-weight:bold">Nomor: <?php echo($r["no_bukti_pembayaran"]) ?></div>
      <br>
      <table>
          <tr>
              <td>DIBAYAR KEPADA</td>
              <td>:</td>
              <td><?php echo($r["jab_pengaju"]) ?></td>
          </tr>
          <tr style="border:none">
              <td>JUMLAH</td>
              <td>:</td>
              <td>Rp. <?php echo(number_format($r["total"], 2, '.', ',')) ?></td>
          </tr>
          <tr style="border:none">
              <td>TERBILANG</td>
              <td>:</td>
              <td style="border: 1px solid black"><?php echo(terbilang($r["total"])) ?> rupiah</td>
          </tr>
          <tr style="border:none">
              <td>UNTUK PEMBAYARAN</td>
              <td>:</td>
              <td style="border: 1px solid black"><?php echo($r["ket_tagihan"]) ?></td>
          </tr>
          <tr style="border:none">
              <td>DASAR</td>
              <td>:</td>
              <td>
                    <p><?php echo($r["no_nota_intern"]) ?>, Tgl <?php echo(strftime("%d %B %Y", strtotime($r["tgl_pengajuan"]))) ?></p>
                    <p>Verifikasi Nomor: <?php echo($r["no_verifikasi"]) ?>, Tgl <?php echo(strftime("%d %B %Y", strtotime($r["tgl_verifikasi"]))) ?></p>
                </td>
          </tr>
      </table>
      <div id="detail" align="center">
            <table>
                <thead id="tblItemHead">
                    <tr>
                    <th scope=col>No</th>
                    <th scope=col>Uraian</th>
                    <th scope=col>Jumlah</th>
                    <th scope=col>Satuan</th>
                    <th scope=col>Harga Satuan (Rp)</th>
                    <th >Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sqlDet ="SELECT tbldet_item_tagihan.*, tbl_item.nm_item, tbl_item.satuan, (tbldet_item_tagihan.qty*tbldet_item_tagihan.harga)subtotal 
                    FROM tbldet_item_tagihan JOIN tbl_item ON tbldet_item_tagihan.id_item=tbl_item.id_item
                    WHERE id_tagihan='".$r["id_tagihan"]."'";
                    $resultDet = $conn->query($sqlDet);
                    if ($resultDet->num_rows >0) {
                        $urt=1;
                        while($rowDet = $resultDet->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo($urt++) ?></td>
                            <td><?php echo($rowDet["nm_item"]) ?></td>
                            <td style="text-align:right"><?php echo($rowDet["qty"]) ?></td>
                            <td><?php echo($rowDet["satuan"]) ?></td>
                            <td style="text-align:right"><?php echo(number_format($rowDet["harga"], 2, '.', ',')) ?></td>
                            <td style="text-align:right"><?php echo(number_format($rowDet["subtotal"], 2, '.', ',')) ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr style="font-weight:bold">
                            <td colspan=5 style="text-align:right">TOTAL</td>
                            <td style="text-align:right"><?php echo(number_format($r["total"], 2, '.', ',')) ?></td>
                        </tr>
                        <?php
                    } else {
                        echo "No Results Found.";
                    }

                    ?>
                </tbody>
            </table>
      </div>
      <br><br>
      <div align="center" style="page-break-inside: avoid; page-break-after: avoid">
          <table style="width:100%">
                    <tr>
                        <td style="width:25%">&nbsp</td>
                        <td style="width:25%">&nbsp</td>
                        <td style="text-align:center;width:50%" colspan=2>Manado, <?php echo(strftime("%d %B %Y", strtotime($r["tgl_bayar"]))) ?></td>
                    </tr>
                <tr>
                <td>
                    <p  style="text-align:center">MENGETAHUI</p>
                    <p>&nbsp</p>
                    <p>&nbsp</p>
                    <p  style="text-align:center"><span style="text-decoration: underline; font-weight:bold"><?php echo($r["nm_minkeu"]) ?></span><br><?php echo($r["jab_minkeu"]) ?></p>
                  </td>
                  <td>
                    <p  style="text-align:center">DIBUKUKAN OLEH:</p>
                    <p>&nbsp</p>
                    <p>&nbsp</p>
                    <p  style="text-align:center"><span style="text-decoration: underline; font-weight:bold"><?php echo($r["nm_verifikator"]) ?></span><br><?php echo($r["jab_verifikator"]) ?></p>
                  </td>
                  <td>
                    <p  style="text-align:center">DIBAYAR OLEH:</p>
                    <p>&nbsp</p>
                    <p>&nbsp</p>
                    <p  style="text-align:center"><span style="text-decoration: underline; font-weight:bold"><?php echo($r["nm_bag_keu"]) ?></span><br><?php echo($r["jab_bag_keu"]) ?></p>
                  </td>
                  <td>
                    <p  style="text-align:center">DITERIMA OLEH:</p>
                    <p>&nbsp</p>
                    <p>&nbsp</p>
                    <p  style="text-align:center"><span style="text-decoration: underline; font-weight:bold"><?php echo($r["nm_pengaju"]) ?></span><br><?php echo($r["jab_pengaju"]) ?></p>
                  </td>
              </tr>
          </table>
      </div>

    </div>
</body>
</html>






<?php 

 
} else {
 echo "No Results Found.";
}

$conn->close();
?>

