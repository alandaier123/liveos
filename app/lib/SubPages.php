<?php 



class SubPages_lib{     
       
   private  $each_disNums;     
   private  $nums; 
   private  $current_page;    
   private  $sub_pages; 
   private  $pageNums;    
   private  $page_array = array();    
   private  $subPage_link;   
   private  $subPage_type;  
   private  $houzui;
   private  $arrays;
   
  function __construct($fenye,$each_disNums,$nums,$current_page,$sub_pages,$subPage_link,$houzui,$subPage_type){     
   $this->each_disNums=intval($each_disNums);     
   $this->nums=intval($nums);     
    $this->houzui=$houzui;
	if(!isset($fenye['dqdi']))
	$fenye =array(
    'dqdi'=>'The',
	'ye'=>'Page',
	'home'=>'home',
	'last'=>'Previous',
	'next'=>'next',
	'weiye'=>'end',
   );
	$this->arrays=$fenye;
    if(!$current_page){     
    $this->current_page=1;     
    }else{     
    $this->current_page=intval($current_page);     
    }     
   $this->sub_pages=intval($sub_pages);     
   $this->pageNums=ceil($nums/$each_disNums);     
   $this->subPage_link=$subPage_link;      
   $this->show_SubPages($subPage_type);      
     
  }     
       
       
  
  function __destruct(){     
    unset($each_disNums);     
    unset($nums);     
    unset($current_page);     
    unset($sub_pages);     
    unset($pageNums);     
    unset($page_array);     
    unset($subPage_link);     
    unset($subPage_type);     
    unset($subPage_type);  
   }     
  public static function pagec($xsuu,$page_size=10,$nums,$sub_pages = 5,$page,$qianzui,$houzui=''){  
              
           $xx = ceil($nums/$page_size);
          
      
         if( $page > $xx) return '';

           $subPages = new SubPages_lib( $xsuu, $page_size, $nums, $page, $sub_pages, $qianzui, $houzui, 2);
           return ( $subPages -> subPageCss2());
  }       
     
  function show_SubPages($subPage_type){     
    if($subPage_type == 1){     
    $this->subPageCss1();     
    }elseif ($subPage_type == 2){     
    $this->subPageCss2();     
    }     
   }     
       
       
    
  function initArray(){     
    for($i=0;$i<$this->sub_pages;$i++){     
    $this->page_array[$i]=$i;     
    }     
    return $this->page_array;     
   }     
       
       
    
  function construct_num_Page(){     
    if($this->pageNums < $this->sub_pages){     
    $current_array=array();     
     for($i=0;$i<$this->pageNums;$i++){      
     $current_array[$i]=$i+1;     
     }     
    }else{     
    $current_array=$this->initArray();     
     if($this->current_page <= 3){     
      for($i=0;$i<count($current_array);$i++){     
      $current_array[$i]=$i+1;     
      }     
     }elseif ($this->current_page <= $this->pageNums && $this->current_page > $this->pageNums - $this->sub_pages + 1 ){     
      for($i=0;$i<count($current_array);$i++){     
      $current_array[$i]=($this->pageNums)-($this->sub_pages)+1+$i;     
      }     
     }else{     
      for($i=0;$i<count($current_array);$i++){     
      $current_array[$i]=$this->current_page-2+$i;     
      }     
     }     
    }     
        
    return $current_array;     
   }     
       
 
  function subPageCss2(){     
   $subPageCss2Str="";     
   $subPageCss2Str.="<span>".$this->arrays['dqdi'].$this->current_page."/".$this->pageNums.$this->arrays['ye']."</span>";     
        
        
    if($this->current_page > 1){  
        
        if(  PAGETRIM == 1)
	         $dangqian = rtrim( $this->subPage_link, WEBFENG);
        else $dangqian = $this->subPage_link.'1';


    $firstPageUrl = $dangqian.$this->houzui;  
	
    $prewPageUrl=$this->subPage_link.($this->current_page-1).$this->houzui;     
    $subPageCss2Str.="<a href=\"$firstPageUrl\">".$this->arrays['home']."</a> "; 
	if($this->current_page<=2)
	  $prewPageUrl= $firstPageUrl;
    $subPageCss2Str.="<a href=\"$prewPageUrl\">".$this->arrays['last']."</a> ";   
	
    }else {     

    $subPageCss2Str.="<span>".$this->arrays['home']."</span>";     
    $subPageCss2Str.="<span>".$this->arrays['last']." </span>"; 
    
    }     
        
   $a=$this->construct_num_Page();     
    for($i=0;$i<count($a);$i++){     
    $s=$a[$i];     
     if($s == $this->current_page ){     
     $subPageCss2Str.="<span class='hover'>".$s."</span>";     
     }else{     
     $url=$this->subPage_link.$s.$this->houzui; 

	  if($s < 2 && PAGETRIM == 1){
	    $url = rtrim( $this->subPage_link, WEBFENG).$this->houzui;
	  }

     $subPageCss2Str.="<a href=\"$url\">".$s."</a>";     
     }     
    }     
        
    if($this->current_page < $this->pageNums){     
    $lastPageUrl=$this->subPage_link.$this->pageNums.$this->houzui;     
    $nextPageUrl=$this->subPage_link.($this->current_page+1).$this->houzui;     
    $subPageCss2Str.=" <a href=\"$nextPageUrl\">".$this->arrays['next']."</a>";     
    $subPageCss2Str.="<a href=\"$lastPageUrl\">".$this->arrays['weiye']."</a> ";     
    }else {     
    $subPageCss2Str.="<span>".$this->arrays['next']."</span>";     
    $subPageCss2Str.="<span>".$this->arrays['weiye']."</span>";     
    }     
    return $sss[]=$subPageCss2Str;     
   }  
   




} 