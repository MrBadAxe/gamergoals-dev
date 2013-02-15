<?

include_once './classes/AccountHandler.php';

if($_POST['user'] && $_POST['pass']){
	$vUser = $_POST['user'];
	$vPass = $_POST['pass'];

	$accth = AccountHandler::getInstance();
	if($accth->validateLogin($user,$pass));
	{
		/* create cookie */
		/* redirect to home */
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login | GamerGoals</title>
</head>
<body>
	<h1>Login</h1>
	<form>
	<label>Username</label>
	<input name="user" type="text" /><br/>
	<label>Password</label>
	<input name="pass" type="password" /><br/>
	<input name="submit" type="submit" />
	</form>
</body>
</html>
