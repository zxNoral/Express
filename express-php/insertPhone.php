<?php

//接单时，输入接单人联系方式，将phone添加到数据库
	$Ono = $_POST['Ono']; 
	$Phone = $_POST['Phone'];
	$Sno = $_POST['Sno'];
	
	$link = mysqli_connect('localhost', 'root', 'root', 'express');
	mysqli_set_charset($link, 'utf8');
	
//1.先判断:该义工输入的联系方式和学号是否与volunteer表匹配
	$sqla = " select Ono from orders,volunteer where volunteer.Phone = '$Phone' and volunteer.Sno = '$Sno' and Ono='$Ono' ";
	$resa = mysqli_query($link,$sqla);
	
	if (mysqli_num_rows($resa)){
		$resulta = array('code' => 1, 'msg'=>'该义工联系方式正确');
	}else{
		$resulta = array('code' => -1, 'msg'=>'该义工联系方式错误或联系方式与学号不匹配');
	}
	
	
//2.判断:义工能否接自己的单子，用Ono，定位phone的插入位置
	$sql = "select * from orders where Ono='$Ono'";
	$res = mysqli_query($link, $sql);

	if (mysqli_num_rows($res)) {
		$sqlc = " update orders set Phone = '$Phone', Sno = '$Sno', Status='已接单' where Ono='$Ono' and '$Sno' <> sendSno ";
		$resc = mysqli_query($link, $sqlc);
		if(mysqli_affected_rows($link)){
			$resultc = array('code' => 3, 'msg'=>'数据（代收人号码）添加成功');		
		}else{
			$resultc = array('code' => -3, 'msg'=>'数据（代收人号码）添加失败，因为不能接自己的发单')';
		}
	}	

	$result = array($resulta,$resultc); 
	echo json_encode($result);
?>