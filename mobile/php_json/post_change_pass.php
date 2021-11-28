<?php
include 'functions.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$user=$obj['user'];
$pass=$obj['pass'];
$passNew=$obj['pass_new'];

$tmp=password_hash($passNew, PASSWORD_DEFAULT);
//echo $tmp."\n";
 
$sql = "SELECT * from tbl_pegawai WHERE id_pegawai='".$user."' and aktif='1'";
//echo($sql);
 
$result = $conn->query($sql);

$go=false;

if ($result->num_rows >0) {
    while($r = $result->fetch_assoc()) {
        //echo $row[0]['nm_pegawai'];
        if(password_verify($pass, $r["password"])){
            $go=true;
            break;
        }
     }
    
}

if($go){
    $sqlUpd="UPDATE tbl_pegawai SET password='".$tmp."' WHERE id_pegawai='".$user."'";
    if ($conn->query($sqlUpd) === TRUE) {
        $msg = array('succeed' => '1', 'error' => '');
    } else {
        $msg = array('succeed' => '0', 'error' => $conn->error);
    }
}else{
    $msg = array('succeed' => '0', 'error' => 'User ID/Password salah');
}
    
$res[]=$msg;
echo json_encode($res);

$conn->close();
?>