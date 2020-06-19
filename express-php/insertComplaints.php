<?php

//将投诉内容添加至数据库
	$Ono = $_POST['Ono']; 
	$Complaints = $_POST['Complaints'];
	
	$link = mysqli_connect('localhost', 'root', 'root', 'express');
	mysqli_set_charset($link, 'utf8');
	$sql = "select * from orders where Ono='$Ono'";
	$res = mysqli_query($link, $sql);
	
	if (mysqli_num_rows($res)) {
		$sql = "update orders set Complaints = '$Complaints' where Ono='$Ono' ";
		$res = mysqli_query($link, $sql);
		
		if(mysqli_affected_rows($link)){
			$result = array('code'=>0,'msg'=>'投诉成功');
		}else{
			$result = array('code'=>2,'msg'=>'投诉失败');
		}
		echo json_encode($result);
	}
	
?>