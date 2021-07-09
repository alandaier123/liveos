<?php

/*
 * 
 */
use GuzzleHttp\Client;
use WeChatPay\Builder;
use WeChatPay\Util\PemUtil;


class guzzle_controller{

    
	static $instance ;
    public static  function index(){

      $url = 'https://api.mch.weixin.qq.com/v3/profitsharing/receivers/add';
      $data = [
			  "sub_mchid"=>"1900000109",
			  "appid"=>"wx8888888888888888",
			  "sub_appid"=>"wx8888888888888889",
			  "type"=>"MERCHANT_ID",
			  "account"=>"86693852",
			  "name"=>"hu89ohu89ohu89o",
			  "relation_type"=>"SERVICE_PROVIDER",
			  "custom_relation"=>"代理商"
			];
      $reponse = http_lib::post($url ,$data);
      echo $reponse;

    }
   
    public static  function wechatpay(){


		// 工厂方法构造一个实例
		self::$instance = Builder::factory([
		    // 商户号
		    'mchid' => '1000100',
		    // 商户证书序列号
		    'serial' => 'XXXXXXXXXX',
		    // 商户API私钥 PEM格式的文本字符串或者文件resource
		    'privateKey' => PemUtil::loadPrivateKey('D:\soft\weixincertutil\WXCertUtil\cert\1610061673_20210602_cert\apiclient_key.pem'),
		    'certs' => [
		        // 可由内置的平台证书下载器 `./bin/CertificateDownloader.php` 生成
		        'YYYYYYYYYY' => PemUtil::loadCertificate('D:\soft\weixincertutil\WXCertUtil\cert\1610061673_20210602_cert\apiclient_cert.pem')
		    ],
		    // APIv2密钥(32字节)--不使用APIv2可选
		    'secret' => 'ZZZZZZZZZZ',
		    'merchant' => [// --不使用APIv2可选
		        // 商户证书 文件路径 --不使用APIv2可选
		        'cert' => '/path/to/mch/apiclient_cert.pem',
		        // 商户API私钥 文件路径 --不使用APIv2可选
		        'key' => '/path/to/mch/apiclient_key.pem',
		    ],
		]);


    }

    public static function topay(){
    	self::wechatpay();
    	try {
		    $resp = self::$instance->v3->pay->transactions->native->post(['json' => [
		        'mchid' => '1900006XXX',
		        'out_trade_no' => 'native12177525012014070332333',
		        'appid' => 'wxdace645e0bc2cXXX',
		        'description' => 'Image形象店-深圳腾大-QQ公仔',
		        'notify_url' => 'https://weixin.qq.com/',
		        'amount' => [
		            'total' => 1,
		            'currency' => 'CNY'
		        ],
		    ]]);

		    echo $resp->getStatusCode() . ' ' . $resp->getReasonPhrase(), PHP_EOL;
		    echo $resp->getBody(), PHP_EOL;
		} catch (Exception $e) {
		    // 进行错误处理
		    echo $e->getMessage(), PHP_EOL;
		    if ($e instanceof \Psr\Http\Message\ResponseInterface && $e->hasResponse()) {
		        echo $e->getResponse()->getStatusCode() . ' ' . $e->getResponse()->getReasonPhrase(), PHP_EOL;
		        echo $e->getResponse()->getBody();
		    }
		}
    }
  
      
}
    

    
    
    
    

  

