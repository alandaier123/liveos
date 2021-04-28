<?php

/*
 * 对没有绑定手机的用户弹框提醒
 */

class admin_adminlog_controller extends admin_controller {

		
		function __construct(){
			parent::__construct();
			
		}
   

	    public function index(){
	    	$this->tokenkey();
	    	
	    	$limit = $wherestr = '' ;
    		$PAGE  = (int) isset( $_GET['page']) ? $_GET['page'] : 0;
    		$pagenum = 10;
			$limit = dba_lib::limitstring( $pagenum ,$PAGE);

	    	if($_GET['action']=='adminlog'){ 
	    		if(!authcode_lib::verify_code($_GET['token'],$this->$tokenkey,2)){
	        		return response::jsonp(5,'token 验证失败'); 
	        	}


	        	unset($_GET['token'],$_GET['action']);
			    if( isset( $_GET['type']) && $_GET['type'] != '') $WHERE['l.type ='] = $_GET['type'];

			    if( isset( $_GET['fenqu']) && $_GET['fenqu'] != '') $WHERE['l.uid ='] = $_GET['fenqu'];

			    if( isset( $_GET['start']) && $_GET['start'] != '') $WHERE[ 'l.atime >='] = strtotime( $_GET['start']);

			    if( isset( $_GET['end']) && $_GET['end'] != '') $WHERE[ 'l.atime <='] = strtotime( $_GET['end']);

			    if( isset( $_GET['guan']) && $_GET['guan'] != '') $WHERE['a.name LIKE'] = '\'%'.$_GET['guan'].'%\'';
			    if(count($WHERE)>=1){
			    	$wherestr .= 'where '; 
			    	foreach ($WHERE as $key => $value) {
			    		$wherestr .= $key.$value.' and ';
			    	}
			    	$wherestr = trim($wherestr,'and ');
			    }

	    	}
	    	$sql = 'select l.id,l.uid,l.type,l.ip,l.atime,a.name from ay_adminlog l INNER JOIN ay_admin a on l.uid=a.id '.$wherestr.' order by l.id desc limit '.$limit;
	    	$data['list'] = dba_lib::query($sql);
	    	$res = dba_lib::getone('select count(*) as total from ay_adminlog ');
			
			//var_dump($sql,$limit,$data['list']);
	    	$data['where'] = $_GET;
	    	//$data['lang']   = self::$lang;
	    	$data['pagestr'] = SubPages_lib::pagec( self::$lang['PAGE'], $pagenum, $res['total'], 5, $PAGE, '?action='.$_GET['action'].'&page=','&guan='.$_GET['guan'].'&start='.$_GET['start'].'&end='.$_GET['end'].'&type='.$_GET['type'].'&fenqu='.$_GET['fenqu'] ); 

	    	$data['token']  = authcode_lib::token($this->$tokenkey);

            $data['action'] = self::$lang[$this->$tokenkey];
            
	        $html = frame_lib::admin('/admin/adminlog',$data);
	        ECHO $html;
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
