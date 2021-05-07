<?php

/*
 * 
 */

class test_controller{

   
    public  function index(){

       //$order = new order_lib(1);
       //$data = apcu_add('test', 150);
       //var_dump($data);

       //phpinfo();

    }
    public function gettest(){
    	$data = apcu_cache_info();
    	var_dump($data);
    }
    public function clear(){
      $data = apcu_clear_cache(); 
      var_dump($data);
    }


    
    
    

  
}
