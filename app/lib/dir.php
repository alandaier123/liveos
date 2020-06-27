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
    public static function strtransform($data){

        if( ! get_magic_quotes_gpc() ) 
            return addslashes( str_replace( array( '0xbf27' , '0xbf5c27' ), array( "'" , "'" ) , $data ));
        else 
            return $data;
    }
    public static function write( $filename, $arr='',$time=''){  

         if( is_array( $arr ))
             $con = var_export( $arr, true);
         else{
             $con = $arr;
             if(! $con || $con == '' ) $con = '0';
         }

         if( $con != ''){

             if($time != '') $con = "<?php \$time= '".self::strtransform($time)."'; return $con;";
             else            $con = "<?php return $con;";
         } 
         
         self::conwrite( $filename, $con); 
         return true;
    }
    public static function conwrite( $filename, $content)
    {
             $filename_lock = $filename.'.lock';
             $os = 0;
             while( 1 ) {

                  $os++;
                  if(file_exists( $filename_lock)) {

                      if($os > 1000){
                         unlink( $filename_lock);
                         break;
                      }
                      usleep( 1);

                  }else{

                      touch( $filename_lock);
                      $f = fopen( $filename, 'w');
                      fwrite( $f, $content);
                      fclose( $f);
                      unlink( $filename_lock);
                      break;
                  }
             }

             if( file_exists( $filename_lock)) @unlink( $filename_lock);
    }  

}