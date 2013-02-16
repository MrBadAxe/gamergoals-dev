<?

include_once './classes/AccountHandler.php';

if($_POST['user'] && $_POST['pass1'] && $_POST['pass2'] && $_POST['email']){
	$vUser = $_POST['user'];
	$vPass1 = $_POST['pass1'];
	$vPass2 = $_POST['pass2'];
	$vEmail = $_POST['email'];

	$accth = AccountHandler::getInstance();
	if($vPass1 != $vPass2){
		/* set error message, 'your passwords must match' */
	}elseif($accth::getAccountByName($vUser) == NULL){
		/* set error message, 'account name already taken' */
	}else{
		/* create account */
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register | GamerGoals</title>
</head>
<body>
	<h1>Register</h1>
	<form>
	<label>Username</label>
	<input name="user" type="text" /><br/>
	<label>Password</label>
	<input name="pass1" type="password" /><br/>
	<input name="submit" type="submit" />
	</form>
</body>
</html>
