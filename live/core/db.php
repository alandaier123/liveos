<?php


class db{


    /*
   
    db::loadconfig('liveos');
    $sql = 'select * from ay_admin order by id';
    $user = db::getone($sql);
    debug::p($user);
    */
    public static $conn = null;
    public static $dbconfig = null;
    public static $key = null;
    


    public function __construct($key = null){

        if($key!=null ){
            self::$key = $key;
            self::loadconfig();
        }


    } 

    public  static function loadconfig($key = null,$is_public = true){
        if($key == null){
            $key = self::$key;
        }else{
            self::$key = $key;  
        }
             

        if(!isset(self::$dbconfig[$key])){
            self::$dbconfig[$key] = autoloader::loadConfig($key,$is_public);

        }
        
    }

    protected static function getconnection() { 
        
        
        if(!isset(self::$conn[self::$key])){

            $config = self::$dbconfig[self::$key];

            $dsn = $config['driver'].':dbname='.$config['dbname'] . ';host=' . $config['host'] . ';port=' .$config['port']. ';charset=' .$config['charset']; 
            
            
            self::$conn[self::$key] = new pdo($dsn, $config['username'], $config['password']); 

            self::$conn[self::$key]->setattribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
            
        }
        
       
        
    }


    /*
        $res_type 0 返回结果集，1 返回 受影响的行 2 返回插入id
     */
    public static function query($sql, $parameters = null,$res_type = 0) { 
         
        self::getconnection();
        $stmt = self::$conn[self::$key]->prepare($sql); 
        $stmt->execute($parameters);
        $rs = null;
        if($res_type==1){
            $rs = $stmt->rowCount();
        }elseif ($res_type==2) {
            $rs = self::$conn[self::$key]->lastInsertId();
        }else{
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);   
        } 
        
        
        $stmt = null; 
        //self::$conn[self::$key] = null; 
        return $rs; 
    } 
    public static function getone($sql, $parameters = null){
        $data = self::query($sql, $parameters);
        if($data){
            return $data[0];
        }
        return false;
    } 

    public static function getconfig(){
        return self::$dbconfig;
    }
    public static function getconn(){
        self::getconnection();
        return self::$conn;
        
    }

}