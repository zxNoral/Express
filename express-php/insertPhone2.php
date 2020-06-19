<?php

//判断:该单是否被接
	$Ono = $_POST['Ono']; 
	
	$link = mysqli_connect('localhost', 'root', 'root', 'express');
	mysqli_set_charset($link, 'utf8');
	
	$sqlb = " select Ono from orders where Phone is null and Ono='$Ono' ";
	$resb = mysqli_query($link,$sqlb);
	
	if (mysqli_num_rows($resb)){
		$resultb = array('code' => 2, 'msg'=>'该单可接');	
	}else{
		$resultb = array('code' => -2, 'msg'=>'该单已被接');
	}
	
	echo json_encode($resultb);
?>