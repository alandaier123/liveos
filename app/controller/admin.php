<?php

/*
 * 对没有绑定手机的用户弹框提醒
 */

class admin_controller extends controller {

   
    	public  function index(){

            $html = view::make('index');

            ECHO $html;
        

        }
    
    	public  function login(){

    		if(isset($_POST['action']) &&  $_POST['action'] == 'login'){

    			debug::p($_POST);

    			
    		}else{

	            $html = view::make('admin/login');

            	ECHO $html;

    		}

        
        }
    	public function signin(){
    		


    	}

      	public  function vcode(){

      		return authcode_lib::vcode();
        	
        }




}
