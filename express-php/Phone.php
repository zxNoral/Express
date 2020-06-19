<?php

//获取接单人（义工）手机号码
	$Ono = $_POST['Ono'];
	
	$link = mysqli_connect('localhost', 'root', 'root', 'express');
	mysqli_set_charset($link, 'utf8');
	
	$sql = "select * from orders where Ono='$Ono'";
	$res = mysqli_query($link, $sql);
	
	if (mysqli_num_rows($res)) {
		
		$sql = " select Phone from orders,volunteer where orders.Sno=volunteer.Sno and '$Ono'=orders.Ono ";
		
		$res = mysqli_query($link, $sql);
		if(mysqli_affected_rows($link)){
			$result = array('code'=>0,'msg'=>'数据更新成功');
		}else{
			$result = array('code'=>2,'msg'=>'数据更新失败');
		}
		echo json_encode($result);
	}

?>