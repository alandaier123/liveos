<?php

/*
 * 对没有绑定手机的用户弹框提醒
 */

class dba_lib extends db{

   	/*
   	
		$data= array('name'=>'admin','pass'=>'321321');


   	 */
    public static function insert($table='',$data=array()){
    	if($table==''|| $data==array())return '表名或参数不能为空！';
        $param = array();
        $string1 = '';
        $string2 = '';
        foreach ($data as $key => $value) {
            $param[':'.$key] = $value;
            $string1 .= $key.',';
            $string2 .= ':'.$key.',';
        }
     	
        $sql = 'insert into '.$table.'('.trim($string1,',').') values ('.trim($string2,',').')';
        return dba_lib::query($sql,$param,2);
    }
    /*
    	
	$data= array('name'=>'admin','pass'=>'321321');
	$ids = array('id'=>2);
     */
    public static function update($table='',$data=array(),$ids=array()){
    	if($table==''|| $data==array() || $ids==array())return '表名或参数错误！';
        $param = array();
        $string1 = '';
        $string2 = key($ids).'=:'.key($ids);
        foreach ($data as $key => $value) {
            $param[':'.$key] = $value;
            $string1 .= $key.'=:'.$key.',';
           
        }
        $param[':'.key($ids)] = $ids[key($ids)] ;
        

     	
        $sql = 'update '.$table.' set '.trim($string1,',').' where '.$string2;//debug::p($sql,$param) ;die;
        return dba_lib::query($sql,$param,1);
    }

    public static function limitstring( $page_size, $page){  

        $page = (float)( $page) <= 0? 1: $page;

        $page_size = (int)( $page_size) <= 0? 1: $page_size;

        return $pages = ( $page - 1 )* $page_size . "," . $page_size;
	}

  
}
