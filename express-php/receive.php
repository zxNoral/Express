<?php

//获取接单数据
	$link = mysqli_connect('localhost', 'root', 'root', 'express');
	mysqli_set_charset($link, 'utf8');
	
//获取东区发单数据
	$sqlb = " select * from orders where ReceiveAddress like '东%区%' and Phone is null ";
	$resb = mysqli_query($link,$sqlb);
	$arrb = mysqli_fetch_all($resb, MYSQLI_ASSOC);
	
	if (mysqli_num_rows($resb)) {
		$resultb = array('error_code'=>1, 'msg' => '东校区数据获取成功');
		foreach ($arrb as $key => $value){	
			$resultb["data"][$key] = $value;
		}
	}else{
		$resultb = array('error_code'=>2, 'msg'=>'数据获取失败');
	}

//获取西区发单数据
	$sqlc = " select * from orders where ReceiveAddress like '西%区%' and Phone is null ";
	$resc = mysqli_query($link,$sqlc);
	$arrc = mysqli_fetch_all($resc, MYSQLI_ASSOC);
	
	if (mysqli_num_rows($resc)) {
		foreach ($arrc as $key => $value){	
			$resultc = array('error_code'=>3,'msg' => '西校区数据获取成功');
			$resultc["data"][$key] = $value;
		}
	}else{
		$resultc = array('error_code'=>4,'msg'=>'数据获取失败');
	}
	
//获取南区发单数据	
	$sqla = " select * from orders where ReceiveAddress like '南%区%' and Phone is null ";
	$resa = mysqli_query($link,$sqla);
	$arra = mysqli_fetch_all($resa, MYSQLI_ASSOC);
	
	if (mysqli_num_rows($resa)) {
		$resulta = array('error_code'=>5,'msg' => '南校区数据获取成功');
		foreach ($arra as $key => $value){	
			$resulta["data"][$key] = $value;
		}
	}else{
		$resulta = array('error_code'=>6,'msg'=>'数据获取失败');
	}
	
	$result = array($resultb,$resultc,$resulta); 
	echo json_encode($result);

?>