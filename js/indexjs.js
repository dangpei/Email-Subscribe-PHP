
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
	postEmailAndIp();
	//xmlhttp.open("POST","http://localhost/kedao/emailsubscription.php",true);
	//xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	//xmlhttp.send("SubscribeEmailInput="+document.getElementById("exampleInputEmail1").value+"&clientInfo="+clientInfo);
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
function postEmailAndIp(){
  $.post("http://localhost/kedao/emailsubscription.php",{SubscribeEmailInput:$('#exampleInputEmail1').val(),clientInfo:clientInfo},
  function(data){
	  alert(data);
  },
  "text");//这里返回的类型有：json,html,xml,text
}
