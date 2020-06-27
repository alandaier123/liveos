<?php


class txtcc{

    const  txtpath=APP_PATH.'../www/temp/'; 





    public static function ja( $key, $num = 1, $time = ''){ 

           $pat =self::txtpath .str_replace( '../', '', $key).'.php';
           dir_lib::build( $pat );
           if( file_exists( $pat))$value = include $pat;
           else  $value =  0;

           $time = (int)$time;

           $value = (float)($value * 1 + $num);
           x($pat , $value, $time);
           return $value;
    }


    public static function j( $key , $num = 1, $time = ''){ 

           $pat =self::txtpath .str_replace( '../', '', $key).'.php';
           dir_lib::build( $pat );

           if( file_exists( $pat))$value = include $pat;
           else  $value =  0;

           $time = (int)$time;

           $value = (float)($value * 1 - $num);
           x( $pat , $value, $time);
           return $value;
    }


    public static function g( $key){ 

            $pat =self::txtpath .str_replace( '../', '', $key).'.php';
            if( file_exists( $pat)){

               $kkk = include $pat;

                if( $kkk != ''){
                   
                    if( isset( $time)){

                        clearstatcache();
                        $guoqitime = filemtime($pat)+$time; 
                        $dangqtime = time();
                       
                        if( $dangqtime > $guoqitime){
                            unlink($pat);
                            return false;
                        }else return  $kkk;
                   
                    }else return $kkk;

                }else return true;

            }else return false;

    }


    public static function d( $key){ 

            $pat =self::txtpath .str_replace( '../', '', $key).'.php';

            if( file_exists( $pat)){
                unlink( $pat);
                return true;
            }else return false;
    }


    public static function f( $key = ''){

           if($key == '')  $key =self::txtpath;
           return shanchu( $key );
    }


    public static function s( $key , $value , $time = ''){ 

            $time = (int)$time;

            $pat =self::txtpath . str_replace( '../', '', $key).'.php';
            dir_lib::build( $pat);
            if(! $value ) $value = '0';
            if( $value != ''){
               if( ! is_array( $value)) $value = "'". dir_lib:::strtransform( $value )."'";
            }

            dir_lib::write( $pat , $value , $time );
            return $value;
    }




} 