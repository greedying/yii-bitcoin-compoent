<?php
/**
 * Bitcoin组件，扩展自CComponent
 * @author greedying
 * https://github.com/greedying/yii-bitcoin-component
 * 2014.02.08
 */
class Bitcoin extends CApplicationComponent
{
	/*** 
	 * 比特币服务器 rpcuser 
	 * 需要和比特币配置文件中rpcuser相同
	 * ***/
	public $rpcuser = null;

	/*** 
	 * 比特币服务器 rpcpassword
	 * 需要和比特币配置文件中rpcpassword相同
	 **/
	public $rpcpassword = null;

	/*** 
	 * 比特币服务器ip       
	 * **/
	public $ip = null;

	/***
	 * 比特币服务器端口，默认是8332
	 */
	public $port = 8332;

	/***jsonrpcclient ***/
	public $rpcclient = null;

	public function init()
	{
		$this->rpcclient = new jsonRPCClient("http://{$this->rpcuser}:{$this->rpcpassword}@{$this->ip}:{$this->port}");
	}

	public function invoke($function, $args=array())
	{
		//避免json_decode精度问题,
		ini_set('precision', 14);
		$function = strtolower($function);//bitcoin里function都是小写
		try{
			if($args==array()){
				return	$this->rpcclient->$function();
			}else{
				//参数顺序需要与比特币服务器接口一样
				$php = 'return $this->rpcclient->$function(';
				for($i=0; $i<count($args); $i++){
					$php .= '$args[' . $i . '],';
				}
				$php = rtrim($php, ',');
				$php .= ');';
				return eval($php);//调用jsonrpc
			}
		}catch(Exception $e){
			echo 'wrong';
		}
		ini_set('precision', 20);
	}

	public function __call($name,$args=array())
	{
		 return $this->invoke($name, $args);
	}
}
