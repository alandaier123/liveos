<?php

/*
 * 获取抢购资格，暂不涉及支付后取消订单重新入库
 */

class order_lib{

  
    static $UID;
    static $PRODUCT_ID;
    static $REDIS_PRODUCT_KEY = 'PRODUCT_%s';
    static $REDIS_TOTAL     = 'TOTAL';
    static $REDIS_RESUME    = 'RESUME';

    static $REDIS_QUENE_KEY = 'ORDER_QUENE_%s';
   	static $PRODUCT_TOTAL = "PRODUCT_TOTAL_%s";
   	static $RESUME        = "PRODUCT_RESUME_%s";
    static $REDIS;
   	

   	public function __construct($productId,$uid){
      self::$REDIS_PRODUCT_KEY = sprintf(self::$REDIS_PRODUCT_KEY, $productId);
      self::$REDIS_QUENE_KEY   = sprintf(self::$REDIS_QUENE_KEY, $productId);
   		self::$PRODUCT_TOTAL     = sprintf(self::$PRODUCT_TOTAL, $productId);
      self::$RESUME       	   = sprintf(self::$RESUME, $productId);
      self::$UID               = $uid;
      self::$PRODUCT_ID        = $productId;
   	}
    /*
    

    缓存共享数据、reids库存总数据初始化，需手动执行，后关闭！
     */
    public function apcuclear(){
      $res = apcu_delete(self::$PRODUCT_TOTAL);
      $res2 = apcu_delete(self::$RESUME);
      return [$res,$res2];    
    }


    public function apcuinit(){

      $total = apcu_fetch(self::$PRODUCT_TOTAL);
      $resume = apcu_fetch(self::$RESUME);
      if ($total === false && $resume ===false) {
          apcu_add(self::$PRODUCT_TOTAL, 150);
          apcu_add(self::$RESUME, 0);
          $total = apcu_fetch(self::$PRODUCT_TOTAL);
          $resume = apcu_fetch(self::$RESUME);
          return response::jsonp(0,'成功',['total'=>$total,'resume'=>$resume]);
      }else{
          return response::jsonp(1,'异常',['total'=>$total,'resume'=>$resume]);
          
      }      

    }

    public function redisinit(){
      $this->getredis();
      
      $redis_total = self::$REDIS->hget(self::$REDIS_PRODUCT_KEY,self::$REDIS_TOTAL);
      $redis_resume = self::$REDIS->hget(self::$REDIS_PRODUCT_KEY,self::$REDIS_RESUME);
      if ($redis_total === false && $redis_resume ===false) {
          self::$REDIS->hset(self::$REDIS_PRODUCT_KEY,self::$REDIS_TOTAL,1);
          self::$REDIS->hset(self::$REDIS_PRODUCT_KEY,self::$REDIS_RESUME,0);
          $redis_total = self::$REDIS->hget(self::$REDIS_PRODUCT_KEY,self::$REDIS_TOTAL);
          $redis_resume = self::$REDIS->hget(self::$REDIS_PRODUCT_KEY,self::$REDIS_RESUME);

          
          return response::jsonp(0,'成功',['total'=>$redis_total,'resume'=>$redis_resume]);
      }else{
          return response::jsonp(1,'异常',['total'=>$redis_total,'resume'=>$redis_resume]);
          
      }    
    }


    public  function index(){ 
     /* $this->getredis();
      $redis_data = self::$REDIS->hMGet(self::$REDIS_PRODUCT_KEY,[self::$REDIS_TOTAL,self::$REDIS_RESUME]);
      var_dump($redis_data);return;
      $num = $redis_data[self::$REDIS_TOTAL]-$redis_data[self::$REDIS_RESUME];*/

    }

    private function updatestock(){
      
      $redis_data = $this->getredisstock();
    
      $num = $redis_data[self::$REDIS_TOTAL]-$redis_data[self::$REDIS_RESUME];
      if ($num>0 ) {  
          $total = apcu_fetch(self::$PRODUCT_TOTAL);
          if($total+$num<=$redis_data[self::$REDIS_TOTAL] ){
              if(apcu_inc(self::$PRODUCT_TOTAL, $num) ){
                  return $num;
              }  
          }
                  
      }
      return 0; 
    }

    private function getredisstock(){
      $this->getredis();
      return self::$REDIS->hMGet(self::$REDIS_PRODUCT_KEY,[self::$REDIS_TOTAL,self::$REDIS_RESUME]);
      
      //return $redis_data[self::$REDIS_TOTAL]-$redis_data[self::$REDIS_RESUME];
    }

    public function getstock(){
      
      $redis_data = $this->getredisstock();

      return response::jsonp(0,'success',['stock'=>$redis_data[self::$REDIS_TOTAL]-$redis_data[self::$REDIS_RESUME]]);      
      
    }


    public function create(){

      /*TODO
      1、登陆判断
      2、用户重复下单检测
      3、ip重复下单检测
      */
    	$total = apcu_fetch(self::$PRODUCT_TOTAL);
      $resume = apcu_fetch(self::$RESUME);
        if ($total === false || $resume ===false) {
          return response::jsonp(1,'库存信息故障！！');
        }
        //开始进入抢购队列
        if($resume>=$total){

          if(!$this->updatestock())return response::jsonp(2,'已被抢购一空！！');
        }        
        
        
        $this->getredis();
      /*  $DATA = $this->incredis();
        var_dump($DATA);return 0;*/
        if(!$this->incredis()){
          return response::jsonp(3,'已被抢购一空！！');
        }
        
        apcu_inc(self::$RESUME);
        self::$REDIS->lPush(self::$REDIS_QUENE_KEY, json_encode(['user_id' => self::$UID, 'product_id' => self::$PRODUCT_ID]));

        return response::jsonp(0,'抢购成功！请尽快到订单中心支付');	
    }

    private function incredis()
    {
        //同步远端库存时，需要经过lua脚本，保证不会出现超卖现象
        $script = <<<eof
            local key = KEYS[1]
            local field1_val = redis.call('hget', key, KEYS[2])
            local field2_val = redis.call('hget', key, KEYS[3])
            if(field1_val-field2_val>0) then
                return redis.call('HINCRBY', key, KEYS[3],1)
            end
            return 0
        eof;
        return self::$REDIS->eval($script,[self::$REDIS_PRODUCT_KEY,  self::$REDIS_TOTAL, self::$REDIS_RESUME] , 3);
        
         
    }

    private function getredis(){
      if(self::$REDIS==null){
        self::$REDIS = new R();
      }

    } 
    public function getorderquene(){
      $this->getredis();
      return self::$REDIS->lrange(self::$REDIS_QUENE_KEY,0,-1);

    }
    

  
}
