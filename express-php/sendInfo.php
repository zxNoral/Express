<?php
	
//获取发单的详细消息
	
	$sendSno = $_POST['sendSno'];
	
	$link = mysqli_connect('localhost', 'root', 'root', 'express');
	mysqli_set_charset($link, 'utf8');
	
	$sql = " select Ono,Status,Phone from orders where sendSno = '$sendSno' ";
	$res = mysqli_query($link,$sql);
	$arr = mysqli_fetch_all($res, MYSQLI_ASSOC);
	
	if(mysqli_affected_rows($link)){
		$result = array('error_code'=>0,'msg' => '发单数据获取成功'); 
		foreach ($arr as $key => $value){	
			$result["data"][$key] = $value;
		}	
		echo json_encode($result);
	}else{
		$result = array('error_code'=>2,'msg'=>'没有发单记录');
		echo json_encode($result);
	}
?>