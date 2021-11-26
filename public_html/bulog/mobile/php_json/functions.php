<?
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

    function jsonToSql($recs,$tblName,$keyValues,$excluded){
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
                $value=str_replace("TIMESTAMP",$timestamp,$value);
                $value=preg_replace("/<DIGIT>(?s)(.*)<\/DIGIT>/i", str_pad($index+1, string_between_two_string($value, "<DIGIT>", "</DIGIT>"), '0', STR_PAD_LEFT), $value);
                foreach ($rec as $recKey=>$recValue) {
                    $value=str_replace("[".$recKey."]",$recValue,$value);
                }
                array_push($primKeys,$value);
                $rec[$key]=$value;
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