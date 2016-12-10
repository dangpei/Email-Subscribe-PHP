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
	<script src="http://lib.sinaapp.com/js/jquery/1.8.3/jquery.min.js"></script>  
	<script type="text/javascript" src="/kedao/js/indexjs.js">
</head>
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
