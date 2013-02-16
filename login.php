<?
include_once './classes/AccountHandler.php';
use GamerGoals\AccountHandler;

$errorMessage = "";

if(isset($_POST['user']) && isset($_POST['pass'])){
	$vUser = $_POST['user'];
	$vPass = $_POST['pass'];

	$accth = AccountHandler::getInstance();
	try{
		$vResult = $accth->validateLogin($user,$pass);
	}catch(Exception $e){
		$errorMessage = $e->getMessage();
	}
	$errorMessage = "Success! Should be logged in now...";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login | GamerGoals</title>
</head>
<body>
	<h1>Login</h1>
	<h2><?=$errorMessage?></h2>
	<form method="post" action="login.php">
	<label>Username</label>
	<input name="user" type="text" /><br/>
	<label>Password</label>
	<input name="pass" type="password" /><br/>
	<input name="submit" type="submit" />
	</form>
</body>
</html>
