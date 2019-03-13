<?php
public function  cleanData($data){
        $data = trim($data);
        $data = strip_tags($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        //$data = mysqli_real_escape_string($this->conn,$data);
        // $data = BlockSQLInjection ($data);
        return $data;

    }
   
    public function dmy($day2convert){
        $timestamp = strtotime($day2convert);
        $dmy = date("d-M-Y", $timestamp);
        return$dmy;
    }
    
    public function month($date){
       $month =  date("M", strtotime($date));
       return $month;
    }
   
    public function url($id,$title){
      $url =   $id."_".implode("-",explode(' ',$title));
      return $url;
    }
    public function percent($get,$total){
        $percent =$get/$total;
        $percent = floor($percent*100);
        return $percent;
    }
    public function alt($title){
      $alt = explode(" ",$title);
      $alt = implode("-",$alt);
      return $alt;
    }
   
    public function auto_copyright($year = 'auto'){
    	if(intval($year) == 'auto')
    		{ $year = date('Y'); }
    	if(intval($year) == date('Y'))
    		{ echo intval($year); }
    	if(intval($year) < date('Y'))
    		{ echo intval($year) . ' - ' . date('Y'); }
    	if(intval($year) > date('Y'))
    		{ echo date('Y'); }
    }

?>
