<?php

//设置快递状态更新
	$Ono = $_POST['Ono'];
	
	$link = mysqli_connect('localhost', 'root', 'root', 'express');
	mysqli_set_charset($link, 'utf8');
	
	$sql = "select * from orders where Ono='$Ono'";
	$res = mysqli_query($link, $sql);
	
	if (mysqli_num_rows($res)) {
		$sql = "update orders set Status = '等待确认收货' where Ono='$Ono' ";
		$res = mysqli_query($link, $sql);
		if(mysqli_affected_rows($link)){
			$result = array('code'=>0,'msg'=>'数据更新成功');
			echo json_encode($result);
		}else{
			$result = array('code'=>2,'msg'=>'数据更新失败');
			echo json_encode($result);
		}
	}

?>