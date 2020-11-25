<?php

class router{

	
	protected static $path_info = array();

	//控制器、方法、参数信息
	protected static $controller = null;
	protected static $action = null;


	public static function auto(){
		/*1、保存url信息*/
		self::parse_uri();

		//debug::p(self::$path_info);die;

		if(self::parse_controller() && self::$controller) {
			 
			

			controller::call(self::$controller, self::$action);
		} else {

			if(DEFAULT_CTL_404) {
				self::default_404();
				return controller::call(self::$controller, self::$action);
			}

			
			response::error('404');
		}

	}
	
	protected static function default_404(){
		self::$controller = DEFAULT_CTL_404;
	
		self::$action     = DEFAULT_ACT_404;
	}

/*
	url中不含参数
	默认url至少两个分段 一个分段暂不处理
	倒数第一个是action，第二个是controller
 */
	protected static function parse_controller(){

		$num = count(self::$path_info);
		
			

		if($num <=1 || empty(self::$path_info[0])) {
			
			self::default_404();
		
			return true;
		} else {
			$dir_name = APP_PATH.DS.autoloader::controller;		

			if($num>2){
				foreach ( array_slice(self::$path_info, 0, $num- 2) as $path) {

				
					if (!preg_match('/^[\w]+$/', $path)) {
						return false;
					}

					$dir_name .= DS . strtolower($path);
				
				
				}
			}


				
			//var_dump($dir_name.DS.strtolower(self::$path_info[$num-2]).EXT );die;
			if(file_exists($dir_name.DS.strtolower(self::$path_info[$num-2]).EXT )){

				self::$controller = implode('_', array_slice(self::$path_info, 0, $num- 1));
				//var_dump(self::$controller);die;
				self::parse_action($num-2);
				return true;
			}

			return false;
		}
	}
	/**
	 * 1、保存url信息
	 * 
	 */
	protected static function parse_uri(){
		
		$pathinfo = $_SERVER['REQUEST_URI'];
		if (false !== ($pos = strpos($pathinfo, '?'))) {
			$pathinfo = substr($pathinfo, 0, $pos);
		}
		
		$pathinfo = trim(str_replace('//', '/', $pathinfo), '/');

		self::$path_info = explode('/', $pathinfo);

	}




	protected static function parse_action($key){
		if(empty(self::$path_info[$key + 1])) {
			self::$action = DEFAULT_ACT_404;
		} else {
			self::$action = self::$path_info[$key + 1];
			
		}
	}




	public static function get_action(){
		return self::$action;
	}

	public static function get_controller(){
		return self::$controller;
	}



}