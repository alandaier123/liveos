<?php

/*
 * 
 */

class test_controller{


    public $postCharset = 'UTF-8';
    public $data = ['mch_id'=> '124554411544521', 
        'out_trade_no'=> '202106022322526226',
        'total_fee'=> '100',
        'body'=> '连衣裙',
        'remarks'=> '您购买的连衣裙已支sdfvsedrgfvberdf付成功！',
        'notify_url'=> 'https://wx.wonway.com.cn',
        'nonce_str'=>'rdfghdrsdsdgfb45',
        'api_type'=>'JSAPI',
        'appid'=>'wx27b03b8c9056bbab',
        'openid'=>'45374534',
        'spbill_create_ip'=>'192.168.0.114',
        'sign'=>''] ;


    public $key ='MIIEpQIBAAKCAQEAzOwFt/pGjG9/siGppbf9kNhYztywYsFz4fDDLd5E4v0d+yRkdRMk1DJCt64EjAeS6gcjwXCB4ELzUqoAd57BDHfR/SspOi5ijFtHdyOmdu6HTu87uxa6lHHWBEEs2Qbwqpc3+ANjEB/l+dalGxShcQO9ft15oudnwBII9L6j0K9EE5OtRLw8B5FGK58svZhwaH9EwoW1KvjSM3xgP3wyCwZnZ5/IqCQrbVnWaCahidTFsoEGoIeESu9dq+QpIX2dav2PKcD56EKo40yiA1og3+G4SUoxK8gAz3tq2uBrJAwa3YRHFAF98ryxcisDQcMgQ2PTKp/tnNkStzV734dz9QIDAQABAoIBAQC5wS1B41W2EZAwWcFdXhY1CVgfU/9z1aaE5ekXGAdbt1RJBmklkw/sZg8CT3UBtg/fok8wFxszvZyxjzbTOA4IjkjEdC5v9gIQ9uEmRyOrZXcz/zom0miZDUOSIb5UkKzyBheO8wsGX9PpEEAj9ySMvHY2nO6Y06jBe9ewe2slS0qc1ozmVmXZ3fyFG4HajKYCNeUFOeij6ebRb08yaD930/BnwY0+OqsSNHzDL0lmblG0ajqbTUD/OAVcH7UTvCURPA3Qc0qQiqLoM6V1moRF5kJzKZpmAAIh64jSvnZrILNCHFzRi4dS1bS6PgZ4yfIWqGhhppxo574HD7ltAykBAoGBAPPXwcvju/6F3MfM27x4I0IxACbxIcSHuPYd8ZopeN+/4Sp9/QENLqJDbqQevVH5r/b46JOMVtdDhsilm6agNRNrsICyQ5U/0DsxGttWFFaddGlfRYijYJ/IdkTRYX8CqvEVA/oS482WykZ3xHb589YsfPWtvlvaun7PTrp3msQ1AoGBANcjgZ4Hr54Y9e2TDl9U1dbMwJuJIPdSdiPnsx1DcqbRvBY2Z8trgYeBVpVPgj3bh/ecwzbpJl8FT1GbCL/I+J/vHoVIoWju+cjdB8Z0vDsDgVcqH1oM0AZA1Il2n0aMiY1d23nyLJ3iQfot433lomrrSSM6g6lrDfhdNYOAFGjBAoGABiSSUkObcc8Hf9UOWBIiuUEowtJiSmQs6a5ZbsvKqsBXuM1RuVwOp7HRMLtBg7Ypk6wzl7v6WBPwak+Zuznf/GxDFwrmnvTrlwImrg3eF0yCKUFoLAgJoBzZteQcc6mqisY/wmYFbSF2WQ4dWe30EZovT7UfzYqWFim8zv/CW10CgYEAzFXW+GfIb1q5ykoQLo9/AyM6FQArpXxW5UdeIf872CIAiQBnmRek0TURLYN06pemDpJ//5l2bm22poWfy7hwHEebL3CKjgXcjOEST3X0igCMSmOhn3/n3OiadW2LXhCBXRm2KZ7QrayGib4oAh2nI/IRZzpebv1VKX4uI5X0zIECgYEAyVSF2K14eUg4pw9zxseTQCm8R8pne/xIBP9VPmutt3lovgHuEFycAAlL5rLViaYXoeOUGS+Ty63t9QdNi2qNL5fPhPqk0Q/SAmncH2RtF4vLUg7E3ROrPwbUj993HwJFOfMlNCg2LSdfIACyd0ZZmKQtO4pHorToHJk+WhDS/5s=';

    public  function index(){

       //$order = new order_lib(1);
       //$data = apcu_add('test', 150);
       //var_dump($data);

       phpinfo();

    }
    public function gettest(){
    	$data = apcu_cache_info();
    	var_dump($data);
    }
    public function clear(){
      $data = apcu_clear_cache(); 
      var_dump($data);
    }

    public function rsatest(){
      //$this->rsa2($this->data,$this->key);
      var_dump($this->alonersaSign($this->data,$this->key));
    }
        /**
     * RSA单独签名方法，未做字符串处理,字符串处理见getSignContent()
     * @param $data 待签名字符串
     * @param $privatekey 商户私钥，根据keyfromfile来判断是读取字符串还是读取文件，false:填写私钥字符串去回车和空格 true:填写私钥文件路径
     * @param $signType 签名方式，RSA:SHA1     RSA2:SHA256
     * @param $keyfromfile 私钥获取方式，读取字符串还是读文件
     * @return string
     */
    public function alonersaSign($data,$privatekey,$signType = "RSA2",$keyfromfile=false) {
        if(!$keyfromfile){
            $priKey=$privatekey;
            $res = "-----BEGIN RSA PRIVATE KEY-----\n" . wordwrap($priKey, 64,"\n", true) . "\n-----END RSA PRIVATE KEY-----";
        }else{
            $priKey = file_get_contents($privatekey);
            $res = openssl_get_privatekey($priKey);
        }

        $data = $this->getSignContent($data);var_dump($data.'<br/>');
        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');
        if ("RSA2" == $signType) {
            openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        } else {
            openssl_sign($data, $sign, $res);
        }
        if($keyfromfile){
            openssl_free_key($res);
        }
        $sign = base64_encode($sign);
        return $sign;
    }


    public function getSignContent($params){
        ksort($params);
        unset($params['sign']);

        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;            
        }

        unset ($k, $v);
        return $stringToBeSigned;
    }
  
}
