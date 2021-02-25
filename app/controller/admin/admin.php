<?php

/*
 * 对没有绑定手机的用户弹框提醒
 */

class admin_admin_controller extends admin_controller {

		
		function __construct(){
			parent::__construct();
			$this->$tokenkey = 'admin_admin_index';
		}
   

	    public function index(){
	    	//dba_lib::loadconfig('liveos');
	    	$where = $username = '';
	    	if($_GET['username']!=''){
	    		$username = $_GET['username'];
	    		$where    = 'where name like \'%'.$_GET['username'].'%\'';
	    	}
	    	
	    	$sql = 'select * from ay_admin '.$where.' order by id';
	    	$data['ad_user_info'] = dba_lib::query($sql);
	    	$data['username'] 	  = $username;
	    	$data['token']  = authcode_lib::token($this->$tokenkey);
	    	$data['action'] = self::$lang[$this->$tokenkey];
	    	$data['token_key'] = $this->$tokenkey;
	    	//debug::p($data);die;
	        $html = frame_lib::admin('/admin/admin',$data);
	        ECHO $html;
	    }   

	    public function dodel(){
	    	if(isset($_GET['action'])&& $_GET['action'] =='del' ){
	    		//return response::jsonp(6,$this->$tokenkey);
	    		$data = [];
	    		if(!authcode_lib::verify_code($_GET['token'],$this->$tokenkey,2)){
	    			$data['token']  = authcode_lib::token($this->$tokenkey);
	        		return response::jsonp(5,'token 验证失败',$data); 
	        	}
	    		if($_GET['id'] > 0){
	    			$code = 1;
	    			$msg  = '删除失败！';
	    			$data['token']  = authcode_lib::token($this->$tokenkey);
	    			$sql = 'delete from ay_admin where id = '.$_GET['id'];
	    			$res = dba_lib::query($sql,null,1);
	    			if($res ){
	    				admin_controller::adminlog(3);
	    				$data['res'] 	= $res;
	    				$code = 0;
	    				$msg  = '删除成功!'; 
	    			}	
	    			return response::jsonp($code,$msg,$data);
	    		}
	    	}
	    	return response::jsonp(1,'参数错误！！！');
	        
	    }
	    /*
	    从add 中重定向过来  已token验证
	     */
	    public function doedit(){
	    	if($_POST['name']=='' ){
                	return response::jsonp(1,'用户名不能为空！');
            }
				$data = array();
			    if($_POST['epass']!=''){
			  	 	$data['epass'] = encryption_lib::encode( $_POST['epass']);
			    }
			    if($_POST['pass']!=''){
			   		$data['pass'] = encryption_lib::encode( $_POST['pass']);	 	
			    }

			    $data['name'] = $_POST['name'];
			    $data['off'] = (isset( $_POST['off'])&&$_POST['off']== 1) ? 1 : 0;	
			    $data['yanzhengip'] = (isset( $_POST['yanzhengip'])&&$_POST['yanzhengip']==1) ? 1 : 0;
			    $data['type']  = 0;
			    $data['atime'] = time();
			    $data['ip'] = help_lib::ip();
	    		$res = dba_lib::update('ay_admin',$data,array('id'=>$_POST['id']));
				    if($res){
				    	admin_controller::adminlog(2);
				  		return response::jsonp(999,'更新成功！');

				    }
				    return response::jsonp(2,'更新失败！！');
	    }

        public function adminadd(){
        	//$this->tokenkey();
        	if(isset($_POST['token'])  ){
	        	
	        	if(!authcode_lib::verify_code($_POST['token'],$this->$tokenkey,2)){
	        		return response::jsonp(5,'token 验证失败'); 
	        	}
	        	if($_POST['id']>0)return  $this->doedit();
                if($_POST['name']=='' || $_POST['pass'] == ''){
                	return response::jsonp(1,'用户名或密码不能为空！');
                }
            				
                			$data = array();
                			  if($_POST['epass']==''){
                			  	$_POST['epass'] = $_POST['pass'];
                			  }
                			  $data['name'] = $_POST['name'];
							  $data['off'] = (isset( $_POST['off'])&&$_POST['off']== 1) ? 1 : 0;	
							  $data['yanzhengip'] = (isset( $_POST['yanzhengip'])&&$_POST['yanzhengip']==1) ? 1 : 0;

							  $data['pass'] = encryption_lib::encode( $_POST['pass']);
							  $data['epass'] =encryption_lib::encode( $_POST['epass']);
							  $data['type']  = 0;
							  $data['atime'] = time();
							  $data['ip'] = help_lib::ip();

							  //dba_lib::loadconfig('liveos');

							  $res = dba_lib::insert('ay_admin',$data);
							  if($res){
							  	admin_controller::adminlog(1);
							  	return response::jsonp(999,'添加成功！');

							  }
							  return response::jsonp(2,'添加失败！！');
        	}
        	$id = isset($_GET['id']) ? $_GET['id'] :0;
        	$user_info = dba_lib::getone('select id,name,off,yanzhengip,type,ip,atime from ay_admin where id = '.$id);
        	if($user_info){
        		$data['userinfo'] = $user_info;
        	}
        				
            $html .= view::make('admin/frame/header');
            $data['token'] =  authcode_lib::token($this->$tokenkey);
            $data['action'] = self::$lang[$this->$tokenkey];
            
            $html .= view::make('admin/adminadd',$data);
            
            ECHO $html;


        }






}
