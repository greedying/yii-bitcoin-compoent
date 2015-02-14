#使用说明

将yii框架调用bitcoin比特币远程服务器的代码封装为一个component组件   
本人初学，写得简单，勿笑   

组件只是为了方便调用比特币服务器提供的接口，如需要更复杂的功能，建议继承这个类   
在子类中封装更为丰富的功能

**使用本扩展需要做如下配置**  

```PHP
'components' => array(   
		.....   
		'bitcoin'=>array(   
			'class'=>'Bitcoin',   
			'rpcuser'=>'yourbitcoinusername',   
			'rpcpassword'=>'yourbitcoinpassword',   
			'ip'=>'1.2.3.4',   
			'port'  => '4992',//可空白，有默认值   
			),   
		....   
```   

**调用方式如下**

```php
		Yii::app()->bitcoin->$bitcoinfunction($param1, $param2, ....)；   
```


##依赖的文件

本组件需要使用jsonrpc协议，为此用到jsonRPCClient类   
下载地址为http://www.jsonrpcphp.org/
将jsonRPCClient.php文件放到 protected/extensionss/jsonrpc文件夹中    
并且配置文件中做如下修改

```php
'import' => array(
		...
		,
		'ext.jsonrpc.*',
		....
		),
```

