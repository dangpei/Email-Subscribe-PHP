<!DOCTYPE html>
<!--流程：用户输入邮箱后点击订阅->js获取用户IP，检查邮箱格式->
php脚本检查是否存在同一IP恶意输入的情况(设置10分钟内最多注册3次)、检查邮箱是否重复->
满足所有条件后写入数据库（订阅成功）
-->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Email Subscription</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/email-subscription.css" />
</head>
<script src="http://lib.sinaapp.com/js/jquery/1.8.3/jquery.min.js"></script>  
<script type="text/javascript"> 
var clientInfo="";
$(document).ready(function(){  
        var url = 'http://chaxun.1616.net/s.php?type=ip&output=json&callback=?&_='+Math.random();    
        $.getJSON(url, function(data){ 
        //data.Ip+data.Isp+data.Browser+data.OS);  
		clientInfo=data.Ip;
        });   
});
function sendMailAddressToServer()
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		//  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		// IE6, IE5 浏览器执行代码
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			//document.getElementById("responseDiv").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST","http://localhost/emailsubscription.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("SubscribeEmailInput="+document.getElementById("exampleInputEmail1").value+"&clientInfo="+clientInfo);
}

function checkEmailFormat()
{
	var mailstr=document.getElementById("exampleInputEmail1").value;
	if(mailstr=="")
	{
		alert("邮箱不能为空！");
		return;
	}
	var reg = /^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/gi;
    if(!reg.test(mailstr))
    {
        alert("邮箱格式不正确！");
        return;
    }
	sendMailAddressToServer();
}
  
</script>
<body>


	<main>



		<form>
			
			<h1> Email Subscription</h1>

			<br />
			<br />

			<div class="form-group wrapper">
				
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
			    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				
				<button type="submit" class="btn btn-primary" onclick="checkEmailFormat()">Submit</button>

		  	</div>
			
			

		</form>
		
	</main>
	
</body>
</html>
