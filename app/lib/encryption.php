<?php

class encryption_lib {



   	public static function encode( $var = '' ){
        
		 if(! $var ) $var = time().'b891037e3d772605f56f8e9877d8593c';
         $varlenth = strlen( $var );
		 if( $varlenth < 1 ) $varlenth = 32;
         $hash = md5( '#@$^%&^*&(#'.md5( base64_encode( $var.md5( $var).''. $var.'][{)(*&^%#@^#$&!$@%*&^').'@(t'. $varlenth). $varlenth);
         	
         return substr( $hash ,1 , $varlenth * 3 );
	}
}