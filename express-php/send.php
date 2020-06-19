<?php
	
//新增发单消息
	
	//1.校验参数是否存在--订单号为空
	
	//2.设置要插入的数据
	$Ono = $_POST['Ono']; 
	$sendSno = $_POST['sendSno']; 
	$Sphone = $_POST['Sphone'];
	$ReceiveAddress = $_POST['ReceiveAddress'];
	$SendAddress = $_POST['SendAddress'];
	$Sname = $_POST['Sname'];
	
	$link = mysqli_connect('localhost', 'root', 'root', 'express');
	mysqli_set_charset($link, 'utf8');
	$sql = "select * from orders where Ono='$Ono'";
	$res = mysqli_query($link, $sql);
	
	if(empty($_POST['Ono'])){
		$result = array('code'=>1,'msg'=>'订单号不可为空');
		echo json_encode($result);
	}else if(empty($_POST['SendAddress'])){
		$result = array('code'=>1,'msg'=>'取件地址不可为空');
		echo json_encode($result);
	}else if(empty($_POST['Sname'])){
		$result = array('code'=>1,'msg'=>'姓名不可为空');
		echo json_encode($result);
	}else if(empty($_POST['Sphone'])){
		$result = array('code'=>1,'msg'=>'电话号码不可为空');
		echo json_encode($result);
	}else if(empty($_POST['ReceiveAddress'])){
		$result = array('code'=>1,'msg'=>'收件地址不可为空');
		echo json_encode($result);
	}
	
	else if (mysqli_num_rows($res)) {
		$result = array('code'=> -1,'msg'=>'订单号已存在');
		echo json_encode($result);
	} else {
		$sql = "insert into orders(Ono,Sphone,ReceiveAddress,SendAddress,sendSno,Sname) values ('$Ono', '$Sphone','$ReceiveAddress','$SendAddress','$sendSno','$Sname')";
		$res = mysqli_query($link, $sql);
		if(mysqli_affected_rows($link)){
			$result = array('code'=>0,'msg'=>'数据添加成功');
			echo json_encode($result);
		}else{
			$result = array('code'=>2,'msg'=>'数据添加失败');
			echo json_encode($result);
		}
	}

?>