<?php

class dir_lib{


	public static function build( $dir, $zz = ''){  
         
         if( strstr( $dir, "#"))return ;
      
         if( $zz == ''){
            $dirs = substr( strrchr( $dir,'/') , 1);
             
            if( $dirs != '') $dir = str_replace( $dirs,'',$dir);
                $dir =  rtrim( $dir ,'/');
         }


         if( ! is_dir( $dir)){  

             if( ! dir_lib::build( dirname( $dir ) , $zz = 2)) return false;

              if(! mkdir( $dir, 0777)) return false;

         }

         return true;
    } 

}