<?

include_once './AccountHandler.php';
use GamerGoals\AccountHandler;
$errorMessage = "";

if(isset($_POST['user']) && isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['email'])){
	$vUser = $_POST['user'];
	$vPass1 = $_POST['pass1'];
	$vPass2 = $_POST['pass2'];
	$vEmail = $_POST['email'];

	$accth = AccountHandler::getInstance();
	if($vPass1 != $vPass2){
		$errorMessage = "Your passwords must match.";
	}elseif($accth->accountFromName($vUser) != NULL){
		$errorMessage = "Username '".$vUser."' not available.";
	}else{
		$errorMessage = "creating account...";
		try{
			$accth->createAccount($vUser,$vPass1,$vEmail);
			header("Location: ./redirect.php?mode=1");
		}catch(Exception $e){
			$errorMessage = "Error creating account.";
		}
		
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
	<h2><?=$errorMessage?></h2>
	<form method="post" action="register.php">
		<label>Username</label>
		<input name="user" type="text" /><br/>

		<label>Password</label>
		<input name="pass1" type="password" /><br/>

		<label>Repeat Password</label>
		<input name="pass2" type="password" /><br/>

		<label>Email Address</label>
		<input name="email" type="text" /><br/>

		<input name="submit" type="submit" />
	</form>
</body>
</html>
