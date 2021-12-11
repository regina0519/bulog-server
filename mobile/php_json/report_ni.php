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
            border: 1px solid black;
            border-collapse: collapse;
            padding:5px;
        }
        .HeadKet{
          align-items:center;
          border-bottom: 3px solid black;
        }
        .HeadKet table,.HeadKet th, .HeadKet td {
            border:0px;
        }
        p{
          text-align:justify;
        }
        
    }

    </style>
</head>
<body>
    <div id="content">
      <div style="text-align:center;font-weight:bold; font-size:150%">NOTA INTERN</div>
      <div style="text-align:center;font-weight:bold">Nomor: <?php echo($r["no_nota_intern"]) ?></div>
      <br>
      <div class="HeadKet" align="center">
        <table>
            <tr>
              <td>Kepada Yth</td>
              <td>:</td>
              <td>Pemimpin Wilayah Sulut dan Gorontalo</td>
            </tr>
            <tr>
              <td>Dari</td>
              <td>:</td>
              <td><?php echo($r["jab_pengaju"]) ?> Kanwil Sulut dan Gorontalo</td>
            </tr>
            <tr>
              <td>Perihal</td>
              <td>:</td>
              <td><?php echo($r["ket_tagihan"]) ?></td>
            </tr>
        </table>
      </div>
      
      <p>Dengan hormat,</p>
      <p>Mohon persetujuan pembayaran dari manajemen perusahaan untuk <?php echo($r["ket_tagihan"]) ?> senilai <span style="font-weight:bold">Rp. <?php echo(number_format($r["total"], 2, '.', ',')) ?></span> (<?php echo(terbilang($r["total"])) ?> rupiah)</p>
      <p>Dengan Rincian sebagai berikut:</p>


      <div align="center">
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

      <p>Demikian disampaikan, terima kasih.</p>

      <div class="HeadKet" align="center" style="border:0px">
        <table style="width:100%">
            <tr style="page-break-inside: avoid; page-break-after: avoid">
              <td style="width:50%; align-items:center">&nbsp</td>
              <td style="width:50%; align-items:center">
                <p  style="text-align:center">Manado, <?php echo(strftime("%d %B %Y", strtotime($r["tgl_pengajuan"]))) ?></p>
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

