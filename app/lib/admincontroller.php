<?php

class admincontroller_lib extends controller{


        function __construct() {

            parent::__construct();          
            if (!ini_get("session.auto_start")) {
                
                session_lib::setsession(); 
            }    
                      
           
        }

    

}