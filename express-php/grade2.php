<?php

//将义工学分添加至数据库
	$Sno = $_POST['Sno']; 
	$Grade = $_POST['Grade']; 
	
	$link = mysqli_connect('localhost', 'root', 'root', 'express');
	mysqli_set_charset($link, 'utf8');
	
	$sql = "select * from volunteer where Sno='$Sno'";
	$res = mysqli_query($link, $sql);
	
	if (mysqli_num_rows($res)) {
		$sql = "update volunteer set Grade = '$Grade' where Sno='$Sno' ";
		$res = mysqli_query($link, $sql);
		
		if(mysqli_affected_rows($link)){
			$result = array('code'=>0,'msg'=>'学分记录添加成功');
		}else{
			$result = array('code'=>-1,'msg'=>'学分记录添加失败');
		}
		echo json_encode($result);
	}
	
?>