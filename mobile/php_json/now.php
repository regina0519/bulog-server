<?php
    date_default_timezone_set("Asia/Ujung_Pandang");
    $msg = array('now' => date("Y-m-d H:i:s"));
    $res[]=$msg;
    echo json_encode($res);
?>