<?php
    error_reporting(E_ALL ^ E_NOTICE);
    date_default_timezone_set("Asia/Ujung_Pandang");
    include '../../db/connection.php';
 
    // Create connection
    $conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);
    
    if ($conn->connect_error) {
    
        die("Connection failed: " . $conn->connect_error);
    }

    function string_between_two_string($str, $starting_word, $ending_word){
        $subtring_start = strpos($str, $starting_word);
        //Adding the strating index of the strating word to 
        //its length would give its ending index
        $subtring_start += strlen($starting_word);  
        //Length of our required sub string
        $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;  
        // Return the substring from the index substring_start of length size 
        return substr($str, $subtring_start, $size);  
    }

    function jsonToSql($recs,$tblName,$keyValues,$excluded,$conn){
        $index=0;
        $timestamp=date_create()->format('YmdHis');
        $prefix="";
        $ret="";
        $result=array();
        $resKeys=array();
        foreach($recs as $rec){
            foreach ($excluded as $field) {
                unset($rec[$field]);
            }
            if($index==0){
                $prefix="REPLACE INTO ".$tblName."(".implode(",",array_keys($rec)).")";
            }
            $primKeys=array();
            foreach ($keyValues as $key=>$value) {
                foreach ($rec as $recKey=>$recValue) {
                    $value=str_replace("[".$recKey."]",$recValue,$value);
                }
                $value=str_replace("TIMESTAMP",$timestamp,$value);
                $valBU=preg_replace("/<DIGIT>(?s)(.*)<\/DIGIT>/i", "", $value);
                $digit=string_between_two_string($value, "<DIGIT>", "</DIGIT>");
                $sqlTmp="SELECT ".$key." FROM ".$tblName." WHERE ".$key." LIKE '".$valBU."%' ORDER BY ".$key." desc LIMIT 1";
                $newInd=$index+1;
                //echo($HostUser);
                //$conn2 = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);
                $resTmp = $conn->query($sqlTmp);
                if ($resTmp->num_rows >0) {
                    while($r = $resTmp->fetch_assoc()) {
                        //echo $row[0]['nm_pegawai'];
                        $v=$r[$key];
                        $newInd=str_replace($valBU,"",$v)+$index+1;
                        break;
                     }
                }else{$index--;}
                $value=preg_replace("/<DIGIT>(?s)(.*)<\/DIGIT>/i", str_pad($newInd, $digit, '0', STR_PAD_LEFT), $value);
                
                if($rec[$key]==""){
                    $rec[$key]=$value;
                    array_push($primKeys,$value);
                }else{
                    array_push($primKeys,$rec[$key]);
                }
            }
            if($ret==""){
                $ret="VALUES('".implode("','",$rec)."')";
            }else{
                $ret.=", ('".implode("','",$rec)."')";
            }
            array_push($resKeys,$primKeys);
            $index++;
        }
        $ret=$prefix ." ". $ret;
        array_push($result,$ret,$resKeys);
        return $result;
    }
?>