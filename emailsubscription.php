


<?php
checkRepeatIp();
doPost();
function doPost()
{
	$res="";
	$ipAddress = $_POST["clientInfo"];
	$email = $_POST["SubscribeEmailInput"];
	if($email!=""||$ipAddress!="")
	{
		date_default_timezone_set('PRC');
		$time = time();
		$formateTime = date("Y-m-d H:i:s",$time);
		$con = new mysqli('localhost', 'root', '','kedaoindex');　
		$result = $con -> query('SELECT * FROM temp_ip WHERE ipaddress='{$ipAddress}'');　　
		$ipshowtimes = 0;
		while($row = $result -> fetch_row()) 
		{	
			$res .= $row[0]."  ";
			$ipshowtimes++;	
		}
		if($ipshowtimes >= 3)//超过3个不可以继续添加
		{
			
			echo "Subscribe Frequently！操作过于频繁，请稍后再试";
		}
		else
		{
			$result = $con -> query('SELECT * FROM subscribe_email WHERE email='{$email}'');　　
			$emailshowtimes = 0;//email出现的次数
			while($row = $result -> fetch_row()) 
			{	
				$emailshowtimes++;	
			}
			if($emailshowtimes>0)
			{
				echo "This E-mail address is existed！该邮箱已存在！";
			}
			else
			{
				$con -> query('INSERT INTO temp_ip (ipaddress,datetime,other) VALUES ('{$ipAddress}','{$formateTime}','null')');　	
				$con -> query('INSERT INTO subscribe_email (email,datetime,other) VALUES ('{$email}','{$formateTime}','null')');　	
				echo "Subscribe Successfully！订阅成功！";
			}
		}
	}
	else
	{
		echo "Illegal access!";
	}
}
function checkRepeatIp()
{
	$con = new mysqli('localhost', 'root', '','kedaoindex');　
	$result = $con -> query('SELECT * FROM temp_ip');　　
	$res = "";
	while ($row = $result -> fetch_row()) 
	{	
		$thisDateTime = $row[2];
		date_default_timezone_set('PRC');
		$time = time();
		$nowTime = strtotime(date("Y-m-d H:i:s",$time)); //当前时间
		$subscribeTime = strtotime ($thisDateTime);  
		$diff = ceil(($nowTime-$subscribeTime));//时间差 单位：分钟
		$res .= date("Y-m-d H:i:s",$time)." ".$thisDateTime." ".$diff."</br>";
		if ($diff > 600)//清理超过600秒的IP地址
		{
			$con -> query('DELETE FROM temp_ip WHERE ord = '{$row[0]}'');　
		}
	}
}
?>

