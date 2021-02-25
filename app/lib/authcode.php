<?php

/*
 * 各种验证码
 */

class authcode_lib{
   

    public static function vcode($shu = 4,$width=130,$height=40,$time = 60){
        ob_clean();
        header("Content-type: image/png");
        
        
        $image = imagecreatetruecolor($width, $height);
        imagefill($image, 0, 0, imagecolorallocate($image, 255, 255,245));

        $code = "0123456789"; 

        $ascii='';
        $COLOR = imagecolorallocate($image, rand(0,200), rand(0,200), rand(0,200));
        for( $i = 0 ; $i < $shu ; $i++ ){

            $char = $code{rand(0,strlen($code)-1)};

            $shus = $i*($width/$shu) ;
            $tux = $shus+rand(5,10);
            imagestring($image, 5, $tux, 12 , $char, $COLOR);

            $ascii.=$char;
        } 
        
        $_SESSION['code'] =  strtoupper( $ascii );

        $_SESSION['codetime'] = time()+$time;
        imagepng( $image );
        imagedestroy( $image );
    }


 


    public static function verify_code($code = 0 ,$key='',$type = 1){

        $val_key = 'code';
        $time_key = 'codetime';
        if($type==2){
            $val_key  = 'token_'.$key;
            $time_key = 'token_time_'.$key;
        }
        //var_dump($code,$key,$time_key,isset( $_SESSION[$time_key]) , ($_SESSION[$time_key]  > time()));die;
        if( isset( $_SESSION[$time_key]) &&  ($_SESSION[$time_key]  > time()) ){
            unset( $_SESSION[$time_key] );
            
            if(isset($_SESSION[$val_key]) && $_SESSION[$val_key] == $code){
                unset( $_SESSION[$val_key] );
                return true;
            }            
         
        }

        return false;    
        
    }

    public static function token($key='',$time = 60){
        if($key !=''){
            $val_key  = 'token_'.$key; 
            $time_key = 'token_time_'.$key;

            if( isset( $_SESSION[$time_key]) &&  ($_SESSION[$time_key]  > time()) ){

                return $_SESSION[$val_key];

            }
            
            $_SESSION[$val_key]  = encryption_lib::encode( time().rand(1,999999999));
            $_SESSION[$time_key] = time()+$time;  
            return $_SESSION[$val_key];
        }

        return false;
    }
    

  
}
