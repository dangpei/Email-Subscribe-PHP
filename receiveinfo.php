<?php
doPost();
function doPost()
{
	$ipAddress = $_POST["clientInfo"];
	$email = $_POST["SubscribeEmailInput"];
	if(strval($email)==null)
	{
		echo "Illegal request!";
	}
	else
	{
		$ch = curl_init();
		$str ='http://localhost:9999/kedao?ip='.$ipAddress.'&email='.$email;
		curl_setopt($ch, CURLOPT_URL, $str);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		if(strstr(trim(strval($output)),"OK"))
		{
			echo "SubscriptionSuccess!";
		}
		else
		{
			echo "SubscriptionFailed!";
		}
	}
	
}
?>