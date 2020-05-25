<?php

/*
 * 对没有绑定手机的用户弹框提醒
 */

class msgbox_lib{

   
	public static function msgbox ( $mess='' , $location='yes'){ 

        if( isset( $_GET['ajson'])){

           ob_clean();
           header('Content-type:application/json;charset=UTF-8');
           if( $location == 'yes' ) $location = 1;
           $token = token();

           if( isset( $_GET['action'])) $_SESSION[ $_GET['action']]  = $token;
           exit( json_encode( array( 'code' => $location,'msg' => $mess, 'token' =>  $token)));
        }

        if( $location == 'yes') 
           $locations = "window.history.back();";
        else 
           $locations = " window.location.href='".$location."';";

        if($mess == '')
           echo  '<script>'. $locations.'</script>';
        else
           echo  '<script>alert("'.$mess.'");'. $locations.'</script>';

        die;
	}

    

  
}
