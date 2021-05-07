<?php

/*
 * 
 */

class order_controller{

    static $orderobj = null;

    public function __construct(){
        if (!ini_get("session.auto_start")) {
                
                session_lib::setsession(); 
        }
        if(!isset($_SESSION['uid']) || $_SESSION['uid']<1){
                $_SESSION['uid'] = rand(1000,9999);                 
        }

        self::$orderobj = new order_lib(1,$_SESSION['uid']);
            
    } 
    public  function index(){

       //var_dump($_SESSION['uid']);

       
       $data = self::$orderobj->index();
       echo $data ;

    }
    public function redisinit(){
    	
       $data = self::$orderobj->redisinit();
       echo $data ;
    }
    public function apcuinit(){
       
       $data = self::$orderobj->apcuinit();
       echo $data ;
    }
    public function ordertest(){
       
       
       $response = self::$orderobj->create();
       echo $response ;
    }

    public function selecttest(){
       
       
       $response = self::$orderobj->getstock();
    }

    public function apcuclear(){
       
       $response = self::$orderobj->apcuclear();
       var_dump($response);
    }

    public function getorderquene(){

       $response = self::$orderobj->getorderquene();
       debug::p($response);
    }
      
}
    

    
    
    
    

  

