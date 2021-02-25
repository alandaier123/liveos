<?php

/*
 * 辅助功能类
 */

class help_lib{

   
  	public static function ip() { 

		$ip1 = getenv("HTTP_CLIENT_IP")?getenv("HTTP_CLIENT_IP"):"none"; 
		$ip2 = getenv("HTTP_X_FORWARDED_FOR")?getenv("HTTP_X_FORWARDED_FOR"):"none"; 
		$ip3 = getenv("REMOTE_ADDR")?getenv("REMOTE_ADDR"):"none"; 
		if (isset($ip1) && $ip1 != "none" && $ip1 != "unknown")
		$ip = $ip1; 
		elseif (isset($ip2) && $ip2 != "none" && $ip2 != "unknown")
		$ip = $ip2; 
		elseif (isset($ip3) && $ip3 != "none" && $ip3 != "unknown")
		$ip = $ip3; 
		else $ip =  $_SERVER['REMOTE_ADDR']; 
	    if( strstr( $ip, ",")){
			 $woqu = explode(',',$ip);
		     $ip = $woqu['0'];
		 }
	    return $ip; 
	} 
	    

    

  
}
