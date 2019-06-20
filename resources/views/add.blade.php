<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>POST</h1>
	
	<form action="/insert" method="post">
		{{ csrf_field() }}
		
		用户：<input type="text" name="uname" value=""><br><br>
		邮箱：<input type="text" name="email" value=""><br><br>
		<input type="submit" value="提交">
	</form>


	<h1>GET</h1>
	
	<form action="/insert2" method="get">
		用户：<input type="text" name="uname" value=""><br><br>
		邮箱：<input type="text" name="email" value=""><br><br>
		<input type="submit" value="提交">
	</form>
	
	
</body>
</html>