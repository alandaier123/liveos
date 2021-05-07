<?php


/*
1、设置默认404页面在router
2、更改核心目录名称在autoloader
*/


//框架入口所在路径
defined('LIVE_PATH') OR define('LIVE_PATH',dirname(__FILE__));

/* 应用程序根目录 这个应在外部定义 */
defined('APP_PATH')  OR define('APP_PATH', $_SERVER['DOCUMENT_ROOT'] );

//是否脚本 
defined('IS_SCRIPT') OR define('IS_SCRIPT', false);

//调试模式，默认false,
defined('IS_DEBUG')  OR define('IS_DEBUG', false);

defined('DS')        OR define('DS', '/');
defined('EXT')       OR define('EXT', '.php'); 

defined('DEFAULT_CTL_404')       OR define('DEFAULT_CTL_404', 'default404');   
defined('DEFAULT_ACT_404')       OR define('DEFAULT_ACT_404', 'index'); 

//核心目录
const CORE_DIRNAME = 'core';

//脚本模式 暂无处理
if(IS_SCRIPT){
    
}




//引入自动加载类
require_once LIVE_PATH.'/'.CORE_DIRNAME.'/autoloader.php';

spl_autoload_register(array('autoloader', 'loader'));

//调试模式下 
if(IS_DEBUG){
    error_reporting(E_ALL);

}

/*set_exception_handler(function($e) {
    $message = $e->getMessage();
    if (IS_DEBUG)
        echo $e;
});*/


register_shutdown_function(function() {
  
    if (IS_DEBUG) {
        
        echo '<pre>' . PHP_EOL;
        var_dump(error_get_last());
        echo '</pre>';        
 
        
    }
});

// test_v_lib::asd();
//  debug::p($_SERVER['REQUEST_URI']);
//  var_dump(autoloader::getLoadedfiles());   
//终止处理函数
register_shutdown_function(function() {
   
    if (IS_DEBUG ) {
        //var_dump(error_get_last());

    }else{
       // 跳转默认终止页面 
    }

});

//1、自动加载还差cfg、view

//3、数据库文件加载
//
//1、自动加载测试

// test_v_lib::asd();
// v_lib::asd();
// v_controller::asd();
// test_v_controller::asd();
// v_model::asd();
// test_v_model::asd();
// lib_activity_dfsgd::asdf();
// //2、配置文件加载测试
//  config::load('qwe');
//  config::load('memcached',false);
// debug::p(config::getall());
// debug::p(autoloader::getLoadedfiles());
// redis 配置文件加载
// 
/*$r =new R('default');

$key = $_GET['key'];
$value = $_GET['value'];

$res = $r->set($key,$value);var_dump($res);*/
/*$resa = array();
for ($i=0; $i < 5000; $i++) { 
	$res = $r->set("tutorial-name-".$i, "Redis tutorial-".$i);
	$resa[$i] = $res;
}
debug::p($resa);*/


/*$resa = $r->keys(0,'*');
debug::p($resa);*/


/*$resa = $r->flushdb(0);
debug::p($resa);*/


/*$r =new R('test');
for ($i=0; $i <5000 ; $i++) { 
	$r->getInstance($i);
}
die;*/
//
/*$redisObj = new \Redis();
$redisObj->connect("192.168.154.130", 6379);
var_dump($redisObj);die;*/
//路由测试
router::auto();



// db::loadconfig('zhibo');
// $sql = 'select * from zb_admin order by id';
// $user = db::getone($sql);
// debug::p($user);


// db::loadconfig('zhibo');
// $conn = db::getconn();
// $dbconfig = db::getconfig();
// debug::p($conn,$dbconfig);


