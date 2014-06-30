<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Validate
{
	
    function is_numeric($amount) {
        
         if(is_numeric($amount)){
           list($nu,$de) = explode('.',$amount);
           return (strlen($de) < 3 || isset($de)) ? TRUE : FALSE;
         }else{
           return FALSE;
         }
        
    }
    
    function is_validdate($date) {
        
        if (ereg("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $date)) {
            $arr = split("-", $date);
            $yyyy = $arr[0];
            $mm = $arr[1];
            $dd = $arr[2];
            if (is_numeric($yyyy) && is_numeric($mm) && is_numeric($dd)) {
                return checkdate($mm, $dd, $yyyy);
            } else {
                return false;
            }
        } else {
            return false;
        }
        
    }
    
    function string_validate($string,$length)  {
        
        return (strlen($string)>=$length) ? TRUE : FALSE;
        
    }
    
    function in_array_r($needle, $haystack) {
        $found = false;
        foreach ($haystack as $item) {
        if ($item === $needle) { 
                $found = true; 
                break; 
            } elseif (is_array($item)) {
                $found = $this->in_array_r($needle, $item); 
                if($found) { 
                    break; 
                } 
            }    
        }
        return $found;
    }
    
    function construct_validationreport($data) {
        
        echo "<div class='report_wrap'>";
        
        echo "<table class='validation_report'>";
        echo "<tr>";
        echo "<th>Line</th>";
        
            $titleExtract = $data[1]; // Extract array from 1st column to create table
            
            //Construct Headers
            foreach($titleExtract as $key => $value) {
                    echo "<th>".$key."</th>";
            }
        
        echo "</tr>";
        //Extract Report
        
            foreach($data as $key=>$value) {
                //print_array($value);
                if($this->in_array_r('ERR',$value)) { $trclass='error'; } else { $trclass='success'; }
                
                echo "<tr class='".$trclass."'>";
                
                    echo "<td>".$key."</td>";
                    
                    foreach($value as $msg) {
                        
                        if($msg['valid']=='ERR') { 
                            
                            echo '<td class="error" onclick="throwMsg(\''.addslashes($msg['msg']).'\');">'.$msg['valid'].'</td>';
                        } else { 
                            
                            echo "<td class='success'>".$msg['valid']."</td>";
                           
                        } 
                        
                        
                    }
                
                echo "</tr>";
                
                
            }
        
        echo "</table>";
        echo "</div>";
        
        
        
    }

    
}

?>