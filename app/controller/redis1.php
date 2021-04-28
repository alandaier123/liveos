<?php

/*
 * 
 */

class redis1_controller{

   
    public  function index(){

        //$r =new R('default');
		//$res = $r->info();
		/*$r =new R('default');

		$key = $_GET['key'];
		$value = $_GET['value'];

		$res = $r->set($key,$value);var_dump($res);*/
		//$resa = array();
	/*	for ($i=0; $i < 5000; $i++) { 
			$res = $r->set($i, "Redis tutorial-".$i);
			$resa[$i] = $res;
		}*/
		//$r =new R('default');
		// $r2 =new R('test');
		// $class = new ReflectionClass('R');
		// debug::p($class->getStaticPropertyValue('config'));
		// debug::p($class->getStaticPropertyValue('config'));
		// debug::p($class->getStaticPropertyValue('config'));

		$r1 =new R('default');
		$r2 =new R('test');
		$r3 =new R('test3');
		debug::p($r1);
		debug::p($r2);
		debug::p($r3);
		/*$r2 = new R('test');
		debug::p($r2->getStaticPropertyValue('config'));
		$r3 = new R('test2');
		debug::p($r3->getStaticPropertyValue('config'));*/
    }
    
    
    

  
}
