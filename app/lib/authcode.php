<?php

/*
 * 各种验证码
 */

class authcode_lib{


        public static function vcode($shu = 4,$width=130,$height=40){
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

        $_SESSION['codetime'] = time();
        imagepng( $image );
        imagedestroy( $image );
    }

    
    public static function verify_code($code = 0 ,$time = 60){
        
        if( isset( $_SESSION['codetime']) && (( $_SESSION['codetime'] + $time) > time() )  ){
            unset( $_SESSION['codetime'] );
            
            if(isset($_SESSION['code']) && $_SESSION['code'] == $code){
                unset( $_SESSION['code'] );
                return true;
            }            
         
        }

        return false;    
        
    }
    

  
}
