<?php

//获取投诉信息总数和接单总数信息

	$Sno = $_POST['Sno']; 
	
	$link = mysqli_connect('localhost', 'root', 'root', 'express');
	mysqli_set_charset($link, 'utf8');
	
	$sql = "select * from orders where Sno='$Sno'";
	$res = mysqli_query($link, $sql);
	
	//当订单状态是已完成时，才计算投诉信息总数和接单总数
	if (mysqli_num_rows($res)) {
		$sqlz = "select count(Complaints) from orders where Sno='$Sno' and Complaints is not null and Status = '已完成' ";
		$resz = mysqli_query($link, $sqlz);
		$arrz = mysqli_fetch_all($resz, MYSQLI_ASSOC);
				
		$sqla = "select count(Ono) from orders where Sno='$Sno' and Status = '已完成' ";
		$resa = mysqli_query($link, $sqla);
		$arra = mysqli_fetch_all($resa, MYSQLI_ASSOC);
				
		if(mysqli_affected_rows($link)){
			foreach($arrz as $val){
				$complaintsCounts = ($val["count(Complaints)"]);
			}
			foreach($arra as $val){
				$receiveCounts = ($val["count(Ono)"]);
			}
			$result = array('complaintsCounts'=>$complaintsCounts,'receiveCounts'=> $receiveCounts, 'code'=>0,'msg'=>'数据获取成功');
		}else{
			$result = array('code'=>2,'msg'=>'数据获取失败');
		}
		echo json_encode($result);
	}

?>