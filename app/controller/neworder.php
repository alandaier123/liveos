<?php

/*
 * 
 */

class neworder_controller{

   
 	public function test(){
 		echo $_SERVER['HTTP_HOST'];
 	}
    
     public function getNewOrderId()
    {
        list($msec, $sec) = explode(' ', microtime());
        $msectime = number_format((floatval($msec) + floatval($sec)) * 1000, 0, '', '');
        $orderId = 'DC' . $msectime . mt_rand(10000, max(intval($msec * 10000) + 10000, 98369));
        echo $orderId;
    }

  
}
