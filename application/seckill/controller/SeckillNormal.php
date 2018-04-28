<?php
	namespace app\seckill\controller;
	use think\Db;
	/**
	* 秒杀实现－常规做法
	*/
	class SeckillNormal
	{
		
		function __construct()
		{
			# code...
		}

		// 方法1 常规做法
		public function seckill() {
			$price=10;
			$user_id=1;
			$goods_id=1;
			$sku_id=11;
			$number=1;

			//生成唯一订单
			function build_order_no(){
			    return date('ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
			}
			//记录日志
			function insertLog($event,$type=0){
				$data = array(
					'event' => $event,
					'type' => $type,
				);
				Db::name('log')->insert($data);  
			}

			//模拟下单操作
			//库存是否大于0
			$row = Db::name('store')->field('number')->where('sku_id',$sku_id)->find();
			if($row['number']>0){//高并发下会导致超卖
				$order_sn=build_order_no();
				//生成订单  
				$data = array(
					'order_sn' => $order_sn,
					'user_id' => $user_id,
					'goods_id' => $goods_id,
					'sku_id' => $sku_id,
					'price' => $price,
				);
				Db::name('order')->insert($data);
				
				//库存减少
				$res =  Db::name('store')->where('sku_id',$sku_id)->dec('number',$number)->update();
				if($res){  
					insertLog('decr success',1);
				}else{  
					insertLog('decr fail',-1);
				} 
			}else{
				insertLog('store is done',0);
			}
		}
	}