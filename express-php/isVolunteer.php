<?php

//是否为义工
	$Sno = $_POST['userSno']; 
	
	$link = mysqli_connect('localhost', 'root', 'root', 'express');
	mysqli_set_charset($link, 'utf8');
	$sql = "select * from volunteer where Sno='$Sno'";
	$res = mysqli_query($link, $sql);
	
	if (mysqli_num_rows($res)) {
		$result = array('code'=>0,'msg'=>'义工成员');
	}else{
		$result = array('code'=>2,'msg'=>'普通学生');
	}
	
	echo json_encode($result);
	
?>