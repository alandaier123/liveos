<?php

return [
			'default' => [['host'=>'192.168.154.130', 'port'=>'6379']],
		/*	'friend' => [
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6379'],
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6380'],
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6381'],
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6382'],
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6383'],
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6384'],
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6385'],
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6386'],
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6387'],
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6388'],
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6389'],
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6390'],
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6391'],
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6392'],
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6393'],
				['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6394'],
			],*/
					//线上机器
			// 'rw' => array(
			// 		 array('host'=>'192.168.6.17', 'port'=>'6379'),
			// 	),
			//线上备机 只读
			// 'r' => array(
			// 		'master' => array('host'=>'192.168.6.18', 'port'=>'6380'),
			// 	),
			// 'dev' => [['host'=>__KIS_REDIS_HOST_FRIEND_1__, 'port'=>'6379']],

			// 'test' => [
			// 	['host'=>'192.168.11.247', 'port'=>'6379'],
			// 	['host'=>'192.168.11.248', 'port'=>'6379'],
			// 	['host'=>'192.168.11.247', 'port'=>'6380'],
			// 	['host'=>'192.168.11.248', 'port'=>'6380'],

			// ],
			'test2' => [
				['host'=>'192.168.11.247', 'port'=>'6379'],
				['host'=>'192.168.11.248', 'port'=>'6379'],
				['host'=>'192.168.11.247', 'port'=>'6380'],
				['host'=>'192.168.11.248', 'port'=>'6380'],
				['host'=>'192.168.11.201', 'port'=>'6379'],
				['host'=>'192.168.11.203', 'port'=>'6379'],
				['host'=>'192.168.11.201', 'port'=>'6380'],
				['host'=>'192.168.11.203', 'port'=>'6380'],
				// ['host'=>'192.168.11.204', 'port'=>'6379'],
				// ['host'=>'192.168.11.204', 'port'=>'6380'],

			],
			'test3' => [
				['host'=>'192.168.11.204', 'port'=>'6379'],
				['host'=>'192.168.11.204', 'port'=>'6380'],
			],

			'test' => [
				['host'=>'192.168.154.130', 'port'=>'6379'],
				['host'=>'192.168.154.130', 'port'=>'6380'],
			]
			
			// 'user_f' => [['host'=>'192.168.6.113', 'port'=>'6386']],
		];