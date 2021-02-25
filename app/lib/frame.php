<?php

class frame_lib{

        public static function admin($body ='', $params = []){
            $html = '';
            $html .= view::make('admin/frame/header');
            //$html .= view::make('admin/frame/aside'); 
            $html .= view::make($body,$params);
            $html .= view::make('admin/frame/footer'); 
            
            return $html;

        }

    

 

}