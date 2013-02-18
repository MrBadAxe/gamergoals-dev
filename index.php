<!DOCTYPE html>
<html>
<head>
<title>GamerGoals</title>
</head>
<body>

<h1>GamerGoals</h1>
<div>under construction</div><br/>

<? if(isset($_COOKIE['user'])){ ?>
	<div>welcome, <?=$_COOKIE['user']?></div>
	<a href="./logout.php">Logout</a><br/>
<? }else{ ?>
	<a href="./login.php">Login</a><br/>
	<a href="./register.php">Register</a><br/>
<? } ?>
</body>
</html>
