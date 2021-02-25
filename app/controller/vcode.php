<?php

/*
 * 对没有绑定手机的用户弹框提醒
 */

class vcode_controller extends controller {

   		function __construct(){
   			parent::__construct();
		    if (!ini_get("session.auto_start")) {
                
                session_lib::setsession(); 
            } 
   		}


    	

      	public  function index(){
            
            authcode_lib::vcode();
        	
        }

        public  function login(){

            
    		if(isset($_POST['action']) &&  $_POST['action'] == 'login'){

                if(!authcode_lib::verify_code($_POST['token'],'admin_tologin',2)){
                    return response::jsonp(5,'token 验证失败'); 
                }

        		if(authcode_lib::verify_code($_POST['code'])){

                    $name = $_POST['name'] = trim( $_POST['name']);
                    $pass = $_POST['pass'] = trim( $_POST['pass']);

                    db::loadconfig('liveos');
                    $sql = 'select * from ay_admin where name = \''.$name.'\' order by id';
                    $user = db::getone($sql);

                    if($user){
                        

                        if( $user['off'] < 1  ){
                            return response::jsonp(4,'账号停用'); 
                        }

                        $encode = encryption_lib::encode($pass);
                        
                        if($encode==$user['pass']){
                            /*验证ip处理*/

                            $this->verify_ip();

                            $_SESSION['_eid'] = $user['id'];
                            admin_controller::adminlog(0);
                            return response::jsonp(0,'验证通过');
                        }
                        
                        return response::jsonp(3,'密码错误');                        

                    }
                        return response::jsonp(2,'用户不存在');                                                                 
                    
                }
                return  response::jsonp(1,'验证码错误');        
                   			
    		}

    		return  response::jsonp(6,'没有权限');
        
        }

        public function verify_ip(){
            //            $DLIP = $Mem -> g( 'adminlogin/'. $USER['id'] );

            // if( $DLIP !=  $IP && $USER['yanzhengip'] == 1 ){

            //        adminlog($USER['id'],2,serialize($DLIP));
            //        session_destroy();
            //        msgbox($LANG['tuichu'].$LANG['chenggong'],'?');
            // }
        }    

  
}
