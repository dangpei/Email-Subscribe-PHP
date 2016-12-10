
var clientInfo="";
$(document).ready(function(){  
        var url = 'http://chaxun.1616.net/s.php?type=ip&output=json&callback=?&_='+Math.random();    
        $.getJSON(url, function(data){ 
		clientInfo=data.Ip;
        });   
});
function sendMailAddressToServer()
{
	var xmlhttp;
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	postEmailAndIp();
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
	 alert("感谢您的订阅！");
	sendMailAddressToServer();
}
function postEmailAndIp(){
  $.post("http://localhost/kedao/receiveinfo.php",{SubscribeEmailInput:$('#exampleInputEmail1').val(),clientInfo:clientInfo},
  function(data){
	  alert(data);
  },
  "text");
}
