<?php

class session_lib{


	public static function setsession( $model = 0,$time = 300 ){

         

         ini_set('session.use_trans_sid',0); 
         ini_set('session.hash_function', 'sha512');
         ini_set('session.hash_bits_per_character', 4);

         if( $model == 2){

             ini_set('session.save_handler','user');
             ini_set('session.use_cookies', 1);
             ini_set('session.save_path','');
             session_set_save_handler( 'sessionopen' , 'sessionclose' , 'sessionread' , 'sessionwrite' , 'sessiondestroy' , 'sessiongc' );


         }else if( $model == 1){

             ini_set('session.save_handler','files');
             dir_lib::build( APP_PATH .DS. "session/");
             session_save_path( APP_PATH .DS. "session/");
         }
 
             session_start();

            
	}

}