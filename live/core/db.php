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
        }
        self::$key = $key;       

        if(!isset(self::$dbconfig[$key])){
            self::$dbconfig[$key] = autoloader::loadConfig($key,$is_public);

        }
        
    }

    protected static function getconnection() { 
        

        if(self::$conn[self::$key]==null){

            $config = self::$dbconfig[self::$key];

            $dsn = $config['driver'].':dbname='.$config['dbname'] . ';host=' . $config['host'] . ';port=' .$config['port']. ';charset=' .$config['charset']; 
            
            
            self::$conn[self::$key] = new pdo($dsn, $config['username'], $config['password']); 

            self::$conn[self::$key]->setattribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
            
        }
        
       
        
    } 
    

    public static function query($sql, $parameters = null) { 
         
        self::getconnection();
        $stmt = self::$conn[self::$key]->prepare($sql); 
        $stmt->execute($parameters); 
        $rs = $stmt->fetchall(); 
        
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