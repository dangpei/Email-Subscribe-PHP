


<?php
checkRepeatIp();
doPost();
function doPost()
{
	$res="";
	//获取、整理数据
	$ipAddress=$_POST["clientInfo"];
	$email=$_POST["SubscribeEmailInput"];
	date_default_timezone_set('PRC');
	$time = time();
	$formateTime=date("Y-m-d H:i:s",$time);
	//连接数据库
	$con = mysql_connect("localhost","root","");
	mysql_select_db("kedaoindex", $con);
	//准备SQL语句
	$sql="SELECT * FROM temp_ip WHERE ipaddress='".$ipAddress."'";
	$result=mysql_query($sql,$con);	
	$ipshowtimes=0;//ip出现的次数
	while($row = mysql_fetch_row($result)) 
	{	
		$res.=$row[0]."  ";
		$ipshowtimes++;	
	}
	if($ipshowtimes>=3)//超过3个不可以继续添加
	{
		
		echo "Subscribe Frequently！操作过于频繁，请稍后再试";
	}
	else
	{
		$sql="SELECT * FROM subscribe_email WHERE email='".$email."'";
		$result=mysql_query($sql,$con);	
		$emailshowtimes=0;//email出现的次数
		while($row = mysql_fetch_row($result)) 
		{	
			$emailshowtimes++;	
		}
		if($emailshowtimes>0)
		{
			echo "This E-mail address is existed！该邮箱已存在！";
		}
		else
		{
			$sql="INSERT INTO temp_ip (ipaddress,datetime,other) VALUES ('{$ipAddress}','{$formateTime}','null')";
			mysql_query($sql,$con);	
			$sql="INSERT INTO subscribe_email (email,datetime,other) VALUES ('{$email}','{$formateTime}','null')";
			mysql_query($sql,$con);	
			echo "Subscribe Successfully！订阅成功！";
		}
	}
}
function checkRepeatIp()
{
	$res="";
	$con = mysql_connect("localhost","root","");
	mysql_select_db("kedaoindex", $con);
	$sql="SELECT * FROM temp_ip";
	$result=mysql_query($sql,$con);	
	while($row = mysql_fetch_row($result)) 
	{	
		$thisDateTime=$row[2];
		date_default_timezone_set('PRC');
		$time = time();
		$nowTime=strtotime(date("Y-m-d H:i:s",$time)); //当前时间
		$subscribeTime=strtotime ($thisDateTime);  
		$diff=ceil(($nowTime-$subscribeTime));//时间差 单位：分钟
		$res.=date("Y-m-d H:i:s",$time)." ".$thisDateTime." ".$diff."</br>";
		if($diff>600)//清理超过600秒的IP地址
		{
			$sql="DELETE FROM temp_ip WHERE ord = '{$row[0]}'";
			mysql_query($sql,$con);	
		}
	}
	mysql_close($con);
}
?>

