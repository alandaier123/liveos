<?php

/*
 * 对没有绑定手机的用户弹框提醒
 */

class admin_controller extends controller {


        function __construct() {

            parent::__construct();          
            if (!ini_get("session.auto_start")) {
                
                session_lib::setsession(); 
            }    
                      
                        
        }
        
        private function frame($body ='', $params = []){
            $html = '';
            $html .= view::make('admin/frame/header');
            $html .= view::make('admin/frame/aside'); 
            $html .= view::make($body,$params);
            $html .= view::make('admin/frame/footer'); 
            
            return $html;

        }
    	public  function index(){
            if(!isset($_SESSION['_eid']) || $_SESSION['_eid']<1){
                return $this->login();
            }
            //权限验证并生成，用户表存储用户菜单权限

            $html = view::make('admin/index');
            
            ECHO $html;
        

        }

        public function body(){



            $html = $this->frame('/admin/body');

            ECHO $html;
        }
        public function quite(){
                //标识退出的 是哪个管理员 待处理
                //日志记录  待处理
                //adminlog($USER['id'],1);
                session_destroy();
                response::jsonp(0,'退出成功');

            

 
        }
    	public  function login(){

            if(isset($_SESSION['_eid']) && $_SESSION['_eid']>=1){
                return $this->index();
            }

    		if(isset($_POST['action']) &&  $_POST['action'] == 'login'){


        		if(authcode_lib::verify_code($_POST['code'])){

                    $name = $_POST['name'] = trim( $_POST['name']);
                    $pass = $_POST['pass'] = trim( $_POST['pass']);

                    db::loadconfig('zhibo');
                    $sql = 'select * from zb_admin where name = \''.$name.'\' order by id';
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
                            return response::jsonp(0,'验证通过');
                        }
                        
                        return response::jsonp(3,'密码错误');                        

                    }
                        return response::jsonp(2,'用户不存在');                                                                 
                    
                }
                return  response::jsonp(1,'验证码错误');        
                   			
    		}

            $html = view::make('admin/login');

        	ECHO $html;

    		

        
        }
        public function verify_ip(){
            //            $DLIP = $Mem -> g( 'adminlogin/'. $USER['id'] );

            // if( $DLIP !=  $IP && $USER['yanzhengip'] == 1 ){

            //        adminlog($USER['id'],2,serialize($DLIP));
            //        session_destroy();
            //        msgbox($LANG['tuichu'].$LANG['chenggong'],'?');
            // }
        }

      	public  function vcode(){
            
            authcode_lib::vcode();
        	
        }

        public function admin(){
             $html = view::make('admin/admin');

            ECHO $html;
        }
        public function adminadd(){

            $html = view::make('admin/adminadd');

            ECHO $html;


        }




}
