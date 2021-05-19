<?php

class Utilities 
{
    //Pritty Print
    public function pp($mixed, $die = true){
			echo "<pre>";
			print_r($mixed);echo "</pre>";
			$backtrack = debug_backtrace();
			$line = "<b>".$backtrack[0]['file']. "</b> at line number <b> {$backtrack[0]['line']}</b> by pp function";
			if ($die) die($line); 
			else echo $line;
		}
  
    
}
