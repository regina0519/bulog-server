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
    </style>
</head>
<body>
    <div style="text-align:center;font-weight:bold; font-size:150%">NOTA INTERN</div>
    <div style="text-align:center;">Nomor: xxx</div>
    <div class="HeadKet" align="center">
      <table>
          <tr>
            <td>Kepada Yth</td>
            <td>:</td>
            <td>XXXxxxxxxxxxx</td>
          </tr>
          <tr>
            <td>Dari</td>
            <td>:</td>
            <td>XXX</td>
          </tr>
          <tr>
            <td>Perihal</td>
            <td>:</td>
            <td>XXX</td>
          </tr>
      </table>
    </div>
    
    <p>Dengan hormat,</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <p>Mohon persetujuan pembayaran dari manajemen perusahaan senilai XXX (XXX)</p>
    <p>Dengan Rincian sebagai berikut:</p>


    <table>
      <colgroup>
      <colgroup SPAN=3>
      <colgroup SPAN=3>
      <thead>
        <tr>
          <th scope=col rowspan=2>No</th>
          <th scope=col rowspan=2>Uraian</th>
          <th scope=col rowspan=2>Jumlah</th>
          <th scope=col rowspan=2>Satuan</th>
          <th scope=colgroup colspan=3>Rendering in Your Browser</th>
        </tr>
        <tr>
          <th scope=col>Entity</th>
          <th scope=col>Decimal</th>
          <th scope=col>Hex</th>
        </tr>
      </thead>
      <tbody>
          <?php 
          for($i=0;$i<=100;$i++){
              echo
              "<tr>
          <td scope=row>non-breaking space</td>
          <td>1111</td>
          <td>2222</td>
          <td>3333</td>
          <td>4444</td>
          <td>5555</td>
          <td>6666</td>
        </tr>";
          } 
        
        ?>
      </tbody>
    </table>

</body>
</html>