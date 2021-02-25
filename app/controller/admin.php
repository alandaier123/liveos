<?php

/*
 * 对没有绑定手机的用户弹框提醒
 */

class admin_controller extends controller {

        public $tokenkey = null;
        public static $lang     = null;
        function __construct(){
            parent::__construct();
            self::$lang = config::load('lang/china',false);
            if (!ini_get("session.auto_start")) {
                
                session_lib::setsession(); 
            }
            
            
            if(!isset($_SESSION['_eid']) || $_SESSION['_eid']<1){
                $this->tologin(); 
                
            }
            dba_lib::loadconfig('liveos'); 
        }
        /*
        
        $type 0 登陆 1增加用户 2编辑用户 3删除用户 4退出       
         */
        public static function adminlog($type=0){
        
            $data['type']  = $type;
            $data['atime'] = time();
            $data['ip'] = help_lib::ip();
            $data['uid'] = $_SESSION['_eid'];

            dba_lib::insert('ay_adminlog',$data);

        }
        public function tokenkey(){
             $this->$tokenkey = router::get_controller().'_'.router::get_action();
        }
    
    	public  function index(){
            $this->tokenkey();
            $data['action'] = self::$lang[$this->$tokenkey];

            $html = frame_lib::admin('admin/index',$data);
            
            ECHO $html;
        

        }

        public function body(){


            $html = frame_lib::admin('/admin/body');

            ECHO $html;
        }
        public function quite(){
                //标识退出的 是哪个管理员 待处理
                //日志记录  待处理
                //adminlog($USER['id'],1);
                admin_controller::adminlog(4);
                session_destroy();
                response::jsonp(0,'退出成功');         

 
        }

        public function tologin(){

            if(isset($_SESSION['_eid']) && $_SESSION['_eid']>=1){
                return $this->index();
            }
            //$this->tokenkey();  因为重定向，入口不同可能存在key不同，
            $data['token'] =  authcode_lib::token('admin_tologin');
            
            $html = view::make('admin/login',$data);

            ECHO $html;

            exit(0);
        }










}
