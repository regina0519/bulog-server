<?php
    //error_reporting(E_ALL ^ E_NOTICE);
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

    function stringTruncateIndo($str, $min, $char, $name) {
        $arr = explode($char,$str);
        if (count($arr) <= $min + 1) return $str;
        $ret = "";
        for ($i = 0; $i < $min; $i++) {
            $ret .= $arr[$i];
            if ($i < $min - 1) $ret .= $char;
        }
        $ret .= "," . $char . "dan " . (count($arr) - $min) . " " . $name . " lainnya";
        return $ret;
    }


    function konversi($x){
  
        $x = abs($x);
        $angka = array ("","satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        
        if($x < 12){
         $temp = " ".$angka[$x];
        }else if($x<20){
         $temp = konversi($x - 10)." belas";
        }else if ($x<100){
         $temp = konversi($x/10)." puluh". konversi($x%10);
        }else if($x<200){
         $temp = " seratus".konversi($x-100);
        }else if($x<1000){
         $temp = konversi($x/100)." ratus".konversi($x%100);   
        }else if($x<2000){
         $temp = " seribu".konversi($x-1000);
        }else if($x<1000000){
         $temp = konversi($x/1000)." ribu".konversi($x%1000);   
        }else if($x<1000000000){
         $temp = konversi($x/1000000)." juta".konversi($x%1000000);
        }else if($x<1000000000000){
         $temp = konversi($x/1000000000)." milyar".konversi($x%1000000000);
        }
        
        return $temp;
       }
        
       function tkoma($x){
        $str = stristr($x,".");
        $ex = explode('.',$x);
        
        if(($ex[1]/10) >= 1){
         $a = abs($ex[1]);
        }
        $string = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan",   "sembilan","sepuluh", "sebelas");
        $temp = "";
       
        $a2 = $ex[1]/10;
        $pjg = strlen($str);
        $i =1;
          
        
        if($a>=1 && $a< 12){   
         $temp .= " ".$string[$a];
        }else if($a>12 && $a < 20){   
         $temp .= konversi($a - 10)." belas";
        }else if ($a>20 && $a<100){   
         $temp .= konversi($a / 10)." ". konversi($a % 10);
        }else{
         if($a2<1){
          
          while ($i<$pjg){     
           $char = substr($str,$i,1);     
           $i++;
           $temp .= " ".$string[$char];
          }
         }
        }  
        return $temp;
       }
       
       function terbilang($x){
        if($x<0){
         $hasil = "minus ".trim(konversi(x));
        }else{
         $poin = trim(tkoma($x));
         $hasil = trim(konversi($x));
        }
        
      if($poin){
         $hasil = $hasil." koma ".$poin;
        }else{
         $hasil = $hasil;
        }
        return $hasil;  
       }
    
?>